<aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 min-h-screen px-4 py-6">
    <div class="mb-6">
        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Content</h3>
        <ul class="mt-4 space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-sm text-gray-700 dark:text-gray-200 hover:text-indigo-600">
                    Dashboard
                </a>
            </li>
            <li>
                <div class="mt-4 border-t pt-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Categories</span>
                        <a href="{{ route('categories.create') }}" class="text-xs text-white bg-indigo-600 px-2 py-1 rounded">Create</a>
                    </div>
                    <ul class="mt-3 space-y-2">
                        <li>
                            <a href="{{ route('categories.index') }}" class="block text-sm text-gray-600 dark:text-gray-300 hover:text-indigo-600">List</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</aside>