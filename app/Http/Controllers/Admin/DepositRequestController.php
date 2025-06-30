<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepositRequest;
use Illuminate\Http\Request;
use App\Models\Notification;

class DepositRequestController extends Controller
{
    public function index()
    {
        $requests = DepositRequest::with('user')->latest()->get();
        return view('admin.deposit.index', compact('requests'));
    }

    public function approve($id)
    {
        $request = DepositRequest::findOrFail($id);
        $user = $request->user;

        if ($request->status !== 'pending') {
            return back()->with('error', 'Permintaan sudah diproses.');
        }

        $user->balance += $request->amount;
        $user->save();

        $request->update(['status' => 'approved']);

        Notification::create([
            'user_id' => $user->id,
            'title' => 'Deposit Berhasil Diverifikasi',
            'message' => 'Saldo sebesar Rp ' . number_format($request->amount, 0, ',', '.') . ' telah masuk ke akun Anda.',
        ]);


        return back()->with('success', 'Deposit disetujui dan saldo telah ditambahkan.');
    }

    public function reject($id)
    {
        $request = DepositRequest::findOrFail($id);

        if ($request->status !== 'pending') {
            return back()->with('error', 'Permintaan sudah diproses.');
        }

        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Deposit ditolak.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'method' => 'required|in:bni,bca,qris',
            'proof'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('proof')->store('deposit_proofs', 'public');

        DepositRequest::create([
            'user_id' => auth()->id(),
            'amount'  => $request->amount,
            'method'  => $request->method,
            'proof'   => $path,
        ]);

        return redirect()->route('balance.index')->with('success', 'Permintaan deposit berhasil dikirim! Tunggu verifikasi admin.');
    }
}
