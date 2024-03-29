jQuery(function($){
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        window.lancerPartie = function(){
            $.ajax({
                type: "POST",
                url: "lancer",
                async: false,
                data: {code: codePartie},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    console.log(response);
                    sendLancerPartie(response.piocheVisibleGlobale, response.cartesDestinations);
                    reloadPageForAllClients();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

    window.piocherVers = function(){
        console.log('test');
        //document.getElementById('overlay').style.display = 'block';


    }
 

});