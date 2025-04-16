@extends('admin.layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Stats Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <!-- Total Users (Non-Admin) -->
        <div class="bg-white p-6 border rounded-lg shadow-lg flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
            </div>
            <i class="fas fa-users text-4xl text-orange-500"></i>
        </div>

        <!-- Total Categories -->
        <div class="bg-white p-6 border rounded-lg shadow-lg flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Categories</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalCategories }}</p>
            </div>
            <i class="fas fa-folder text-4xl text-orange-500"></i>
        </div>

        <!-- Total Products -->
        <div class="bg-white p-6 border rounded-lg shadow-lg flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Products</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
            </div>
            <i class="fas fa-boxes-stacked text-4xl text-orange-500"></i>
        </div>

        <!-- Total Rented -->
        <div class="bg-white p-6 border rounded-lg shadow-lg flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Total Rented</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalRented }}</p>
            </div>
            <i class="fas fa-truck-loading text-4xl text-orange-500"></i>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <h2 class="text-lg font-semibold mb-2">Rentals per Month</h2>
            <canvas id="rentalsChart" height="200"></canvas>
        </div>
        <div>
            <h2 class="text-lg font-semibold mb-2">Rentals by Status</h2>
            <canvas id="statusChart" height="200"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const monthLabels = @json($monthLabels);
    const monthCounts = @json(array_values($monthlyData->toArray()));

    const ctx = document.getElementById('rentalsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Rentals',
                data: monthCounts,
                backgroundColor: 'rgba(59,130,246,0.5)',
                borderColor: 'rgba(59,130,246,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const statusData = @json($statusCounts);
    const statusLabels = Object.keys(statusData);
    const statusValues = Object.values(statusData);

    const ctx2 = document.getElementById('statusChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                label: 'Status',
                data: statusValues,
                backgroundColor: [
                    'rgba(234,88,12,0.6)',   // pending
                    'rgba(34,197,94,0.6)',   // confirmed
                    'rgba(14,165,233,0.6)'   // completed
                ]
            }]
        }
    });
</script>
@endpush
