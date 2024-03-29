<!doctype html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Chevaucheurs De Vers</title>
        @vite('resources/css/app.scss')
    </head>

    <body style="height: 100vh">

        <div class="row h-100">
            <div class="col-9">
                <h1 class='text-center'>Chevaucheurs de vers</h1>
                <!-- TODO : if votreTour => afficher "c'est à vous" <h3>C'est à currentPlayer de jouer</h3> -->
                <!-- TODO : Temps restant : .... -->
                
                <div class='row my-3 d-flex justify-content-center'>
                    @if($partie_commencee)
                        <div class='col-3 d-flex align-items-center justify-content-center'>
                            <button type="button" class='btn btn-outline-secondary' data-bs-toggle="modal" data-bs-target="#exampleModalToggle">Piocher des vers</button>
                        </div>
                        <div class='col-3 d-flex align-items-center justify-content-center'>
                            <button class='btn btn-outline-secondary' onclick='piocherDestination()'>Piocher des destinations</button>
                        </div>
                        <div class='col-3 d-flex align-items-center justify-content-center'>
                            <button class='btn btn-outline-secondary' onclick='poserVers()'>Poser des vers</button>
                        </div>  
                    @else
                        <div class='col d-flex align-items-center justify-content-center'>
                            <button class='btn btn-outline-secondary' onclick='lancerPartie()'>Lancer la partie</button>
                        </div>
                    @endif
                </div>

                <div class='row'>
                    <div class='col-9'>
                        <x-carte-jeu/>
                    </div>
                    
                    <div class="col-3">
                        @if($partie_commencee)
                            @php
                                $cartes = array_slice(session()->get('piocheVisibleGlobale', []), 0, 5);
                            @endphp

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
                    <div class='col-4'>
                        @if($partie_commencee)
                            <b>Mes destinations et points associés:</b>
                            <ul>
                                @forelse(session()->get('cartesDestinationsMain_'.$user->id, []) as $destination => $points)
                                     <li>{{$destination}} : {{$points}}</li>
                                @empty
                                     <p>Aucune carte pour le moment.</p>
                                @endforelse
                            </ul>
                        @endif
                    </div>
                    <div class='col-8'>
                        <div class='row'>
                            @if($partie_commencee)
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
            </div>
        </div>


        @if(session()->get('piocheVisibleGlobale') !== null )
            @php 
                $cartes = session()->get('piocheVisibleGlobale');
            @endphp    
        @endif

        <!-- Modal -->

        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Choisir le premier ver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @forelse($cartes as $index => $carte)
                            @if($index == 5)
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <input type="radio" name="carte_selectionnee" value="{{ $carte[$index] }}">
                                            <p class="d-inline"><img class="selectedCard rotate-image" src="{{ asset('images/dos_de_carte.png') }}" alt="Ver face caché" style="width: 40px; height: auto;">&nbsp; Pioche <p>  
                                        </label>
                                    </div>
                                </div>
                            @elseif($index == 6)
                                <div id="lastCard" class="row" style="display: none;">
                                    <div class="col">
                                        <label>
                                            <input type="radio" name="carte_selectionnee" value="{{ $carte[$index] }}">
                                            <p class="d-inline"><img class="selectedCard rotate-image" src="{{ asset('images/dos_de_carte.png') }}" alt="Ver face caché" style="width: 40px; height: auto;">&nbsp;Pioche <p>  
                                        </label>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <label>
                                            <input type="radio" name="carte_selectionnee" value="{{ $carte }}" id="carte{{ $index }}">
                                            <img class="selectedCard rotate-image" src="{{ asset('images/'.$carte.'.png') }}" alt="{{ $carte }}" style="width: 50px; height: auto;">  
                                        </label>
                                    </div>
                                </div>
                            @endif  
                        @empty
                            <div class="row">
                                <p>Aucune carte visible pour le moment.</p>
                            </div>
                        @endforelse
                        <script>
                            var radioInputs = document.querySelectorAll('input[name="carte_selectionnee"]');
                            var selectedValue = radioInputs.checked.value;
                            console.log(selectedValue);
                        </script>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Valider le choix du premier ver</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel2">Choisir le second ver</h5>
                    </div>
                <div class="modal-body">
                    message blop
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-dismiss="modal" onclick=piocherVers()>Valider le second ver</button>
                </div>
            </div>
        </div>


        @vite('resources/js/app.js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="{{asset('dataTables/js/dataTables.v1.13.2.min.js')}}"></script>
        <script>
            const codePartie = "{{$code_partie}}";
        </script>
    </body>

</html>
