<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function __construct() {}


    public function index()
    {
        $data = [];

        return view('web.pages.blog.index', compact('data'));
    }


    public function show()
    {
        $data = [];

        return view('web.pages.blog.show', compact('data'));
    }
}
