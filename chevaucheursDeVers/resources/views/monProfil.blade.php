@extends('template')

@section('content')
    <div class="row m-1">
        <div class="container border-brown rounded">
            <h2 class="text-center">Profil</h2>
        </div>
    </div>
    <div class="row m-1 border-brown rounded justify-content-center">
        <div class="col-5 m-3 border-brown rounded">
            <h4 class="text-center m-3">Données de connexion</h4>
            <hr/>
            <div class="row d-flex align-items-center my-2">
                <b class='col'>Photo de profil : </b>
                <div class='col'>
                    <img id="photoContainer" src="{{ asset('images/'.$photo_profil.'.png') }}" style="height: 5vh;" alt="profil">
                </div>
            </div>
            <div class="row">
                <b class='col'>Pseudo : </b>
                <p class='col' id="pseudoContainer">{{$user['pseudo']}}</p>
            </div>
            <div class="row">
                <b class='col'>Email : </b>
                <p class='col' id="emailContainer">{{$user['email']}}</p>
            </div>
            <div class="row">
                <b class='col'>Mot de passe : </b>
                <p class='col' id="mdpContainer">****</p>

            </div>
            <div class="row justify-content-end m-3">
                <div class="col-3"> 
                    <button type="button" class="btn btn-primary" onclick="modifyUserAccount(this)">Modifier</button>
                </div>
            </div>
        </div>
        <div class="col-5 m-3 border-brown rounded">
        </div>
    </div>

    

@endsection