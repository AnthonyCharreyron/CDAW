@extends('template')

@section('content')
    
    <div class="row">
        <div class="col-md-6">
            <div class="rounded p-4 m-4" style="background-color: #dec189ff;">
                <div class="row">
                    <h4 class='text-center' >Classement des joueurs ayant les meilleurs scores</h4>
                    <hr>
                </div>
                <table id="meilleurScore" class="hover">
                    <thead>
                        <tr>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Meilleur score</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="rounded p-4 m-4" style="background-color: #dec189ff;">
                <div class="row">
                    <h4 class='text-center'>Classement des joueurs ayant gagné le plus de parties</h4>
                    <hr>
                </div>
                <table id="nbParties" class="hover">
                    <thead>
                        <tr>
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
