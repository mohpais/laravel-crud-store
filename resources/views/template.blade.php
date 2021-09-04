<!DOCTYPE html>
<html>

<head>
    <title>PHP DEVELOPER TECHNICAL SKILL TEST</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>

<body class="bg-light">
    @if (Request::path() !== 'login' && Request::path() !== 'register')
        @include('inc.navbar')
    @endif
    <div class="container-fluid">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
</body>

</html>