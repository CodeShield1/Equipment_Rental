@extends('admin.layout')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-bold text-black mb-6 flex items-center gap-2">
            <i class="fas fa-plus text-orange-500"></i> Add Product
        </h2>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @include('admin.products.form', ['buttonText' => 'Create'])
        </form>
    </div>
@endsection
