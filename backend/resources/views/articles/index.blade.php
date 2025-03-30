<x-app-layout>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Articles</h1>
            <div>
                @guest
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 mr-4">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Register to Contribute</a>
                @else
                    @can('create', App\Models\Article::class)
                        <a href="{{ route('articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                            Create New Article
                        </a>
                    @endcan
                @endguest
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 bg-green-100 text-green-700 p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if($articles->isEmpty())
            <div class="bg-blue-100 text-blue-700 p-4 rounded-md">
                No articles found.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($articles as $article)
                    <div class="bg-white shadow rounded-lg p-6 {{ isset($article->is_expired) ? 'bg-gray-50' : '' }}">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <p class="text-gray-500 mb-2">By {{ $article->contributor_username }}</p>
                        @if(isset($article->is_expired))
                            @php
                                $now = \Carbon\Carbon::now();
                                $status = $article->end_date < $now ? 'Expired' : 'Upcoming';
                            @endphp
                            <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded-md text-sm mb-2">{{ $status }}</span>
                        @endif
                        <p class="text-gray-700 my-3" style="word-wrap: break-word">{{ Str::limit(strip_tags($article->body), 150) }}</p>
                        <div class="text-sm text-gray-600 mb-4">
                            <div>Created: {{ $article->create_date->format('M d, Y') }}</div>
                            <div>Active Period: {{ $article->start_date->format('M d, Y') }} - {{ $article->end_date->format('M d, Y') }}</div>
                        </div>
                        <div class="flex justify-between items-center">
                            @if(!isset($article->is_expired))
                                <a href="{{ route('articles.show', $article) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm">
                                    View Details
                                </a>
                            @endif
                            @can('update', $article)
                                <div class="space-x-2">
                                    <a href="{{ route('articles.edit', $article) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
