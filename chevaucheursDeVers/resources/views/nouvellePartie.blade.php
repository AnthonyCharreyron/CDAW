@extends('template')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="container text-center m-5">
        
        <div class="row d-flex justify-content-center align-items-center">
            <div class='col-md-4'>
                <h3 class='my-3'>Créer une partie :</h3>
                <hr>
                <b class="mb-3">Caractéristiques de la partie créée :</b>
                <form method="POST" action="{{ route('creer_partie') }}" class="create-form">
                    @csrf
                    <div>
                        <label for="partie-privee" class="form-label">Privée :</label>
                        <input type="checkbox" id="partie-privee" name="partie-privee" class="form-check-input">
                    </div>
                    <div class="mb-3">
                        <label for="temps-coup" class="form-label">Temps par coup :</label>
                        <select id="temps-coup" name="temps-coup" class="form-select text-center">
                            <option value="30">30 secondes</option>
                            <option value="60">1 minute</option>
                            <option value="120">2 minutes</option>
                            <option value="300">5 minutes</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombre-joueurs" class="form-label">Nombre de joueurs :</label>
                        <select id="nombre-joueurs" name="nombre-joueurs" class="form-select text-center">
                            <option value="2">2 joueurs</option>
                            <option value="3">3 joueurs</option>
                            <option value="4">4 joueurs</option>
                            <option value="5">5 joueurs</option>
                        </select>
                    </div>
                    <input type="hidden" id="hostId" name="hostId" value="{{$user['id']}}">
                    <br>
                    <button type="submit" class="btn bg-dark-brown text-white">Créer la partie</button>
                </form>
            </div>
        </div>
    </div>
@endsection