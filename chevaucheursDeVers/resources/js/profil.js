
jQuery(function($) {
    $(document).ready(function() {
        window.modifyUserAccount = function(button) {
            // Sélectionne la zone d'affichage des données de connexion
            let userAccountInfo = $(button).closest(".col-5");
        
            // Récupère les éléments de données de connexion
            let pseudo = userAccountInfo.find("#pseudoContainer").text();
        
            // Remplace les éléments de données par des champs de saisie pré-remplis
            userAccountInfo.find("p:contains('Photo de profil')").next("div").html('<input type="text">');
            userAccountInfo.find("p:contains('Pseudo')").next("div").html('<input type="text" value="' + pseudo + '">');
            userAccountInfo.find("p:contains('Mot de passe')").next("div").html('<input type="password">');
        
            // Désactive le champ d'e-mail
            userAccountInfo.find("input[type='email']").prop('disabled', true);
        
            // Remplace le bouton "Modifier" par un bouton "Enregistrer"
            userAccountInfo.find("button:contains('Modifier')").replaceWith(`<button type="button" class="btn btn-success ml-auto" onclick="saveUserAccount(this)">Enregistrer</button>`); // Remplace le bouton "Modifier" par un bouton "Enregistrer" en utilisant la fonction replaceWith
        }
        
    });
})