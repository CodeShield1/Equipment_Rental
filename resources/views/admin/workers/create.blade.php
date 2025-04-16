<!-- resources/views/admin/workers/create.blade.php -->

@extends('admin.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Add New Worker</h1>

        <form action="{{ route('admin.workers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Worker Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="w-full border-gray-300 rounded-md px-4 py-2" required>
            </div>

            <!-- Worker Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full border-gray-300 rounded-md px-4 py-2" required>
            </div>

            <!-- Worker Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-md px-4 py-2" required>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Worker Image</label>
                <input type="file" name="image" id="image" class="w-full border-gray-300 rounded-md px-4 py-2">
            </div>

            <!-- Equipment Selection -->
            <div class="mb-4">
                <label for="equipment" class="block text-sm font-medium text-gray-700">Assign Equipment</label>
                <select name="equipment[]" id="equipment" class="w-full border-gray-300 rounded-md px-4 py-2" multiple>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded-lg">Create Worker</button>
        </form>
    </div>
@endsection
