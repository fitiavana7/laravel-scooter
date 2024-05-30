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
            <form method="post" action="{{ route('update' , $client->id) }}" enctype="multipart/form-data">
                @csrf
                <h4>MODIFIER LE REPARATION</h4>
                <input type="text" value="{{$rep->id}}" name="repId" hidden />
                <input type="text" value="{{ $rep->libelle }}" name="libelle" placeholder="libelle">
                <input type="number" value="{{ $rep->quantite }}" name="quantite" placeholder="quantité">
                <input type="number" value="{{ $rep->prix_un }}" name="prixUn" placeholder="prix unitaire">
                <button class="btn btn-primary" type="submit">
                    ENREGISTRER
                </button>
                @if ($errors->any())
                <div class="error-list">
                    <div class="item" style="color: red;margin : 1px;">
                    @foreach ($errors->all() as $err )
                        <span>{{ $err }}</span> 
                    @endforeach                        
                    </div>
                </div>                
            @endif
            </form>
            <div class="reparations-items">
                <div class="total">
                    <h5>Listes des réparations :</h5>
                </div>
                <div class="barre">
                    <form class='filtre' method="post" action="{{ route('filter' , $client->id ) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="libelle" required placeholder="libelle">
                        <input type="number" name="prixMin" required placeholder="prix min">
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
                @foreach ($reparations as $item)
                    <div class="items-row">
                        <div class="libelle"><h6>{{ $item->libelle }}</h6></div>
                        <div class="item"><h6>{{ $item->quantite }}</h6></div>
                        <div class="item"><h6>Ar {{ number_format($item->prix_un , 0 ,',','.') }}</h6></div>
                        <div class="item"><h6>Ar {{ number_format($item->prix , 0 ,',','.') }}</h6></div>
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
    </script>
@endsection