<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/css/bootstrap.css">

    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendors/iconly/bold.css">

    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/css/app.css">
    <link rel="shortcut icon" href="{{ asset('assets/backend') }}/images/favicon.svg" type="image/x-icon">
    

    @stack('css')
</head>

<body>
    <div id="app">

        @include('backend.layout.partials._sidebar')

        @yield('content')

        <script src="{{ asset('assets/backend') }}/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="{{ asset('assets/backend') }}/js/bootstrap.bundle.min.js"></script>

        <script src="{{ asset('assets/backend') }}/vendors/apexcharts/apexcharts.js"></script>
        <script src="{{ asset('assets/backend') }}/js/pages/dashboard.js"></script>

        <script src="{{ asset('assets/backend') }}/js/main.js"></script>

        @stack('js')

    </div>
</body>

</html>
