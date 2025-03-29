<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articles') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">All Articles</h1>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 mr-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Register to Contribute
                    </a>
                @else
                    @can('create', App\Models\Article::class)
                        <a href="{{ route('articles.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Create New Article
                        </a>
                    @endcan
                @endguest
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($articles->isEmpty())
            <div class="text-center py-12 bg-white shadow rounded">
                <p class="text-gray-500">No articles found.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($articles as $article)
                    <div class="bg-white shadow rounded-lg overflow-hidden {{ isset($article->is_expired) && $article->is_expired ? 'opacity-75' : '' }}">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h2 class="text-xl font-semibold text-gray-800">{{ $article->title }}</h2>
                                @if(isset($article->is_expired) && $article->is_expired)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Expired
                                    </span>
                                @endif
                            </div>
                            <p class="text-gray-600 mb-4 line-clamp-3">{{ strip_tags($article->body) }}</p>
                            <div class="text-sm text-gray-500 mb-4">
                                <p>By {{ $article->contributor_username }}</p>
                                <p>Active Period: {{ $article->start_date->format('M d, Y') }} - {{ $article->end_date->format('M d, Y') }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                @if($article->isActive())
                                    <a href="{{ route('articles.show', $article) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        Read More
                                    </a>
                                @endif
                                @auth
                                    @can('update', $article)
                                        <div class="flex space-x-2">
                                            <a href="{{ route('articles.edit', $article) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                                Edit
                                            </a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this article?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endcan
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout> 