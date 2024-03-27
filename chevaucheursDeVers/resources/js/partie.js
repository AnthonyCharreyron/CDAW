jQuery(function($){
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        console.log('test0');
        window.lancerPartie = function(){
            $.ajax({
                type: "POST",
                url: "lancer",
                async: false,
                data: {code: codePartie},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    console.log(response);
                    sendPiocheVisible(response.piocheVisibleGlobale);
                    reloadPageForAllClients();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });

 

});