<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\Web\DoctorService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(
        protected DoctorService $doctorService
    ) {}


    public function index()
    {
        $data = [
            'teams' => $this->doctorService->getDoctorsCollection([
                'status' => 'ACTIVE'
            ])
        ];

        return view('web.pages.team.index', compact('data'));
    }


    public function show($id)
    {
        $data = [
            'team' => $this->doctorService->find($id)
        ];

        return view('web.pages.team.show', compact('data'));
    }
}
