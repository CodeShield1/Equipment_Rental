@csrf
<div class="bg-white p-6 rounded shadow max-w-md">
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
        <input type="text" name="name"
               value="{{ old('name', $category->name ?? '') }}"
               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit"
            class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded shadow inline-flex items-center gap-2">
        <i class="fas fa-save"></i> {{ $buttonText ?? 'Save' }}
    </button>
</div>
