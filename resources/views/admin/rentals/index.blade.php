@extends('admin.layout')

@section('content')
    <h2 class="text-2xl font-bold text-black mb-6 flex items-center gap-2">
        <i class="fas fa-truck-loading text-orange-500"></i> All Rental Requests
    </h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-6 rounded shadow-sm">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Filter Section -->
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-700">Filter by Status</h2>
    
        <form method="GET" class="flex items-center space-x-2">
            <label for="status" class="text-sm">Status:</label>
            <select name="status" id="status" onchange="this.form.submit()" class="text-sm border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                <option value="">All</option>
                <option value="pending" @selected($status == 'pending')>Pending</option>
                <option value="confirmed" @selected($status == 'confirmed')>Confirmed</option>
                <option value="completed" @selected($status == 'completed')>Completed</option>
            </select>
        </form>
    </div>

    <!-- Rental Requests Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100 border-b text-gray-700 text-sm uppercase tracking-wide">
                    <th class="p-3 text-left">User</th>
                    <th class="p-3 text-left">Product</th>
                    <th class="p-3 text-left">Dates</th>
                    <th class="p-3 text-left">Location</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800">
                @forelse($rentals as $rental)
                    <tr class="border-b hover:bg-orange-50">
                        <td class="p-3">{{ $rental->user->name }}</td>
                        <td class="p-3">{{ $rental->product->name }}</td>
                        <td class="p-3">{{ $rental->start_date }} → {{ $rental->end_date }}</td>
                        <td class="p-3">{{ $rental->location }}</td>
                        <td class="p-3 capitalize">{{ $rental->status }}</td>
                        <td class="p-3 text-right space-x-2">
                            <form method="POST" action="{{ route('admin.rentals.update', $rental) }}" class="inline-block">
                                @csrf @method('PUT')
                                <select name="status" class="text-sm border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                                    <option value="pending" @selected($rental->status == 'pending')>Pending</option>
                                    <option value="confirmed" @selected($rental->status == 'confirmed')>Confirmed</option>
                                    <option value="completed" @selected($rental->status == 'completed')>Completed</option>
                                </select>
                                <button class="bg-orange-500 text-white text-sm px-4 py-2 rounded shadow hover:bg-orange-600 transition duration-200">
                                    <i class="fas fa-check-circle"></i> Update
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.rentals.destroy', $rental) }}" class="inline-block">
                                @csrf @method('DELETE')
                                <button class="text-red-600 text-sm" onclick="return confirm('Delete this rental?')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-4 text-center text-gray-500" colspan="6"> <i class="fas fa-circle-info mr-1"></i> No rentals found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
