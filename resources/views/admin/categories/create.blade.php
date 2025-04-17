@extends('admin.layout')

@section('content')
    <div class="max-w-xl">
        <h2 class="text-2xl font-bold text-black mb-6 flex items-center gap-2">
            <i class="fas fa-plus text-orange-500"></i> Add Category
        </h2>
        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
            @include('admin.categories.form', ['buttonText' => 'Create'])
        </form>
    </div>
@endsection
