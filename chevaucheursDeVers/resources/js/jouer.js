$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');


    $('.create').on('click', function() {
        $('.create-form').toggle();
        $('.join-more').hide();
    });

    $('.create-submit').on('click', function() {
        $('.launch-form').toggle();
        $('.create-form').hide();
        $('.join-more').hide();
    });

    $('.join').on('click', function() {
        $('.join-more').toggle();
        $('.create-form').hide();
        $('.launch-form').hide();
    });

    $('.join-submit').on('click', function() {
        $('.join-more').hide();

        let codePartie = $('#code-partie').val();
        let formData = new FormData();
        formData.append("partie_code", estPrivee);

        $.ajax({
            url: 'jouer/rejoindre',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'post',
            headers: {'X-CSRF-TOKEN': csrfToken},
            success: function(data){
                console.log(data);
                alert("Vous avez rejoint une partie. En attente de l'hôte pour lancer");
            },
            error: function(err) {
                console.log("Erreur");
                console.log(err);
                alert("Problème pour rejoindre la partie");
            }
        });

    });

    $('.create-submit').on('click', function() {
        
        let estPrivee = $('#partie-privee').is(':checked') ? 1 : 0;
        let tempsParCoup = $('#partie-temps').val();
        let nbJoueurs = $('#partie-nb-joueurs').val();


        let formData = new FormData();
        formData.append("partie_privee", estPrivee);
        formData.append("partie_tpsParCoup", tempsParCoup);
        formData.append("partie_nbJoueurs", nbJoueurs);


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
            },
            error: function(err) {
                console.log("Erreur");
                console.log(err);

            }
        });
    });
});