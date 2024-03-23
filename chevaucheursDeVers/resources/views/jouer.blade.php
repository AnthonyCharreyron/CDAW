@extends('template')

@section('content')
    <x-chat/>

    <div class='row'>
        <div class='col-6 create-all'>
            <button class="create">Créer une partie</button>

            <div class="create-form" style="display: none;">
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
            <div class="launch-form" style="display: none">
                <p>En attente des joueurs</p>
                <button class="launch-submit incomplet">Lancer la partie sans attendre</button>
                <button class="launch-submit complet" style="display: none">Lancer la partie</button>
            </div>


        </div>
        <div class='col-6 join-all'>
            <button class="join">Rejoindre une partie</button>

            <div class="join-more join-form" style="display: none">
                <label for="code-partie">En utilisant un code de partie :</label>
                <input type="text" id="code-partie">
                <button class="join-submit">Valider le code</button>
            </div>

            <div class="join-more join-table" style="display: none;">
                <table id="parties-en-cours">
                    <thead>
                        <tr>
                            <th>Nom de la partie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contenu de la table -->
                    </tbody>
                </table>
            </div>
        </div>   
    </div>

@endsection


