@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Welcome to Laravel Blog</h2>
                </div>
                <div class="card-body">
                    @auth
                        <p>You're logged in! Check out our latest articles or create your own.</p>
                        <div class="mt-4">
                            <a href="{{ route('articles.index') }}" class="btn btn-primary">View Articles</a>
                            @if(Auth::user()->is_approved)
                                <a href="{{ route('articles.create') }}" class="btn btn-success">Create Article</a>
                            @endif
                        </div>
                    @else
                        <p>Please login or register to access all features.</p>
                        <div class="mt-4">
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
