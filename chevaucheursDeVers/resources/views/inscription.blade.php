@extends('template')

@section('content')
    <div class="container inscription-form">
        <div class="row my-3 justify-content-center">
            <div class="col-md-4 border-brown rounded bg-sand">
                <h1 class="text-center mt-3">Inscription</h1>
                @isset($error)
                    <div>
                        <p class=' alert alert-danger text-center'>{{$error}}</p>
                    </div>
                @endisset
                <form method="POST" action="{{ route('inscription') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="inscription-pseudo" class="form-label">Pseudo :</label>
                        <input type="text" class="form-control" id="inscription-pseudo" name="inscription-pseudo" required>
                    </div>
                    <div class="mb-3">
                        <label for="inscription-email" class="form-label">Adresse mail :</label>
                        <input type="email" class="form-control" id="inscription-email" name="inscription-email" required>
                    </div>
                    <div class="mb-3">
                        <label for="inscription-password" class="form-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="inscription-password" name="inscription-password" required>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-dark mb-3">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <a href="{{ route('connexion') }}" class="btn btn-primary">Se connecter</a>
    </div>
@endsection
