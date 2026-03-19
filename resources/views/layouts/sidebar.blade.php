<aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen shadow-sm flex flex-col">

    @php
        $user = auth()->user();
        $navItems = [
            ['route'=>'categories.index','label'=>'Categories','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>','pattern'=>'categories.*'],
            ['route'=>'tickets.index','label'=>'Service Requests','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h6M9 8h6"/>','pattern'=>'tickets.*','extra'=>'<a href="'.route('tickets.create').'" class="ml-1 inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white transition duration-150 flex-shrink-0" title="Create new request"><svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg></a>'],
        ];
        if($user && in_array($user->role,['admin','agent'])){
            $navItems[]=['route'=>'tickets.admin-index','label'=>'Manage Requests','icon'=>'<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>','pattern'=>'tickets.admin-index'];
        }
    @endphp

    <div class="p-6 sticky top-16 flex-1 overflow-y-auto">

        {{-- User Profile Section --}}
        <div class="mb-8 pb-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                    <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ strtoupper(substr($user->name,0,1)) }}</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($user->role) }}</p>
                </div>
            </div>
        </div>

        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-6">Navigation</h3>

        <nav class="space-y-1">
            @foreach($navItems as $item)
                <x-sidebar-link :route="$item['route']" :label="$item['label']" :icon="$item['icon']" :pattern="$item['pattern']" :extra="$item['extra'] ?? null" />
            @endforeach
        </nav>
    </div>

    <div class="p-6 border-t border-gray-200 dark:border-gray-700">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-600 dark:text-gray-300 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition duration-150">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg><span>Logout</span>
            </button>
        </form>
    </div>
</aside>