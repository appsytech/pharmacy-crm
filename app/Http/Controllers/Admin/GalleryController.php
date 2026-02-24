<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\GalleryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function __construct(
        protected GalleryService $galleryService
    ) {}



    public function index(Request $request): View
    {
        $request->validate([
            'title' => 'nullable|string|max:100',
        ]);

        $data = [
            'images' => $this->galleryService->getGallerys([
                'title' => $request->title ?? null,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.gallery.index', compact('data'));
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'required|file',
            'big_image' => 'nullable|file',
            'status' => 'required|in:ACTIVE,INACTIVE,DRAFT',
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

        $isCreated = $this->galleryService->create($request);

        if ($isCreated) {

            return response()->json([
                'status' => true,
                'code' => 200,
                'messages' => ['Gallery Created Successfully'],
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
            'image' => $this->galleryService->find((int) decrypt($request->id)),
        ];

        return view('admin.pages.gallery.edit', compact('data'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|file',
            'big_image' => 'nullable|file',
            'status' => 'required|in:ACTIVE,INACTIVE,DRAFT',
        ]);

        $isUpdated = $this->galleryService->update($request);

        if ($isUpdated) {
            return redirect()->route('gallery.index')->with('success', 'Gallery updated successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }


    public function delete(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $isDeleted = $this->galleryService->delete($request->id);

        if ($isDeleted) {
            return redirect()->back()->with('success', 'Gallery Deleted Successfully');
        } else {
            return redirect()->back()->withErrors('Something went wrong!');
        }
    }
}
