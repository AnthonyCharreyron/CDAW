jQuery(function($){
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        console.log('test0');
        window.lancerPartie = function(){
            $.ajax({
                type: "POST",
                url: "lancer",
                data: {code: codePartie},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    console.log(response);
                    console.log('test2');
                    //reloadPageForAllClients();
                    console.log('test3');
                    sendPiocheVisible(response.piocheVisibleGlobale, csrfToken);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    });

    
    

});