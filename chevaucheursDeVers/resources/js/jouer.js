$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');


    $('.create').on('click', function() {
        $('.create-form').show();
        $('.join-table').hide();
    });

    // Gérer le clic sur le bouton "Rejoindre une partie"
    $('.join').on('click', function() {
        $('.join-table').show();
        $('.create-form').hide();
    });

    $('.create-submit').on('click', function() {
        
        let nomPartie = $('#partie-nom').val();
        let estPrivee = $('#partie-privee').is(':checked') ? 1 : 0;

        let formData = new FormData();
        formData.append("partie_privee", estPrivee);

        $.ajax({
            url: 'jouer/creer',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'post',
            headers: {'X-CSRF-TOKEN': csrfToken},
            success: function(data){
                console.log(data);
                const json = data;
                if(json.success){
                    window.location.href = 'jouer/' + nomPartie;
                }
            },
            error: function(err) {
                console.log("Erreur");
                console.log(err);

            }
        });
    });
});