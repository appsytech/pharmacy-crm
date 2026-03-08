<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\ActivityService;
use App\Services\Web\ServiceCategoryService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct(
        protected ActivityService $activityService,
        protected ServiceCategoryService $serviceCategoryService
    ) {}


    public function index()
    {
        $data = [
            'activities' => $this->activityService->getActivities(),
            'categories' => $this->serviceCategoryService->getServiceCategoriesCollection()

        ];

        return view('web.pages.activity.index', compact('data'));
    }


    public function show(Request $request)
    {
        $data = [
            'activity'  => $this->activityService->find($request->id),
            'categories' => $this->serviceCategoryService->getServiceCategoriesCollection()

        ];

        return view('web.pages.activity.show', compact('data'));
    }
}
