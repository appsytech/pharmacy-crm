<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\TestimonialService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function __construct(
        protected TestimonialService $testimonialService
    ) {}


    public function index(Request $request): View
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'email' => 'nullable|string|max:100',
        ]);

        $data = [
            'testimonials' => $this->testimonialService->getTestimonials([
                'name' => $request->name ?? null,
                'email' => $request->email,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.testimonial.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:150',
            'email'       => 'nullable|email|max:150',
            'company'     => 'nullable|string|max:150',
            'position'    => 'nullable|string|max:150',
            'image'       => 'nullable|file|max:255',
            'stars'       => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'sort'        => 'nullable|integer|min:0',
            'status'      => 'required|in:PENDING,APPROVED,REJECTED',
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

        $response = $this->testimonialService->create($request);

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
            'testimonial' => $this->testimonialService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.testimonial.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'name'        => 'required|string|max:150',
            'email'       => 'nullable|email|max:150',
            'company'     => 'nullable|string|max:150',
            'position'    => 'nullable|string|max:150',
            'image'       => 'nullable|file|max:255',
            'stars'       => 'required|integer|min:1|max:5',
            'description' => 'required|string',
            'sort'        => 'nullable|integer|min:0',
            'status'      => 'required|in:PENDING,APPROVED,REJECTED',
        ]);

        $response = $this->testimonialService->update($request);

        if ($response['status']) {
            return redirect()->route('testimonial.index')->with('success', 'Testimonial Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->testimonialService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Testimonial Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
