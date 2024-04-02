@extends('template')

@section('content')

    <div class='row text-center mt-5'>
        <h3>Découvrez le classement des meilleurs Chevaucheurs des Vers !</h3>
        <h5 class="text-muted">Ces joueurs intrépides ont su braver tous les dangers en affrontant le désert ... </h5>
        <h4 class="fw-bold">Serez-vous à la hauteur pour les défier ?</h4>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <div class="rounded border-brown p-4 m-4" style="background-color: #dec189ff;">
                <div class="row">
                    <h4 class='text-center' >TOP 10 : meilleurs scores sur une partie</h4>
                    <hr>
                </div>
                <table id="meilleurScore" class="hover stripe">
                    <thead>
                        <tr>
                            <th scope="col">Rang</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Meilleur score</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rounded border-brown p-4 m-4" style="background-color: #dec189ff;">
                <div class="row">
                    <h4 class='text-center'>TOP 10 : nombres de parties gagnées</h4>
                    <hr>
                </div>
                <table id="nbParties" class="hover stripe">
                    <thead>
                        <tr>
                            <th scope="col">Rang</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Nombre de parties gagnées</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('pagescripts')
@endsection
