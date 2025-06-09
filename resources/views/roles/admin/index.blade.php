@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Admin List</h1>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <!-- Search Form -->
        <form action="{{ route('role.management.admin.index') }}" method="GET" class="flex items-center">
            <input
                type="text"
                name="search"
                placeholder="Search for events..."
                value="{{ request('search') }}"
                class="w-100 p-2 rounded border border-gray-300 dark:border-gray-300"
            />
            <button
                type="submit"
                class="ml-2 bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600 dark:bg-blue-500 dark:hover:bg-blue-600"
            >
                Search
            </button>
        </form>

        <!-- Add Event Button -->
        <a href="{{ route('role.management.admin.create') }}"
            class="bg-blue-500 dark:bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 dark:hover:bg-blue-600">
            + Add New Admin
        </a>
    </div>


    <!-- Events Table -->
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg">
            <thead class="bg-gray-800 dark:bg-gray-700 text-white">
                <tr>
                    <th class="py-4 px-6 text-left text-sm font-medium tracking-wide">Name</th>
                    <th class="py-4 px-6 text-left text-sm font-medium tracking-wide">Email</th>
                    <th class="py-4 px-6 text-center text-sm font-medium tracking-wide">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 dark:text-gray-300">
                @foreach($admins as $admin)
                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                        <td class="py-4 px-6">{{ $admin->name }}</td>
                        <td class="py-4 px-6">{{ $admin->email }}</td>
                        <td class="py-4 px-6 text-center flex justify-center space-x-4">
                            <!-- Delete Button -->
                            <form action="{{ route('role.management.admin.destroy', $admin->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="{{ $admin->status === 'active' ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} text-white text-sm px-4 py-2 rounded-lg shadow transition"
                                        onclick="return confirm('Are you sure you want to {{ $admin->status === 'active' ? 'deactivate' : 'activate' }} this admin?')">
                                    {{ $admin->status === 'active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
