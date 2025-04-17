@extends('admin.layout')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black flex items-center gap-2">
            <i class="fas fa-boxes-stacked text-orange-500"></i> Products
        </h2>
        <a href="{{ route('admin.products.create') }}"
           class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded shadow transition">
            <i class="fas fa-plus mr-1"></i> Add Product
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4 text-sm shadow-sm">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 text-left">Image</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Price/Day</th>
                    <th class="px-6 py-3 text-left">Available</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 text-sm divide-y divide-gray-100">
                @foreach($products as $product)
                    <tr class="hover:bg-orange-50 transition">
                        <td class="px-6 py-3">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-16 h-16 object-cover rounded border">
                            @else
                                <div class="text-gray-400 italic">No image</div>
                            @endif
                        </td>
                        <td class="px-6 py-3 font-medium">{{ $product->name }}</td>
                        <td class="px-6 py-3">{{ $product->category->name }}</td>
                        <td class="px-6 py-3">{{ $product->price_per_day }} DH</td>
                        <td class="px-6 py-3">
                            @if($product->quantity_available > 0)
                                <span class="inline-flex items-center gap-1 text-green-600">
                                    <i class="fas fa-check-circle"></i> Yes
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-red-500">
                                    <i class="fas fa-times-circle"></i> No
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3 text-right space-x-3">
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="text-orange-500 hover:underline inline-flex items-center gap-1">
                                <i class="fas fa-edit"></i> <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}"
                                  method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this product?')"
                                        class="text-red-500 hover:underline inline-flex items-center gap-1">
                                    <i class="fas fa-trash"></i> <span>Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
