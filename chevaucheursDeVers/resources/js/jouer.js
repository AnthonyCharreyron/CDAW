$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');


    $('.create').on('click', function() {
        $('.create-form').toggle();
        $('.join-more').hide();
    });

    $('.create-submit').on('click', function() {
        $('.launch-form').toggle();
        $('.create').hide();
        $('.create-form').hide();
        $('.join-all').hide();
    });

    $('.join').on('click', function() {
        $('.join-more').toggle();
        $('.create-form').hide();
    });

    $('.join-submit').on('click', function() {
        $('.create-all').hide();

        let codePartie = $('#code-partie').val();
        let formData = new FormData();
        formData.append("partie_code", codePartie);

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
        let tempsParCoup = $('#temps-coup').val();
        let nbJoueurs = $('#nombre-joueurs').val();
        console.log(nbJoueurs);
        console.log(tempsParCoup);

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