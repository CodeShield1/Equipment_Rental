@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold mb-4">My Rentals</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="w-full bg-white shadow-md rounded">
        <thead>
            <tr class="border-b">
                <th class="p-3 text-left">Product</th>
                <th class="p-3 text-left">Date</th>
                <th class="p-3 text-left">Location</th>
                <th class="p-3 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rentals as $rental)
                <tr class="border-b hover:bg-gray-100">
                    <td class="p-3">{{ $rental->product->name }}</td>
                    <td class="p-3">{{ $rental->start_date }} → {{ $rental->end_date }}</td>
                    <td class="p-3">{{ $rental->location }}</td>
                    <td class="p-3 capitalize">{{ $rental->status }}</td>
                </tr>
            @empty
                <tr>
                    <td class="p-4 text-center text-gray-500" colspan="4">No rentals yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
