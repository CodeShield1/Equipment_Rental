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
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
        <input type="file" name="image" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-400 focus:border-orange-400">
        @error('image')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        @if(isset($category->image) && $category->image) <!-- Check if the image exists and is not null -->
            <div class="mt-3">
                <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="w-32 h-32 object-cover rounded">
            </div>
        @else
            <div class="mt-3" id="image-preview" style="display:none;">
                <img id="image-preview-img" src="" alt="Preview" class="w-32 h-32 object-cover rounded">
            </div>
        @endif
        </div>
    <button type="submit"
            class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-4 py-2 rounded shadow inline-flex items-center gap-2">
        <i class="fas fa-save"></i> {{ $buttonText ?? 'Save' }}
    </button>
</div>
<script>
    document.querySelector('input[name="image"]').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const previewImg = document.getElementById('image-preview-img');
                previewImg.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
