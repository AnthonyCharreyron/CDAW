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
                <div class="col-1">
                    <img src="images/Colline-logo.png" style="height: 10vh" alt="Logo Colline">
                </div>
                @foreach($menu as $onglet)
                    <li class="col list-unstyled">
                        <a class="text-decoration-none text-black"  style="{{$onglet['menu_libelle']==='Se connecter' ? 'font-weight: bold' : ''}}" href="{{$onglet['route']}}">{{$onglet['menu_libelle']}}</a>
                    </li>
                @endforeach
            </ul>
        </nav>


        @yield('content')

        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        @yield('pagescripts')
    </body>



</html>