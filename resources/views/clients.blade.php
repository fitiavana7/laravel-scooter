@extends('layouts.mine')

@section('content')
    <div class="navbar">
        <h3>G-SCOOT</h3>
        <div class="navbar-links">
            @if ($user)
                <a class="link" href="{{ route('acceuil') }}">acceuil</a>
                <a class='link link-active' href="{{ route('clients') }}">clients</a>
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
    <div class="clients">
        <div class="sidenav">
            <a href="/clients"><button class="btn btn-success">listes</button></a>
            <a href="/nouveau"><button class="btn lien-active btn-success">ajouter</button></a>
        </div>
        <div class="content">
            <h3 class="clients-text">GERER VOS CLIENTS ICI</h3>
            <div class="clients-barre">
                <form action="{{ route('search') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" required name="search" placeholder="entrer le nom">
                    <button type="  submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </form>
                <a href="{{ route('clients') }}">
                    <button class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                </a>
            </div>
            <div class="clients-items">
                @if ($data->count() > 0)
                    @foreach ($data as $client)
                        <div class="item">
                            <h6>{{ $client->nom }} {{ $client->prenom }} : <span style="color: black;">{{$client->adresse}}</span></h6>
                            <div class="item-buttons">
                                <a href="{{ route('client' , $client->id ) }}">
                                    <button class="btn btn-success"><i class="fa fa-eye"></i></button>
                                </a>
                                <a href="{{ route('modify' ,  $client->id ) }}">
                                    <button class="btn btn-warning"><i class="fa fa-edit"></i></button>
                                </a>
                                <a href="{{ route('delete' , $client->id ) }}">
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </a>
                            </div> 
                        </div>     
                    @endforeach     
                @else
                    <h6 class="not-found">PAS DE CLIENTS</h6>
                @endif
            
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