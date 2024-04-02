<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chevaucheurs De Vers</title>
    <link rel="stylesheet" href="{{asset('dataTables/css/dataTables.v1.13.4-custom.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kufam:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    @vite('resources/css/app.scss')
    @yield('style')
    @yield('head')
</head>
<body class='kufam-font d-flex flex-column min-vh-100'>
    <nav class="menu">
        <ul class="row m-0">
            @foreach($menu as $onglet)
                @if(($isConnected && $onglet['menu_libelle'] === "Se connecter / S'inscrire") || (!$isConnected && $onglet['menu_libelle'] === 'Jouer'))
                    @if($onglet['menu_libelle']==="Se connecter / S'inscrire")
                        <div class="col d-flex align-items-center justify-content-end">
                            <form method="POST" action="{{ route('connexion.logout') }}">
                                @csrf
                                <button class="btn btn-link" type="submit">Se déconnecter</button>
                            </form>
                            <a class="border-0" href="/monProfil">
                                <img src="{{ asset('images/'.$photo_profil.'.png') }}" style="height: 10vh" alt="profil">
                            </a>
                        </div>
                    @else
                        <div class='col'></div>
                    @endif
                    @else
                        @if($onglet['menu_libelle'] === 'Jouer') 

                      
                            <a class="col dropdown kufam-font text-decoration-none text-black {{$currentPage === $onglet['menu_libelle'] ? 'active' : ''}} dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">{{$onglet['menu_libelle']}}</a>
                            <ul class="dropdown-menu bg-sand border-brown" style="width: 20vw; height: auto">
                                <li><a class="dropdown-item d-flex justify-content-start" href="{{ route('nouvellePartie') }}">Créer une partie</a></li>
                                <hr>
                                <li><a class="dropdown-item d-flex justify-content-start" href="{{ route('rejoindrePartie') }}">Rejoindre une partie</a></li>
                            </ul>
         
                    
                           
                        @else
                            <a class="col kufam-font text-decoration-none text-black {{$currentPage === $onglet['menu_libelle'] ? 'active' : ''}}" href="{{$onglet['route']}}">
                                @if($onglet['no_ordre'] === 1)
                                    <img src="{{ asset('images/Colline-logo.png') }}" style="height: 10vh" alt="Logo Colline">
                                    <p>&nbsp;</p>
                                @endif
                
                                <p style="{{$onglet['menu_libelle'] === 'Se connecter / S\'inscrire' ? 'font-weight: bold' : ''}}">{{$onglet['menu_libelle']}}</p>
                                
                            </a>
                        @endif
                    @endif

            @endforeach
        </ul>
    </nav>

    @yield('content')

    @vite('resources/js/app.js')
    @yield('pagescripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="{{asset('dataTables/js/dataTables.v1.13.2.min.js')}}"></script>
</body>

<footer class="footer mt-auto py-3 text-muted text-center">
    <div class="container">
        <span>CHEVAUCHEURS DE VERS</span>
        <br>
        <span>Développé par Anthony Charreyron et Anna Ruiz</span>
        <br>
        <span> Projet CDAW  &copy; {{ date('Y') }}</span>
    </div>
</footer>

</html>
