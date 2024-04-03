@extends('template')

@section('content')
    <div class="row m-1">
        <div class="container">
            <h2 class="text-center mt-3">Profil</h2>
        </div>
    </div>
    <div class="row m-1 border-brown rounded justify-content-center">
        <div class="col-5 m-3 border-brown rounded">
            <h4 class="text-center m-3">Données de connexion</h4>
            <hr/>

            <div class="container" id='images' style="display: none">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <img id="image1" src="{{asset('images/0.png')}}" class="img-fluid" alt="Image 1">
                        <p for="image1">Image 1</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img id="image2" src="{{asset('images/1.png')}}" class="img-fluid" alt="Image 2">
                        <p for="image2">Image 2</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img id="image3" src="{{asset('images/2.png')}}" class="img-fluid" alt="Image 3">
                        <p for="image3">Image 3</p>
                    </div>
                    <div class="col-md-3 text-center">
                        <img id="image4" src="{{asset('images/3.png')}}" class="img-fluid" alt="Image 4">
                        <p for="image4">Image 4</p>
                    </div>
                </div>
            </div>

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
            <h4 class="text-center m-3">Liste d'amis</h4>
            <hr/>

            <table id="liste-amis" class="hover">
                <thead>
                    <tr>
                        <th scope="col">Profil</th>
                        <th scope="col">Pseudo</th>
                    </tr>
                </thead>
            </table>
            <table id="demande-pour-moi" class="hover">
                <thead>
                    <tr>
                        <th scope="col">Profil</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('pagescripts')
    <script>
        const idUser = "{{$user->id}}";
    </script>
@endsection