@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
   <div class="mt-4 mb-6">
       <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Admin Dashboard</h1>
   </div>

   <!-- Analytics Cards -->
   <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
       <!-- Total Users Card -->
       <a href="{{ route('role.management.normal.user.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
           <div class="flex items-center">
               <div class="p-3 rounded-full bg-blue-100 mr-4">
                   <x-heroicon-o-users class="w-6 h-6 text-blue-500"/>
               </div>
               <div>
                   <p class="text-gray-500 text-sm">Total Users</p>
                   <p class="text-2xl font-bold text-gray-800" id="totalUsers">{{ number_format($totalUsers) }}</p>
               </div>
           </div>
       </a>

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

       <!-- Active Photographers Card -->
       <a href="{{ route('role.management.photographer.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
           <div class="flex items-center">
               <div class="p-3 rounded-full bg-purple-100 mr-4">
                   <x-heroicon-o-camera class="w-6 h-6 text-purple-500"/>
               </div>
               <div>
                   <p class="text-gray-500 text-sm">Active Photographers</p>
                   <p class="text-2xl font-bold text-gray-800" id="activePhotographers">{{ number_format($activePhotographers) }}</p>
               </div>
           </div>
       </a>

       <!-- Total Photos Card -->
       <a href="{{ route('eventdetails.index') }}" class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow">
           <div class="flex items-center">
               <div class="p-3 rounded-full bg-yellow-100 mr-4">
                   <x-heroicon-o-photograph class="w-6 h-6 text-yellow-500"/>
               </div>
               <div>
                   <p class="text-gray-500 text-sm">Total Photos</p>
                   <p class="text-2xl font-bold text-gray-800" id="totalPhotos">{{ number_format($totalPhotos) }}</p>
               </div>
           </div>
       </a>
   </div>

   <!-- User Logs Table -->
   <div class="bg-white rounded-lg shadow">
       <div class="p-6">
           <div class="flex justify-between items-center mb-4">
               <h2 class="text-lg font-semibold text-gray-800">User Logs</h2>
               <div class="flex gap-4">
                   <input type="text"
                       id="searchLogs"
                       placeholder="Search all logs..."
                       class="px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500">
                   <select id="statusFilter"
                       class="px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-blue-500">
                       <option value="">All Status</option>
                       <option value="success">Success</option>
                       <option value="failed">Failed</option>
                   </select>
               </div>
           </div>
           <div class="overflow-x-auto">
               <table class="w-full">
                   <thead>
                       <tr class="text-left bg-gray-50 dark:bg-black">
                           <th class="px-4 py-3 font-medium">User</th>
                           <th class="px-4 py-3 font-medium">Action</th>
                           <th class="px-4 py-3 font-medium">IP Address</th>
                           <th class="px-4 py-3 font-medium">Date & Time</th>
                           <th class="px-4 py-3 font-medium">Status</th>
                       </tr>
                   </thead>
                   <tbody class="divide-y divide-gray-200">
                       @forelse($userLogs as $log)
                       <tr class="hover:bg-gray-50">
                           <td class="px-4 py-4">
                               <div class="flex items-center">
                                   <div class="h-8 w-8 mr-3 bg-gray-200 rounded-full flex items-center justify-center">
                                       {{ strtoupper(substr($log->user?->name ?? 'U', 0, 1)) }}
                                   </div>
                                   <div class="min-w-0">
                                       <div class="font-medium truncate">{{ $log->user?->name ?? 'Unknown User' }}</div>
                                       <div class="text-sm text-gray-500 truncate">{{ $log->user?->email ?? 'N/A' }}</div>
                                   </div>
                               </div>
                           </td>
                           <td class="px-4 py-4 truncate">{{ $log->action }}</td>
                           <td class="px-4 py-4">{{ $log->ip_address }}</td>
                           <td class="px-4 py-4">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                           <td class="px-4 py-4">
                               <span class="px-2 py-1 rounded-full text-sm {{ $log->status === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                   {{ $log->status }}
                               </span>
                           </td>
                       </tr>
                       @empty
                       <tr>
                           <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                               No logs found
                           </td>
                       </tr>
                       @endforelse
                   </tbody>
               </table>
               <div class="mt-4">
                   {{ $userLogs->links() }}
               </div>
           </div>
       </div>
   </div>
</div>

@push('scripts')
<script>
const searchInput = document.getElementById('searchLogs');
const statusFilter = document.getElementById('statusFilter');
let timeoutId;

function filterLogs() {
   clearTimeout(timeoutId);
   timeoutId = setTimeout(() => {
       const searchTerm = searchInput.value.toLowerCase();
       const status = statusFilter.value;
       const rows = document.querySelectorAll('tbody tr');

       rows.forEach(row => {
           const text = row.textContent.toLowerCase();
           const statusCell = row.querySelector('td:last-child')?.textContent.trim().toLowerCase();
           const matchesSearch = searchTerm === '' || text.includes(searchTerm);
           const matchesStatus = status === '' || statusCell === status;
           row.style.display = matchesSearch && matchesStatus ? '' : 'none';
       });
   }, 300);
}

searchInput?.addEventListener('input', filterLogs);
statusFilter?.addEventListener('change', filterLogs);

// Update stats every 30 seconds
function updateStats() {
   fetch('{{ route("admin.dashboard.stats") }}')
       .then(response => response.json())
       .then(data => {
           document.getElementById('totalPhotos').textContent = data.totalPhotos.toLocaleString();
           document.getElementById('totalUsers').textContent = data.totalUsers.toLocaleString();
           document.getElementById('totalEvents').textContent = data.totalEvents.toLocaleString();
           document.getElementById('activePhotographers').textContent = data.activePhotographers.toLocaleString();
       });
}

setInterval(updateStats, 30000);
</script>
@endpush
@endsection
