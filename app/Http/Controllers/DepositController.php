<?php

namespace App\Http\Controllers;

use App\Models\DepositTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class DepositController extends Controller
{
    public function showMethods(Request $request)
    {
        $amount = $request->input('amount');

        if ($amount < 10000) {
            return redirect()->route('balance.index')->with('error', 'Minimal deposit adalah Rp 10.000');
        }

        return view('deposit.methods', compact('amount'));
    }

public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $request->validate([
        'amount' => 'required|numeric|min:10000',
        'method' => 'required|in:bca,bni,qris',
    ]);

    $deposit = DepositTransaction::create([
        'user_id' => Auth::id(),
        'amount' => $request->amount,
        'method' => $request->method,
        'status' => 'pending',
    ]);

    // Tambahkan pengecekan jika deposit berhasil
    logger('SEBELUM NOTIFIKASI');
    if ($deposit) {
        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'Deposit Terkirim',
            'message' => 'Permintaan deposit sebesar Rp ' . number_format($request->amount, 0, ',', '.') . ' telah dikirim. Silakan tunggu verifikasi.',
        ]);
    }
    logger('SESUDAH NOTIFIKASI');

    return redirect()->route('deposit.history')->with('success', 'Silakan selesaikan pembayaran. Kami akan verifikasi sesegera mungkin.');
}


    public function history()
    {
        $transactions = DepositTransaction::where('user_id', Auth::id())->latest()->get();
        return view('deposit.history', compact('transactions'));
    }
}
