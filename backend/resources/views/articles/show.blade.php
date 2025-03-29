@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title mb-4">{{ $article->title }}</h1>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="text-muted">
                            <div>By {{ $article->contributor_username }}</div>
                            <div>Created on {{ $article->create_date->format('M d, Y') }}</div>
                            <div>Active: {{ $article->start_date->format('M d, Y') }} - {{ $article->end_date->format('M d, Y') }}</div>
                        </div>
                        
                        @can('update', $article)
                            <div class="btn-group">
                                <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning">
                                    Edit
                                </a>
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>

                    <div class="card-text">
                        {!! nl2br(e($article->body)) !!}
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">
                            Back to Articles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 