<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-3xl text-gray-900 dark:text-white">Create Service Request</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Submit a new service request for assistance</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl">
                <div class="p-8">
                    <form id="ticketForm" method="POST" action="{{ route('tickets.store') }}">
                        @csrf

                        <!-- Category -->
                        <div class="mb-6">
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Category <span class="text-red-500">*</span></label>
                            <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-600/20 rounded-lg shadow-sm transition" required>
                                <option value="">Select a category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Subject -->
                        <div class="mb-6">
                            <label for="subject" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Subject <span class="text-red-500">*</span></label>
                            <input id="subject" name="subject" type="text" placeholder="Brief summary of your request..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-600/20 rounded-lg shadow-sm transition" value="{{ old('subject') }}" required />
                            @error('subject') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Description <span class="text-red-500">*</span></label>
                            <textarea id="description" name="description" rows="6" placeholder="Provide detailed information about your request..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-600/20 rounded-lg shadow-sm transition" required>{{ old('description') }}</textarea>
                            @error('description') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Priority -->
                        <div class="mb-8">
                            <label for="priority" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Priority <span class="text-red-500">*</span></label>
                            <select id="priority" name="priority" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-2 focus:ring-indigo-500/20 dark:focus:ring-indigo-600/20 rounded-lg shadow-sm transition" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                            @error('priority') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition shadow-md">
                                <span>Submit Request</span>
                            </button>
                            <a href="{{ route('tickets.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gray-600 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 font-medium transition">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
