@extends('template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <x-chat/>

    <div class="container text-center">
        <div class="row">
            <div class="col-6">
                <button id="create-btn" class="btn btn-primary">Créer une partie</button>
            </div>
            <div class="col-6">
                <hr class="d-md-none">
                <button id="join-btn" class="btn btn-primary">Rejoindre une partie</button>
            </div>
        </div>
        <div class="row">
            <form method="POST" action="{{ route('creer_partie') }}" class="col-md-6 create-form" style="display: none;">
                @csrf
                <b>Caractéristiques de la partie créée :</b><br>
                <div class="mb-3">
                    <label for="partie-privee" class="form-label">Privée :</label>
                    <input type="checkbox" id="partie-privee" class="form-check-input">
                </div>
                <div class="mb-3">
                    <label for="temps-coup" class="form-label">Temps par coup :</label>
                    <select id="temps-coup" name="temps-coup" class="form-select">
                        <option value="30">30 secondes</option>
                        <option value="60">1 minute</option>
                        <option value="120">2 minutes</option>
                        <option value="300">5 minutes</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nombre-joueurs" class="form-label">Nombre de joueurs :</label>
                    <select id="nombre-joueurs" name="nombre-joueurs" class="form-select">
                        <option value="2">2 joueurs</option>
                        <option value="3">3 joueurs</option>
                        <option value="4">4 joueurs</option>
                        <option value="5">5 joueurs</option>
                    </select>
                </div>
                <input type="hidden" id="hostId" name="hostId" value="{{$user['id']}}">
                <br>
                <button id="create-submit" type="submit" class="btn btn-primary">Créer la partie</button>
            </form>

            <div class="col-md-6 join-more" style="display: none;">
                <b>Rejoindre la partie :</b><br>
                <div class="join-form">
                    <label for="code-partie">En utilisant un code de partie :</label>
                    <input type="text" id="code-partie" class="form-control">
                    <button id="join-submit" class="btn btn-primary join-submit">Valider le code</button>
                </div>
                <div class="join-table mt-3">
                    <table id="partiePublique" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Numéro de partie</th>
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


