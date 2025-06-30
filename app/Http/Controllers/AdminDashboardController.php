<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InvestmentTransaction;
use Illuminate\Http\Request;
use App\Models\DepositRequest;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalUsers = $users->count();
        $totalTransactions = InvestmentTransaction::count();

        $monthlyUserData = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('count', 'month')
            ->toArray();

        $monthlyUserData = array_replace(array_fill(1, 12, 0), $monthlyUserData); // Lengkapi bulan kosong

        // Tambahkan baris ini:
        $depositRequests = DepositRequest::with('user')->where('status', 'pending')->latest()->get();

        return view('admin.dashboard', compact(
            'users',
            'totalUsers',
            'totalTransactions',
            'monthlyUserData',
            'depositRequests' // Ini penting
        ));
    }
}