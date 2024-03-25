<!doctype html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Chevaucheurs De Vers</title>
        <link rel="stylesheet" href="{{asset('dataTables/css/dataTables.v1.13.4-custom.min.css')}}">
        @vite('resources/css/app.scss')
        @yield('style')

        @yield('head')
    </head>
    <body>
        <nav class="menu">
            <ul class="row m-0">
                @foreach($menu as $onglet)
                    @if(($isConnected && $onglet['menu_libelle'] === 'Se connecter') || (!$isConnected && $onglet['menu_libelle'] === 'Jouer'))
                        @if($onglet['menu_libelle']==='Se connecter')
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
                        <a class="col text-decoration-none text-black {{$currentPage===$onglet['menu_libelle'] ? 'active' : ''}}"  href="{{$onglet['route']}}">
                            @if($onglet['no_ordre']===1)
                                <img src="{{asset('images/Colline-logo.png')}}" style="height: 10vh" alt="Logo Colline">
                                <p>&nbsp;</p>
                            @endif
                            
                            <p style="{{$onglet['menu_libelle']==='Se connecter' ? 'font-weight: bold' : ''}}">{{$onglet['menu_libelle']}}</p>
                            
                        </a>
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
</html>