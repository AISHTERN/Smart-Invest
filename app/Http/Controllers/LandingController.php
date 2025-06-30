<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvestmentTransaction;
use App\Models\User;
use App\Models\Investment;

class LandingController extends Controller
{
    public function index()
    {

        $totalUsers     = User::count();
        $totalInvest    = Investment::count(); // ← GANTI: ambil dari model Investment
        $totalPayments  = InvestmentTransaction::sum('amount');

        return view('landing', compact('totalUsers', 'totalInvest', 'totalPayments'));
    }
}
