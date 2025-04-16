@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold mb-4">Rent: {{ $product->name }}</h1>

    <form action="{{ route('rentals.store', $product) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-sm mb-1">Start Date</label>
            <input type="date" name="start_date" class="w-full border rounded px-3 py-2" value="{{ old('start_date') }}">
            @error('start_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">End Date</label>
            <input type="date" name="end_date" class="w-full border rounded px-3 py-2" value="{{ old('end_date') }}">
            @error('end_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm mb-1">Project Location</label>
            <input type="text" name="location" class="w-full border rounded px-3 py-2" value="{{ old('location') }}">
            @error('location') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Submit Request
        </button>
    </form>
</div>
@endsection
