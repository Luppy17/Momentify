@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Create New Event Manager</h1>

    <!-- Back Button -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('role.management.event.manager.index') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            ← Back to event manager list
        </a>
    </div>

    <!-- Create Event Form -->
    <form action="{{ route('role.management.event.manager.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" required
                    class="w-full mt-1 p-2 border rounded" placeholder="Enter name">
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" required
                    class="w-full mt-1 p-2 border rounded text-gray-500 dark:text-gray-500">
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                    class="w-full mt-1 p-2 border rounded text-gray-500 dark:text-gray-500">
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full mt-1 p-2 border rounded text-gray-500 dark:text-gray-500">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create Event Manager
            </button>
        </div>
    </form>
</div>
@endsection
