@extends('admin.layout')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-black flex items-center gap-2">
            <i class="fas fa-folder text-orange-500"></i> Categories
        </h2>
        <a href="{{ route('admin.categories.create') }}"
           class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-4 py-2 rounded shadow transition">
            <i class="fas fa-plus mr-1"></i> Add Category
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4 text-sm shadow-sm">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
            <thead class="bg-gray-100 text-gray-700 text-sm uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 text-sm divide-y divide-gray-100">
                @forelse($categories as $category)
                    <tr class="hover:bg-orange-50 transition">
                        <td class="px-6 py-3">{{ $category->name }}</td>
                        <td class="px-6 py-3 text-right space-x-3">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="text-orange-500 hover:underline font-medium inline-flex items-center gap-1">
                                <i class="fas fa-edit"></i> <span>Edit</span>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                  method="POST" class="inline-block">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this category?')"
                                        class="text-red-500 hover:underline font-medium inline-flex items-center gap-1">
                                    <i class="fas fa-trash"></i> <span>Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center px-6 py-4 text-gray-500">
                            <i class="fas fa-circle-info mr-1"></i> No categories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
