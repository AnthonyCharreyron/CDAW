jQuery(function($){
    $(document).ready(function() {
        $('.launch-submit').on('click', function() {
            //TO DO : si on est pas le max, envoyer dans le back le nombre de joueurs
            //TO DO : afficher le bon bouton quand on est au max
            window.location.href='/jouer/partie/' + codePartie;
        });
    });
});
