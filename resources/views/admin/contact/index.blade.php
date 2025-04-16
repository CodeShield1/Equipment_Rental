@extends('admin.layout')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Contact Messages</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Phone</th>
                    <th class="py-2 px-4 border-b">Message</th>
                    <th class="py-2 px-4 border-b">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $message->first_name }} {{ $message->last_name }}</td>
                        <td class="py-2 px-4 border-b">{{ $message->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $message->phone }}</td>
                        <td class="py-2 px-4 border-b">{{ $message->message }}</td>
                        <td class="py-2 px-4 border-b">
                            <!-- You can add actions like view or delete here -->
                            <a href="#" class="text-blue-600 hover:text-blue-800">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
