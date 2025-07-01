<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function index()
    {
        $withdrawRequests = WithdrawRequest::with('user')->where('status', 'pending')->get();
        return view('admin.withdraw.request', compact('withdrawRequests'));
    }

public function approve($id)
{
    $withdraw = \App\Models\WithdrawRequest::findOrFail($id);

    // Cegah approve ganda
    if ($withdraw->status !== 'pending') {
        return back()->with('error', 'Withdraw sudah diproses sebelumnya.');
    }

    $user = \App\Models\User::find($withdraw->user_id);
    if (!$user) {
        return back()->with('error', 'User tidak ditemukan.');
    }

    // Kurangi saldo user
    $user->balance -= $withdraw->amount;
    $user->save();

    // Set status approved
    $withdraw->status = 'approved';
    $withdraw->save();

    return back()->with('success', 'Withdraw disetujui dan saldo user telah dipotong.');
}




    public function reject($id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->status = 'rejected';
        $withdraw->save();

        return back()->with('success', 'Withdraw berhasil ditolak.');
    }
}
