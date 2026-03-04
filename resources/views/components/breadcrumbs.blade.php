<div class="flex items-center gap-2 text-sm bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-3">
    <a href="{{ route('dashboard') }}" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
        Home
    </a>

    @if(isset($breadcrumbs) && count($breadcrumbs) > 0)
        @foreach($breadcrumbs as $breadcrumb)
            <span class="text-gray-400 dark:text-gray-600">/</span>
            @if($loop->last)
                <span class="text-gray-900 dark:text-white font-medium">{{ $breadcrumb['label'] }}</span>
            @else
                <a href="{{ $breadcrumb['url'] }}" class="text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                    {{ $breadcrumb['label'] }}
                </a>
            @endif
        @endforeach
    @endif
</div>
