@extends('layouts.mine')

@section('content')
    <div class="navbar">
        <h3>G-SCOOT</h3>
        <div class="navbar-links">
            @if ($user)
            <a class="link link-active" href="{{ route('acceuil') }}">acceuil</a>
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
                @else
                <a  class="link link-active" href="{{ route('login') }}">connexion</a>
                <a  class="link link-active" href="{{ route('register') }}">creer</a>
            @endif
        </div>
    </div>
    <div class="home">
        <div class="home-text">
            <h1>G-SCOOT , GERER AVEC FACILITÉ</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente autem cupiditate placeat natus eaque esse aperiam soluta ipsa consectetur, accusamus quae ducimus assumenda saepe eius exercitationem tempore tempora iusto fuga fugit veritatis a suscipit dolores hic pariatur! Aut, eveniet fugit.</p>
            @if ($user)
            <div class="home-text-button"> 
                <a href="{{ route('clients') }}"><button class="btn btn-danger">voir les clients</button></a>
            </div>                
            @endif
        </div>
        <div class='home-links'>
            <a href=""><button class="btn btn-danger"><i class="fa fa-facebook"></i></button></a>
            <a href=""><button class="btn btn-danger"><i class="fa fa-github"></i></button></a>
            <a href=""><button class="btn btn-danger"><i class="fa fa-google"></i></button></a>
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