@extends('template')

@section('content')
    <h1>Connexion</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{ route('connexion.authenticate') }}">
        @csrf
        <label for="pseudo">Pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" required>
        <br>
        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>

    <div >
        <button class="inscription">S'inscrire</button>
        <div class="inscription-form" style="display: none">
            <label>Pseudo : </label>
            <input type="text" id="inscription-pseudo"><br>
            <label>Adresse mail : </label>
            <input type="email" id="inscription-email"><br>
            <label>Mot de passe : </label>
            <input type="text" id="inscription-password"><br>

            <button class="btn-inscription">Créer</button>
        </div>
    </div>



@endsection



