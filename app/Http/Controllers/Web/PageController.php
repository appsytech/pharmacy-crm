<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct() {}



    public function homePage()
    {
        $data = [];

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
