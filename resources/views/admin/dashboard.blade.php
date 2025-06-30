@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-[rgba(10,10,25,1)] text-white">
    <!-- Sidebar -->
    <aside class="w-64 bg-[rgba(20,20,40,0.9)] backdrop-blur-md border-r border-[rgba(100,255,218,0.1)] shadow-lg">
        <div class="p-6 text-xl font-bold text-[#64ffda] border-b border-[rgba(100,255,218,0.1)]">
            📊 <span class="text-white">AdminPanel</span>
        </div>
        <nav class="p-4 space-y-3 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-[#64ffda22]">🏠 Dashboard</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded hover:bg-[#64ffda22]">📂 Manage Categories</a>
            <a href="{{ route('admin.investments.index') }}" class="block px-3 py-2 rounded hover:bg-[#64ffda22]">💼 Manage Investments</a>
            <a href="{{ route('admin.users') }}" class="block px-3 py-2 rounded hover:bg-[#64ffda22]">👥 Manage Users</a>
            <a href="{{ route('admin.deposit.requests') }}" class="block px-3 py-2 rounded hover:bg-[#64ffda22]">📄 Deposit Requests</a>
            <a href="{{ route('admin.withdraw.requests') }}" class="block px-3 py-2 rounded hover:bg-[#64ffda22]">💸 Withdraw Requests</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-3 py-2 text-red-400 rounded hover:bg-red-800/20">🚪 Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 space-y-6 bg-[rgba(10,10,25,1)]">
        <h1 class="text-2xl font-bold text-[#64ffda]">Hello Admin 👋</h1>

        <!-- Highlight Cards -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div class="p-6 text-center rounded-xl bg-[rgba(30,60,50,0.1)] border border-[rgba(100,255,218,0.2)] shadow-sm">
                <div class="text-3xl font-bold text-green-400">{{ $totalUsers }}</div>
                <div class="mt-1 text-sm text-gray-400">Total Users</div>
            </div>
            <div class="p-6 text-center rounded-xl bg-[rgba(30,60,80,0.1)] border border-[rgba(100,255,218,0.2)] shadow-sm">
                <div class="text-3xl font-bold text-blue-400">{{ $totalTransactions }}</div>
                <div class="mt-1 text-sm text-gray-400">Total Transactions</div>
            </div>
        </div>

        <!-- Chart -->
        <div class="p-6 rounded-xl bg-[rgba(20,20,40,0.6)] border border-[rgba(100,255,218,0.2)] shadow">
            <h2 class="mb-4 text-xl font-semibold text-white">📈 User Growth Chart</h2>
            <canvas id="userChart" height="100"></canvas>
        </div>

        <!-- Deposit Table -->
        <div class="p-6 rounded-xl bg-[rgba(20,20,40,0.6)] border border-[rgba(100,255,218,0.2)] shadow">
            <h2 class="mb-4 text-xl font-semibold text-white">💰 Pending Deposit Requests</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm border border-[rgba(100,255,218,0.2)]">
                    <thead class="bg-[rgba(100,255,218,0.1)] text-[#64ffda]">
                        <tr>
                            <th class="px-4 py-2 text-left">User</th>
                            <th class="px-4 py-2">Amount</th>
                            <th class="px-4 py-2">Method</th>
                            <th class="px-4 py-2">Proof</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($depositRequests as $deposit)
                        <tr class="border-b border-[rgba(100,255,218,0.1)] hover:bg-[rgba(100,255,218,0.05)]">
                            <td class="px-4 py-2">{{ $deposit->user->full_name }}</td>
                            <td class="px-4 py-2 text-green-400">Rp {{ number_format($deposit->amount, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 capitalize">{{ strtoupper($deposit->method) }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ asset('storage/' . $deposit->proof) }}" target="_blank" class="text-[#64ffda] underline">Lihat</a>
                            </td>
                            <td class="px-4 py-2 text-right">
                                <form action="{{ route('admin.deposit.approve', $deposit->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 text-xs text-white bg-green-600 rounded hover:bg-green-700">Approve</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-400">Tidak ada permintaan deposit.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($monthlyUserData)) !!},
            datasets: [{
                label: 'User Growth',
                data: {!! json_encode(array_values($monthlyUserData)) !!},
                backgroundColor: 'rgba(100,255,218,0.1)',
                borderColor: '#64ffda',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, ticks: { color: '#ccc' } },
                x: { ticks: { color: '#ccc' } }
            },
            plugins: {
                legend: { labels: { color: '#64ffda' } }
            }
        }
    });
</script>
@endsection
