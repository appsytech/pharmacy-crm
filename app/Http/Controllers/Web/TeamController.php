<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct() {}


    public function index()
    {
        $data = [];

        return view('web.pages.team.index', compact('data'));
    }


    public function show()
    {
        $data = [];

        return view('web.pages.team.show', compact('data'));
    }
}
