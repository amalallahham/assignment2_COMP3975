<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Users</h1>

        @if (session('success'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Username</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Approved</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Role</th>
                        <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $user->username }}</td>
                            <td class="px-4 py-2 text-sm">
                                @if ($user->is_approved)
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded">Yes</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs font-semibold bg-red-100 text-red-600 rounded">No</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $user->role }}</td>
                            <td class="px-4 py-2 space-x-2">
                                @if ($user->role !== 'Admin')
                                    @if (! $user->is_approved)
                                        <form action="{{ route('admin.approve', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white text-sm rounded">Approve</button>
                                        </form>
                                    @endif
                
                                    @if ($user->role === 'Contributor')
                                        <form action="{{ route('admin.promote', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded">Promote</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>

</x-app-layout>
