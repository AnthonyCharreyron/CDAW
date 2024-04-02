@extends('template')

@section('content')
    <div class="row">
        <div class="rounded p-4 m-4" style="background-color: #dec189ff;">
            <div class="row">
                <h4 class='text-center' >Gestion des joueurs de Chevaucheurs des Dunes</h4>
                <hr>
            </div>
            <table id="gestionUser" class="hover">
                <thead>
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Pseudo</th>                        
                        <th scope="col">Administrateur</th>
                        <th scope="col">Bloqué</th>
                        <th scope="col">Commentaires</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection