@extends('layouts.app')

@section('content')
<div class="max-w-3xl px-4 py-6 mx-auto bg-white rounded shadow">
    <h2 class="mb-4 text-xl font-bold">Riwayat Deposit</h2>

    @if (session('success'))
        <div class="p-3 mb-4 text-green-700 bg-green-100 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full text-sm border border-gray-200">
        <thead class="text-gray-700 bg-gray-100">
            <tr>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Metode</th>
                <th class="px-4 py-2">Jumlah</th>
                <th class="px-4 py-2">Status</th>
            </tr>
        </thead>
        <tbody class="text-gray-800">
            @forelse ($transactions as $transaction)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    <td class="px-4 py-2 uppercase">{{ $transaction->method }}</td>
                    <td class="px-4 py-2">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 capitalize">
                        @if ($transaction->status == 'pending')
                            <span class="px-2 py-1 text-xs text-yellow-700 bg-yellow-100 rounded">Pending</span>
                        @elseif ($transaction->status == 'approved')
                            <span class="px-2 py-1 text-xs text-green-700 bg-green-100 rounded">Approved</span>
                        @else
                            <span class="px-2 py-1 text-xs text-red-700 bg-red-100 rounded">Rejected</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">Belum ada transaksi deposit.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
