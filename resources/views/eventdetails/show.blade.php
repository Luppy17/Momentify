@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
   <!-- Hero Section -->
   <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-12">
       <div class="container mx-auto px-6">
           <div class="flex justify-between items-center">
               <h1 class="text-5xl font-bold">{{ $event->event_name }}</h1>
               <a href="{{ route('eventdetails.index') }}"
                  class="bg-white text-blue-600 px-6 py-3 rounded-full hover:bg-opacity-90 transition flex items-center gap-2">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                       <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                   </svg>
                   Back to Events
               </a>
           </div>
           
           <div class="mt-6 flex gap-8">
               <div class="flex items-center gap-2">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                   </svg>
                   {{ $event->date }}
               </div>
               <div class="flex items-center gap-2">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                   </svg>
                   {{ $event->time }}
               </div>
               <div class="flex items-center gap-2">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                   </svg>
                   {{ $event->event_place }}
               </div>
           </div>
       </div>
   </div>

   <!-- Content Section -->
   <div class="container mx-auto px-6 py-12">
       <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
           <!-- Photographers Section -->
           <div class="bg-white rounded-2xl shadow-lg p-8">
               <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                   </svg>
                   Photographers
               </h2>
               
               <div class="space-y-4">
                   @forelse($event->photographers as $photographer)
                       <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                           <div class="flex items-center gap-4">
                               <div class="bg-blue-100 rounded-full p-3">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                   </svg>
                               </div>
                               <div>
                                   <p class="font-semibold text-gray-800">{{ $photographer->name }}</p>
                                   <p class="text-sm text-gray-500">{{ $photographer->email }}</p>
                               </div>
                           </div>
                           @if (auth()->user()->is_event_manager == 1)
                               <form action="{{ route('eventdetails.removePhotographer', ['event' => $event->id, 'photographer' => $photographer->id]) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="text-red-500 hover:text-red-700 transition">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                           <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                       </svg>
                                   </button>
                               </form>
                           @endif
                       </div>
                   @empty
                       <div class="text-center py-8">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                           </svg>
                           <p class="text-gray-500">No photographers assigned yet</p>
                       </div>
                   @endforelse
               </div>
           </div>

           <!-- Assignment/Upload Section -->
           <div class="bg-white rounded-2xl shadow-lg p-8">
               @if(auth()->user()->is_event_manager == 1)
                   

                   <!-- Assign Photographer Form -->
                   <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                       </svg>
                       Assign Photographer
                   </h2>
                   <form action="{{ route('eventdetails.assign', $event->id) }}" method="POST" class="space-y-6">
                       @csrf
                       <div>
                           <label for="photographer_id" class="block text-sm font-medium text-gray-700 mb-2">Select Photographer</label>
                           <select name="photographer_id" id="photographer_id"
                               class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                               <option value="" disabled selected>Choose a photographer</option>
                               @foreach($photographers as $photographer)
                                   <option value="{{ $photographer->id }}">{{ $photographer->name }}</option>
                               @endforeach
                           </select>
                       </div>
                       <button type="submit"
                           class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                               <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                           </svg>
                           Assign Photographer
                       </button>
                   </form>

                   <!-- Gallery Section for Event Manager -->
                   <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mt-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Event Gallery ({{ $event->images->count() }} photos)
                    </h2>
                    
                    @if($event->images->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($event->images as $image)
                                <div class="relative group rounded-lg overflow-hidden shadow-lg">
                                    <form action="{{ route('eventdetails.deleteImage', $image->id) }}" method="POST" class="absolute top-2 right-2 z-10">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 bg-red-500 rounded-full text-white hover:bg-red-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                    <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $image->path) }}"  
                                         alt="Event Image" 
                                         class="w-full h-48 object-cover transform group-hover:scale-110 transition duration-300">
                                    <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/60 to-transparent text-white text-sm">
                                        {{ $image->created_at->format('M d, Y H:i') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 bg-gray-50 rounded-lg">
                            <p class="text-gray-500">No images uploaded yet</p>
                        </div>
                    @endif
                </div>
               @endif

               @if(auth()->user()->is_photographer == 1)
                <!-- Upload Form for Photographers -->
                <form action="{{ route('eventdetails.upload', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div id="drop-zone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center transition-colors duration-200 ease-in-out">
                        <input type="file" name="images[]" id="images" multiple class="hidden" accept="image/*" />
                        <label for="images" id="drop-label" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <p class="text-gray-600">Click to upload images or drag and drop</p>
                            <p class="text-sm text-gray-500 mt-2">PNG, JPG up to 10MB</p>
                        </label>
                    </div>
                    <div id="preview" class="grid grid-cols-2 md:grid-cols-3 gap-4"></div>
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        Upload Images
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
                            dropZone.classList.add('border-blue-500', 'bg-blue-50');
                        }

                        function unhighlight(e) {
                            dropZone.classList.remove('border-blue-500', 'bg-blue-50');
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
                                    container.className = 'relative';

                                    const img = document.createElement('img');
                                    img.src = e.target.result;
                                    img.className = 'w-full h-48 object-cover rounded-lg shadow';

                                    const removeBtn = document.createElement('button');
                                    removeBtn.innerHTML = '&times;';
                                    removeBtn.className = 'absolute top-1 right-1 bg-red-600 text-white w-6 h-6 rounded-full text-center leading-6 shadow';
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

                       @if($event->images->count() > 0)
                           <!-- Photographer's Uploaded Images -->
                           <div class="mt-8">
                               <h3 class="text-xl font-bold text-gray-800 mb-4">Your Uploaded Images</h3>
                               <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                   @foreach($event->images as $image)
                                       @if($image->photographer_id == auth()->id())
                                           <div class="relative group rounded-lg overflow-hidden shadow-lg">
                                            <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $image->path) }}" alt="Event Image"

                                                    class="w-full h-48 object-cover transform group-hover:scale-110 transition duration-300">
                                               <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/60 to-transparent text-white text-sm">
                                                   {{ $image->created_at->format('M d, Y H:i') }}
                                               </div>
                                           </div>
                                       @endif
                                   @endforeach
                               </div>
                           </div>
                       @endif
                   @endif

                   @if(auth()->user()->is_admin == 1)
                   <!-- Upload Form for Photographers -->
                

                       @if($event->images->count() > 0)
                           <!-- Photographer's Uploaded Images -->
                           <div class="mt-8">
                               <h3 class="text-xl font-bold text-gray-800 mb-4">Uploaded Images</h3>
                               <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                   @foreach($event->images as $image)
                                       
                                           <div class="relative group rounded-lg overflow-hidden shadow-lg">
                                            <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $image->path) }}" alt="Event Image"

                                                    class="w-full h-48 object-cover transform group-hover:scale-110 transition duration-300">
                                               <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/60 to-transparent text-white text-sm">
                                                   {{ $image->created_at->format('M d, Y H:i') }}
                                               </div>
                                           </div>
                                      
                                   @endforeach
                               </div>
                           </div>
                       @endif
                   @endif
               </div>
           </div>
       </div>

       <!-- All Event Images Section -->
          @if(auth()->user()->is_admin == 0 && auth()->user()->is_event_manager == 0 && auth()->user()->is_photographer == 0)
       <div class="mt-12">
           <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
               </svg>
               Event Gallery
           </h2>

           @if($event->images->count() > 0)
               <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                   @foreach($event->images as $image)
                       <a href="{{ route('eventdetails.showImage', ['event' => $event->id, 'image' => $image->id]) }}" class="block">
                           <div class="relative group rounded-xl overflow-hidden shadow-lg">
                               <img src="{{ asset('https://momentify-s3-bucket.s3.us-east-1.amazonaws.com/' . $image->path) }}" 
                                    alt="Event Image"
                                    class="w-full h-64 object-cover transform group-hover:scale-110 transition duration-300">
                               <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-black/70 to-transparent">
                                   <p class="text-white/80 text-xs">
                                       {{ $image->created_at->format('M d, Y H:i') }}
                                   </p>
                               </div>
                           </div>
                       </a>
                   @endforeach
               </div>
           @else
               <div class="text-center py-12 bg-gray-50 rounded-xl">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                   </svg>
                   <p class="mt-4 text-gray-500">No images have been uploaded for this event yet.</p>
               </div>
           @endif
       </div>
       @endif
       @if(session('success'))
           <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg">
               {{ session('success') }}
           </div>
       @endif
   </div>
@endsection