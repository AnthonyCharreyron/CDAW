@extends('template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="container text-center m-5"> 
        <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-4 join-more my-3">
                <h3 class='mb-3'>Rejoindre une partie :</h3>
                <hr>
                <div class="join-form">
                    <label for="code-partie">En utilisant un code de partie :</label>
                    <input type="text" id="code-partie" class="form-control">
                    <button id="join-submit" class="btn bg-dark-brown text-white join-submit my-2">Valider le code</button>
                </div>
            </div>          
        </div>
        <div class="row d-flex justify-content-center align-items-center">
             <div class="col-md-6 join-more my-3">
                <div class="join-table my-3">
                    <label for="partiePublique">En cliquant sur "Rejoindre" dans le tableau suivant :</label>
                    <table id="partiePublique" class="hover bg-sand border-brown rounded">
                        <thead>
                            <tr>
                                <th scope="col">Code de la partie</th>
                                <th scope="col">Nombre de joueurs</th>
                                <th scope="col">Temps par coup</th>
                                <th scope="col">Rejoindre</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
