@csrf
<div class="bg-white p-6 rounded shadow max-w-3xl">

    <div class="grid md:grid-cols-2 gap-6 mb-6">
        <!-- Product Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
            <input type="text" name="name"
                   value="{{ old('name', $product->name ?? '') }}"
                   class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Category -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category_id"
                    class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>

    <!-- Price -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Price per Day (DH)</label>
        <input type="number" step="0.01" name="price_per_day"
               value="{{ old('price_per_day', $product->price_per_day ?? '') }}"
               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
        @error('price_per_day') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Description -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3"
                  class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <!-- Image Upload -->
    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
        <input type="file" name="image" id="imageInput"
               class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-orange-400">
        
        <div class="mt-3">
            <img id="imagePreview"
                 src="{{ isset($product) && $product->image ? asset('storage/' . $product->image) : '' }}"
                 class="w-24 h-24 rounded object-cover border border-gray-200 shadow-sm {{ isset($product) && $product->image ? '' : 'hidden' }}">
        </div>
    </div>
        <!-- Availability -->
    <div class="mb-6">
        <label class="inline-flex items-center text-sm text-gray-700">
            <input type="checkbox" name="available" value="1"
                   class="text-orange-500 focus:ring-orange-400 border-gray-300 rounded mr-2"
                   {{ old('available', $product->available ?? true) ? 'checked' : '' }}>
            Available
        </label>
    </div>

    <!-- Submit Button -->
    <div class="text-right">
        <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium px-5 py-2 rounded shadow inline-flex items-center gap-2">
            <i class="fas fa-save"></i> {{ $buttonText ?? 'Save' }}
        </button>
    </div>
</div>
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            imagePreview.classList.remove('hidden');
        }
    });
</script>
