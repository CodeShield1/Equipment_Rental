@extends('layouts.app')

@section('content')
<div class="max-w-[90rem] mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Browse Equipment</h1>

<!-- Sorting and Filtering Controls -->
<div class="flex justify-between items-center mb-6">
    <div class="flex flex-col md:flex-row  items-baseline md:items-center justify-between w-full space-x-4">
        <!-- Filter by Category -->
        <select id="categoryFilter" class="border rounded px-8 py-2 text-sm">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
         <div class="flex items-center mt-5 md:mt-0">
            <!-- Filter by City -->
            <select id="cityFilter" class="border rounded px-8 py-2 text-sm">
                <option value="">All Cities</option>
                @foreach($cities as $city)
                    <option value="{{ $city->city }}" {{ request('city') == $city->city ? 'selected' : '' }}>{{ $city->city }}</option>
                @endforeach
            </select>

            <!-- Sorting Options -->
            <select id="sortBy" class="border rounded px-4 py-2 text-sm ml-5">
                <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Sort by Price (Low to High)</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Sort by Price (High to Low)</option>
            </select>
        </div>
    </div>
</div>

<!-- Product Grid -->
<div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-[3rem]">
    @foreach($products as $product)
        <div class="bg-white rounded shadow p-4 product-item" data-category="{{ $product->category_id }}" data-city="{{ $product->city }}" data-name="{{ $product->name }}" data-price="{{ $product->price_per_day }}">
            <a href="{{ route('shop.show', $product) }}">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-contain mb-3 rounded " />
                @endif
            </a>
            <a href="{{ route('shop.show', $product) }}">
                <h3 class="font-semibold">{{ $product->name }}</h3>
            </a>
            <p class="text-sm text-gray-500 mb-3">{{ $product->price_per_day }} DH / day</p>
            <a href="{{ route('shop.show', $product) }}" class="bg-orange-500 text-white px-3 py-2 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 w-full"> Rent</a>
        </div>
    @endforeach
    </div>
</div>
{{-- CTA Section --}}
<section class="bg-black py-12">
    <div class="max-w-[90rem] mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-4 items-baseline
">
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
<footer class="bg-black text-white py-6 ">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Equipment Rental. All Rights Reserved.</p>
    </div>
</footer>

@endsection