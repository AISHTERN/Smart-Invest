<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class WithdrawController extends Controller
{
    public function create()
    {
        return view('withdraw.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'method_type' => 'required|in:bank,ewallet',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
            'bank_name' => 'required_if:method_type,bank|nullable|string',
            'ewallet_name' => 'required_if:method_type,ewallet|nullable|string',
        ]);

        $user = Auth::user();

        if ($user->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak mencukupi.');
        }

        // Simpan permintaan withdraw
            WithdrawRequest::create([
                'user_id'        => auth()->id(),
                'amount'         => $request->amount,
                'method_type'    => $request->method_type, // 'bank' atau 'ewallet'
                'bank_name'      => $request->method_type === 'bank' ? $request->bank_name : null,
                'ewallet_name'   => $request->method_type === 'ewallet' ? $request->ewallet_name : null,
                'account_number' => $request->account_number,
                'account_name'   => $request->account_name,
                'status'         => 'pending',
            ]);

        // Tambahkan notifikasi
        Notification::create([
            'user_id' => $user->id,
            'title' => 'Permintaan Withdraw Dikirim',
            'message' => 'Anda telah mengajukan permintaan withdraw sebesar Rp ' . number_format($request->amount, 0, ',', '.'),
        ]);

        return redirect()->back()->with('success', 'Permintaan withdraw berhasil dikirim dan akan segera ditinjau oleh admin.');
    }

    public function updateStatus($id, $status)
    {
        $withdraw = \App\Models\WithdrawRequest::findOrFail($id);

        if (!in_array($status, ['approved', 'rejected'])) {
            return back()->with('error', 'Status tidak valid.');
        }

        $withdraw->status = $status;
        $withdraw->save();

        return back()->with('success', "Permintaan withdraw telah di-{$status}.");
    }
}