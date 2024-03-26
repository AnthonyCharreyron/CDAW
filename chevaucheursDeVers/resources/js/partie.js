jQuery(function($){
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        window.lancerPartie = function(){
            $.ajax({
                type: "POST",
                url: "lancer",
                data: {code: codePartie},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    console.log(response);
                    reloadPageForAllClients();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    });

    
    

});