<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PharmacyScheduleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class PharmacyScheduleController extends Controller
{
    public function __construct(
        protected PharmacyScheduleService $scheduleService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'status' => 'nullable|in:0,1',
        ]);

        $data = [
            'schedules' => $this->scheduleService->getPharmacySchedules([
                'status' => $request->status ?? null,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.pharmacy-schedule.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'days'        => 'required|string|max:30',
            'start_time'  => 'required|date',
            'end_time'    => 'required|date|after:start_time',
            'status'      => 'required|in:0,1',
            'sort'        => 'nullable|integer|min:0',
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

        $response = $this->scheduleService->create($request);

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
            'schedule' => $this->scheduleService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.pharmacy-schedule.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'days'        => 'required|string|max:30',
            'start_time'  => 'required|date',
            'end_time'    => 'required|date|after:start_time',
            'status'      => 'required|in:0,1',
            'sort'        => 'nullable|integer|min:0',
        ]);

        $response = $this->scheduleService->update($request);

        if ($response['status']) {
            return redirect()->route('pharmacy-schedule.index')->with('success', 'Pharmacy Schedule Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->scheduleService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Pharmacy Schedule Deleted Successfully');
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

        $isUpdated = $this->scheduleService->updateStatus($request->id);

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
