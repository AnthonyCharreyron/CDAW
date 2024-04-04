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
            <div class='d-flex justify-content-center'>
                <button class='btn bg-dark-brown text-white' id="btn-voir-demande-amis">Demandes d'amis en attente</button>
            </div>
            <table id="demande-pour-moi" class="hover" style="display:none">
                <thead>
                    <tr>
                        <th scope="col">Profil</th>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
            
            <!-- Bouton pour voir le profil -->
            <!-- <button type="button" class="btn btn-primary btn-voir-profil" data-id-ami="ID_AMI_AFFICHÉ"  data-bs-toggle="modal" data-bs-target="#modalProfilAmi">Voir le profil</button> -->
            <!-- <img src="{{asset('images/1.png')}}" style="height: 5vh;"  alt="Voir le profil" class="img-voir-profil" data-id-ami="ID_AMI_AFFICHÉ"> -->
            <!-- Modal pour afficher les informations de l'ami -->

            <div class="modal fade" id="modalProfilAmi" tabindex="-1" aria-labelledby="modalProfilAmiLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalProfilAmiLabel">Profil de <span id="amiPseudo"></span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img id="amiPhotoProfil" src="{{asset('images/1.png')}}" alt="Photo de profil" class="img-fluid rounded">
                                </div>
                                <div class="col-md-8">
                                    <p><strong>Pseudo :</strong> <span id="amiPseudoModal"></span></p>
                                    <p><strong>Parties jouées :</strong> <span id="amiPartiesJouees"></span></p>
                                    <p><strong>Parties gagnées :</strong> <span id="amiPartiesGagnees"></span></p>
                                    <p><strong>Meilleur score :</strong> <span id="amiMeilleurScore"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('pagescripts')
    <script>
        const idUser = "{{$user->id}}";
    </script>
@endsection