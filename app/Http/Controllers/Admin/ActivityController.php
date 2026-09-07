<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Activity\ActivityRequest;
use App\Models\Activity;
use App\Models\ActivityImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
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

        Activity::create($data);

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
     * Upload one gallery photo to temp storage the moment it's picked - this
     * is what keeps a 30MB photo (or a dozen of them) out of the main form's
     * request body, so choosing lots of heavy photos can never trip
     * post_max_size. Nothing here is final: the file just sits in
     * activity/gallery-temp until syncGalleryState() promotes it, which only
     * happens if the admin actually submits the form.
     */
    public function uploadTempImage(Request $request, Activity $activity)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:30720', Rule::dimensions()->maxWidth(8000)->maxHeight(8000)],
        ]);

        $tempPath = $request->file('image')->store('activity/gallery-temp', 'public');

        return response()->json([
            'temp_path' => $tempPath,
            'url' => asset('storage/' . $tempPath),
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

            // The temp path only ever comes from uploadTempImage(), but it's
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

            ActivityImage::create([
                'activity_id' => $activity->id,
                'image' => $finalPath,
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