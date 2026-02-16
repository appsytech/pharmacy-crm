<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\DoctorService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class DoctorController extends Controller
{
    public function __construct(
        protected DoctorService $doctorService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'fullName' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:100',
        ]);

        $data = [
            'doctors' => $this->doctorService->getDoctors([
                'name' => $request->name ?? null,
                'userName' => $request->username,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.doctor.index', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:150',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:150|unique:doctors,email',
            'password' => 'required|string|min:8|max:255|confirmed',
            'consultation_fee' => 'nullable|numeric|min:0',
            'role'          => 'required|string|max:100',
            'profile_image' => 'nullable|file',
            'speciality' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'experience' => 'nullable|integer|min:0',
            'description' => 'nullable|string', //
            'status' => 'required|in:ACTIVE,INACTIVE,ONLEAVE',
            'position' => 'required|in:JUNIOR,SENIOR,CONSULTANT,HEAD',
            'license_number' => 'required|string|max:50|unique:doctors,license_number',
            'join_date' => 'nullable|date',
            'availability' => 'nullable|string',
            'fb_profile' => 'nullable|url|max:255',
            'linkedin_profile' => 'nullable|url|max:255',
            'twitter_profile' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:150',
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

        $response = $this->doctorService->create($request);

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
            'doctor' => $this->doctorService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.doctor.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'full_name' => 'required|string|max:150',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|email|max:150|unique:doctors,email,' . $request->id,
            'password' => 'nullable|string|min:8|max:255|confirmed',
            'consultation_fee' => 'nullable|numeric|min:0',
            'role'          => 'required|string|max:100',
            'profile_image' => 'nullable|file',
            'speciality' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'experience' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'nullable|in:ACTIVE,INACTIVE,ONLEAVE',
            'position' => 'required|in:JUNIOR,SENIOR,CONSULTANT,HEAD',
            'license_number' => 'required|string|max:50|unique:doctors,license_number,' . $request->id,
            'join_date' => 'nullable|date',
            'availability' => 'nullable|string',
            'fb_profile' => 'nullable|url|max:255',
            'linkedin_profile' => 'nullable|url|max:255',
            'twitter_profile' => 'nullable|url|max:255',
            'location' => 'nullable|string|max:150',
        ]);

        $response = $this->doctorService->update($request);

        if ($response['status']) {
            return redirect()->route('doctor.index')->with('success', 'Admin Updated Successfully');
        } else {
            return redirect()->back()->withErrors($response['message']);
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->doctorService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Doctor Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
