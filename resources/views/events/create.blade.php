@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Create New Event</h1>

    <!-- Back Button -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('eventconfig.index') }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            ← Back to Events
        </a>
    </div>

    <!-- Create Event Form -->
    <form action="{{ route('eventconfig.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="event_name" class="block text-gray-700">Event Name</label>
            <input type="text" name="event_name" id="event_name" required
                   class="w-full mt-1 p-2 border rounded" placeholder="Enter event name">
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700">Event Date</label>
            <input type="date" name="date" id="date" required
                   class="w-full mt-1 p-2 border rounded text-gray-500 dark:text-gray-500">
        </div>

        <div class="mb-4">
            <label for="time" class="block text-gray-700">Event Time</label>
            <input type="time" name="time" id="time" required
                   class="w-full mt-1 p-2 border rounded text-gray-500 dark:text-gray-500">
        </div>

        <div class="mb-4">
            <label for="event_place" class="block text-gray-700">Event Place</label>
            <input type="text" name="event_place" id="event_place" required
                   class="w-full mt-1 p-2 border rounded" placeholder="Enter event place">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Create Event
            </button>
        </div>
    </form>
</div>
@endsection
