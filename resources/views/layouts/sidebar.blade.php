<aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen shadow-sm">

    <div class="p-6 sticky top-16">

        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-6">
            Navigation
        </h3>

        <nav class="space-y-1">

            {{-- Categories --}}
            <a href="{{ route('categories.index') }}"
               class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition duration-150
               {{ request()->routeIs('categories.*')
                    ? 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400'
                    : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700' }}">

                <svg class="w-4 h-4 flex-shrink-0"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <span>Categories</span>
            </a>


            {{-- Service Requests --}}
            <div class="flex items-center justify-between py-1">
                <a href="{{ route('tickets.index') }}"
                   class="flex-1 flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition duration-150
                   {{ request()->routeIs('tickets.*')
                        ? 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400'
                        : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700' }}">

                    <svg class="w-4 h-4 flex-shrink-0"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12h6M9 16h6M9 8h6"/>
                    </svg>

                    <span>Service Requests</span>
                </a>

                <a href="{{ route('tickets.create') }}"
                   class="ml-1 inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white transition duration-150 flex-shrink-0"
                   title="Create new request">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>


            {{-- Admin Section --}}
            @if(auth()->user()?->role === 'admin' || auth()->user()?->role === 'agent')

                <div class="pt-6 mt-2">
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-3">
                        Admin
                    </h3>
                </div>

                <a href="{{ route('tickets.admin-index') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition duration-150
                   {{ request()->routeIs('tickets.admin-index')
                        ? 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400'
                        : 'text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">

                    <svg class="w-4 h-4 flex-shrink-0"
                         fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>

                    <span>Manage Requests</span>
                </a>

            @endif

        </nav>
    </div>

</aside>