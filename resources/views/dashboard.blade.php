@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="mt-4 mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Dashboard</h1>
        </div>

        <!-- Analytics Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            @if (auth()->user()->is_event_manager)
                <!-- Total Events Card -->
                <a href="{{ route('eventconfig.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <x-heroicon-o-calendar class="w-6 h-6 text-green-500"/>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Events</p>
                            <p class="text-2xl font-bold text-gray-800" id="totalEvents">{{ number_format($totalEvents) }}</p>
                        </div>
                    </div>
                </a>
            @endif

            @if (auth()->user()->is_photographer)
                <a href="{{ route('role.management.photographer.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 mr-4">
                            <x-heroicon-o-camera class="w-6 h-6 text-purple-500"/>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Event Assigned</p>
                            <p class="text-2xl font-bold text-gray-800" id="activePhotographers">{{ number_format($totalAssigned) }}</p>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    </div>
@endsection
