<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ServiceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService
    ) {}




    public function index(Request $request): View
    {
        $request->validate([
            'title' => 'nullable|string|max:100',
            'status' => 'nullable|integer|in:0,1',
        ]);

        $data = [
            'services' => $this->serviceService->getServices([
                'title' => $request->title ?? null,
                'status' => $request->status,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.service.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title'               => 'required|string|max:255',
            'icon'                => 'required|file',
            'description'         => 'nullable|string',
            'location'            => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'images1'             => 'nullable|file',
            'images2'             => 'nullable|file',
            'images3'             => 'nullable|file',
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

        return $this->serviceService->create($request);
    }

    public function edit(Request $request): View
    {
        $data = [
            'service' => $this->serviceService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.service.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'title'               => 'required|string|max:255',
            'icon'                => 'nullable|file',
            'description'         => 'nullable|string',
            'location'            => 'nullable|string|max:255',
            'mission_description' => 'nullable|string',
            'images1'             => 'nullable|file',
            'images2'             => 'nullable|file',
            'images3'             => 'nullable|file',
            'status'              => 'required|integer|in:0,1',
            'sort'               => 'required|integer|min:0'
        ]);

        $isUpdated = $this->serviceService->update($request);

        if ($isUpdated) {
            return redirect()->route('service.index')->with('success', 'Service Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->serviceService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Service Deleted Successfully');
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

        $isUpdated = $this->serviceService->updateStatus($request->id);

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
