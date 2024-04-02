import './bootstrap';

import './classement';
import './jouer';
import './socket';
import './profil';
import './lobby';
import './gestionUser';
import './partie';

jQuery(function($){
    $(document).ready(function() {
        $('#btn-regles-jeu').on('click', function() {
            $('#regles-jeu').toggle();
        });
    });
})




