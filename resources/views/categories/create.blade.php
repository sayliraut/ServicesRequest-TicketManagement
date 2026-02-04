<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="categoryForm" action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <!-- Name -->
                        <div class="mb-6">
                            <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">
                                Name
                            </label>
                            <input 
                                id="name" 
                                name="name" 
                                type="text" 
                                class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block w-full"
                                value="{{ old('name') }}"
                            />
                            <span class="text-red-600 text-sm mt-2" id="nameError"></span>
                        </div>

                        <!-- Is Active Toggle -->
                        <div class="mb-6">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-2">
                                Status
                            </label>
                            <div class="flex items-center gap-4">
                                <label style="position: relative; display: inline-block; width: 50px; height: 24px;">
                                    <input 
                                        type="checkbox" 
                                        id="is_active" 
                                        name="is_active" 
                                        value="1"
                                        style="opacity: 0; width: 0; height: 0;"
                                        {{ old('is_active', true) ? 'checked' : '' }}
                                    />
                                    <span style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 24px;" id="slider"></span>
                                    <span style="position: absolute; content: ''; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; border-radius: 50%;" id="slider-button"></span>
                                </label>
                                <span id="status-label" class="text-sm font-medium text-gray-600 dark:text-gray-300">
                                    {{ old('is_active', true) ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <span class="text-red-600 text-sm mt-2" id="is_activeError"></span>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4">
                            <button 
                                type="submit" 
                                id="submitBtn"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:bg-indigo-700 dark:focus:bg-indigo-600 active:bg-indigo-900 dark:active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            >
                                <span id="submitText">Create Category</span>
                                <span id="submitSpinner" class="ml-2 hidden">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                            </button>
                            <a 
                                href="{{ route('categories.index') }}" 
                                class="inline-flex items-center px-4 py-2 bg-gray-600 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-600 focus:bg-gray-700 dark:focus:bg-gray-600 active:bg-gray-900 dark:active:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            >
                                Cancel
                            </a>
                        </div>
                    </form>

                    <!-- Success Message -->
                    <div id="successMessage" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                        <p id="successText"></p>
                    </div>

                    <!-- Error Message -->
                    <div id="errorMessage" class="hidden mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        <p id="errorText"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle functionality
            const toggleSwitch = document.getElementById('is_active');
            const slider = document.getElementById('slider');
            const sliderButton = document.getElementById('slider-button');
            const statusLabel = document.getElementById('status-label');

            function updateToggle() {
                if (toggleSwitch.checked) {
                    slider.style.backgroundColor = '#3b82f6';
                    sliderButton.style.transform = 'translateX(26px)';
                    statusLabel.textContent = 'Active';
                } else {
                    slider.style.backgroundColor = '#ccc';
                    sliderButton.style.transform = 'translateX(0)';
                    statusLabel.textContent = 'Inactive';
                }
            }

            toggleSwitch.addEventListener('change', updateToggle);
            updateToggle();

            // jQuery validation
            $('#categoryForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2,
                        maxlength: 100
                    }
                },
                messages: {
                    name: {
                        required: 'Category name is required',
                        minlength: 'Category name must be at least 2 characters',
                        maxlength: 'Category name must not exceed 100 characters'
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr('id') === 'name') {
                        $('#nameError').text(error.text());
                    } else if (element.attr('id') === 'is_active') {
                        $('#is_activeError').text(error.text());
                    }
                },
                success: function(label, element) {
                    if (element.id === 'name') {
                        $('#nameError').text('');
                    } else if (element.id === 'is_active') {
                        $('#is_activeError').text('');
                    }
                },
                submitHandler: function(form) {
                    // AJAX submission
                    submitFormAjax();
                    return false;
                }
            });

            // AJAX form submission
            function submitFormAjax() {
                const submitBtn = $('#submitBtn');
                const submitText = $('#submitText');
                const submitSpinner = $('#submitSpinner');
                const successMessage = $('#successMessage');
                const errorMessage = $('#errorMessage');
                const nameError = $('#nameError');

                // Hide previous messages
                successMessage.addClass('hidden');
                errorMessage.addClass('hidden');
                nameError.text('');

                // Show loading state
                submitBtn.prop('disabled', true);
                submitText.addClass('hidden');
                submitSpinner.removeClass('hidden');

                // Get form data
                const formData = {
                    _token: $('input[name="_token"]').val(),
                    name: $('#name').val(),
                    is_active: $('#is_active').is(':checked') ? 1 : 0
                };

                // Submit via AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route("categories.store") }}',
                    data: formData,
                    success: function(response) {
                        // Show success message
                        $('#successText').text(response.message || 'Category created successfully!');
                        successMessage.removeClass('hidden');

                        // Reset form
                        $('#categoryForm')[0].reset();
                        updateToggle();

                        // Redirect after 2 seconds
                        setTimeout(function() {
                            window.location.href = '{{ route("categories.index") }}';
                        }, 2000);
                    },
                    error: function(response) {
                        // Show error message
                        if (response.responseJSON && response.responseJSON.errors) {
                            const errors = response.responseJSON.errors;
                            if (errors.name) {
                                nameError.text(errors.name[0]);
                            }
                            $('#errorText').text('Please fix the errors and try again.');
                        } else if (response.responseJSON && response.responseJSON.message) {
                            $('#errorText').text(response.responseJSON.message);
                        } else {
                            $('#errorText').text('An error occurred. Please try again.');
                        }
                        errorMessage.removeClass('hidden');
                    },
                    complete: function() {
                        // Hide loading state
                        submitBtn.prop('disabled', false);
                        submitText.removeClass('hidden');
                        submitSpinner.addClass('hidden');
                    }
                });
            }
        });
    </script>
</x-app-layout>
