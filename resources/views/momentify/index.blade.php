@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Momentify</h1>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <!-- Search Form -->
        <form action="{{ route('eventdetails.index') }}" method="GET" class="overflow-hidden flex items-center">
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
    </div>

    <!-- Events Details Table -->
    <div class="overflow-hidden bg-white shadow-md rounded-lg">
        <table class="w-full table-auto">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-4 px-6 text-left text-sm font-semibold tracking-wide uppercase">Name</th>
                    <th class="py-4 px-6 text-center text-sm font-semibold tracking-wide uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">

            </tbody>
        </table>
    </div>
</div>
@endsection