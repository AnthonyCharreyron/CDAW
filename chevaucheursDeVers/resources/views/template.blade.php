<!doctype html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Chevaucheurs De Vers</title>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
        @vite('resources/css/app.scss')
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

        @vite('resources/js/app.js')
        @yield('pagescripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    </body>
</html>