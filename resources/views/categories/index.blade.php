<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-3xl text-gray-900 dark:text-white">Categories</h2>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your service request categories</p>
            </div>
            <a href="{{route('categories.create')}}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-md transition">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <span>Add Category</span>
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl">
            <div class="p-6">
                <table id="Datatable_category_list" class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">ID</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Name</th>
                            <th class="text-left px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Status</th>
                            <th class="text-center px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Categories list and AJAX handlers loaded from external file -->
    <script src="{{ asset('js/categories-list.js') }}"></script>
</x-app-layout>
