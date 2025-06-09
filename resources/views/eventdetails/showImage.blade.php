@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold">Event Image</h1>
        <div class="flex gap-4">
            <a href="{{ route('eventdetails.downloadImage', ['event' => $event->id, 'image' => $image->id]) }}" 
               class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Download
            </a>
            <a href="{{ route('eventdetails.show', $event->id) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to Event
            </a>
        </div>
    </div>

    <!-- Main Image -->
    <div class="mb-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $image->path) }}" 
                 alt="Event Image"
                 class="w-full h-auto max-h-[600px] object-contain">
            <div class="p-4">
                <p class="text-gray-600">Uploaded on: {{ $image->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Similar Images Section -->
    @if(count($similarImages) > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Similar Images
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($similarImages as $similar)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden group">
                        <a href="{{ route('eventdetails.showImage', ['event' => $event->id, 'image' => $similar['image']->id]) }}" 
                           class="block">
                            <div class="relative">
                                <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $similar['image']->path) }}" 
                                     alt="Similar Image"
                                     class="w-full h-48 object-cover transform group-hover:scale-110 transition duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                                    <p class="text-white/80 text-sm">
                                        {{ number_format($similar['confidence'], 1) }}% Match
                                    </p>
                                    <p class="text-white/80 text-xs">
                                        {{ $similar['image']->created_at->format('M d, Y H:i') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <p class="mt-4 text-gray-500">No similar images found. This image may not contain any faces or no similar faces were found in the collection.</p>
        </div>
    @endif
</div>
@endsection 