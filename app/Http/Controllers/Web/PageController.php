<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\CheckupProcessService;
use App\Services\Web\DoctorService;
use App\Services\Web\FaqService;
use App\Services\Web\GalleryService;
use App\Services\Web\HomeSliderService;
use App\Services\Web\ServiceService;
use App\Services\Web\TestimonialService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        protected HomeSliderService $homeSliderService,
        protected TestimonialService $testimonialService,
        protected FaqService $faqService,
        protected DoctorService $doctorService,
        protected CheckupProcessService $checkupProcessService,
        protected GalleryService $galleryService,
        protected ServiceService $serviceService
    ) {}



    public function homePage()
    {
        $data = [
            'sliders' => $this->homeSliderService->getHomeSliders([
                'deviceType' => 0,
            ]),
            'testimonials' => $this->testimonialService->getTestimonials([
                'status' => 'APPROVED'
            ]),
            'faqs' => $this->faqService->getFaqs([], ['question', 'answer']),

            'doctors' => $this->doctorService->getDoctorsCollection([
                'status' => 'ACTIVE'
            ]),
            'checkupProcesses' => $this->checkupProcessService->getCheckupProcesss(),
            'services' => $this->serviceService->getServices(),

        ];


        return view('web.homepage', compact('data'));
    }


    public function aboutUs()
    {
        $data = [];

        return view('web.pages.about', compact('data'));
    }


    public function gallery()
    {
        $data = [
            'images' => $this->galleryService->getGallerys([], ['id', 'title', 'description', 'images'])
        ];

        return view('web.pages.gallery', compact('data'));
    }

    public function contact()
    {
        $data = [];

        return view('web.pages.contact', compact('data'));
    }
}
