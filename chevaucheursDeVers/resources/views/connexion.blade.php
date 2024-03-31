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

    <div class="container justify-content-center d-flex align-items-center mb-3">
        <div class="row">
            <div class="col-md-9">
                <form method="POST" action="{{ route('connexion.authenticate') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="pseudo" class="form-label">Pseudo :</label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo" requiered>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="password" name="password" requiered>
                    </div>
                    <button type="submit" class="btn btn-outline-dark mb-3">Se connecter</button>
                </form>
                
                <button class="btn btn-outline-dark inscription">S'inscrire</button>
                <div class="inscription-form" style="display: none;">
                    <div class="mb-3">
                        <label for="inscription-pseudo" class="form-label">Pseudo :</label>
                        <input type="text" class="form-control" id="inscription-pseudo">
                    </div>
                    <div class="mb-3">
                        <label for="inscription-email" class="form-label">Adresse mail :</label>
                        <input type="email" class="form-control" id="inscription-email">
                    </div>
                    <div class="mb-3">
                        <label for="inscription-password" class="form-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="inscription-password">
                    </div>
                    <button class="btn btn-outline-dark submit-inscription">Créer</button>
                </div>
            </div>
        </div>
    </div>


@endsection



