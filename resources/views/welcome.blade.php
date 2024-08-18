<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="favicon.ico">

        <meta name="description" content="" />
        <meta name="keywords" content="bootstrap, bootstrap4" />
        @livewireStyles

        <!-- Bootstrap CSS -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link href="{{asset('css/tiny-slider.css')}}" rel="stylesheet">
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <title>Furni</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body>
        @include('components.navbar')
        @yield('body')
        @include('components.footer')
        @livewireScripts
        <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('js/tiny-slider.js')}}"></script>
        <script src="{{asset('js/custom.js')}}"></script>
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('cartUpdated', () => {
                    // Vous pouvez faire d'autres actions ici si nécessaire.
                    console.log('Panier mis à jour');
                });
            });

        </script>

    </body>
</html>
