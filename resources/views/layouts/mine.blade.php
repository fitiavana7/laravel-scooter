<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shorcut icon" href="{{ asset('./pics/gscoot.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion reparation scooter</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('./styles/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/css/fontAwesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/css/w3.css') }}">

    <!-- style -->
    <link rel="stylesheet" href="{{ asset('./styles/index.css') }}">

</head>
<body>
    @yield('content')
    <div class='footer'>
        <p>Fitiavana Andriaherilanto copyright &copy;</p>
    </div>
</body>
</html>