<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>YaVentas - Tu tienda online en Cuba</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="YaVentas es una tienda online que se dedica a vender productos variados y de buena calidad y precio en Cuba. Encuentra lo que buscas y recíbelo en tu casa con facilidad y seguridad."/>
    <meta name="keywords" content="tienda online, productos variados, buena calidad, buen precio, Cuba"/>
    <meta property="og:url" content="https://yaventas.com/"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="YaVentas - Tu tienda online en Cuba"/>
    <meta property="og:description"
          content="YaVentas es una tienda online que se dedica a vender productos variados y de buena calidad y precio en Cuba. Encuentra lo que buscas y recíbelo en tu casa con facilidad y seguridad."/>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo/fav.png">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @laravelPWA
    @livewireStyles
    @vite(['resources/css/app.css','resources/css/components/auth/login.css', 'resources/js/app.js'])
    @stack('styles')

</head>

<body>


<livewire:navigation/>
<livewire:mobile-navigation/>

<div wire:id="main-content">
    {{ $slot }}
</div>

<livewire:footer/>


@livewireScripts

<script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js     ') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js        ') }}"></script>
<script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js    ') }}"></script>
<script src="{{ asset('assets/js/plugins/slick.js                  ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.syotimer.min.js    ') }}"></script>
<script src="{{ asset('assets/js/plugins/wow.js                    ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-ui.js              ') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.js      ') }}"></script>
<script src="{{ asset('assets/js/plugins/magnific-popup.js         ') }}"></script>
<script src="{{ asset('assets/js/plugins/select2.min.js            ') }}"></script>
<script src="{{ asset('assets/js/plugins/waypoints.js              ') }}"></script>
<script src="{{ asset('assets/js/plugins/counterup.js              ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.countdown.min.js   ') }}"></script>
<script src="{{ asset('assets/js/plugins/images-loaded.js          ') }}"></script>
<script src="{{ asset('assets/js/plugins/isotope.js                ') }}"></script>
<script src="{{ asset('assets/js/plugins/scrollup.js               ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.vticker-min.js     ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.theia.sticky.js    ') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.elevatezoom.js     ') }}"></script>
<!-- Template  JS -->
<script src="{{ asset('assets/js/main.js?v=3.3') }}"></script>
<script src="{{ asset('assets/js/shop.js?v=3.3') }}"></script>
<script src="{{ asset('assets/js/pwa.js     ') }}"></script>

@stack('scripts')

</body>

</html>
