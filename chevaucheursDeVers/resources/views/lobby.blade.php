@extends('template')

@section('content')
    <div class="launch-form">
        <p>Le code pour rejoindre la partie est : <b>{{$code_partie}}</b></p>

        <b>Liste des joueurs présents :</b><br>
        <ul id='userJoin'>
            @foreach($participants as $user)
                <li>{{$idHost==$user->id ? $user->pseudo.' (Host)' : $user->pseudo}}</li>
            @endforeach
        </ul>
        <br>
        <p>En attente des joueurs restants</p>
        @if($idHost==$userId)
            <button class="launch-submit incomplet">Lancer la partie sans attendre</button>
        @endif
        <button class="launch-submit complet" style="display: none">Lancer la partie</button>
    </div>
@endsection

@section('pagescripts')
    <script>
        const codePartie = "{{$code_partie}}";
    </script>
@endsection