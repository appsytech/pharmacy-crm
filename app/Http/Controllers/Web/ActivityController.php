<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\ActivityService;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct(
        protected ActivityService $activityService
    ) {}


    public function index()
    {
        $data = [
            'activities' => $this->activityService->getActivities()
        ];

        return view('web.pages.activity.index', compact('data'));
    }


    public function show(Request $request)
    {
        $data = [
            'activity'  => $this->activityService->find($request->id)
        ];

        return view('web.pages.activity.show', compact('data'));
    }
}
