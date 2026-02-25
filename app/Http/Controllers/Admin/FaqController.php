<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\FaqService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function __construct(
        protected FaqService $faqService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'status' => 'nullable|in:0,1',
        ]);

        $data = [
            'faqs' => $this->faqService->getFaqs([
                'status' => $request->status ?? null,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.faq.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question'  => 'required|string|max:255',
            'answer'    => 'required|string',
            'status' => 'required|in:0,1',
            'sort'      => 'nullable|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'code' => 422,
                'messages' => ['Validation Error'],
                'errors' => $validator->errors()->all(),
                'data' => null,
            ], 422);
        }

        $response = $this->faqService->create($request);

        $code = $response['status'] ? 200 : 500;

        return response()->json([
            'status' => $response['status'],
            'code' => $code,
            'messages' => $response['message'],
            'errors' => null,
            'data' => null,
        ], $code);
    }

    public function edit(Request $request): View
    {
        $data = [
            'faq' => $this->faqService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.faq.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'question'  => 'required|string|max:255',
            'answer'    => 'required|string',
            'status' => 'required|in:0,1',
            'sort'      => 'nullable|integer|min:0',
        ]);

        $response = $this->faqService->update($request);

        if ($response['status']) {
            return redirect()->route('faq.index')->with('success', 'Faq Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->faqService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Faq Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'data' => null,
            ], 422);
        }

        $isUpdated = $this->faqService->updateStatus($request->id);

        if ($isUpdated) {
            return response()->json([
                'status' => true,
                'message' => 'Status Updated',
                'errors' => null,
                'data' => null,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'errors' => null,
                'data' => null,
            ], 500);
        }
    }
}
