<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ActivityCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ActivityCategoryController extends Controller
{
    public function __construct(
        protected ActivityCategoryService $activityCategoryService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'name' => 'nullable|string|max:100',
            'status' => 'nullable|integer|in:0,1',
        ]);

        $data = [
            'activityCategories' => $this->activityCategoryService->getActivityCategories([
                'name' => $request->name ?? null,
                'status' => $request->status,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.activity-category.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|string|max:255',
            'status'              => 'required|integer|in:0,1',
            'sort'               => 'required|integer|min:0'
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

        return $this->activityCategoryService->create($request);
    }

    public function edit(Request $request): View
    {
        $data = [
            'activityCategory' => $this->activityCategoryService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.activity-category.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'name'               => 'required|string|max:255',
            'status'              => 'required|integer|in:0,1',
            'sort'               => 'required|integer|min:0'
        ]);

        $isUpdated = $this->activityCategoryService->update($request);

        if ($isUpdated) {
            return redirect()->route('activity-category.index')->with('success', 'Activity Category Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->activityCategoryService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Activity Category Deleted Successfully');
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

        $isUpdated = $this->activityCategoryService->updateStatus($request->id);

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
