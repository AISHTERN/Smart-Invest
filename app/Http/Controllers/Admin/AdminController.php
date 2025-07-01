<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WithdrawRequest;

class AdminController extends Controller
{
public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function showTopupForm(User $user)
    {
        return view('admin.users.topup', compact('user'));
    }

    public function topupBalance(Request $request, User $user)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user->balance += $request->amount;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Saldo berhasil ditambahkan.');
    }

    public function withdrawRequests()
    {
        $withdrawRequests = WithdrawRequest::where('status', 'pending')->with('user')->get();

        return view('admin.withdraw.request', compact('withdrawRequests'));
    }

    public function approveWithdraw($id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->status = 'approved';
        $withdraw->save();

        // Kurangi saldo user (opsional, jika belum dikurangi di form)
        $withdraw->user->decrement('balance', $withdraw->amount);

        return back()->with('success', 'Withdraw berhasil disetujui.');
    }
}
