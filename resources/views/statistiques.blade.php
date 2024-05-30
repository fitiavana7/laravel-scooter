@extends('layouts.mine')

@section('content')
<div class="navbar">
        <h3>G-SCOOT</h3>
        <div class="navbar-links">
            @if ($user)
            <a class="link" href="{{ route('acceuil') }}">acceuil</a>
                <a class='link' href="{{ route('clients') }}">clients</a>
                <a class='link link-active' href="{{ route('stats') }}">statistiques</a>                
                <div class="drop">
                    <button id="btn" class="btn btn-primary"><i class="fa fa-user"></i> <h6>{{ $user->name }}</h6> </button></a>
                    <div class="btn-show" id="drop">
                        <ul>
                            <li><a href="{{ route('logout') }}"><i class="fa fa-arrow-left"></i> Deconnection</a></li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="stats">
        <div class="chart">
            <div class="side">
                <h3>LES TOP CLIENTS</h3>
                <canvas id="chart"></canvas>
            </div>
            <div class="side">
                <h3>TOUTS LES CLIENTS</h3>
                <canvas id="chart2"></canvas>
            </div>
        </div>
        <div class="donnee">
            <div class="side">
            <h4>Les plus grands nombres de reparations</h4>
            <div class="decroissant">
                <div class="items-row-title">
                    <div class="item"><h6>Nom</h6></div>
                    <div class="item"><h6>Prenom</h6></div>
                    <div class="montant"><h6>Nombres</h6></div>
                </div>
                @foreach ($nb_rep as $item )
                <div class="items-row">
                    <div class="item"><h6>{{ $item->nom }}</h6></div>
                    <div class="item"><h6>{{ $item->prenom }}</h6></div>
                    <div class="montant"><h6>{{ $item->reparations_count }}</h6></div>
                </div>    
                @endforeach
            </div>
            </div>
            <div class="side">
            <h4>Les pieces plus couteuses</h4>
            <div class="decroissant cout">
                <div class="items-row-title">
                    <div class="item"><h6>Libelle</h6></div>
                    <div class="item"><h6>Quantité</h6></div>
                    <div class="item"><h6>Prix unitare</h6></div>
                    <div class="item"><h6>Prix</h6></div>
                </div>
                @foreach ($plus as $item )
                    <div class="items-row">
                        <div class="item"><h6>{{ $item->libelle }}</h6></div>
                        <div class="item"><h6>{{ $item->quantite }}</h6></div>
                        <div class="item"><h6>Ar {{ number_format($item->prix_un , 0 ,',','.') }}</h6></div>
                        <div class="item"><h6>Ar {{ number_format($item->prix , 0 ,',','.') }}</h6></div>
                    </div>    
                @endforeach
            </div>
            </div>
           
        </div>
    </div>
    <script src="./Chart.min.js"></script>
    <script>
        let btn = document.getElementById('btn') , drop = document.getElementById('drop');
        btn.onclick = () => {
            if (drop.style.display == 'block') {
                drop.style.display = 'none'
            } else {
                drop.style.display = 'block'
            } 
        }
        let ctx = document.getElementById('chart').getContext('2d');
        var myChart = new Chart(ctx , {
            type : 'horizontalBar',
            data : {
                labels : <?= json_encode($chart_label) ?>  ,
                datasets : [{
                    backgroundColor : 'blue',
                    data : <?= json_encode($chart_data) ?>
                }]
            } ,
            options : {
                legend : {
                    display : false ,
                },
                labels : {
                    fontColor : 'black',
                    fontFamily : 'Circular Std Book',
                    fontSize : 14
                }
            }
        });

      let ctx2 = document.getElementById('chart2').getContext('2d');
        var myChart2 = new Chart(ctx2 , {
            type : 'pie',
            data : {
                labels : <?= json_encode($chart2_label) ?>  ,
                datasets : [{
                    backgroundColor : 'blue',
                    backgroundColor : ['red' , 'blue' , 'yellow' , 'green', 'purple' , 'orange' , 'skyblue' , 'white' , 'aqua' , 'pink', 'aquamarine', 'black' , 'silver'],
                    data : <?= json_encode($chart2_data) ?>,
                    borderColor : 'white' ,
                    borderWidth : 2
                }]
            } ,
            options : {
                responsive : true ,
                // maintainAspectRatio : false,
                // legend : {
                //     display : false ,
                // },
                layout  :{
                    padding : {
                        left : 0 ,
                        right : 0,
                        bottom : 0 ,
                        top : 0
                    }
                },
                plugins : {
                    labels : {
                        render : 'label',
                        position :'outside',
                        arc : true
                    }
                }
               
            }
        });

    </script>
@endsection