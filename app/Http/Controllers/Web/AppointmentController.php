<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function __construct() {}


    public function index()
    {
        $data = [];

        return view('web.pages.appointment.index', compact('data'));
    }
}
