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
    <div class='nouveau'>         
        <div class="sidenav">
            <a href="/clients"><button class="btn btn-success">listes</button></a>
            <a href="/nouveau"><button class="btn btn-success">ajouter</button></a>
            <a href=""><button class="btn btn-success lien-active">modifier</button></a>
        </div>
        <div class="content">          
        <div class="nouveau-details">
            <h2>MODIFIER LE CLIENT ICI</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat, similique laudantium. Obcaecati hic alias ea numquam totam aspernatur, eum enim repellat in error reprehenderit blanditiis recusandae dolore ullam deserunt sed fuga nobis voluptates distinctio eius qui laudantium impedit. Esse ipsum tempore placeat totam quae cum repellat veritatis temporibus exercitationem. Officia.</p>
        </div>
        <form action="{{ route('edit' , $client->id ) }}" method="post" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="error-list">
                    <div class="item">
                    @foreach ($errors->all() as $err )
                        <span>{{ $err }}</span> 
                    @endforeach                        
                    </div>
                </div>                
            @endif
            <div class="nouveau-form">
                <input type="text" value='{{ $client->nom }}' name="nom" id="nom" placeholder='nom' />
                <input type="text"  value='{{ $client->prenom }}' name="prenom" id="prenom" placeholder='prenom' />
                <input type="text"  value='{{ $client->phone }}' name="phone" id="phone" placeholder='telephone' />
                <input type="text"  value='{{ $client->mail }}' name="mail" id="mail" placeholder='e-mail' />
                <input type="text"  value='{{ $client->adresse }}' name="adresse" id="adresse" placeholder='adresse' />
                <input type="number"  value='{{ $client->cin }}' name="cin" id="cin" placeholder='numero CIN' />
                <button class='btn btn-danger' type="submit">ENREGISTRER</button>
            </div>
        </form>
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