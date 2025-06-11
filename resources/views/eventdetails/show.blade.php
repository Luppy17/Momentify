@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <!-- Enhanced Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 text-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="4"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
        </div>

        <div class="relative container mx-auto px-6 py-16">
            <!-- Navigation -->
            <div class="flex justify-between items-center mb-12">
                <div class="flex items-center gap-4">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-lg font-medium opacity-90">Event Details</span>
                </div>
                <a href="{{ route('eventdetails.index') }}"
                    class="group bg-white/20 backdrop-blur-sm text-white px-6 py-3 rounded-full hover:bg-white/30 transition-all duration-300 flex items-center gap-2 border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Back to Events
                </a>
            </div>

            <!-- Event Title and Info -->
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-6xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                    {{ $event->event_name }}
                </h1>

                <div class="flex flex-wrap justify-center gap-8 text-lg">
                    <div class="flex items-center gap-3 bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 border border-white/20">
                        <div class="bg-white/20 rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-medium">{{ $event->date }}</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 border border-white/20">
                        <div class="bg-white/20 rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">{{ $event->time }}</span>
                    </div>
                    <div class="flex items-center gap-3 bg-white/20 backdrop-blur-sm rounded-full px-6 py-3 border border-white/20">
                        <div class="bg-white/20 rounded-full p-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">{{ $event->event_place }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-16">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="bg-blue-100 rounded-2xl p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-800">{{ $event->photographers->count() }}</p>
                        <p class="text-gray-600 font-medium">Photographers</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="bg-purple-100 rounded-2xl p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-800">{{ $event->images->count() }}</p>
                        <p class="text-gray-600 font-medium">Photos</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex items-center gap-4">
                    <div class="bg-green-100 rounded-2xl p-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-800">Active</p>
                        <p class="text-gray-600 font-medium">Status</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role-based Content Sections -->
        @if(auth()->user()->is_event_manager == 1)
            <!-- Event Manager Section -->
            <div class="space-y-12">
                <!-- Photographers Management -->
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-8">
                        <h2 class="text-3xl font-bold flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            Team Management
                        </h2>
                        <p class="mt-2 opacity-90">Manage photographers assigned to this event</p>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Current Photographers -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Assigned Photographers</h3>
                                <div class="space-y-4">
                                    @forelse($event->photographers as $photographer)
                                        <div class="flex items-center justify-between p-6 bg-gray-50 rounded-2xl border border-gray-200 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-4">
                                                <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-4 text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-800 text-lg">{{ $photographer->name }}</p>
                                                    <p class="text-gray-600">{{ $photographer->email }}</p>
                                                </div>
                                            </div>
                                            <form action="{{ route('eventdetails.removePhotographer', ['event' => $event->id, 'photographer' => $photographer->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-100 hover:bg-red-200 text-red-600 p-3 rounded-xl transition-all duration-300 group">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:scale-110 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @empty
                                        <div class="text-center py-12 bg-gray-50 rounded-2xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                                            </svg>
                                            <p class="text-gray-600 text-lg">No photographers assigned yet</p>
                                            <p class="text-gray-500 mt-2">Use the form to assign photographers to this event</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Assign Photographer Form -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-800 mb-6">Assign New Photographer</h3>
                                <form action="{{ route('eventdetails.assign', $event->id) }}" method="POST" class="bg-gradient-to-br from-blue-50 to-indigo-50 p-8 rounded-2xl border border-blue-200">
                                    @csrf
                                    <div class="space-y-6">
                                        <div>
                                            <label for="photographer_id" class="block text-sm font-bold text-gray-700 mb-3">Select Photographer</label>
                                            <select name="photographer_id" id="photographer_id"
                                                class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-lg">
                                                <option value="" disabled selected>Choose a photographer</option>
                                                @foreach($photographers as $photographer)
                                                    <option value="{{ $photographer->id }}">{{ $photographer->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit"
                                            class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 flex items-center justify-center gap-3 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                            Assign Photographer
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gallery Management for Event Manager -->
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-8">
                        <h2 class="text-3xl font-bold flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Event Gallery Management
                        </h2>
                        <p class="mt-2 opacity-90">{{ $event->images->count() }} photos uploaded</p>
                    </div>

                    <div class="p-8">
                        @if($event->images->count() > 0)
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                @foreach($event->images as $image)
                                    <div class="relative group rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                                        <form action="{{ route('eventdetails.deleteImage', $image->id) }}" method="POST" class="absolute top-3 right-3 z-10">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-full shadow-lg transition-all duration-300 opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                        <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $image->path) }}"
                                            alt="Event Image"
                                            class="w-full h-64 object-cover transform group-hover:scale-110 transition-all duration-500">
                                        <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                            <p class="text-white text-sm font-medium">
                                                {{ $image->created_at->format('M d, Y H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-16 bg-gray-50 rounded-2xl">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-600 text-xl font-bold">No images uploaded yet</p>
                                <p class="text-gray-500 mt-2">Photographers will upload images here during the event</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if(auth()->user()->is_photographer == 1)
            <!-- Photographer Section -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-teal-600 text-white p-8">
                    <h2 class="text-3xl font-bold flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Upload Event Photos
                    </h2>
                    <p class="mt-2 opacity-90">Share your captured moments with the event</p>
                </div>

                <div class="p-8">
                    <form action="{{ route('eventdetails.upload', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        <div id="drop-zone" class="border-4 border-dashed border-gray-300 rounded-2xl p-12 text-center transition-all duration-300 hover:border-green-400 hover:bg-green-50">
                            <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*" />
                            <label for="images" id="drop-label" class="cursor-pointer">
                                <div class="bg-green-100 rounded-full p-6 w-24 h-24 mx-auto mb-6 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                </div>
                                <p class="text-gray-800 text-xl font-bold mb-2">Drop your images here or click to browse</p>
                                <p class="text-gray-600">Support PNG, JPG up to 10MB each</p>
                            </label>
                        </div>
                        <div id="preview" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-teal-600 text-white px-8 py-4 rounded-xl hover:from-green-700 hover:to-teal-700 transition-all duration-300 flex items-center justify-center gap-3 font-bold text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            Upload Photos to Gallery
                        </button>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const dropZone = document.getElementById('drop-zone');
                            const fileInput = document.getElementById('images');
                            const preview = document.getElementById('preview');
                            const dropLabel = document.getElementById('drop-label');

                            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                                dropZone.addEventListener(eventName, preventDefaults, false);
                                document.body.addEventListener(eventName, preventDefaults, false);
                            });

                            ['dragenter', 'dragover'].forEach(eventName => {
                                dropZone.addEventListener(eventName, highlight, false);
                            });

                            ['dragleave', 'drop'].forEach(eventName => {
                                dropZone.addEventListener(eventName, unhighlight, false);
                            });

                            dropZone.addEventListener('drop', handleDrop, false);
                            fileInput.addEventListener('change', updatePreview);

                            function preventDefaults(e) {
                                e.preventDefault();
                                e.stopPropagation();
                            }

                            function highlight(e) {
                                dropZone.classList.add('border-green-500', 'bg-green-50');
                            }

                            function unhighlight(e) {
                                dropZone.classList.remove('border-green-500', 'bg-green-50');
                            }

                            function handleDrop(e) {
                                const dt = e.dataTransfer;
                                fileInput.files = dt.files;
                                updatePreview();
                            }

                            function updatePreview() {
                                const files = Array.from(fileInput.files);
                                if (files.length > 0) {
                                    dropLabel.style.display = 'none';
                                } else {
                                    dropLabel.style.display = 'block';
                                }

                                preview.innerHTML = '';
                                files.forEach((file, index) => {
                                    if (!file.type.startsWith('image/')) return;

                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        const container = document.createElement('div');
                                        container.className = 'relative group';

                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.className = 'w-full h-48 object-cover rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300';

                                        const removeBtn = document.createElement('button');
                                        removeBtn.innerHTML = '&times;';
                                        removeBtn.className = 'absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded-full text-center leading-8 shadow-lg transition-all duration-300 opacity-0 group-hover:opacity-100';
                                        removeBtn.onclick = function() {
                                            const dt = new DataTransfer();
                                            files.splice(index, 1);
                                            files.forEach(file => dt.items.add(file));
                                            fileInput.files = dt.files;
                                            updatePreview();
                                        };

                                        container.appendChild(img);
                                        container.appendChild(removeBtn);
                                        preview.appendChild(container);
                                    };
                                    reader.readAsDataURL(file);
                                });
                            }
                        });
                    </script>
                </div>
            </div>
        @endif

        @if(auth()->user()->is_admin == 1)
            <!-- Admin Section -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-pink-600 text-white p-8">
                    <h2 class="text-3xl font-bold flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Administrator View
                    </h2>
                    <p class="mt-2 opacity-90">Full event oversight and management</p>
                </div>

                <div class="p-8">
                    @if($event->images->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($event->images as $image)
                                <div class="relative group rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                                    <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $image->path) }}"
                                        alt="Event Image"
                                        class="w-full h-64 object-cover transform group-hover:scale-110 transition-all duration-500">
                                    <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                                        <p class="text-white text-sm font-medium">
                                            {{ $image->created_at->format('M d, Y H:i') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-gray-50 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-600 text-xl font-bold">No images uploaded yet</p>
                            <p class="text-gray-500 mt-2">Images will appear here as photographers upload them</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @if(auth()->user()->is_admin == 0 && auth()->user()->is_event_manager == 0 && auth()->user()->is_photographer == 0)
            <!-- Public Gallery Section -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white p-8">
                    <h2 class="text-3xl font-bold flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Event Gallery
                    </h2>
                    <p class="mt-2 opacity-90">{{ $event->images->count() }} beautiful moments captured</p>
                </div>

                <div class="p-8">
                    @if($event->images->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($event->images as $image)
                                <a href="{{ route('eventdetails.showImage', ['event' => $event->id, 'image' => $image->id]) }}" class="block group">
                                    <div class="relative rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                                        <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $image->path) }}"
                                            alt="Event Image"
                                            class="w-full h-64 object-cover transform group-hover:scale-110 transition-all duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                                            <div class="absolute bottom-4 left-4 right-4">
                                                <p class="text-white font-medium">
                                                    {{ $image->created_at->format('M d, Y H:i') }}
                                                </p>
                                                <div class="flex items-center gap-2 mt-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    <span class="text-white/80 text-sm">View</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-gray-50 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-gray-400 mx-auto mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-600 text-xl font-bold">Gallery Coming Soon</p>
                            <p class="text-gray-500 mt-2">Photos will be available here after the event</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="fixed bottom-6 right-6 bg-green-500 text-white px-8 py-4 rounded-2xl shadow-xl z-50 transform transition-all duration-300">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
