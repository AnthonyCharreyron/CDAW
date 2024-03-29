@extends('template')

@section('content')
    <div class="launch-form">
        <p>Le code pour rejoindre la partie est : <b>{{$code_partie}}</b></p>

        <b>Liste des joueurs présents :</b><br>
        <ul id='userJoin'>
            @foreach($participants as $participant)
                <li>{{$idHost==$participant->id_user ? $participant->pseudo .' (Host)' : $participant->pseudo}}</li>
            @endforeach
        </ul>
        <br>
        @if($nb_joueurs != $nombre_joueurs_max)
            <p class="d-inline">En attente des joueurs restants: <div class="d-inline" id="nb_joueurs">{{$nb_joueurs}}</div>/{{$nombre_joueurs_max}}</p>
        @else
            <p>En attente de l'hôte pour lancer la partie</p>
        @endif
        @if($idHost==$userId)
            <button class="btn btn-outline-dark launch-submit incomplet">Lancer la partie sans attendre</button>
        @endif
        <button class="launch-submit complet" style="display: none">Lancer la partie</button>
    </div>
@endsection

@section('pagescripts')
    <script>
        const codePartie = "{{$code_partie}}";
    </script>
@endsection