jQuery(function($){
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        window.lancerPartie = function(){
            $.ajax({
                type: "POST",
                url: "/jouer/partie/lancer",
                async: false,
                data: {code: codePartie},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    console.log(response);
                    sendLancerPartie(response.piocheVisibleGlobale, response.cartesDestinations, response.cartesDestinationsRestantes, response.piocheDestinations);
                    reloadPageForAllClients();
                    deleteCookie('partieDebutee');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        window.supprimerDestination=function(userId, destinationId){
            setCookie("partieDebutee", "true", 30);
            $.ajax({
                type: "POST",
                url: "/supprimerCarteDestination",
                async: false,
                data: {userId: userId, destinationId: destinationId},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    if(destinationId!=null){
                        let destinationToRemove = document.getElementById(destinationId);
                        destinationToRemove.remove();
                        sendCartesDestinationsRestantes(response.cartesDestinationsRestantes);
                    }
                    finDeTour(response.listePseudosParticipants, response.userPseudo);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
   
        }

        function finDeTour(listePseudo, userPseudo){
            let pseudoJoueurSuivant = joueursSuivants(listePseudo, userPseudo);
            sendFinDeTour(listePseudo, userPseudo);
            $.ajax({
                type: "POST",
                url: "/prochainJoueur",
                data: {prochainJoueur: pseudoJoueurSuivant},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function joueursSuivants(listePseudo, pseudoActuel) {
            var index = listePseudo.indexOf(pseudoActuel);
            if (index === -1) {
                return null;
            }
            var indexSuivant = (index + 1) % listePseudo.length;
            console.log(listePseudo[indexSuivant]);
            return listePseudo[indexSuivant];
        }

        // Fonction pour définir un cookie
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }

        function deleteCookie(cookieName) {
            document.cookie = cookieName + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }

        window.piocherVers = function(numTourPioche){
            var indexSelectedCarte = document.querySelector('input[name="carte_selectionnee"]:checked');
            if(indexSelectedCarte){
                var indexCarte = indexSelectedCarte.value;
    
                $.ajax({
                    type: "POST",
                    url: "/piocherVer",
                    async: false,
                    data: {carteVer: indexCarte},
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    success: function(response) {
                        if(numTourPioche==1){
                            if(indexCarte!='pioche'){
                                var nouvelleCarte = response.nouvelleCarte;
                                var img = document.getElementById('carte_' + indexCarte);

                                img.setAttribute('src', response.baseURLimg + '/' + nouvelleCarte + '.png');
                                img.setAttribute('alt', nouvelleCarte);
                            }
                            $('#message-deuxieme-pioche').toggle();
                            var btn = document.getElementById('btn-pioche-ver');
                            btn.setAttribute('data-bs-dismiss', 'modal');
                            btn.setAttribute('onclick', 'piocherVers(2)');
                        } else {
                            sendPiocherVers(response.piocheVisible);
                            finDeTour(response.listePseudosParticipants, response.userPseudo);
                        }
                        
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        }

        window.piocherDestinations=function(){

            var checkboxes = document.getElementsByName('destinations');
            var isChecked = false;
            var destinationsAGarder = [];

            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    isChecked = true;
                    var valeur = checkboxes[i].value;
                    var elements = valeur.split('_');
                    var destination = elements[0];
                    var score = elements[1];

                    destinationsAGarder[destination]=score;
                }
            }
            console.log(JSON.stringify(destinationsAGarder));

            if (!isChecked) {
                $('#piocher_destination_alert').toggle();
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: "/piocherDestinations",
                    async: false,
                    data: {cartesDestinations: destinationsAGarder},
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    success: function(response) {
                        sendPiocherDestinations(response.piocheDestinations, response.cartesDestinationsRestantes);
                        finDeTour(response.listePseudosParticipants, response.userPseudo);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            }

        }

    });
 

});