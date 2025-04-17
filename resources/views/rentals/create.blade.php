@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <h1 class="text-xl font-bold mb-4">Rent: {{ $product->name }}</h1>

    <form action="{{ route('rentals.store', $product) }}" method="POST">
        @csrf

        <!-- Start Date -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Start Date</label>
            <input type="date" name="start_date" class="w-full border rounded px-3 py-2" id="start_date" value="{{ old('start_date') }}">
            @error('start_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <!-- End Date -->
        <div class="mb-4">
            <label class="block text-sm mb-1">End Date</label>
            <input type="date" name="end_date" class="w-full border rounded px-3 py-2" id="end_date" value="{{ old('end_date') }}">
            @error('end_date') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <!-- Project Location -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Project Address</label>
            <input type="text" name="location" class="w-full border rounded px-3 py-2"  value="{{ old('location') }}">
            @error('location') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <input type="hidden" name="" id="product_price" value=" {{ $product->price_per_day ?? 0 }} ">

        <!-- Worker Selection -->
        <div class="mb-4">
            <label class="block text-sm mb-1">Select Worker</label>
            <select name="worker_id" class="w-full border rounded px-3 py-2" id="worker_id">
                <option value="">Select a worker</option>
                @foreach($workers as $worker)
                    <option class="flex items-center justify-between" value="{{ $worker->id }}" data-price="{{ $worker->price_per_day }}">
                        {{ $worker->name }} - {{ $worker->city }} (Available) - {{ $worker->price_per_day }} DH / day
                    </option>
                @endforeach
            </select>
            @error('worker_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <p id="totalPrice" class="text-lg font-semibold text-gray-700">Total Price: 0 DH</p>
        </div>
    
        <!-- Submit Button -->
        <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 w-full">
            Submit Request
        </button>
    </form>
</div>

{{-- CTA Section --}}
<section class="bg-black py-12">
    <div class="max-w-[90rem] mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-4 items-baseline">
        <div>
            <a href="/" class="text-white duration-300 hover:text-orange-500 text-2xl font-bold mb-5">Equipment Rental</a>
            <p class="text-gray-400 mt-5 leading-6">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
        </div>
        <div>
            <h4 class="text-white text-xl font-bold">Quick Links</h4>
            <ul class="mt-5">
                <li class="mt-3"><x-nav-link :href="route('landing')" class="text-white block text-base hover:text-orange-500">Home</x-nav-link></li>
                <li class="mt-3"><x-nav-link :href="route('shop.index')" class="text-white block text-base hover:text-orange-500">Shop</x-nav-link></li>
                <li class="mt-3"><x-nav-link :href="'#testimonials'" class="text-white block text-base hover:text-orange-500">Testimonials</x-nav-link></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white text-xl font-bold">Let's get Started</h4>
            <ul class="mt-5">
                <li class="mt-3"><x-nav-link :href="route('register')" class="text-white">Register</x-nav-link></li>
                <li class="mt-3"><x-nav-link :href="route('login')" class="text-white">Login</x-nav-link></li>
            </ul>
        </div>
        <div>
            <h4 class="text-white text-xl font-bold">Contacts</h4>
            <p class="text-gray-400 mt-5">75 Regal Row, Bni Makada Tangier</p>
            <div class="mt-3">
                <a href="mailto:support@example.com" class="text-gray-400 hover:text-orange-500">support@example.com</a>
            </div>
            <div class="mt-3">
                <a href="tel:+21257484523" class="text-gray-400 hover:text-orange-500">+212 57484523</a>
            </div>
        </div>
    </div>
</section>

{{-- Footer Section --}}
<footer class="bg-black text-white py-6 ">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Equipment Rental. All Rights Reserved.</p>
    </div>
</footer>
@endsection
