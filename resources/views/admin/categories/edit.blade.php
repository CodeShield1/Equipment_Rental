@extends('admin.layout')

@section('content')
    <div class="max-w-xl">
        <h2 class="text-2xl font-bold text-black mb-6 flex items-center gap-2">
            <i class="fas fa-edit text-orange-500"></i> Edit Category
        </h2>
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @method('PUT')
            @include('admin.categories.form', ['buttonText' => 'Update'])
        </form>
    </div>
@endsection
