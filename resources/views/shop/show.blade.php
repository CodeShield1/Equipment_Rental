@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="bg-white rounded shadow p-6">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-64 object-cover mb-4 rounded" />
        @endif
        <h1 class="text-2xl font-bold">{{ $product->name }}</h1>
        <p class="text-gray-500 mt-1">{{ $product->category->name }}</p>
        <p class="mt-4">{{ $product->description }}</p>
        <p class="mt-2 font-semibold">{{ $product->price_per_day }} DH / day</p>

        <a href="{{ route('rentals.create', $product) }}" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Rent Now
        </a>
    </div>
</div>
@endsection
