@extends('layouts.mine')

@section('content')
    <div class="navbar">
        <h3>G-SCOOT</h3>
        <div class="navbar-links">
            @if ($user)
            <a class="link" href="{{ route('acceuil') }}">acceuil</a>
                <a class='link' href="{{ route('clients') }}">clients</a>
                <a class='link' href="{{ route('stats') }}">statistiques</a>                
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
   <div class="reparations">
        <div class="reparations-title">
            <h3>LES REPARATIONS DU CLIENTS , <span>{{ $client->nom }} {{ $client->prenom }}</span></h3>
            <h5 class="total">Ar {{ number_format($total , 0 ,',','.') }} </h5>    
        </div>
        <div class="reparations-box">
            <form method="post" action="{{ route('addRep' , $client->id ) }}" enctype="multipart/form-data">
                @csrf
                <h4>AJOUTER UN REPARATION</h4>
                <input type="text" required name="libelle" placeholder="libelle">
                <input type="number" required name="quantite" placeholder="quantité">
                <input type="number" required name="prixUn" placeholder="prix unitaire">
                <input type="date" required name="date" placeholder="date">
                <button class="btn btn-success" type="submit">
                    AJOUTER
                </button>
            </form>
            <div class="reparations-items">
                <div class="total">
                    <div class="total-prix">
                        <h5>Listes des réparations :</h5>
                    </div>    
                    <div class="print">
                        <select class="form-control" name="" id="dateToPrint">
                            <option value=""></option>
                            @foreach ($dates as $date)
                                <option value=" {{ $date->date }}"> {{ $date->date   }}</option>
                            @endforeach
                        </select>
                        <a id="linkToPrint" href='' target="_blank">
                            <button id="buttonToPrint" disabled class="btn btn-success"><i class="fa fa-print"></i></button>
                        </a>
                    </div>     
                </div>
                <div class="barre">
                    <form class='filtre' method="post" action="{{ route('filter' , $client->id ) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="libelle" required placeholder="libelle">
                        <input type="number" name="prixMin" required  placeholder="prix min">
                        <input type="number" name="prixMax" required placeholder="prix max">
                        <button class="btn btn-primary" type="submit">
                        RECHERCHER
                        </button>
                        
                    </form>
                    <a href="{{ route('client' , $client->id) }}">
                        <button class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                    </a> 
                    
                </div>         
                <div class="items-row-title">
                    <div class="libelle"><h6>Libellé</h6></div>
                    <div class="item"><h6>Quantité</h6></div>
                    <div class="item"><h6>Prix unitare</h6></div>
                    <div class="item"><h6>Prix</h6></div>
                    <div class="item"><h6>Date</h6></div>
                    <div class="item"><h6>Action</h6></div>
                </div>
                @foreach ($client->reparations as $item)
                    <div class="items-row">
                        <div class="libelle"><h6>{{ $item->libelle }}</h6></div>
                        <div class="item"><h6>{{ $item->quantite }}</h6></div>
                        <div class="item"><h6>Ar {{ number_format($item->prix_un , 0 ,',','.') }}</h6></div>
                        <div class="item"><h6>Ar {{ number_format($item->prix , 0 ,',','.') }} </h6></div>
                        <div class="item"><h6>{{ $item->date }} {{$item->id}}</h6></div>
                        <div class="item">
                            <a  href="/deleteRep/{{ $client->id }}/{{$item->id}}">
                                <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </a>
                            <a  href="/editRep/{{ $client->id }}/{{$item->id}}">
                                <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                            </a>
                        </div>
                    </div>
                @endforeach               
            </div>
        </div>
        
   </div>
   <script>
        let btn = document.getElementById('btn') , drop = document.getElementById('drop');
        btn.onclick = () => {
            if (drop.style.display == 'block') {
                drop.style.display = 'none'
            } else {
                drop.style.display = 'block'
            } 
        }

        let dateToPrint = document.getElementById('dateToPrint') , linkToPrint = document.getElementById('linkToPrint') , btnPrint = document.getElementById('buttonToPrint');
       
        dateToPrint.onchange = (e) => {
            if (e.target.value != '') {
                linkToPrint.href = `/print/<?= $client->id ?>/${transformDate(e.target.value)}`
                btnPrint.disabled = false
            }
            console.log(e.target.value);
        }

        function transformDate(date){
            let data = date.split('')
            data.shift()
            return data.join('')
        }

    </script>
@endsection