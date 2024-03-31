<div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Division</h3>

            <!--begin::Close-->
            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                <i class="ki-duotone ki-cross fs-1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </div>
            <!--end::Close-->
        </div>

        <form id="updateForm" enctype="multipart/form-data">
            <div class="modal-body">
                <input type="hidden" name="division_id" id="division_id" value="<?= @$id; ?>">
                <label for="division_name" class="form-label fw-bold">Division Name</label>
                <div class="fv-row">
                    <input type="text" name="division_name" id="division_name" class="form-control" placeholder="e.g. Finance" value="<?= @$division_name; ?>">
                </div>
            </div>
    
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="submitForm">
                    <!--begin::Indicator label-->
                    <span class="indicator-label fw-bold">Submit</span>
                    <!--end::Indicator label-->
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </form>
    </div>


<script>
    var updateForm = function () {
        var submitButton;
        var validator;
        var form;
       
        // Handle form validation and submittion
        var handleForm = function () {
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'division_name': {
                            validators: {
                                notEmpty: {
                                    message: 'Division Name is required'
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: 'is-invalid',
                            eleValidClass: 'is-valid'
                        })
                    }
                }
            );

            // Action buttons
            submitButton.addEventListener('click', function (e) {
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        if (status == 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click 
                            submitButton.disabled = true;

                            // Simulate ajax process
                            setTimeout(function () {
                                var form = new FormData($("#updateForm")[0]);
                                $.ajax({
                                    method: 'POST',
                                    url: base_url + "division/update",
                                    dataType: 'json',
                                    data: form,
                                    processData: false,
                                    contentType: false,
                                    success: function (result) {
                                        if (result.response == 200) {
                                            toastr.options = {
                                                "closeButton": false,
                                                "debug": false,
                                                "newestOnTop": true,
                                                "progressBar": false,
                                                "positionClass": "toastr-top-right",
                                                "preventDuplicates": true,
                                                "showDuration": "300",
                                                "hideDuration": "1000",
                                                "timeOut": "5000",
                                                "extendedTimeOut": "1000",
                                                "showEasing": "swing",
                                                "hideEasing": "linear",
                                                "showMethod": "fadeIn",
                                                "hideMethod": "fadeOut"
                                            };

                                            toastr.success(result.message);

                                            submitButton.setAttribute('data-kt-indicator', 'on');
                                            submitButton.disabled = true;
									
                                            window.setTimeout(function () {
                                                window.location.href = base_url + 'division';
                                            }, 2000);
                                        } else {
                                            toastr.options = {
                                                "closeButton": false,
                                                "debug": false,
                                                "newestOnTop": true,
                                                "progressBar": false,
                                                "positionClass": "toastr-top-right",
                                                "preventDuplicates": true,
                                                "showDuration": "300",
                                                "hideDuration": "1000",
                                                "timeOut": "5000",
                                                "extendedTimeOut": "1000",
                                                "showEasing": "swing",
                                                "hideEasing": "linear",
                                                "showMethod": "fadeIn",
                                                "hideMethod": "fadeOut"
                                            };
                                            
                                            toastr.error(result.message);

                                            submitButton.removeAttribute('data-kt-indicator');
                                            submitButton.disabled = false;
                                        }
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        toastr.options = {
                                            "closeButton": false,
                                            "debug": false,
                                            "newestOnTop": true,
                                            "progressBar": false,
                                            "positionClass": "toastr-top-right",
                                            "preventDuplicates": true,
                                            "showDuration": "300",
                                            "hideDuration": "1000",
                                            "timeOut": "5000",
                                            "extendedTimeOut": "1000",
                                            "showEasing": "swing",
                                            "hideEasing": "linear",
                                            "showMethod": "fadeIn",
                                            "hideMethod": "fadeOut"
                                        };

                                        toastr.error('Unexpected Error. Please try again.');

                                        submitButton.removeAttribute('data-kt-indicator');
                                        submitButton.disabled = false;
                                    }
                                })
                            }, 2000);
                        } else {
                            // Show error message.
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                }
            });
        }

        return {
            // Public functions
            init: function () {
                // Elements
                form = document.querySelector('#updateForm');
                submitButton = document.getElementById('submitForm');

                handleForm();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        updateForm.init();
    });
</script>