@extends('template')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/dataTables/css/dataTables.v1.13.4-custom.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <p>Classement des joueurs</p>
    </div>
    <table id="classement" class="hover">
        <thead>
            <tr>
                <th scope="col">Joueur</th>
                <th scope="col">Nombre de parties jouées</th>
                <th scope="col">Nombre de victoires</th>
                <th scope="col">Pourcentage</th>
                <th scope="col">Nombre de points moyens</th>
            </tr>
        </thead>
    </table>
@endsection

@section('pagescripts')
    <script type="text/javascript" src="{{asset('js/classement.js')}}"></script>
@endsection






