<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Branch\BranchRequest;
use App\Models\Branch;
use Illuminate\Support\Facades\Storage;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::ordered()->paginate(20);

        return view('admin.branch.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branch._form', ['branch' => new Branch]);
    }

    public function store(BranchRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('branch', 'public');
        }

        Branch::create($data);

        return redirect()->route('admin.branch.index')->with('success', 'Thêm cơ sở thành công.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branch._form', compact('branch'));
    }

    public function update(BranchRequest $request, Branch $branch)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($branch->image) {
                Storage::disk('public')->delete($branch->image);
            }
            $data['image'] = $request->file('image')->store('branch', 'public');
        }

        $branch->update($data);

        return redirect()->route('admin.branch.index')->with('success', 'Cập nhật cơ sở thành công.');
    }

    public function destroy(Branch $branch)
    {
        if ($branch->image) {
            Storage::disk('public')->delete($branch->image);
        }

        $branch->delete();

        return redirect()->route('admin.branch.index')->with('success', 'Xóa cơ sở thành công.');
    }
}
