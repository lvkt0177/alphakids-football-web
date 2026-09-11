<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ActivityMediaType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Activity\ActivityRequest;
use App\Models\Activity;
use App\Models\ActivityImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
    /**
     * Video extensions accepted in the gallery. Checked against the file's
     * real content (Laravel's `mimes` rule sniffs actual bytes, not the
     * client-supplied Content-Type), not just the name - a renamed .exe
     * cannot pass as a .mp4 here.
     */
    private const VIDEO_EXTENSIONS = ['mp4', 'mov', 'webm', 'm4v'];

    /**
     * KB, matches Laravel's `max` rule unit. The brief is "video > 300MB" -
     * this gives headroom above that so an admin's video isn't rejected a
     * few MB over the requirement.
     */
    private const MAX_VIDEO_KB = 512000; // 500MB

    private const MAX_IMAGE_KB = 30720; // 30MB, unchanged from the cover image rule

    public function index()
    {
        $activities = Activity::ordered()->paginate(20);

        return view('admin.activity.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activity._form', ['activity' => new Activity()]);
    }

    public function store(ActivityRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('activity', 'public');
        }

        $activity = Activity::create($data);

        $this->syncGalleryState($request, $activity);

        return redirect()->route('admin.activity.index')->with('success', 'Thêm hoạt động thành công.');
    }

    public function edit(Activity $activity)
    {
        $activity->load('images');

        return view('admin.activity._form', compact('activity'));
    }

    public function update(ActivityRequest $request, Activity $activity)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($activity->image) {
                Storage::disk('public')->delete($activity->image);
            }
            $data['image'] = $request->file('image')->store('activity', 'public');
        }

        $activity->update($data);

        $this->syncGalleryState($request, $activity);

        return redirect()->route('admin.activity.index')->with('success', 'Cập nhật hoạt động thành công.');
    }

    /**
     * Upload one gallery photo or video to temp storage the moment it's
     * picked - this is what keeps a 500MB video (or a dozen heavy photos)
     * out of the main form's request body, so choosing lots of heavy media
     * can never trip post_max_size. Nothing here is final: the file just
     * sits in activity/gallery-temp until syncGalleryState() promotes it,
     * which only happens if the admin actually submits the form.
     *
     * Type is decided here from the file itself (extension + sniffed
     * content), never from client input - the picker lets an admin choose
     * images and videos in the same batch, so the server has to tell them
     * apart on its own.
     *
     * Not scoped to an activity - the create form has to be able to call
     * this before an Activity row even exists, and the temp folder was
     * never per-activity to begin with.
     */
    public function uploadTempMedia(Request $request)
    {
        if (! $request->hasFile('file')) {
            // PHP silently drops the whole upload (empty $_FILES) when the
            // file exceeds upload_max_filesize/post_max_size - that's the
            // single most likely failure mode for a >300MB video and it
            // never reaches Laravel's validator, so it needs its own
            // message instead of a generic "required" error.
            return response()->json([
                'message' => 'File quá lớn hoặc máy chủ từ chối tải lên (vượt giới hạn cấu hình). Vui lòng kiểm tra lại dung lượng file.',
            ], 413);
        }

        /** @var UploadedFile $file */
        $file = $request->file('file');

        if (! $file->isValid()) {
            return response()->json([
                'message' => 'Tải file lên thất bại (lỗi: ' . $file->getErrorMessage() . ').',
            ], 422);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $isVideo = in_array($extension, self::VIDEO_EXTENSIONS, true);

        $validator = Validator::make(
            ['file' => $file],
            $isVideo
                ? ['file' => ['required', 'file', 'mimes:' . implode(',', self::VIDEO_EXTENSIONS), 'max:' . self::MAX_VIDEO_KB]]
                : ['file' => ['required', 'image', 'max:' . self::MAX_IMAGE_KB, Rule::dimensions()->maxWidth(8000)->maxHeight(8000)]],
            [
                'file.mimes' => 'Video phải ở định dạng MP4, MOV hoặc WebM.',
                'file.max' => $isVideo ? 'Video không được vượt quá 500MB.' : 'Hình ảnh không được vượt quá 30MB.',
                'file.image' => 'File tải lên phải là hình ảnh hoặc video (MP4, MOV, WebM).',
                'file.dimensions' => 'Ảnh có độ phân giải quá lớn (tối đa 8000x8000px). Vui lòng dùng ảnh nhỏ hơn.',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 422);
        }

        $tempPath = $file->store('activity/gallery-temp', 'public');

        return response()->json([
            'temp_path' => $tempPath,
            'url' => asset('storage/' . $tempPath),
            'type' => $isVideo ? ActivityMediaType::VIDEO->value : ActivityMediaType::IMAGE->value,
        ]);
    }

    /**
     * Apply the gallery to whatever the admin left it as on submit: existing
     * photos not present in gallery_state were deleted in the UI, remaining
     * ones are re-numbered to the submitted order, and "new" entries point at
     * temp uploads that get promoted into real ActivityImage rows here - the
     * one moment gallery changes actually take effect.
     */
    private function syncGalleryState(Request $request, Activity $activity): void
    {
        $state = json_decode($request->input('gallery_state', '[]'), true);
        $state = is_array($state) ? $state : [];

        $keepIds = collect($state)
            ->where('type', 'existing')
            ->pluck('id')
            ->map(fn ($id) => (int) $id);

        ActivityImage::query()
            ->where('activity_id', $activity->id)
            ->whereNotIn('id', $keepIds)
            ->get()
            ->each(function (ActivityImage $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            });

        foreach ($state as $index => $item) {
            if (($item['type'] ?? null) === 'existing') {
                ActivityImage::query()
                    ->where('activity_id', $activity->id)
                    ->where('id', (int) ($item['id'] ?? 0))
                    ->update(['sort_order' => $index]);

                continue;
            }

            if (($item['type'] ?? null) !== 'new') {
                continue;
            }

            $tempPath = (string) ($item['temp_path'] ?? '');

            // The temp path only ever comes from uploadTempMedia(), but it's
            // still client-supplied input - refuse anything that isn't
            // actually inside the temp gallery folder before touching disk.
            if (! Str::startsWith($tempPath, 'activity/gallery-temp/') || Str::contains($tempPath, '..')) {
                continue;
            }

            if (! Storage::disk('public')->exists($tempPath)) {
                continue;
            }

            $finalPath = Str::replaceFirst('activity/gallery-temp/', 'activity/gallery/', $tempPath);
            Storage::disk('public')->move($tempPath, $finalPath);

            // Re-derived from the file itself, same as uploadTempMedia() - the
            // "new" item's client-supplied type is never trusted here either.
            $extension = strtolower(pathinfo($finalPath, PATHINFO_EXTENSION));
            $isVideo = in_array($extension, self::VIDEO_EXTENSIONS, true);

            ActivityImage::create([
                'activity_id' => $activity->id,
                'image' => $finalPath,
                'type' => $isVideo ? ActivityMediaType::VIDEO : ActivityMediaType::IMAGE,
                'sort_order' => $index,
            ]);
        }
    }

    public function destroy(Activity $activity)
    {
        if ($activity->image) {
            Storage::disk('public')->delete($activity->image);
        }

        $activity->images->each(fn (ActivityImage $image) => Storage::disk('public')->delete($image->image));

        $activity->delete();

        return redirect()->route('admin.activity.index')->with('success', 'Xóa hoạt động thành công.');
    }
}