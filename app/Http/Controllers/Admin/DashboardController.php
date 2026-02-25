<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\PharmacyStatisticService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        protected PharmacyStatisticService $pharmacyStatisticService
    ) {}
    public function index()
    {
        $data = [
            'totalPatients' => $this->pharmacyStatisticService->findByType('PATIENT', ['value'])?->value,
            'totalDoctors' => $this->pharmacyStatisticService->findByType('DOCTORS', ['value'])?->value,
            'totalAwards' => $this->pharmacyStatisticService->findByType('AWARD', ['value'])?->value,
        ];


        return view('admin.dashboard', compact('data'));
    }
}
