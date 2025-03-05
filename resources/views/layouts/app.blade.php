<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @stack('css')
    @vite(['resources/css/app.css'])
</head>
<body>
    {{-- <!-- Include Header -->
    @include('components.header') --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Include Footer -->
    {{-- @include('components.footer') --}}
    @stack('js')
</body>
</html>
