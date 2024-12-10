@extends('layouts.app')

@section('content')

<!-- Back Button -->
<div class="flex justify-end mb-4 mt-4">
    <a href="{{ route('eventdetails.index') }}"
       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        ← Back to Events
    </a>
</div>

<div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-4">
    <!-- Event Information -->
    <div class="mb-6">
        <h1 class="text-4xl font-semibold text-gray-800">{{ $event->event_name }}</h1>
        <p class="text-gray-600 mt-2">
            <span class="font-medium">Date:</span> {{ $event->date }}
        </p>
        <p class="text-gray-600">
            <span class="font-medium">Time:</span> {{ $event->time }}
        </p>
        <p class="text-gray-600">
            <span class="font-medium">Place:</span> {{ $event->event_place }}
        </p>
    </div>

    <!-- Photographers Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Photographers</h2>
        <ul class="list-disc pl-5 text-gray-700">
            @forelse($event->photographers as $photographer)
                <li class="flex justify-start items-center mb-0">
                    <span class="font-medium">{{ $photographer->name }}</span>
                    <span class="text-sm text-gray-500 ml-1">({{ $photographer->email }})</span>
                    @if (auth()->user()->is_admin == 1)
                        <!-- Delete Link -->
                        <form action="{{ route('eventdetails.removePhotographer', ['event' => $event->id, 'photographer' => $photographer->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:void(0)" onclick="this.closest('form').submit()"
                                class="text-red-500 text-sm hover:text-red-700 ml-3">
                                Delete
                            </a>
                        </form>
                    @endif
                </li>
            @empty
                <p class="text-gray-500">No photographers assigned to this event.</p>
            @endforelse
        </ul>
    </div>

    <!-- Assign Photographer Section -->
    @if (auth()->user()->is_photographer == 0)
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Assign Photographer</h2>
            <form action="{{ route('eventdetails.assign', $event->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="photographer_id" class="block text-gray-600 font-medium">Select Photographer</label>
                    <select name="photographer_id" id="photographer_id"
                        class="w-full p-3 border border-gray-300 dark:border-gray-300 bg-white text-gray-800 dark:text-gray-800 rounded-lg focus:ring focus:ring-blue-300 dark:focus:ring-blue-500">
                        <option value="" disabled selected class="text-gray-500 dark:text-gray-400">
                            Select a photographer
                        </option>
                        @foreach($photographers as $photographer)
                            <option value="{{ $photographer->id }}">{{ $photographer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit"
                            class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition">
                        Assign
                    </button>
                </div>
            </form>
        </div>
    @else
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Image Uploaded</h2>
            <div class="flex flex-wrap gap-4">
                @foreach($event->images as $image)
                    <img src="{{ config('app.url') . '/' . $image->path }}" alt="Images" class="w-60 h-40">
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Upload Image</h2>
            <form action="{{ route('eventdetails.upload', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="file" name="images[]" id="images" multiple>
                <div>
                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600 transition"
                    >
                        Upload
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>

@endsection
