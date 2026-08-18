<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Activity\ActivityRequest;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('admin.activity.index')->with('success', 'Cập nhật hoạt động thành công.');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->image) {
            Storage::disk('public')->delete($activity->image);
        }

        $activity->delete();

        return redirect()->route('admin.activity.index')->with('success', 'Xóa hoạt động thành công.');
    }
}