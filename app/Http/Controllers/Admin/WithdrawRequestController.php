<?php

namespace App\Http\Controllers;

use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class nWithdrawRequestController extends Controller
{
    public function index()
    {
        $withdrawRequests = WithdrawRequest::with('user')->where('status', 'pending')->get();
        return view('admin.withdraw.request', compact('withdrawRequests'));
    }

    public function approve($id)
    {
        $withdraw = WithdrawRequest::with('user')->findOrFail($id);
        $withdraw->status = 'approved';
        $withdraw->save();

        // Kurangi saldo user
        $withdraw->user->decrement('balance', $withdraw->amount);

        return back()->with('success', 'Withdraw berhasil disetujui.');
    }

    public function reject($id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->status = 'rejected';
        $withdraw->save();

        return back()->with('success', 'Withdraw berhasil ditolak.');
    }
}