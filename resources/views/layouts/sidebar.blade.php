<aside class="w-full lg:w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen px-4 py-6">
    <div class="sticky top-16">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Navigation</h3>

        <nav class="mt-4" aria-label="Sidebar">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2 text-sm rounded-md {{ request()->routeIs('categories.*') ? 'bg-gray-100 dark:bg-gray-900 text-indigo-600 font-medium' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900' }}">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <span>Categories</span>
                    </a>
                </li>

                <li>
                    <div class="flex items-center justify-between px-3 py-2">
                        <a href="{{ route('tickets.index') }}" class="flex items-center gap-3 text-sm rounded-md {{ request()->routeIs('tickets.*') ? 'bg-gray-100 dark:bg-gray-900 text-indigo-600 font-medium px-3 py-2' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-900 px-3 py-2' }}">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M9 8h6"></path></svg>
                            <span>Service Requests</span>
                        </a>

                        <a href="{{ route('tickets.create') }}" class="inline-flex items-center gap-2 text-xs text-white bg-indigo-600 hover:bg-indigo-700 px-2 py-1 rounded">
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            New
                        </a>
                    </div>
                </li>

                @if(auth()->user() && in_array(auth()->user()->role, ['admin', 'agent']))
                    <li class="mt-4">
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