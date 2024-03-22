@extends('template')

@section('style')
@endsection

@section('content')
    <div class="row">
        <p>Classement des joueurs</p>
    </div>
    <table id="classement" class="hover">
        <thead>
            <tr>
                <th scope="col">Joueur</th>
                <th scope="col">Score</th>
                <th scope="col">Gagnant</th>
                <!-- <th scope="col">Pourcentage</th>
                <th scope="col">Nombre de points moyens</th> -->
            </tr>
        </thead>
    </table>
@endsection

@section('pagescripts')
@endsection






