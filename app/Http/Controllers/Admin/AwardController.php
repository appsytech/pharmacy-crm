<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AwardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class AwardController extends Controller
{
    public function __construct(
        protected AwardService $awardService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'award_name' => 'nullable|string|max:100',
        ]);

        $data = [
            'awards' => $this->awardService->getAwards([
                'awardName' => $request->award_name ?? null,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.award.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'award_name' => 'required|string|max:255',
            'award_type' => 'nullable|string|max:100',
            'award_to' => 'nullable|string|max:255',
            'award_by' => 'nullable|string|max:255',
            'award_year' => 'required|integer|digits:4',
            'award_by_country' => 'nullable|string|max:100',
            'image' => 'nullable|file',
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

        $isCreated = $this->awardService->create($request);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Award Created Successfully'],
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
            'award' => $this->awardService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.award.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'award_name' => 'required|string|max:255',
            'award_type' => 'nullable|string|max:100',
            'award_to' => 'nullable|string|max:255',
            'award_by' => 'nullable|string|max:255',
            'award_year' => 'required|integer|digits:4',
            'award_by_country' => 'nullable|string|max:100',
            'image' => 'nullable|file',
        ]);

        $isUpdated = $this->awardService->update($request);

        if ($isUpdated) {
            return redirect()->route('award.index')->with('success', 'Award Updated Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }

    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->awardService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Award Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
