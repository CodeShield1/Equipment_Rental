@extends('admin.layout')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-black mb-6 flex items-center gap-2">
            <i class="fas fa-edit text-orange-500"></i> Edit Product
        </h2>

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.products.form', ['buttonText' => 'Update'])
        </form>
    </div>
@endsection
