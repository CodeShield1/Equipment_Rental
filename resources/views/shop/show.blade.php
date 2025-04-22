@extends('layouts.app')

@section('content')
{{-- Product Detail Section --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-[90rem] mx-auto px-4 flex flex-col lg:flex-row space-x-8">
        <!-- Product Image -->
        <div class="flex-1 mb-6 lg:mb-0">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full object-contain h-[400px] rounded-lg shadow-md">
            @endif
        </div>

        <!-- Product Info -->
        <div class="flex-1 m-0 ">
            <div class="flex items-center justify-between w-[75%]">
                <h1 class="text-3xl font-bold text-gray-950 mb-4 ibm">{{ $product->name }}</h1>
                <p class="text-xl font-semibold">{{ $product->price_per_day }} DH / day</p>
            </div>

            <p class="text-gray-600 mb-4">{{ $product->category->name }}</p>
            <p class="text-gray-800 text-lg mb-6">{{ $product->description }}</p>
            
            <!-- Product Details -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-2">Specifications</h3>
                <ul class="list-disc pl-5">
                    <li>Max Weight: {{ $product->weight }} kg</li>
                    <li>Fuel Type: {{ $product->fuel_type }}</li>
                    <li>Brand: {{ $product->brand }}</li>
                    <li>Dimensions: {{ $product->dimensions }}</li>
                </ul>
            </div>
            

            <!-- Additional Info Section -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Available Quantities</h3>
                <p class="text-gray-700">Currently available: {{ $product->quantity_available }} units</p>
            </div>

            <!-- Available Workers Section -->
            <div class=" mb-6">
                <h3 class="text-xl font-semibold mb-4">Workers Available for This Equipment</h3>
                <p class="text-gray-600 mb-4">City: {{ $product->city }}</p>
                <p class="text-gray-600 mb-4">Total Available Workers: 
                    {{ $product->workers->where('city', $product->city)->where('status' , 'available')->count() }}
                </p>
            </div>
                        <!-- Pricing and Rent Button -->
                        <div class=" mb-6">
                            <a href="{{ route('rentals.create', $product) }}" class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">
                                Rent Now
                            </a>
                        </div>
            

        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="bg-black py-12">
    <div class="max-w-[90rem] mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-4 items-baseline">
        <div>
            <a href="/" class="text-white duration-300 hover:text-orange-500 text-2xl font-bold mb-5">Equipment Rental</a>
            <p class="text-gray-400 mt-5 leading-6">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
        </div>
        <div>
            <h4 class="text-white text-xl font-bold ibm">Quick Links</h4>
            <ul class="mt-5">
                <li class="mt-3">
                    <x-nav-link :href="route('landing')" class="text-white block text-base hover:text-orange-500 hover:border-b-2 hover:border-black text-md">Home</x-nav-link>
                </li>
                <li class="mt-3">
                    <x-nav-link :href="route('shop.index')" class="text-white block text-base hover:text-orange-500 hover:border-b-2 hover:border-black text-md">Shop</x-nav-link>
                </li>
                <li class="mt-3">
                    <x-nav-link :href="'#testimonials'" class="text-white block text-base hover:text-orange-500 hover:border-b-2 hover:border-black text-md">Testimonials</x-nav-link>
                </li>
            </ul>
        </div>
        <div class="mt-[2rem]">
            <h4 class="text-white text-xl font-bold ibm">Let's get Started</h4>
            <ul class="mt-5">
                <li class="mt-3">
                    <x-nav-link :href="route('register')" class="text-white text-base hover:text-orange-500 hover:border-b-2 hover:border-black text-md">Register</x-nav-link>
                </li>
                <li class="mt-3">
                    <x-nav-link :href="route('login')" class="text-white text-base hover:text-orange-500 hover:border-b-2 hover:border-black text-md">Login</x-nav-link>
                </li>
            </ul>
        </div>
        <div class="mt-[2rem]">
            <h4 class="text-white text-xl font-bold ibm">Contacts</h4>
            <p class="text-gray-400 mt-5 ">75 Regal Row, Bni Makada Tangier</p>
            <div class="mt-3">
                <a href="mailto:support@example.com" class="text-gray-400 hover:text-orange-500 text-lg">support@example.com</a>
            </div>
            <div class="mt-3">
                <a href="tel:+21257484523" class="text-gray-400 hover:text-orange-500 text-lg">+212 57484523</a>
            </div>
        </div>
    </div>
</section>

{{-- Footer Section --}}
<footer class="bg-black text-white py-6">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Equipment Rental. All Rights Reserved.</p>
    </div>
</footer>

@endsection
