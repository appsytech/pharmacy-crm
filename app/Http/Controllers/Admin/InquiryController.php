<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\InquiryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function __construct(
        protected InquiryService $inquiryService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'email' => 'nullable|string|max:100',
        ]);

        $data = [
            'inquiries' => $this->inquiryService->getInquiries([
                'email' => $request->email ?? null,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.inquiry.index', compact('data'));
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->inquiryService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Inquiry Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
