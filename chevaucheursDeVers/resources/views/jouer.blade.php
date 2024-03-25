@extends('template')

@section('content')
    <x-chat/>

    <div class='row'>
        <div class='col-6 create-all'>
            <button class="create-btn">Créer une partie</button>

            <div class="create-form" style="display: none;">
                <b>Caractéristiques de la partie créée :</b><br>
                <label>Privée :</label>
                <input type="checkbox" id="partie-privee"><br>
                <label for="temps-coup">Temps par coup :</label>
                <select id="temps-coup">
                    <option value="30">30 secondes</option>
                    <option value="60">1 minute</option>
                    <option value="120">2 minutes</option>
                    <option value="300">5 minutes</option>

                </select><br>
                <label>Nombre de joueurs :</label>
                <select id="nombre-joueurs">
                    <option value="2">2 joueurs</option>
                    <option value="3">3 joueurs</option>
                    <option value="4">4 joueurs</option>
                    <option value="5">5 joueurs</option>
                </select><br><br>

                <button class="create-submit">Créer la partie</button>
            </div>
        </div>
        
        <div class='col-6 join-all'>
            <button class="join-btn">Rejoindre une partie</button>
            <div class='join-more' style="display: none">
                <b>Rejoindre la partie :</b><br>
                <div class="join-form" >
                    <label for="code-partie">En utilisant un code de partie :</label>
                    <input type="text" id="code-partie">
                    <button class="join-submit">Valider le code</button>
                </div>
                <div class="join-table">
                    <table id="partiePublique">
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


