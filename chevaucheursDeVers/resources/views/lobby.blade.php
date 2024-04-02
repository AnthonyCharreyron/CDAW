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
                <p class="d-inline">Nombre de joueurs présents dans le lobby : <span class="d-inline" id="nb_joueurs">{{ $nb_joueurs }}</span>/{{ $nombre_joueurs_max }}</p>
                @if ($idHost == $userId)
                    <button class="btn bg-dark-brown text-white launch-submit incomplet">Lancer la partie sans attendre</button>
                    <button class="btn bg-dark-brown text-white launch-submit complet" style="display: none;">Lancer la partie</button>
                @else
                    <p>En attente de l'hôte pour lancer la partie</p>
                @endif    
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
        var nb_joueurs_max = "{{$nombre_joueurs_max}}"
    </script>
@endsection
