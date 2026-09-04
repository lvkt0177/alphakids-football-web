<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\FaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::ordered()->paginate(20);

        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq._form', ['faq' => new Faq()]);
    }

    public function store(FaqRequest $request)
    {
        Faq::create($request->validated());

        return redirect()->route('admin.faq.index')->with('success', 'Thêm câu hỏi thành công.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq._form', compact('faq'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $faq->update($request->validated());

        return redirect()->route('admin.faq.index')->with('success', 'Cập nhật câu hỏi thành công.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.faq.index')->with('success', 'Xóa câu hỏi thành công.');
    }
}
