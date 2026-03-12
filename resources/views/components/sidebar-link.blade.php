@php
    $active = $isActive() ? 'bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400' : 'text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700';
@endphp

<div class="flex items-center justify-between py-1">
    <a href="{{ route($route) }}" class="flex-1 flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition duration-150 {{ $active }}">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">{!! $icon !!}</svg>
        <span>{{ $label }}</span>
    </a>
    @if($extra)
        {!! $extra !!}
    @endif
</div>