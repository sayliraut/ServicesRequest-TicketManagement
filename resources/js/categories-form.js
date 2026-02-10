document.addEventListener('DOMContentLoaded', function() {
    // Toggle UI
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
        rules: { name: { required: true, minlength: 2, maxlength: 100 } },
        messages: { name: { required: 'Category name is required', minlength: 'Category name must be at least 2 characters', maxlength: 'Category name must not exceed 100 characters' } },
        errorPlacement: function(error, element) { if (element.attr('id') === 'name') { $('#nameError').text(error.text()); } },
        success: function(label, element) { if (element.id === 'name') { $('#nameError').text(''); } },
        submitHandler: function(form) { submitFormAjax(); return false; }
    });

    function submitFormAjax() {
        const submitBtn = $('#submitBtn');
        const submitText = $('#submitText');
        const submitSpinner = $('#submitSpinner');
        const successMessage = $('#successMessage');
        const errorMessage = $('#errorMessage');
        const nameError = $('#nameError');

        successMessage.addClass('hidden'); 
        errorMessage.addClass('hidden'); 
        nameError.text('');
        submitBtn.prop('disabled', true); 
        submitText.addClass('hidden'); 
        submitSpinner.removeClass('hidden');

        const isEdit = document.getElementById('categoryForm').method === 'POST' && document.querySelector('input[name="_method"]') === null ? false : true;
        const url = $('#categoryForm').attr('action');

        const formData = {
            _token: $('input[name="_token"]').val(),
            name: $('#name').val(),
            is_active: $('#is_active').is(':checked') ? 1 : 0
        };

        if (isEdit) { formData._method = 'PUT'; }

        $.ajax({ 
            type: 'POST', 
            url: url, 
            data: formData,
            success: function(response) {
                $('#successText').text(response.message || 'Category saved successfully!'); 
                successMessage.removeClass('hidden');
                if (!isEdit) { $('#categoryForm')[0].reset(); updateToggle(); }
                setTimeout(function() { window.location.href = window.BASE_URL + '/categories'; }, 1200);
            },
            error: function(response) {
                if (response.responseJSON && response.responseJSON.errors) {
                    const errors = response.responseJSON.errors; 
                    if (errors.name) { nameError.text(errors.name[0]); }
                    $('#errorText').text('Please fix the errors and try again.');
                } else if (response.responseJSON && response.responseJSON.message) {
                    $('#errorText').text(response.responseJSON.message);
                } else { $('#errorText').text('An error occurred. Please try again.'); }
                errorMessage.removeClass('hidden');
            },
            complete: function() { 
                submitBtn.prop('disabled', false); 
                submitText.removeClass('hidden'); 
                submitSpinner.addClass('hidden'); 
            }
        });
    }
});
