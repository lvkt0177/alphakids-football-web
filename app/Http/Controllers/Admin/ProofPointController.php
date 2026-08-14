<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProofPoint\ProofPointRequest;
use App\Models\ProofPoint;

class ProofPointController extends Controller
{
    public function index()
    {
        $proofPoints = ProofPoint::ordered()->paginate(20);

        return view('admin.proof-point.index', compact('proofPoints'));
    }

    public function create()
    {
        return view('admin.proof-point._form', ['proofPoint' => new ProofPoint()]);
    }

    public function store(ProofPointRequest $request)
    {
        ProofPoint::create($request->validated());

        return redirect()->route('admin.proof-point.index')->with('success', 'Thêm nội dung thành công.');
    }

    public function edit(ProofPoint $proofPoint)
    {
        return view('admin.proof-point._form', compact('proofPoint'));
    }

    public function update(ProofPointRequest $request, ProofPoint $proofPoint)
    {
        $proofPoint->update($request->validated());

        return redirect()->route('admin.proof-point.index')->with('success', 'Cập nhật nội dung thành công.');
    }

    public function destroy(ProofPoint $proofPoint)
    {
        $proofPoint->delete();

        return redirect()->route('admin.proof-point.index')->with('success', 'Xóa nội dung thành công.');
    }
}
