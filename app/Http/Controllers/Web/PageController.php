<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\FaqService;
use App\Services\Web\HomeSliderService;
use App\Services\Web\TestimonialService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        protected HomeSliderService $homeSliderService,
        protected TestimonialService $testimonialService,
        protected FaqService $faqService
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
            'faqs' => $this->faqService->getFaqs([], ['question', 'answer'])
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
        $data = [];

        return view('web.pages.gallery', compact('data'));
    }

    public function contact()
    {
        $data = [];

        return view('web.pages.contact', compact('data'));
    }
}
