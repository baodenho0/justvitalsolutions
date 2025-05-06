/**
 * Common JavaScript functions for all admin pages
 */

// Document ready function
$(function() {
    // Initialize Bootstrap components
    initBootstrapComponents();

    // Initialize form validations
    initFormValidations();

    // Initialize AJAX setup
    initAjaxSetup();

    // Initialize datatables if they exist
    initDataTables();

    // Initialize custom file inputs
    if (typeof bsCustomFileInput !== 'undefined') {
        bsCustomFileInput.init();
    }

    // Flash message auto-hide
    $('.alert-dismissible').fadeTo(5000, 500).slideUp(500);

    // Enable tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Enable popovers
    $('[data-toggle="popover"]').popover();

    // Handle menu items functionality
    handleMenuItems();

    // Handle image previews
    handleImagePreviews();
});

/**
 * Initialize Bootstrap components
 */
function initBootstrapComponents() {
    // Enable tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Enable popovers
    $('[data-toggle="popover"]').popover();

    // Initialize any modals
    $('.modal').on('show.bs.modal', function() {
        // Do something when modal is shown
    });
}

/**
 * Initialize form validations
 */
function initFormValidations() {
    // Add form validation if needed
    $('form.needs-validation').on('submit', function(event) {
        if (this.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        $(this).addClass('was-validated');
    });
}

/**
 * Initialize AJAX setup with CSRF token
 */
function initAjaxSetup() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

/**
 * Initialize DataTables if they exist on the page
 */
function initDataTables() {
    if ($.fn.DataTable) {
        $('.datatable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "search": "Search:",
                "lengthMenu": "Displays _MENU_ items",
                "info": "Displays _START_ to _END_ of _TOTAL_ items",
                "infoEmpty": "Displaying 0 to 0 of 0 items",
                "infoFiltered": "(filter from _MAX_ entries)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });
    }
}

/**
 * Handle menu items functionality
 */
function handleMenuItems() {
    let menuItemIndex = $('.menu-item-row').length;

    $('#add-menu-item').on('click', function() {
        const template = $('#menu-item-template').html();
        if (template) {
            const newItem = template.replace(/INDEX/g, menuItemIndex++);
            $('#menu-items-container').append(newItem);
        }
    });

    $(document).on('click', '.remove-menu-item', function() {
        $(this).closest('.menu-item-row').remove();
    });
}

/**
 * Handle image previews when selecting files
 */
function handleImagePreviews() {
    // Show image preview when a file is selected
    $(document).on('change', '.custom-file-input', function() {
        const file = this.files[0];
        const fileType = file?.type || '';
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'];

        if (file && validImageTypes.includes(fileType)) {
            const reader = new FileReader();
            const preview = $(this).closest('.form-group').find('.img-preview');

            reader.onload = function(e) {
                if (preview.length) {
                    preview.attr('src', e.target.result);
                } else {
                    const newPreview = $('<div class="mt-2"><img src="' + e.target.result + '" class="img-thumbnail" style="max-height: 100px;"></div>');
                    $(this).closest('.input-group').after(newPreview);
                }
            }.bind(this);

            reader.readAsDataURL(file);
        }
    });
}
