<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\ServiceCategoryService;
use App\Services\Web\ServiceService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(
        protected ServiceService $serviceService,
        protected ServiceCategoryService $serviceCategoryService
    ) {}


    public function index()
    {
        $data = [
            'services' => $this->serviceService->getServices(),

        ];

        return view('web.pages.service.index', compact('data'));
    }


    public function show(Request $request)
    {
        $service = $this->serviceService->find($request->id);

        $data = [
            'service' => $service,
            'relatedServices' => $this->serviceService->getServices([
                'exceptId' => $service->id,
                'limit' => 5,
            ], ['id', 'icon', 'title', 'created_at', 'created_by']),
            'categories' => $this->serviceCategoryService->getServiceCategoriesCollection()

        ];


        return view('web.pages.service.show', compact('data'));
    }
}
