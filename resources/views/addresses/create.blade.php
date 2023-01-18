<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jaffar Hussain, provelopers.net">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Address Collector</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .container {
            max-width: 960px;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    {{-- <link href="form-validation.css" rel="stylesheet"> --}}

</head>


<body class="bg-light">

    <div class="container">
        <main>
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
                                <h6 class="my-0">Address</h6>
                                <small class="text-muted">...</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Address 2</h6>
                                <small class="text-muted">...</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Country</h6>
                                <small class="text-muted">...</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">State</h6>
                                <small class="text-muted">...</small>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Zip</h6>
                                <small class="text-muted">...</small>
                            </div>
                        </li>
                    </ul>

                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Mailing address</h4>
                    <form class="needs-validation" novalidate>
                        <div class="row g-3">

                            <div class="col-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" placeholder="1234 Main St"
                                    required>
                                @error('address')
                                    <div class="text-danger">
                                        Please enter your shipping address.
                                    </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="address2" class="form-label">Address 2 <span
                                        class="text-muted">(Optional)</span></label>
                                <input type="text" class="form-control" name="address2"
                                    placeholder="Apartment or suite">
                            </div>

                            <div class="col-md-5">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" name="country" placeholder="" required>

                                @error('country')
                                    <div class="text-danger">
                                        Please select a valid country.
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" name="state" placeholder="" required>

                                @error('state')
                                    <div class="text-danger">
                                        Please provide a valid state.
                                    </div>
                                @enderror

                            </div>

                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" name="zip" placeholder="" required>
                                @error('zip')
                                    <div class="text-danger">
                                        Zip code required.
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- @if (!$validateMode)
                            <hr class="my-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="save-info">
                                <label class="form-check-label" for="save-info">Use original/entered address</label>
                            </div>
                        @endif --}}

                        <hr class="my-4">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if (!empty($validationError))
                            <div class="alert alert-danger">
                                {{ $validationError }}
                            </div>
                        @endif

                        {{-- @if ($processing)
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        @endif --}}
                        {{-- @if ($validateMode) --}}
                        <button class="w-100 btn btn-primary btn-lg">Validate</button>
                        {{-- @else
                            <button class="w-100 btn btn-primary btn-lg" wire:click.prevent="store()">Save</button>
                        @endif --}}
                    </form>
                </div>
            </div>


        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2023 provelopers</p>

        </footer>
    </div>


    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>
