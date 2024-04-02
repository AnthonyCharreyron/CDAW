@extends('template')

@section('content')
    <div class="row h-100 m-0">
        <div class="col-9 text-center">
            <h3 class="mt-3">Lobby</h3>
            <div class='container bg-sand p-3 border-brown rounded'>
     
                <p>Le code pour rejoindre la partie est : <b>{{$code_partie}}</b></p>
                <br>
                <b>Liste des joueurs présents :</b><br>
                <br>
                <ul id="userJoin" class='list-unstyled'>
                    @foreach($participants as $participant)
                        <li>{{$idHost==$participant->id_user ? $participant->pseudo .' (Host)' : $participant->pseudo}}</li>
                    @endforeach
                </ul>
                <br>
                @if($nb_joueurs != $nombre_joueurs_max)
                    <p class="d-inline">En attente des joueurs restants: <span class="d-inline" id="nb_joueurs">{{$nb_joueurs}}</span>/{{$nombre_joueurs_max}}</p>
                @else
                    <p>En attente de l'hôte pour lancer la partie</p>
                @endif
                @if($idHost==$userId)
                    <button class="btn btn-outline-dark launch-submit incomplet">Lancer la partie sans attendre</button>
                @endif
                <button class="launch-submit complet" style="display: none">Lancer la partie</button>
    
            </div>  
        </div>
        <div class="col-3 vh-100 sidebar">
            <x-chat/>
        </div>
    </div>
@endsection

@section('pagescripts')
    <script>
        const codePartie = "{{$code_partie}}";
    </script>
@endsection
