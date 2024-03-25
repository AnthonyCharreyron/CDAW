@extends('template')

@section('content')
    <div class="launch-form">
        <p>Le code pour rejoindre la partie est : <b>{{$code_partie}}</b></p>
        <b>Liste des joueurs présents :</b><br>
        
        <p>En attente des joueurs restants</p>
        <button class="launch-submit incomplet">Lancer la partie sans attendre</button>
        <button class="launch-submit complet" style="display: none">Lancer la partie</button>
    </div>
@endsection

@section('pagescripts')
    <script>
        const codePartie = "{{$code_partie}}";
    </script>
@endsection