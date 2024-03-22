@extends('template')

@section('content')
    <x-chat/>

    <div class='row'>
        <div class='col-3 create'>
            <button class="create">Créer une partie</button>
            <div class="create-form" style="display: none;">
                <label>Nom de la partie : </label>
                <input type="text" id="partie-nom"><br>
                <label>Privée : </label>
                <input type="checkbox" id="partie-privee"><br>

                <button class="create-submit">Créer</button>
            </div>
        </div>
        <div class="vr"></div>
        <div class='col-3 join'>
            <button class="join">Rejoindre une partie</button>
            <div class="join-table" style="display: none;">
                <!-- DataTable pour les parties en cours -->
                <table id="parties-en-cours">
                    <thead>
                        <tr>
                            <th>Nom de la partie</th>
                            <!-- Autres colonnes -->
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


