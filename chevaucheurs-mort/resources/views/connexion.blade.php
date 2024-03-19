@extends('template')

@section('content')
    <h4> Veuillez vous identifier</h4>
    <div class="container rounded justify-content-center d-flex align-items-center mb-3" >
        <div class="card p-4">
            <h2 class="text-center mb-4">Connexion</h2>
            <form id="loginForm">
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" class="form-control" id="pseudo" placeholder="Votre pseudo">
                </div>
                <div class="form-group">
                    <label for="pwd">Mot de passe</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Votre mot de passe">
                </div>
                <button type="submit" class="btn btn-primary btn-block" id="loginButton">Se Connecter</button>
            </form>
            <a class="text-center" href="premiereConnexion.php" >Première connexion<a>
        </div>
    </div>
@endsection



