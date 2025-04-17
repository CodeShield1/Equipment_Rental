@extends('layouts.app')

@section('content')
<section class="relative w-full h-[70vh] max-w-[90rem] my-[3rem] mx-auto" data-aos="fade-up">
    <div class="relative w-full h-full md:overflow-hidden flex flex-col md:flex-row items-center justify-between">
        <!-- Text Section -->
        <div class="flex-1 text-left px-4 md:px-8">
            <div class="max-w-xl">
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-950 mb-4 ibm leading-20">Rent Construction Equipment Easily</h1>
                <p class="text-gray-800 text-md sm:text-xl mb-6">From excavators to power tools, get everything you need for your construction site in just a few clicks. Flexible rental terms, trusted brands, and 24/7 support to keep your project running smoothly.</p>
                <a href="{{ route('shop.index') }}" class="bg-orange-500 hover:bg-orange-600 px-6 py-3 rounded text-white font-semibold text-lg">Browse Equipment</a>
            </div>
        </div>

        <!-- Image Section -->
        <div class="swiper-container overflow-x-hidden hidden md:block" id="swiper" data-aos="fade-left">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{ asset('images/hero.jpg') }}" alt="hero image"></div>
                <div class="swiper-slide"><img src="{{ asset('images/hero2.jpg') }}" alt="hero image 2"></div>
                <div class="swiper-slide"><img src="{{ asset('images/hero3.jpg') }}" alt="hero image 3"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="w-full mt-[2rem] block md:hidden px-4">
            <img class="w-full" src="{{ asset('images/hero.jpg') }}" alt="hero image">
        </div>
    </div>
</section>

{{-- Featured Categories --}}
<section class="max-w-[90rem] mx-auto px-4 py-12 mt-[6rem] md:mt-0" data-aos="fade-up">
    <h2 class="text-2xl font-bold mb-6 text-black ibm">Equipment Categories</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($categories as $category)
            <a href="{{ route('shop.index', $category->id) }}" class="bg-white p-4 shadow rounded flex items-center justify-between">
                <div class="w-[20%]">
                    <img class="w-full" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                </div>
                <div class="w-[75%]">
                    <h3 class="font-semibold text-lg mb-1">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $category->products_count }} products</p>
                </div>
            </a>
        @endforeach
    </div>
</section>

{{-- Most Rented --}}
<section class="bg-gray-100 py-12" data-aos="fade-up">
    <div class="max-w-[90rem] mx-auto px-4">
        <h2 class="text-2xl font-bold mb-6 text-black ibm">Most Rented Equipment</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($mostRented as $product)
                <a href="{{ route('shop.show', $product->id) }}" class="bg-white p-4 rounded shadow hover:shadow-md transition block">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-contain mb-2 rounded">
                    @endif
                    <h3 class="font-semibold text-black">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $product->price_per_day }} DH/day</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- About Section --}}
<section class="bg-white border-t overflow-hidden" >
    <div class="max-w-[88rem] py-12 mx-auto px-4 flex flex-col md:flex-row items-center space-x-8">
        <div class="flex-1 text-left mb-8 md:mb-0 " data-aos="fade-right">
            <h2 class="text-2xl font-bold mb-4 text-black ibm">About Our Company</h2>
            <p class="text-gray-600 mb-4 md:w-[75%]">
                We provide top-notch construction equipment for contractors, builders, and businesses across Morocco.
                Our goal is to make equipment rental as seamless as possible with excellent customer service and fast delivery.
            </p>
            <p class="text-gray-600 mb-6 md:w-[75%]">Contact us for bulk rentals or partnerships. We're here to support your next project.</p>
            <a href="#contact" class="bg-orange-500 hover:bg-orange-600 px-6 py-3 rounded text-white font-semibold text-lg">
                Get in Touch
            </a>
        </div>
        <div class="flex-1 m-sm-0" style="margin: 0;" data-aos="fade-left">
            <img src="{{ asset('images/about.jpeg') }}" alt="Company Image" class="w-full shadow-lg sm:h-[405px] object-cover shadow-md">
        </div>
    </div>
</section>

{{-- Featured Products --}}
<section class="max-w-[90rem] mx-auto px-4 py-12" data-aos="fade-up">
    <h2 class="text-2xl font-bold mb-6 text-black ibm">Featured Equipment</h2>
    @if($featured->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($featured as $product)
            <a href="{{ route('shop.show', $product->id) }}" class="bg-white p-4 rounded shadow hover:shadow-md transition block">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-contain mb-2 rounded">
                @endif
                <h3 class="font-semibold text-black">{{ $product->name }}</h3>
                <p class="text-sm text-gray-600">{{ $product->price_per_day }} DH/day</p>
            </a>
        @endforeach
    </div>
    @else
        <p>No featured products available at the moment.</p>
    @endif
</section>

{{-- Testimonials --}}
<section class="bg-white py-12" id="testimonials" >
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8 text-center text-black ibm">What Our Clients Say</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-6 shadow-lg rounded text-center" data-aos="fade-down" >
                <p class="text-gray-600 mb-4 italic">"The rental process was smooth and fast. We got our bulldozer delivered within hours!"</p>
                <div class="font-semibold text-orange-500">Ahmed Z.</div>
                <div class="text-sm text-gray-400">Site Manager, Casablanca</div>
            </div>
            <div class="bg-white p-6 shadow-lg rounded text-center" data-aos="fade-down" data-aos-delay="300">
                <p class="text-gray-600 mb-4 italic">"Super professional team. We’ll definitely rent again for future projects."</p>
                <div class="font-semibold text-orange-500">Fatima B.</div>
                <div class="text-sm text-gray-400">Construction Supervisor, Rabat</div>
            </div>
            <div class="bg-white p-6 shadow-lg rounded text-center" data-aos="fade-down" data-aos-delay="600">
                <p class="text-gray-600 mb-4 italic">"Great variety of machines and reasonable prices. Highly recommend!"</p>
                <div class="font-semibold text-orange-500">Youssef M.</div>
                <div class="text-sm text-gray-400">Freelancer, Marrakech</div>
            </div>
        </div>
    </div>
</section>

{{-- Contact Us --}}
<section class="bg-white py-[7rem] " id="contact" data-aos="fade-up">
    <div class="max-w-[90rem] mx-auto px-4 flex flex-col md:flex-row  space-x-8">
        <div class="flex-1 mb-8 md:mb-0">
            <img src="{{ asset('images/contact.jpg') }}" alt="Company Image" class="w-full h-full object-cover rounded-lg shadow-xl">
        </div>

        <!-- Form Section -->
        <div class="flex-1 text-left cont md:w-full md:mx-0">
            <h2 class="text-3xl font-bold text-black mb-6">Ready To Get Started?</h2>
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 mb-6 rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
                @csrf
                <!-- Name Fields -->
                <div class="flex items-center justify-between">
                    <div class="w-[48%]">
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="first_name" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500" required>
                    </div>
                    <div class="w-[48%]">
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <input type="text" name="last_name" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500" required>
                    </div>
                </div>

                <!-- Phone and Email -->
                <div class="flex items-center justify-between">
                    <div class="w-[48%]">
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="text" name="phone" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500" required>
                    </div>
                    <div class="w-[48%]">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500" required>
                    </div>
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Your Message</label>
                    <textarea name="message" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-orange-500" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 w-full">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>

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
