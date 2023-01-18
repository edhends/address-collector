<!-- resources/views/addresses/index.blade.php -->

<x-layout>
    <div class="py-5 text-center">
        <h2>Address Form</h2>
        <p class="lead">Please fill in your mailing address!</p>
    </div>

    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Validated Address</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Address 1</h6>
                        <small class="text-muted" id="normalized-address1">...</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Address 2</h6>
                        <small class="text-muted" id="normalized-address2">...</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Country</h6>
                        <small class="text-muted" id="normalized-country">...</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">City</h6>
                        <small class="text-muted" id="normalized-city">...</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">State</h6>
                        <small class="text-muted" id="normalized-state">...</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Zip5</h6>
                        <small class="text-muted" id="normalized-zip5">...</small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">Zip4</h6>
                        <small class="text-muted" id="normalized-zip4">...</small>
                    </div>
                </li>
            </ul>

        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Mailing address</h4>
            <form class="needs-validation" id="address-form" novalidate>
                <div class="row g-3">

                    <div class="col-12">
                        <label for="address" class="form-label">Address 1</label>
                        <input type="text" class="form-control" name="address1" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">Please provide a valid address</div>
                    </div>

                    <div class="col-12">
                        <label for="address2" class="form-label">Address 2 <span
                                class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" name="address2" placeholder="Apartment or suite">
                        <div class="invalid-feedback">Please provide a valid address</div>
                    </div>

                    <div class="col-md-5">
                        <label for="country" class="form-label">City</label>
                        <input type="hidden" class="form-control" value="United States" name="country" placeholder=""
                            required>
                        <input type="text" class="form-control" name="city" placeholder="city" required>
                        <div class="invalid-feedback">Please provide a valid city.</div>
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" name="state" placeholder="state" required>
                        <div class="invalid-feedback">Please provide a valid state.</div>
                    </div>

                    <div class="col-md-3">
                        <label for="zip" class="form-label">Zip5</label>
                        <input type="text" class="form-control" name="zip5" placeholder="zip5">
                        <div class="invalid-feedback">Please provide a valid zip.</div>
                    </div>

                </div>

                <div id="use-original-address-container" class="d-none">
                    <hr class="my-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="use-original-address">
                        <label class="form-check-label" for="use-original-address">Use original/entered address</label>
                    </div>
                </div>

                <hr class="my-4">
                <div class="alert alert-success d-none" id="global-success-message">

                </div>
                <div class="alert alert-danger d-none" id="global-error-message">

                </div>

                <div class="spinner-border text-primary d-none" id="processing" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <button type="button" class="w-100 btn btn-primary btn-lg" id="btn-validate">
                    Validate
                </button>
                <button type="button" class="w-100 btn btn-primary btn-lg d-none" id="btn-save">
                    Save
                </button>
            </form>
        </div>
    </div>
    <script>
        (function() {
            'use strict'
            var form = document.getElementById("address-form");
            $("#btn-validate").on("click", (e) => {
                $("#global-error-message,#global-success-message").addClass("d-none");

                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    console.log("valid");
                    validateAddress(form);
                }

                form.classList.add('was-validated');
            })

            $("#btn-save").on("click", (e) => {
                var data = $("#btn-save").data();
                console.log(data);
                var useOriginal = $("#use-original-address").is(":checked");
                var address = data.originalAddress;
                if (!useOriginal) {
                    address = {
                        address1: data.normalizedAddress.Address1,
                        address2: data.normalizedAddress.Address2,
                        city: data.normalizedAddress.City,
                        state: data.normalizedAddress.State,
                        country: data.normalizedAddress.Country,
                        zip5: data.normalizedAddress.Zip5,
                        zip4: data.normalizedAddress.Zip4
                    };
                    address.country = $("input[name=country]").val();

                }

                saveAddress(address)

            })

            function validateAddress(form) {
                hideValidationErrors();
                $("#processing").toggleClass("d-none");
                $("#btn-validate").attr("disabled", true);
                var originalAddress = $(form).serialize();
                $.ajax({
                    url: "{{ route('addresses.validate') }}",
                    type: "POST",
                    data: originalAddress
                }).then((response) => {
                    console.log(response);
                    if (response.success) {
                        $("#global-success-message").html('Validation Success');
                        $("#global-success-message").removeClass("d-none");
                        $("#btn-validate").addClass("d-none");
                        $("#btn-save").removeClass("d-none");
                        $("#btn-save").data('originalAddress', originalAddress);
                        $("#btn-save").data('normalizedAddress', response.address);
                        response.address.Country = $("input[name=country]").val();;
                        populateNormalizedAddress(response.address);
                        $("#use-original-address-container").removeClass("d-none");
                    } else {
                        $("#global-error-message").html(response.error)
                        $("#global-error-message").removeClass("d-none")
                        showValidationErrors(response.error);
                    }

                }).fail(error => {
                    console.log(error);
                    $("#global-error-message").html(error.message || 'Request Error')
                    $("#global-error-message").removeClass("d-none")
                }).always(() => {
                    $("#processing").toggleClass("d-none");
                    $("#btn-validate").removeAttr("disabled");
                })
            }

            function saveAddress(data) {
                $("#global-error-message,#global-success-message").addClass("d-none");
                $("#processing").toggleClass("d-none");
                $("#btn-save").attr("disabled", true);
                $.ajax({
                    url: "{{ route('addresses.store') }}",
                    type: "POST",
                    data: data
                }).then((response) => {
                    console.log(response);
                    if (response.success) {
                        $("#global-success-message").html('Saved Successfully');
                        $("#global-success-message").removeClass("d-none");
                        $("#btn-save").addClass("d-none");
                        $("#btn-validate").removeClass("d-none");
                        $("#use-original-address-container").addClass("d-none");
                        resetFields();
                    } else {
                        $("#global-error-message").html(response.error)
                        $("#global-error-message").removeClass("d-none")
                    }

                }).fail(error => {
                    console.log(error);
                    $("#global-error-message").html(error.message || 'Request Error')
                    $("#global-error-message").removeClass("d-none")
                }).always(() => {
                    $("#processing").toggleClass("d-none");
                    $("#btn-save").removeAttr("disabled");
                })
            }

            function populateNormalizedAddress(address) {
                $("#normalized-address1").html(address.Address1);
                $("#normalized-address2").html(address.Address2)
                $("#normalized-country").html(address.Country)
                $("#normalized-city").html(address.City)
                $("#normalized-state").html(address.State)
                $("#normalized-zip5").html(address.Zip5)
                $("#normalized-zip4").html(address.Zip4)
            }

            function hideValidationErrors(){
                $(".is-invalid").removeClass('is-invalid');
                $("#global-error-message,#global-success-message").addClass("d-none");

            }

            function showValidationErrors(errorDescription) {
                switch (true) {
                    case errorDescription.includes('State'):
                        $("input[name=state]").addClass("is-invalid");
                        break;
                    case errorDescription.includes('City'):
                        $("input[name=city]").addClass("is-invalid");
                        break;
                    case errorDescription.includes('Address 1'):
                        $("input[name=address1]").addClass("is-invalid");
                        break;
                    case errorDescription.includes('Zip'):
                        $("input[name=address2]").addClass("is-invalid");
                        break;
                    case errorDescription.includes('Country'):
                        // $("input[name=country]").addClass("is-invalid");
                        break;
                    case errorDescription.includes('Address 2'):
                        $("input[name=address2]").addClass("is-invalid");
                        break;
                    default:
                        console.log(errorDescription)
                }
            }

            function resetFields(){
                $("#address-form").removeClass("was-validated");
                $("#address-form input[type=text]").each((index,el) => {
                    $(el).val('');
                });
                $("#normalized-address1").html('...');
                $("#normalized-address2").html('...');
                $("#normalized-country").html('...');
                $("#normalized-city").html('...');
                $("#normalized-state").html('...');
                $("#normalized-zip5").html('...');
                $("#normalized-zip4").html('...');
            }
        })()
    </script>
</x-layout>
