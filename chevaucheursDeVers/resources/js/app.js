import './bootstrap';

import './carte';
import './classement';
import './jouer';
import './socket';
import './profil';
import './lobby';
import './gestionUser';
import './partie';
import './resultats';


jQuery(function($){
    $(document).ready(function() {
        $('#btn-regles-jeu').on('click', function() {
            $('#regles-jeu').toggle();
        });
    });
})




