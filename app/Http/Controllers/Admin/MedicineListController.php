<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicineListController extends Controller
{
    public function index()
    {
        return view('admin.pages.medicine-list.index');
    }
}
