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
                            <button class='btn btn-outline-secondary' onclick='piocherVers()'>Piocher des vers</button>
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
                            @forelse(session()->get('piocheVisibleGlobale', []) as $carte)
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
                
                @php
                    $couleursVers=['bleu', 'jaune', 'rouge', 'violet', 'vert']; 
                @endphp
                @foreach($participants as $index => $user)
                    <div class="row {{couleursVers[$index]}}">
                        <b>{{$user->pseudo}}</b>
                        @if($partie_commencee)
                            <p>&nbsp; cartes ver en mains</p>
                            <p>&nbsp; wagons restants</p>
                            <p>&nbsp; points</p>
                        @endif
                    </div>
                @endforeach
                
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
