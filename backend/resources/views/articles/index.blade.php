@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Articles</h1>
        <div>
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Register to Contribute</a>
            @else
                @can('create', App\Models\Article::class)
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">
                        Create New Article
                    </a>
                @endcan
            @endguest
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($articles->isEmpty())
        <div class="alert alert-info">
            No articles found.
        </div>
    @else
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 {{ isset($article->is_expired) ? 'bg-light' : '' }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                By {{ $article->contributor_username }}
                            </h6>
                            @if(isset($article->is_expired))
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $status = $article->end_date < $now ? 'Expired' : 'Upcoming';
                                @endphp
                                <div class="badge bg-secondary mb-2">{{ $status }}</div>
                            @endif
                            <p class="card-text">
                                {{ Str::limit(strip_tags($article->body), 150) }}
                            </p>
                            <div class="text-muted small mb-3">
                                <div>Created: {{ $article->create_date->format('M d, Y') }}</div>
                                <div>Active Period: {{ $article->start_date->format('M d, Y') }} - {{ $article->end_date->format('M d, Y') }}</div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                @if(!isset($article->is_expired))
                                    <a href="{{ route('articles.show', $article) }}" class="btn btn-primary btn-sm">
                                        View Details
                                    </a>
                                @endif
                                @can('update', $article)
                                    <div class="btn-group">
                                        <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this article?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection 