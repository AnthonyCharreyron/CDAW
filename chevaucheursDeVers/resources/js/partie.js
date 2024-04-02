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
                    sendLancerPartie(response.piocheVisibleGlobale, response.cartesDestinations);
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
            if(destinationId!=null){
                $.ajax({
                    type: "POST",
                    url: "/supprimerCarteDestination",
                    async: false,
                    data: {userId: userId, destinationId: destinationId},
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    success: function(response) {
                        let destinationToRemove = document.getElementById(destinationId);
                        destinationToRemove.remove();
                        window.location.reload();

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                window.location.reload();
            }
        }

        window.finDeTour=function(listePseudo, userPseudo){
            sendFinDeTour(listePseudo, userPseudo);
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

    });

    window.piocherVers = function(){
        console.log('test');
        //document.getElementById('overlay').style.display = 'block';


    }
 

});