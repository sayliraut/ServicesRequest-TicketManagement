<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white">Dashboard</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Welcome back, {{ auth()->user()->name }}</p>
        </div>
    </x-slot>

    <div class="py-6 px-6">
        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            {{-- Total Categories --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Categories</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total_categories'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Active Categories --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Active Categories</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['active_categories'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Total Tickets --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Requests</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total_tickets'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Open Tickets --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Open Requests</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['open_tickets'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- Status Overview --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Status Distribution --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 lg:col-span-2">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Request Status Overview</h3>
                
                <div class="space-y-4">
                    {{-- In Progress --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">In Progress</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $stats['in_progress_tickets'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $stats['total_tickets'] > 0 ? ($stats['in_progress_tickets'] / $stats['total_tickets'] * 100) : 0 }}%"></div>
                        </div>
                    </div>

                    {{-- Closed --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Closed</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $stats['closed_tickets'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $stats['total_tickets'] > 0 ? ($stats['closed_tickets'] / $stats['total_tickets'] * 100) : 0 }}%"></div>
                        </div>
                    </div>

                    {{-- Open --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Open</span>
                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ $stats['open_tickets'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-yellow-600 h-2 rounded-full" style="width: {{ $stats['total_tickets'] > 0 ? ($stats['open_tickets'] / $stats['total_tickets'] * 100) : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- User Info --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Your Activity</h3>
                
                <div class="space-y-4">
                    @if(in_array(auth()->user()->role, ['admin', 'agent']))
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Assigned to You</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['assigned_tickets'] ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Unassigned</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['unassigned_tickets'] ?? 0 }}</p>
                        </div>
                    @else
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Your Requests</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['my_tickets'] ?? 0 }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Open Requests</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['my_open_tickets'] ?? 0 }}</p>
                        </div>
                        <div class="pt-2">
                            <a href="{{ route('tickets.create') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                New Request
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
