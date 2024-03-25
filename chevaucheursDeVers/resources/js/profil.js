
jQuery(function($) {
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        window.modifyUserAccount = function(button) {
            // Sélectionne la zone d'affichage des données de connexion
            let userAccountInfo = $(button).closest(".col-5");
        
            // Sélectionner les éléments par leur ID
            let pseudoContainer = document.getElementById('pseudoContainer');
            let mdpContainer = document.getElementById('mdpContainer');

            // Créer des champs input pour chaque élément et les remplacer dans le DOM
            let inputPseudo = document.createElement('input');
            inputPseudo.setAttribute('type', 'text');
            inputPseudo.setAttribute('value', pseudoContainer.textContent);
            inputPseudo.setAttribute('name', 'inputPseudo');
            inputPseudo.setAttribute('class', 'col');
            pseudoContainer.parentNode.replaceChild(inputPseudo, pseudoContainer);

            let inputMdp = document.createElement('input');
            inputMdp.setAttribute('type', 'password');
            inputMdp.setAttribute('name', 'inputPassword');
            inputMdp.setAttribute('class', 'col');
            mdpContainer.parentNode.replaceChild(inputMdp, mdpContainer);

            // Remplace le bouton "Modifier" par un bouton "Enregistrer"
            userAccountInfo.find("button:contains('Modifier')").replaceWith(`<button type="button" class="btn btn-success ml-auto" onclick="saveUserAccount(this)">Enregistrer</button>`); // Remplace le bouton "Modifier" par un bouton "Enregistrer" en utilisant la fonction replaceWith
        }

        window.saveUserAccount = function(button) {
            // Sélectionne la zone d'affichage des données de connexion
            let userAccountInfo = $(button).closest(".col-5");

            // Récupère les nouvelles valeurs des champs
            let nouveauPseudo = document.getElementsByName('inputPseudo')[0];
            let nouveauPassword = document.getElementsByName('inputPassword')[0];
            let email = document.getElementById('emailContainer').innerText;

            // Remplace les champs de saisie par les nouvelles valeurs
            let inputPseudo = document.createElement('p');
            inputPseudo.setAttribute('id', 'pseudoContainer');
            inputPseudo.setAttribute('class', 'col');
            inputPseudo.textContent = nouveauPseudo.value;
            nouveauPseudo.replaceWith(inputPseudo);

            let inputMdp = document.createElement('p');
            inputMdp.setAttribute('id', 'mdpContainer');
            inputMdp.setAttribute('class', 'col');
            inputMdp.textContent = '****'; // Remplacer par la nouvelle valeur du mot de passe si nécessaire
            nouveauPassword.replaceWith(inputMdp);

        
            // Remplace le bouton "Enregistrer" par un bouton "Modifier"
            userAccountInfo.find("button:contains('Enregistrer')").replaceWith(`<button type="button" class="btn btn-primary ml-auto" onclick="modifyUserAccount(this)">Modifier</button>`);
            
            $.ajax({
                type: "POST",
                url: "monProfil/modifierProfil",
                data: { pseudo: nouveauPseudo.value, password: nouveauPassword.value, email: email },
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    console.log(response);
                    
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    });
    
})