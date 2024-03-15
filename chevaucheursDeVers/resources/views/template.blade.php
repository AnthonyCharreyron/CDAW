<!doctype html>
<html lang="fr">


    <head>
        <meta charset="UTF-8">
        <title>Chevaucheurs De Vers</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        @yield('style')

        @yield('head')
    </head>
    <body>
        <div class="row menu">
            @foreach ($menu as $onglet)
                <div class="col-2">
                    <a href="{{$onglet->route}}">{{$onglet->menu_libelle}}</a>
                </div>
            @endforeach
        </div>


        @yield('content')

        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @yield('pagescripts')
    </body>



</html>