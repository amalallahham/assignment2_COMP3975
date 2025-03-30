<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Article') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b">
                <h5 class="text-lg font-semibold text-gray-700">Edit Article</h5>
            </div>
            <form action="{{ route('articles.update', $article) }}" method="POST" class="px-6 py-6">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Title</label>
                    <input type="text" name="title" id="title" required value="{{ old('title', $article->title) }}"
                        class="w-full rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 @error('title') border-red-500 @enderror">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="body" class="block text-gray-700 font-medium mb-2">Content</label>
                    <textarea name="body" id="body" rows="10" required
                        class="w-full rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 @error('body') border-red-500 @enderror">{{ old('body', $article->body) }}</textarea>
                    @error('body')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="start_date" class="block text-gray-700 font-medium mb-2">Start Date</label>
                        <input type="date" name="start_date" id="start_date" required
                            value="{{ old('start_date', $article->start_date->format('Y-m-d')) }}"
                            class="w-full rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 @error('start_date') border-red-500 @enderror">
                        @error('start_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700 font-medium mb-2">End Date</label>
                        <input type="date" name="end_date" id="end_date" required
                            value="{{ old('end_date', $article->end_date->format('Y-m-d')) }}"
                            class="w-full rounded border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 @error('end_date') border-red-500 @enderror">
                        @error('end_date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('articles.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded transition duration-200">Cancel</a>
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded transition duration-200">Update Article</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('start_date').addEventListener('change', function() {
            document.getElementById('end_date').min = this.value;
        });
    </script>
    @endpush

</x-app-layout>
