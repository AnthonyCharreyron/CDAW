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
    <form method="POST" action="{{ route('connexion.logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
@endsection



