<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white">{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ isset($category) ? 'Update the category details below' : 'Add a new service request category' }}</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl">
                <div class="p-8">
                    <form id="categoryForm" method="POST" action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <!-- Name -->
                        <div class="mb-8">
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Category Name <span class="text-red-500">*</span></label>
                            <input id="name" name="name" type="text" placeholder="Enter category name..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-600/20 rounded-lg shadow-sm transition" value="{{ old('name', $category->name ?? '') }}" />
                            <span class="text-red-600 text-sm mt-2 block" id="nameError"></span>
                        </div>

                        <!-- Status Toggle -->
                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Status</label>
                            <div class="flex items-center gap-4">
                                <label style="position: relative; display: inline-block; width: 60px; height: 32px;">
                                    <input type="checkbox" id="is_active" name="is_active" value="1" style="opacity: 0; width: 0; height: 0;" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }} />
                                    <span id="slider" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #d1d5db; transition: .4s; border-radius: 32px;"></span>
                                    <span id="slider-button" style="position: absolute; content: ''; height: 28px; width: 28px; left: 2px; bottom: 2px; background-color: white; transition: .4s; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);\"></span>
                                </label>
                                <div>
                                    <span id="status-label" class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ old('is_active', $category->is_active ?? true) ? 'Active' : 'Inactive' }}</span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ old('is_active', $category->is_active ?? true) ? 'Category is visible' : 'Category is hidden' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit" id="submitBtn" class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition shadow-md">
                                <span id="submitText">{{ isset($category) ? 'Save Changes' : 'Create Category' }}</span>
                                <span id="submitSpinner" class="hidden">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-600 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 font-medium transition">Cancel</a>
                        </div>
                    </form>

                    <!-- Success / Error Messages -->
                    <div id="successMessage" class="hidden mt-6 p-4 bg-emerald-100 dark:bg-emerald-900/20 border border-emerald-400 dark:border-emerald-800 text-emerald-700 dark:text-emerald-200 rounded-lg">
                        <div class="flex gap-2">
                            <span class="text-xl">✓</span>
                            <p id="successText"></p>
                        </div>
                    </div>
                    <div id="errorMessage" class="hidden mt-6 p-4 bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-200 rounded-lg">
                        <div class="flex gap-2">
                            <span class="text-xl">!</span>
                            <p id="errorText"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery, validation, and category form logic are loaded globally -->
    <script src="{{ asset('js/categories-form.js') }}"></script>
</x-app-layout>
