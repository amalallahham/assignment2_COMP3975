<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel Blog') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Custom styles -->
        <style>
            body {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .content {
                flex: 1;
            }
            footer {
                margin-top: auto;
                padding: 20px 0;
                background-color: #f8f9fa;
                border-top: 1px solid #dee2e6;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel Blog') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('articles.index') }}">Articles</a>
                        </li>
                        @auth
                            @if(Auth::user()->is_approved)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('articles.create') }}">Create Article</a>
                                </li>
                            @endif
                            @if(Auth::user()->role === 'Admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->first_name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="content py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>COMP 3975 - Assignment 2</h5>
                        <h6>Team Members:</h6>
                        <ul class="list-unstyled">
                            <li>Amal Allaham</li>
                            <li>Jeffery M Joseph</li>
                        </ul>
                    </div>
                    <div class="col-md-6 text-end">
                        <p>&copy; {{ date('Y') }} Laravel Blog. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
