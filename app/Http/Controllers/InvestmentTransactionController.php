<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvestmentTransaction;
use App\Models\Investment;
use App\Models\Notification;

class InvestmentTransactionController extends Controller
{
public function store(Request $request)
{
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    $request->validate([
        'investment_id' => 'required|exists:investments,id',
        'amount'        => 'required|numeric|min:1',
    ]);

    $user = auth()->user();
    $investment = Investment::findOrFail($request->investment_id);

    if ($request->amount < $investment->minimum_amount) {
        return back()->with('error', 'Minimal investasi Rp ' . number_format($investment->minimum_amount, 0, ',', '.'));
    }

    if ($user->balance < $request->amount) {
        return back()->with('error', 'Saldo tidak mencukupi.');
    }

    $user->balance -= $request->amount;
    $user->save();

    $existing = InvestmentTransaction::where('user_id', $user->id)
        ->where('investment_id', $investment->id)
        ->first();

    if ($existing) {
        // Tambahkan ke investasi yang sudah ada
        $existing->amount += $request->amount;

        // Recalculate average purchase price (opsional, bisa pakai rumus rata-rata tertimbang)
        $existing->purchase_price = ($existing->purchase_price + $investment->market_price) / 2;

        $existing->save();
    } else {
        // Buat transaksi baru
        InvestmentTransaction::create([
            'user_id' => $user->id,
            'investment_id' => $investment->id,
            'amount' => $request->amount,
            'purchase_price' => $investment->market_price > 0 ? $investment->market_price : 1,
        ]);
    }

    Notification::create([
        'user_id' => $user->id,
        'title' => 'Investasi Berhasil',
        'message' => 'Anda telah berinvestasi sebesar Rp ' . number_format($request->amount, 0, ',', '.'),
    ]);

    return redirect()->route('investments.success', ['investment' => $request->investment_id]);
}


    public function sell(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:investment_transactions,id',
            'amount'         => 'required|numeric|min:1', // Ini adalah nominal uang yang ingin dijual, bukan jumlah saham
        ]);

        $transaction = InvestmentTransaction::where('id', $request->transaction_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $investment    = $transaction->investment;
        $user          = auth()->user();
        $purchasePrice = $transaction->purchase_price; // Harga per unit saham saat dibeli
        $marketPrice   = $investment->market_price;

        if ($transaction->amount <= 0 || $purchasePrice <= 0 || $marketPrice <= 0) {
            return back()->with('error', 'Data transaksi tidak valid. Gagal menjual aset.');
        }

        // Hitung jumlah saham yang akan dijual berdasarkan input amount (Rp)
        $amountToSell = min($request->amount, $transaction->amount); // nominal yang ingin diuangkan
        $unitsToSell = $amountToSell / $purchasePrice;

        if ($unitsToSell > ($transaction->amount / $purchasePrice)) {
            return back()->with('error', 'Jumlah saham yang ingin dijual melebihi yang Anda miliki.');
        }

        // Hitung nilai jual berdasarkan market price sekarang
        $sellValue = $unitsToSell * $marketPrice;

        // Tambahkan ke saldo user
        $user->balance += $sellValue;
        $user->save();

        // Update jumlah dalam transaksi (kurangi nominal total yg diinvestasikan)
        $transaction->amount -= $amountToSell;
        if ($transaction->amount <= 0) {
            $transaction->delete();
        } else {
            $transaction->save();
        }

        // Buat notifikasi
        Notification::create([
            'user_id' => $user->id,
            'title'   => 'Penjualan Aset Berhasil',
            'message' => 'Anda telah menjual aset ' . $investment->title . ' sebesar Rp ' . number_format($sellValue, 0, ',', '.'),
        ]);

        return redirect()->route('home')->with('sell_success', 'Investasi berhasil dijual.');
    }

    public function success($investmentId)
    {
        $investment = Investment::findOrFail($investmentId);
        return view('investments.success', compact('investment'));
    }
}