<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    @include('layouts.theme.styles')
</head>

<body>
    {{-- loding --}}
    @include('layouts.theme.loding')
    {{-- menu lateral header --}}
    @include('layouts.theme.header')
    {{-- menu lateral derecho --}}
    @include('layouts.theme.rightsidebar')
    {{-- menu lateral izquierdo --}}
    @include('layouts.theme.leftsidebar')
    <div class="mobile-menu-overlay"></div>
    {{-- contenedor principal --}}
    @yield('content')
    {{-- scripts --}}
    @include('layouts.theme.scripts')
</body>

</html>
