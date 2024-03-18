<!doctype html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <title>Chevaucheurs De Vers</title>
        <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}" />
        @yield('style')

        @yield('head')
    </head>
    <body>
        <nav class="menu">
            <ul class="row m-0">
                @foreach($menu as $onglet)
                <a class="col text-decoration-none text-black {{$currentPage===$onglet['menu_libelle'] ? 'active' : ''}}"  href="{{$onglet['route']}}">
                    @if($onglet['no_ordre']===1)
                        <img src="images/Colline-logo.png" style="height: 10vh" alt="Logo Colline">
                        <p>&nbsp;</p>
                    @endif

                    <p style="{{$onglet['menu_libelle']==='Se connecter' ? 'font-weight: bold' : ''}}">{{$onglet['menu_libelle']}}</p>
                </a>
                @endforeach
            </ul>
        </nav>

        @yield('content')

        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        @yield('pagescripts')
    </body>
</html>