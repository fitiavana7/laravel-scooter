<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shorcut icon" href="{{ asset('./pics/gscoot.png') }}">

        <title>Gestion reparation scooter</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

         <!-- bootstrap -->
        <link rel="stylesheet" href="{{ asset('./styles/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('./styles/css/fontAwesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('./styles/css/w3.css') }}">

        <!-- style -->
        <link rel="stylesheet" href="{{ asset('./styles/index.css') }}">
    </head>
    <body>
        <div class="guest">
            <div class="side">
                <h1 class="title">
                    GESTION REPARATION SCOOTER
                </h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum in sapiente consequatur illo vitae rerum quasi perspiciatis, deleniti quidem! Ratione, quisquam beatae! Explicabo aliquid eveniet consequatur, consectetur inventore minus accusamus illo, quos dignissimos pariatur nobis a nemo, nihil provident laudantium. Aliquam, expedita sunt repellendus, quos non consequuntur molestias similique corrupti quam facilis labore inventore officiis culpa aut dolor, fuga qui voluptatibus eveniet veniam! Laboriosam, minima sint harum, ipsa omnis nobis assumenda, repellendus accusamus iste ad aspernatur accusantium nisi commodi porro modi consequatur. Quasi vero alias ipsum voluptates quae mollitia odio qui rerum hic doloribus nemo harum, ratione officia laudantium? Hic!</p>
            </div>
            <div class="form">
                {{ $slot }}
            </div>
        </div>
    </body>
   
</html>
