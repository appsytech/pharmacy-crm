<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\LogMoneyService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogMoneyController extends Controller
{
    public function __construct(
        protected LogMoneyService $logMoneyService
    ) {}

    public function index(Request $request): View
    {
        $request->validate([
            'payment_method' => 'nullable|string|in:CASH,BANK,ONLINE,CHEQUE',
            'type' => 'nullable|in:INCOME,EXPENSE',
        ]);

        $data = [
            'logs' => $this->logMoneyService->getMoneyLogs([
                'paymentMethod' => $request->expense_type_name ?? null,
                'type' => $request->type,
            ]),
            'oldInputs' => $request->all(),
        ];

        return view('admin.pages.log-money.index', compact('data'));
    }
}
