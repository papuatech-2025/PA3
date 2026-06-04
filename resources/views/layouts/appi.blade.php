<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>istem Informasi Dinasa Pemberdayaan Perempuan & anak</title>

<link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
<link href="assets/css/main.css" rel="stylesheet">
<link href="assets/css/main.css" rel="stylesheet">
@stack('styles')

</head>

<body>

@include('partials.header')

<main class="main">
@yield('content')
</main>

@include('partials.footer')

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="assets/js/main.js"></script>
@stack('scripts')

</body>
</html>