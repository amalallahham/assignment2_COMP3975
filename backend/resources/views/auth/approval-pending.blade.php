<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Pending Approval') }}
        </h2>
    </x-slot>

    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow rounded-lg">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Account Pending Approval</h3>
            </div>

            <div class="p-6">
                <div class="bg-blue-100 text-blue-700 p-4 rounded-md mb-6">
                    <h4 class="font-semibold text-lg mb-2">Thank you for registering!</h4>
                    <p>Your account is currently pending approval from an administrator. You will be notified when your account has been approved.</p>
                    <hr class="my-4 border-blue-200">
                    <p class="mb-0">Once approved, you will have full access to contribute articles to our blog.</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-md">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
