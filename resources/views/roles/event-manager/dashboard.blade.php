{{-- resources/views/roles/event-manager/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Greeting Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{ greeting() }}, {{ auth()->user()->name }}!
                    </h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        Here's what's happening with your events today
                    </p>
                </div>
                <div class="hidden sm:block">
                    <x-heroicon-o-calendar-days class="w-16 h-16 text-blue-500 dark:text-blue-400"/>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <!-- Total Events -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                    <x-heroicon-o-calendar class="w-6 h-6 text-blue-500 dark:text-blue-400"/>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Events</p>
                    <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $totalEvents ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Upcoming Events -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                    <x-heroicon-o-clock class="w-6 h-6 text-green-500 dark:text-green-400"/>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Upcoming Events</p>
                    <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $upcomingEvents ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Assigned Photographers -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900">
                    <x-heroicon-o-camera class="w-6 h-6 text-purple-500 dark:text-purple-400"/>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Assigned Photographers</p>
                    <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ $assignedPhotographers ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Events -->
    <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Recent Events</h3>
            <a href="{{ route('eventconfig.index') }}" 
               class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                View All Events
            </a>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($recentEvents ?? [] as $event)
            <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-medium text-gray-800 dark:text-white">{{ $event->name }}</h4>
                        <div class="mt-1 flex items-center gap-4">
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                <x-heroicon-o-calendar-days class="w-4 h-4 inline mr-1"/>
                                {{ $event->start_date->format('M d, Y') }}
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                <x-heroicon-o-user-group class="w-4 h-4 inline mr-1"/>
                                {{ count($event->photographers) }} Photographers
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                            {{ $event->start_date->isPast() 
                                ? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300' 
                                : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' }}">
                            {{ $event->start_date->isPast() ? 'Completed' : 'Upcoming' }}
                        </span>
                        <a href="{{ route('eventdetails.show', $event) }}" 
                           class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 dark:text-blue-400 dark:bg-blue-900 dark:hover:bg-blue-800 transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                <x-heroicon-o-calendar class="w-12 h-12 mx-auto mb-4 opacity-50"/>
                <p class="text-lg font-medium">No events found</p>
                <p class="mt-1">Create your first event to get started</p>
                <a href="{{ route('eventconfig.create') }}" 
                   class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                    Create New Event
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function greeting() {
    const hour = new Date().getHours();
    if (hour < 12) return 'Good Morning';
    if (hour < 17) return 'Good Afternoon';
    return 'Good Evening';
}
document.addEventListener('DOMContentLoaded', function() {
    const greetingElement = document.querySelector('[data-greeting]');
    if (greetingElement) {
        greetingElement.textContent = greeting();
    }
});
</script>
@endpush