<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white">My Requests</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Track and manage your service requests</p>
            </div>
            <a href="{{ route('tickets.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-md transition">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>New Request</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl">
            <div class="p-6">
                @if($tickets->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                    <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Subject</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Category</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Status</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Priority</th>
                                    <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Created</th>
                                    <th class="text-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                                        <td class="px-4 py-3">
                                            <span class="text-gray-900 dark:text-white font-medium">{{ $ticket->subject }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="inline-block px-2 py-1 text-xs bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-200 rounded">{{ $ticket->category->name }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($ticket->status === 'open')
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                                                    <span class="w-2 h-2 bg-yellow-600 dark:bg-yellow-400 rounded-full"></span>Open
                                                </span>
                                            @elseif($ticket->status === 'in_progress')
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                                    <span class="w-2 h-2 bg-blue-600 dark:bg-blue-400 rounded-full"></span>In Progress
                                                </span>
                                            @elseif($ticket->status === 'closed')
                                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200">
                                                    <span class="w-2 h-2 bg-emerald-600 dark:bg-emerald-400 rounded-full"></span>Closed
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($ticket->priority === 'high')
                                                <span class="inline-block px-2 py-1 text-xs bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 rounded font-semibold">High</span>
                                            @elseif($ticket->priority === 'medium')
                                                <span class="inline-block px-2 py-1 text-xs bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 rounded font-semibold">Medium</span>
                                            @else
                                                <span class="inline-block px-2 py-1 text-xs bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded font-semibold">Low</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400 text-xs">
                                            {{ $ticket->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="{{ route('tickets.show', $ticket) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                                <span>View</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-center">
                        {{ $tickets->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No requests yet</h3>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Create your first service request to get started.</p>
                        <a href="{{ route('tickets.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Create Request
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
