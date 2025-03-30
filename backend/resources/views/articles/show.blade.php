<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Article Details') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-6 py-4">
                <h1 class="text-2xl font-bold mb-4 text-gray-900">{{ $article->title }}</h1>

                <div class="flex justify-between items-center border-b pb-4 mb-4">
                    <div class="text-sm text-gray-600">
                        <div>By {{ $article->contributor_username }}</div>
                        <div>Created on {{ $article->create_date->format('M d, Y') }}</div>
                        <div>Active: {{ $article->start_date->format('M d, Y') }} - {{ $article->end_date->format('M d, Y') }}</div>
                    </div>

                    @can('update', $article)
                        <div class="space-x-2">
                            <a href="{{ route('articles.edit', $article) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">
                                Edit
                            </a>

                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this article?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>

                <div class="prose text-gray-700 whitespace-pre-wrap " style="word-wrap: break-word">
                    {!! nl2br(e($article->body)) !!}
                </div>

                <div class="mt-6">
                    <a href="{{ route('articles.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md">
                        Back to Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>