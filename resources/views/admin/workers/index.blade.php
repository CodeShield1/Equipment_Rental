<!-- resources/views/admin/workers/index.blade.php -->

@extends('admin.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-6">Manage Workers</h1>

        <a href="{{ route('admin.workers.create') }}" class="bg-orange-500 text-white px-6 py-3 rounded mb-6 inline-block">
            Add New Worker
        </a>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-left">
                <thead>
                    <tr>
                        <th class="p-3">Image</th>
                        <th class="p-3">Name</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">City</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workers as $worker)
                        <tr>
                            <td class="p-3">
                                <img src="{{ asset('storage/' . $worker->image) }}" alt="Worker Image" class="mt-4 w-16 h-16 object-cover">
                            </td>
                            <td class="p-3">{{ $worker->name }}</td>
                            <td class="p-3">{{ $worker->email }}</td>
                            <td class="p-3">{{ $worker->city }}</td>
                            <td class="p-3">
                                <span class="text-sm {{ $worker->status == 'available' ? 'text-green-500' : 'text-red-500' }}">
                                    {{ ucfirst($worker->status) }}
                                </span>
                            </td>
                            <td class="p-3">
                                <a href="{{ route('admin.workers.edit', $worker->id) }}" class="text-blue-500">Edit</a> |
                                <form action="{{ route('admin.workers.destroy', $worker->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
