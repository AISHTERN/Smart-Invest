<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DepositRequest;

class BalanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('balance.index', compact('user'));
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();
        $user->balance += $request->amount;
        $user->save();

        return back()->with('success', 'Deposit berhasil!');
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $user = Auth::user();

        if ($user->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak mencukupi untuk withdraw.');
        }

        $user->balance -= $request->amount;
        $user->save();

        return back()->with('success', 'Withdraw berhasil!');
    }

    public function submitProof(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:10000',
        'method' => 'required|string|in:bni,bca,qris',
        'proof'  => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = auth()->user();

    // Simpan bukti gambar
    $path = $request->file('proof')->store('proofs', 'public');

    // Simpan ke database (gunakan model sesuai struktur database kamu)
    DepositRequest::create([
        'user_id' => $user->id,
        'amount'  => $request->amount,
        'method'  => $request->method,
        'proof'   => $path,
        'status'  => 'pending',
    ]);

    return redirect()->route('balance.index')->with('success', 'Bukti transfer berhasil dikirim, menunggu konfirmasi admin.');
}
}