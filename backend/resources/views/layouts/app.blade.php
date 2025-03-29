<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'The Blog') }}</title>

        <!-- Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <main class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>

        <footer class="bg-white shadow-lg mt-auto">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h5 class="text-lg font-semibold text-gray-900">COMP 3975 - Assignment 2</h5>
                        <h6 class="text-sm font-medium text-gray-600">Team Members:</h6>
                        <ul class="mt-2 space-y-1">
                            <li class="text-sm text-gray-500">Amal Allaham</li>
                            <li class="text-sm text-gray-500">Jeffery M Joseph</li>
                        </ul>
                    </div>
                    <div class="text-sm text-gray-500">
                        &copy; {{ date('Y') }} The Blog. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
