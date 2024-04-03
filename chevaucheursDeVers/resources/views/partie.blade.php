<!doctype html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('dataTables/css/dataTables.v1.13.4-custom.min.css')}}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kufam:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <title>Chevaucheurs De Vers</title>
        @vite('resources/css/app.scss')
    </head>

    <body style="height: 100vh">

        <div>
            <!-- Modal pour la suppression d'une carte destination au début -->
            <div class="modal fade" id="modalDestination" tabindex="-1" role="dialog" aria-labelledby="modalDestLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDestLabel">Veuillez choisir une destination à supprimer</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul>
                                @if(session()->get('cartesDestinationsMain_'.$user->id)!==null)
                                    @foreach(session()->get('cartesDestinationsMain_'.$user->id) as $destination => $points)
                                        <li>{{$destination}} : {{$points}} <button class="btn btn-danger btn-sm" onclick="supprimerDestination({{$user->id}}, 'destination_{{$loop->index + 1}}')" data-bs-dismiss="modal">Supprimer</button></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="supprimerDestination({{$user->id}}, null)" data-bs-dismiss="modal">Garder toutes les cartes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row h-100 m-0">
            <div class="col-9">
                <h1 class='text-center kufam-font mt-3'>Chevaucheurs de vers</h1>
                <!-- TODO : if votreTour => afficher "c'est à vous" <h3>C'est à currentPlayer de jouer</h3> -->
                <!-- TODO : Temps restant : .... -->
                
                <div class='row my-2 d-flex justify-content-center'>
                    @if($partie_commencee)
                        @if(session()->get('joueurEnCours') === $user->pseudo)
                            @if(!isset($_COOKIE['partieDebutee']))
                                <div class='row d-flex justify-content-center text-center' id="btnModalDestinationContainer">
                                    <div class="col-6">
                                        <u class='fw-bold'>Actions à réaliser</u>
                                        <button id="modalDestBtn" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDestination">Veuillez cliquer pour supprimer ou garder vos destinations</button>
                                    </div>
                                </div>
                            @else
                                <div id="btnPiocheVers" class='col-3 d-flex align-items-center justify-content-center'>
                                    <button type="button" class='btn btn-dark' data-bs-toggle="modal" data-bs-target="#piocherVersModal">Piocher des vers</button>
                                </div>
                                <div id="btnPiocheDestinations" class='col-3 d-flex align-items-center justify-content-center'>
                                    <button type="button" class='btn btn-dark' data-bs-toggle="modal" data-bs-target="#piocherDestinationsModal">Piocher des destinations</button>
                                </div>
                                <div id="btnPoserVers" class='col-3 d-flex align-items-center justify-content-center'>
                                    <button class='btn btn-dark' onclick='poserVers()'>Poser des vers</button>
                                </div>
                            @endif
                        @else 
                            <h5 class='text-center fw-bold'>C'est à {{session()->get('joueurEnCours')}} de jouer !</h5>
                        @endif
                    @else
                        <div class='col d-flex align-items-center justify-content-center'>
                            <button type="button" class='btn btn-dark' onclick='lancerPartie()'>Lancer la partie</button>
                        </div>
                    @endif
                </div>

                <div class='row'>
                    <div class='col-9'>
                        <x-carte-jeu/>
                    </div>
                    
                    <div class="col-3 text-center">
                        @if($partie_commencee)
                            @php
                                $cartes = session()->get('piocheVisibleGlobale', [], 5);
                            @endphp
                            <u>Pioche :</u>
                            @forelse($cartes as $carte)
                                <div class="row">
                                    <img class="pioche p-0 mx-auto rotate-image" src="{{ asset('images/'.$carte.'.png') }}" alt="{{ $carte }}" style="width: 100px; height: auto;">
                                </div>
                            @empty
                                <div class="row">
                                    <p>Aucune carte visible pour le moment.</p>
                                </div>
                            @endforelse
                        @endif
                    </div>
                </div>
                <div class='row'>
                    <div class='col'>
                        @if($partie_commencee)
                            <b>Mes destinations et points associés:</b>
                            <ul>
                                @forelse(session()->get('cartesDestinationsMain_'.$user->id, []) as $destination => $points)
                                     <li id="destination_{{$loop->index + 1}}">{{$destination}} : {{$points}}</li>
                                @empty
                                     <p>Aucune carte pour le moment.</p>
                                @endforelse
                            </ul>
                        @endif
                    </div>
                    <div class='col'>
                        <div class='row'>
                            @if($partie_commencee)
                                <u>Mes cartes :</u>
                                @forelse(session()->get('cartesEnMain_'.$user->id, []) as $carte)
                                     <img class="main p-0 my-auto rotate-image" src="{{ asset('images/'.$carte.'.png') }}" alt="{{ $carte }}" style="width: 100px; height: auto;">
                                @empty
                                     <p>Aucune carte visible pour le moment.</p>
                                @endforelse
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 sidebar">
                <!-- TODO : bandeaux avec couleurs, nb cartes et points de chaque joueur -->
                
                @php
                    $couleursVers = ['bleu', 'jaune', 'rouge', 'violet', 'vert']; 
                @endphp
                @foreach($participants as $index => $user)
                    </br>
                    <div class="row {{ $couleursVers[$index % count($couleursVers)] }}">
                        <b>{{ $user->pseudo }}</b>
                        </hr>
                        @if($partie_commencee)
                            <p class="my-0 mx-3"> cartes Vers en mains</p>
                            <p class="my-0 mx-3"> vers restants</p>
                            <p class="my-0 mx-3"> points</p>
                        @endif
                    </div>
                    </br>
                @endforeach

                <x-chat/>
            </div>
        </div>

        <!-- Modal piocher vers-->
        <div class="modal fade" id="piocherVersModal" aria-hidden="true" aria-labelledby="piocherVersModalLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="piocherVersModalLabel">Choisir un ver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <b id="message-deuxieme-pioche" style="display:none">Veuillez choisir une deuxième carte</b>
                        @if(isset($cartes) && $cartes != null)
                            @foreach($cartes as $index => $carte)                              
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <input type="radio" name="carte_selectionnee" value="{{ $index }}">
                                            <img id='carte_{{$index}}' class="selectedCard rotate-image" src="{{ asset('images/'.$carte.'.png') }}" alt="{{ $carte }}" style="width: 50px; height: auto;">  
                                        </label>
                                    </div>
                                </div>                      
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col">
                                <label>
                                    <input type="radio" name="carte_selectionnee" value="pioche">
                                    <p class="d-inline"><img id='carte_pioche' class="selectedCard rotate-image" src="{{ asset('images/dos_de_carte.png') }}" alt="Ver face caché" style="width: 50px; height: auto;">&nbsp; Pioche <p>  
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id='btn-pioche-ver' class="btn btn-primary" onclick="piocherVers(1, {{ json_encode(session()->get('piocheVisibleGlobale')) }})">Valider</button>
                    </div>
                </div>
            </div>
        </div>

                <!-- Modal piocher destinations -->
        <div class="modal fade" id="piocherDestinationsModal" aria-hidden="true" aria-labelledby="piocherDestinationsModalLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="piocherDestinationsModalLabel">Choisir une ou plusieurs destinations</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id='piocher_destination_alert' class='alert-danger alert' style='display:none'>Veuillez sélectionner au moins une destination.</p>
                        <form>
                            @if(session()->has('piocheDestinations'))
                                @foreach(session()->get('piocheDestinations') as $destination => $score)
                                    <input type="checkbox" id="option_{{$loop->index + 1}}" name="destinations" value="{{$destination}}_{{$score}}">
                                    <label for="option_{{$loop->index + 1}}">{{$destination}} : {{$score}}</label>
                                    <br>
                                @endforeach
                            @endif
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id='btn-pioche-destination' class="btn btn-primary" onclick="piocherDestinations()">Gardez ces destinations</button>
                    </div>
                </div>
            </div>
        </div>

        @vite('resources/js/app.js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="{{asset('dataTables/js/dataTables.v1.13.2.min.js')}}"></script>
        <script>
            const codePartie = "{{$code_partie}}";
            const pseudoJoueur = "{{$user->pseudo}}";
        </script>
    </body>

</html>
