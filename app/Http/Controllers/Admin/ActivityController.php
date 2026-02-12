<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ActivityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ActivityController extends Controller
{
    public function __construct(
        protected ActivityService $activityService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'title' => 'nullable|string|max:100',
            'type' => 'nullable|in:UPCOMING,CURRENT',
            'author' => 'nullable|string|max:100',
        ]);

        $data = [
            'activities' => $this->activityService->getActivities([
                'title' => $request->title ?? null,
                'type' => $request->type ?? null,
                'author' => $request->author ?? null,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.activity.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'type' => 'required|in:UPCOMING,CURRENT',
            'status' => 'required|in:0,1',
            'description' => 'required|string',
            'images' => 'required',
            'sort' => 'required|integer',
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

        $isCreated = $this->activityService->create($request);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Activity Created Successfully'],
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
            'activity' => $this->activityService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.activity.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:100',
            'type' => 'required|in:UPCOMING,CURRENT',
            'status' => 'required|in:0,1',
            'description' => 'required|string',
            'images' => 'nullable',
            'sort' => 'required|integer',
        ]);

        $isUpdated = $this->activityService->update($request);

        if ($isUpdated) {
            return redirect()->route('activity.index')->with('success', 'Activity updated successfully');
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

        $isUpdated = $this->activityService->updateStatus($request->id);

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

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->activityService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Activity Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
