<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="{{ asset('css/tailwind-output.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs" defer></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">

<div x-data="{ open: window.innerWidth >= 1024 ? true : false }" class="flex min-h-screen">

    <!-- Sidebar -->
    <aside :class="{ 'w-64': open, 'w-16': !open }"
           class="bg-black text-white transition-all duration-300 ease-in-out flex flex-col justify-between overflow-hidden shadow-lg">

        <div>
            <!-- Logo + Toggle -->
            <div class="flex items-center justify-between p-4 border-b border-gray-800">
                <span x-show="open" class="text-orange-400 font-bold text-xl transition-all duration-300">Equipment Rental</span>
                <button @click="open = !open" class="text-white text-lg focus:outline-none">
                    <i x-show="!open" class="fas fa-bars"></i>
                    <i x-show="open" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Menu -->
            <nav class="mt-6">
                <ul class="px-4">
                    @php
                        $active = 'text-orange-400';
                        $inactive = 'text-white hover:text-orange-400';
                    @endphp

                    <li class="mt-[2.5rem]">
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 {{ request()->routeIs('admin.dashboard') ? $active : $inactive }}">
                            <i class="fas fa-chart-line w-5 "></i>
                            <span x-show="open" class="transition-all duration-300">Dashboard</span>
                        </a>
                    </li>
                    <li class="mt-[2.5rem]">
                        <a href="{{ route('admin.categories.index') }}"
                           class="flex items-center gap-3 {{ request()->routeIs('admin.categories.*') ? $active : $inactive }}">
                            <i class="fas fa-folder w-5 "></i>
                            <span x-show="open">Categories</span>
                        </a>
                    </li>
                    <li class="mt-[2.5rem]">
                        <a href="{{ route('admin.products.index') }}"
                           class="flex items-center gap-3 {{ request()->routeIs('admin.products.*') ? $active : $inactive }}">
                            <i class="fas fa-boxes-stacked w-5 "></i>
                            <span x-show="open">Products</span>
                        </a>
                    </li>
                    <li class="mt-[2.5rem]">
                        <a href="{{ route('admin.rentals.index') }}"
                           class="flex items-center gap-3 {{ request()->routeIs('admin.rentals.*') ? $active : $inactive }}">
                            <i class="fas fa-truck-loading w-5 "></i>
                            <span x-show="open">Rentals</span>
                        </a>
                    </li>
                    <li class="mt-[2.5rem]">
                        <a href="{{ route('admin.workers.index') }}"
                           class="flex items-center gap-3 {{ request()->routeIs('admin.workers.*') ? $active : $inactive }}">
                           <i class="fa-solid fa-users w-5"></i> 
                            <span x-show="open">Worker</span>
                        </a>
                    </li>
                    <li class="mt-[2.5rem]">
                        <a href="{{ route('admin.contact.index') }}"
                           class="flex items-center gap-3 {{ request()->routeIs('admin.contact.*') ? $active : $inactive }}">
                           <i class="fa-solid fa-envelope w-5"></i> 
                            <span x-show="open">Client Messages</span>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="p-4 border-t border-gray-800">
            @csrf
            <button type="submit" class="flex items-center gap-3 text-sm text-gray-300 hover:text-orange-400 w-full">
                <i class="fas fa-sign-out-alt w-4"></i>
                <span x-show="open">Logout</span>
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6 bg-white overflow-y-auto">
        @yield('content')
    </div>

</div>

</body>
</html>
