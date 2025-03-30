<x-app-layout>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-100 px-6 py-4 border-b">
                <h2 class="text-2xl font-bold text-gray-800">Dashboard</h2>
            </div>

            <div class="px-6 py-6">
                @auth
                    <p class="text-gray-700 mb-4">
                        Welcome back, <span class="font-semibold">{{ Auth::user()->first_name }}</span>!
                    </p>
                    <div class="flex flex-wrap gap-4">
                        @if (Auth::user()->is_approved && Auth::user()->role !== 'Admin')
                            <a href="{{ route('articles.index') }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                                View Articles
                            </a>

                            <a href="{{ route('articles.create') }}"
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                                Create Article
                            </a>
                        @endif

                        @if (Auth::user()->role === 'Admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                                Admin Dashboard
                            </a>
                        @endif
                    </div>
                @endauth

                @guest
                    <div class="text-gray-700 mb-4">
                        <p class="mb-2">Welcome! Please log in or register to access the dashboard.</p>
                        <div class="flex gap-4">
                            <a href="{{ route('login') }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                               class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                                Register
                            </a>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</x-app-layout>
