<aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen px-4 py-6 hidden lg:block">
    <div class="sticky top-20">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Main</h3>

        <nav class="mt-4" aria-label="Sidebar">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-900 text-indigo-600 font-medium' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900' }}">
                        <!-- Dashboard Icon -->
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path></svg>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="mt-3">
                    <div class="flex items-center justify-between px-3">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Service Requests</span>
                        <a href="{{ route('tickets.create') }}" class="inline-flex items-center gap-2 text-xs text-white bg-indigo-600 hover:bg-indigo-700 px-2 py-1 rounded">
                            <!-- Plus Icon -->
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            New
                        </a>
                    </div>

                    <ul class="mt-2">
                        <li>
                            <a href="{{ route('tickets.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-md mt-1 {{ request()->routeIs('tickets.index') ? 'bg-gray-100 dark:bg-gray-900 text-indigo-600 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900' }}">
                                <span>My Requests</span>
                            </a>
                        </li>
                    </ul>
                </li>

                @if(auth()->user() && in_array(auth()->user()->role, ['admin', 'agent']))
                    <li class="mt-3">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200 px-3">Admin</span>

                        <ul class="mt-2">
                            <li>
                                <a href="{{ route('tickets.admin-index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-md mt-1 {{ request()->routeIs('tickets.admin-index') ? 'bg-gray-100 dark:bg-gray-900 text-indigo-600 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900' }}">
                                    <span>Manage Requests</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-md mt-1 {{ request()->routeIs('categories.index') ? 'bg-gray-100 dark:bg-gray-900 text-indigo-600 font-medium' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-900' }}">
                                    <span>Categories</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>