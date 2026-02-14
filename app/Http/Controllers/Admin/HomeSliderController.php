<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\HomeSliderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeSliderController extends Controller
{
    public function __construct(
        protected HomeSliderService $homeSliderService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'type' => 'nullable|string|max:100',
            'status' => 'nullable|in:0,1',
        ]);

        $data = [
            'sliders' => $this->homeSliderService->getHomeSliders([
                'type' => $request->type ?? null,
                'status' => $request->status,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.homepage-slider.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'images' => 'required|file',
            'type' => 'required|string|max:50',
            'status' => 'required|boolean',
            'device_type' => 'required|integer|in:0,1,2', // 0 = web , 1 = android 2 = h5
            'description' => 'nullable|string',
            'jump_type' => 'nullable|string|in:ABOUT,ACTIVITY,ADMISSION',
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

        $isCreated = $this->homeSliderService->create($request);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Homepage Slider Created Successfully'],
                'errors' => null,
                'data' => null,
            ], 200);
        } else {

            return response()->json([
                'status' => false,
                'code' => 500,
                'messages' => ['Something went wrong'],
                'errors' => ['Something went wrong'],
                'data' => null,
            ], 500);
        }
    }

    public function edit(Request $request): View
    {
        $data = [
            'slider' => $this->homeSliderService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.homepage-slider.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'images' => 'nullable|file',
            'type' => 'required|string|max:50',
            'status' => 'required|boolean',
            'device_type' => 'required|integer|in:0,1,2', // 0 = web , 1 = android 2 = h5
            'description' => 'nullable|string',
            'jump_type' => 'nullable|string|in:ABOUT,ACTIVITY,ADMISSION',
        ]);

        $isUpdated = $this->homeSliderService->update($request);

        if ($isUpdated) {
            return redirect()->route('homepage-slider.index')->with('success', 'Homepage Slider Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->homeSliderService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Homepage Slider Deleted Successfully');
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

        $isUpdated = $this->homeSliderService->updateStatus($request->id);

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
