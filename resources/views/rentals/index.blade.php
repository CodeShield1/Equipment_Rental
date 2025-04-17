@extends('layouts.app')

@section('content')
<div class="max-w-[90rem] mx-auto px-4 py-6">
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
