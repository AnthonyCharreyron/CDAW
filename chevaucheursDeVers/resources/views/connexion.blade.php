@extends('template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div id="connexionContainer" class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4 border-brown rounded bg-sand">
                <h1 class="text-center mt-3">Connexion</h1>
                <form method="POST" action="{{ route('connexion.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo :</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark mb-3">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <a href="{{ route('page-inscription') }}" class="btn btn-primary inscription">S'inscrire</a>
    </div>

@endsection
