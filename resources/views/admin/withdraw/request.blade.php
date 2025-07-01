@extends('layouts.app')

@section('content')
<div class="max-w-7xl p-8 mx-auto mt-10 bg-gradient-to-br from-[#1a1f2e] to-[#111827] text-white rounded-xl shadow-xl border border-gray-700 backdrop-blur">

    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white transition bg-gray-700 rounded hover:bg-gray-600">
            ← Kembali ke Dashboard
        </a>
    </div>

    <h2 class="flex items-center gap-2 mb-6 text-3xl font-bold tracking-wide text-indigo-400">
        <svg class="w-6 h-6 text-indigo-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 8v4l3 3"></path>
            <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Permintaan Withdraw
    </h2>

    {{-- Notifikasi SweetAlert --}}
    @if(session('success'))
        <script>
            window.onload = () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    background: '#1f2937',
                    color: '#d1fae5',
                    confirmButtonColor: '#10B981'
                });
            };
        </script>
    @endif

    @if(session('error'))
        <script>
            window.onload = () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    background: '#1f2937',
                    color: '#fecaca',
                    confirmButtonColor: '#EF4444'
                });
            };
        </script>
    @endif

    {{-- Tabel --}}
    <div class="mt-6 overflow-x-auto border border-gray-600 rounded-lg shadow-inner">
        <table class="w-full text-sm text-white table-auto">
            <thead class="text-xs text-indigo-300 uppercase bg-gray-800/70">
                <tr>
                    <th class="px-4 py-3 text-left">User</th>
                    <th class="px-4 py-3 text-left">Jumlah</th>
                    <th class="px-4 py-3 text-left">Metode</th>
                    <th class="px-4 py-3 text-left">No. Rekening</th>
                    <th class="px-4 py-3 text-left">Nama Pemilik</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($withdrawRequests as $withdraw)
                    <tr class="transition border-b border-gray-700 bg-gray-900/40 hover:bg-gray-800">
                        <td class="px-4 py-3">{{ $withdraw->user->full_name }}</td>
                        <td class="px-4 py-3 text-green-400">Rp {{ number_format($withdraw->amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-blue-300">
                            @if($withdraw->method_type === 'bank')
                                {{ $withdraw->bank_name ?? '-' }}
                            @elseif($withdraw->method_type === 'ewallet')
                                {{ $withdraw->ewallet_name ?? '-' }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $withdraw->account_number }}</td>
                        <td class="px-4 py-3">{{ $withdraw->account_name }}</td>
                        <td class="px-4 py-3 space-x-2 text-right">
                            {{-- Tombol Approve --}}
                            <form action="{{ route('admin.withdraw.approve', $withdraw->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Setujui permintaan withdraw ini?')">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-xs font-bold text-white transition bg-green-600 rounded hover:bg-green-700">
                                    Approve
                                </button>
                            </form>

                            {{-- Tombol Tolak --}}
                            <form action="{{ route('admin.withdraw.reject', $withdraw->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Tolak permintaan withdraw ini?')">
                                @csrf
                                <button type="submit" class="px-3 py-1 text-xs font-bold text-white transition bg-red-600 rounded hover:bg-red-700">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-400">Tidak ada permintaan withdraw.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- SweetAlert CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
