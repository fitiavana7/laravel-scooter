<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shorcut icon" href="{{ asset('./pics/gscoot.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>G-SCOOT : {{ $client->nom }} {{ $client->prenom }}</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('./styles/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/css/fontAwesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('./styles/css/w3.css') }}">

    <!-- style -->
    <link rel="stylesheet" href="{{ asset('./styles/index.css') }}">

</head>
<body>
    <div class="facture" id="facture">
        <div class="facture-box">
            <div class="imprimer" id="imprimer">
            <div class="head">
                <h1>G-SCOOT</h1>
                <h1>FACTURE</h1>
            </div>
            <div class="descri">
                <h5>Client : <span>{{ $client->nom }} {{ $client->prenom }}</span> </h5>
                <h5>Telephone : <span>{{ $client->phone }}</span> </h5>
                <h5>Adresse : <span>{{ $client->adresse }}</span> </h5>
                <h5>CIN : <span>{{ $client->cin }}</span> </h5>
            </div>
            <div class="tableau">
            <div class="items-row-title">
                    <div class="libelle"><h6>Libellé</h6></div>
                    <div class="item"><h6>Quantité</h6></div>
                    <div class="item"><h6>Prix unitare</h6></div>
                    <div class="item"><h6>Prix</h6></div>
                    <div class="item"><h6>Date</h6></div>
            </div>
                @foreach ($reparations as $item)
                    <div class="items-row">
                        <div class="libelle"><h6>{{ $item->libelle }}</h6></div>
                        <div class="item"><h6>{{ $item->quantite }}</h6></div>
                        <div class="item"><h6>Ar {{ number_format($item->prix_un , 0 ,',','.') }}</h6></div>
                        <div class="item"><h6>Ar {{ number_format($item->prix , 0 ,',','.') }} </h6></div>
                        <div class="item"><h6>{{ $item->date }} {{$item->id}}</h6></div>
                    </div>
                @endforeach            
            </div>
            <div class="somme">
                <h5>Total : <span>Ar {{ number_format($total , 0 ,',','.') }}</span></h5>
            </div>
            <div class="slogan">
                <h5>G-SCOOT , pour vos innovations !</h5>
            </div>
            </div>
        </div>
    </div>
    <script>
        let imprimer = document.getElementById('facture').innerHTML
        window.print()
    </script>
   </body>
</html>