@extends('layouts.app')

@section('content')
<div class="max-w-6xl p-6 mx-auto mt-10 text-white border border-gray-700 shadow-2xl bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl backdrop-blur-sm">

    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-semibold text-white transition bg-gray-700 border border-gray-600 rounded hover:bg-gray-600 hover:shadow-md">
            ← Kembali
        </a>
    </div>

    <h2 class="flex items-center gap-2 mb-6 text-3xl font-bold tracking-wide text-indigo-300">
        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M12 8v4l3 3"></path>
            <path d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Permintaan Deposit
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

    <div class="overflow-x-auto border border-gray-600 rounded-lg shadow-inner">
        <table class="w-full text-sm text-left text-white table-auto">
            <thead class="text-xs text-indigo-300 uppercase bg-gray-800/50">
                <tr>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Jumlah</th>
                    <th class="px-4 py-3">Metode</th>
                    <th class="px-4 py-3">Bukti</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse ($requests as $req)
                    <tr class="transition border-b border-gray-700 bg-gray-900/40 hover:bg-gray-800">
                        <td class="px-4 py-3">{{ $req->user->full_name }}</td>
                        <td class="px-4 py-3 text-green-300">Rp {{ number_format($req->amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-blue-300 uppercase">{{ $req->method }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ asset('storage/' . $req->proof) }}" target="_blank"
                               class="text-indigo-400 underline transition hover:text-indigo-200">Lihat</a>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                {{ $req->status == 'approved' ? 'bg-green-600 text-white' :
                                   ($req->status == 'rejected' ? 'bg-red-600 text-white' : 'bg-yellow-500 text-gray-900') }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 space-x-2 text-right">
                            @if($req->status == 'pending')
                                <form action="{{ route('admin.deposit.approve', $req->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Setujui deposit ini?')"
                                        class="px-3 py-1 text-xs font-bold text-white transition bg-green-600 rounded hover:bg-green-700">
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('admin.deposit.reject', $req->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Tolak deposit ini?')"
                                        class="px-3 py-1 text-xs font-bold text-white transition bg-red-600 rounded hover:bg-red-700">
                                        Tolak
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400">✔ Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada permintaan deposit.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- SweetAlert CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
