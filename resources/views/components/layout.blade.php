<!-- resources/views/components/layout.blade.php -->

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
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>


<body class="bg-light">

    <div class="container">
        <main>
            {{ $slot }}
        </main>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2023 provelopers</p>

        </footer>
    </div>


    <script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>

    
</body>

</html>
