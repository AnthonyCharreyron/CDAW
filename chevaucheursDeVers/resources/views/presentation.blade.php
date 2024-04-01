@extends('template')

@section('content')
    <div class="row">
        <div class="col-3 text-center d-flex justify-content-center mt-2 border border-secondary rounded mx-auto">
            <h4 class="mt-3">Bonjour {{$user==null ? 'Anonymous' : $user->pseudo}} !</h4>
        </div>
    </div>
    <div class="containerPresentation">
        <div class="row">
            <h2>Chevaucheurs des vers</h2>
            <h3>Un voyage sur la planète Arrakis</h3>
            <p>Dans les arènes impitoyables de la planète désertique d'Arrakis, cinq compagnons de longue date se rassemblent dans l'ombre des dunes éternelles. 
                Alors que les vents soufflent des récits de gloire et de trahison, leur réunion, marque le début d'une nouvelle quête. 
                Il y a vingt ans jour pour jour, le jeune Paul Atreides, héritier des nobles Atreides, débarquait sur Arrakis pour prendre le contrôle du précieux épice.</p>
            <p>Inspirés par l'audace de Paul et son ascension fulgurante, les cinq amis ont forgé leur propre destin. 
                Ils ont lancé un défi intrépide : traverser le désert d'Arrakis en un temps record, reliant les différents sietches et cités disséminés dans les sables mouvants. 
                La récompense ? La promesse de richesses incommensurables, d'honneur et de renommée.</p>
            <p>Dans Les Chevaucheurs de Vers, les joueurs se disputent le contrôle des vers et des villes d'Arrakis, luttant pour la suprématie dans le désert. 
                Que la bataille commence, que le sable soit leur témoin, et que les échos des exploits de Paul résonnent à travers les âges !</p>
        </div>
    </div>
 
    <div class="row mt-2">
        <img src="{{ asset('images/Colline_presentation.jpg') }}" alt="Image de présentation">
    </div>

    <div class="containerJeu">
        <div class="row">
            <div class="col">
                <h3>But du jeu</h3>
                <p>
                    Le but du jeu est d’obtenir le plus de points avant la fin de la partie. Les points sont gagnés des manières suivantes :
                </p>
                <ol>
                    <li>En capturant un ver entre deux villes.</li>
                    <li>En reliant par un ver, en continu, les deux villes d’une Destination.</li>
                    <li>En réalisant le chemin le plus long.</li>
                </ol>
                <p>
                    La partie se termine un tour après qu'un joueur possède 2 vers ou moins à placer pour relier des villes.
                </p>
            </div>

            <div class="col">
                <h3>Tour de jeu</h3>
                <p>
                    Les Chevaucheurs de vers est un jeu joué tour par tour. À son tour, le joueur doit effectuer une et une seule des trois actions suivantes :
                </p>
                <ol>
                    <li>Prendre des cartes Vers : le joueur peut prendre 2 cartes Ver parmi les 5 visibles ou dans la pioche.</li>
                    <li>Prendre possession d’un chemin : le joueur peut s’emparer d’un chemin sur le plateau en se défaussant des cartes Vers requises. Il pose ainsi un ver sur le chemin.</li>
                    <li>Prendre des cartes Destination supplémentaires : le joueur choisit parmi 3 cartes Destination celles qu'il souhaite conserver, en gardant au moins une.</li>
                </ol>
            </div>

        </div>
        <div class="row">
            <h3>Carte de jeu</h3>
            @php
                $images = ["bleu", "jaune", "rose", "multicolore", "rouge", "vert"];
            @endphp
                @for($i = 0; $i <= 5; $i++)
                    <div class="col-md-2">
                        <img src="{{ asset('images/Carte ver '.$images[$i].'.png') }}" alt="Photo {{ $i }}" style="width: 60px; height: auto;">
                    </div>
                @endfor
            </div>
        </div>
    </div>
 
@endsection



