@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Browse Equipment</h1>

    <!-- Sorting and Filtering Controls -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center justify-between w-full space-x-4">
            <!-- Filter by Category -->
            <select id="categoryFilter" class="border rounded px-8 py-2 text-sm">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <!-- Sorting Options -->
            <select id="sortBy" class="border rounded px-4 py-2 text-sm">
                <option value="name">Sort by Name</option>
                <option value="price_asc">Sort by Price (Low to High)</option>
                <option value="price_desc">Sort by Price (High to Low)</option>
            </select>
        </div>
    </div>

    <!-- Product Grid -->
    <div id="productGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded shadow p-4 product-item" data-category="{{ $product->category_id }}" data-name="{{ $product->name }}" data-price="{{ $product->price_per_day }}">
                <a href="{{ route('shop.show', $product) }}">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-40 object-cover mb-3 rounded" />
                    @endif
                </a>
                <h3 class="font-semibold">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500 mb-2">{{ $product->price_per_day }} DH / day</p>
                <a href="{{ route('shop.show', $product) }}" class="text-blue-600 hover:underline text-sm">View & Rent</a>
            </div>
        @endforeach
    </div>
</div>
<footer class="bg-black text-white py-6 mt-[3rem]">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm">&copy; {{ date('Y') }} Equipment Rental. All Rights Reserved.</p>
    </div>
</footer>

@endsection

@push('scripts')
<script>
    // Filter and Sort functionality
    document.getElementById('categoryFilter').addEventListener('change', function() {
        filterAndSort();
    });

    document.getElementById('sortBy').addEventListener('change', function() {
        filterAndSort();
    });

    function filterAndSort() {
        const categoryFilter = document.getElementById('categoryFilter').value;
        const sortBy = document.getElementById('sortBy').value;
        const productGrid = document.getElementById('productGrid');
        const products = Array.from(productGrid.getElementsByClassName('product-item'));

        // Filter products based on category
        let filteredProducts = products.filter(product => {
            if (categoryFilter === '') return true; // Show all if no category selected
            return product.getAttribute('data-category') === categoryFilter;
        });

        // Sort products based on selected sorting option
        if (sortBy === 'price_asc') {
            filteredProducts.sort((a, b) => parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price')));
        } else if (sortBy === 'price_desc') {
            filteredProducts.sort((a, b) => parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price')));
        } else if (sortBy === 'name') {
            filteredProducts.sort((a, b) => a.getAttribute('data-name').localeCompare(b.getAttribute('data-name')));
        }

        // Clear the current grid and append the filtered and sorted products
        productGrid.innerHTML = '';
        filteredProducts.forEach(product => {
            productGrid.appendChild(product);
        });
    }

    // Initial call to ensure the page loads with the correct filtering/sorting
    filterAndSort();
</script>
@endpush
