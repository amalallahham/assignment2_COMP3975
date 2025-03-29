@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">{{ $article->title }}</h1>
        <div class="flex space-x-3">
            <a href="{{ route('articles.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Back to Articles
            </a>
            @can('update', $article)
                <a href="{{ route('articles.edit', $article) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Edit Article
                </a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this article?')">
                        Delete Article
                    </button>
                </form>
            @endcan
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-8">
        <div class="flex justify-between items-start mb-6">
            <div>
                <p class="text-sm text-gray-500">By {{ $article->contributor_username }}</p>
                <p class="text-sm text-gray-500">Created on: {{ $article->create_date->format('M d, Y') }}</p>
                <p class="text-sm text-gray-500">Active Period: {{ $article->start_date->format('M d, Y') }} - {{ $article->end_date->format('M d, Y') }}</p>
            </div>
            @if(!$article->isActive())
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                    {{ $article->end_date < now() ? 'Expired' : 'Upcoming' }}
                </span>
            @endif
        </div>

        <div class="prose max-w-none">
            {!! $article->body !!}
        </div>
    </div>
</div>
@endsection 