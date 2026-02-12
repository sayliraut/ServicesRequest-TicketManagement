<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white">{{ $ticket->subject }}</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Request #{{ $ticket->id }}</p>
            </div>
            <a href="{{ route('tickets.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-600 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="grid grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="col-span-2">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 mb-6">
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <div>
                            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Status</label>
                            <div class="mt-2">
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
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Priority</label>
                            <div class="mt-2">
                                @if($ticket->priority === 'high')
                                    <span class="inline-block px-2 py-1 text-xs bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 rounded font-semibold">High</span>
                                @elseif($ticket->priority === 'medium')
                                    <span class="inline-block px-2 py-1 text-xs bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-200 rounded font-semibold">Medium</span>
                                @else
                                    <span class="inline-block px-2 py-1 text-xs bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded font-semibold">Low</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Category</label>
                            <p class="mt-2 text-gray-900 dark:text-white font-medium">{{ $ticket->category->name }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Assigned To</label>
                            <p class="mt-2 text-gray-900 dark:text-white font-medium">{{ $ticket->agent?->name ?? 'Unassigned' }}</p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Description</h3>
                        <div class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $ticket->description }}</div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Updates</h3>
                    @if($ticket->comments->count() > 0)
                        <div class="space-y-4">
                            @foreach($ticket->comments as $comment)
                                <div class="border-b border-gray-200 dark:border-gray-700 pb-4 last:border-b-0">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700 dark:text-gray-300">{{ $comment->message }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400">No updates yet. We'll notify you when there's progress on your request.</p>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-span-1">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 sticky top-24">
                    <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Request Info</h4>
                    
                    <div class="space-y-4 text-sm">
                        <div>
                            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Created</label>
                            <p class="mt-1 text-gray-900 dark:text-white">{{ $ticket->created_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Last Updated</label>
                            <p class="mt-1 text-gray-900 dark:text-white">{{ $ticket->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Submitted By</label>
                            <p class="mt-1 text-gray-900 dark:text-white">{{ $ticket->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
