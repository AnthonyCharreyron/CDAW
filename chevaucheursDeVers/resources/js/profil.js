
jQuery(function($) {
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        window.modifyUserAccount = function(button) {
            // Sélectionne la zone d'affichage des données de connexion
            let userAccountInfo = $(button).closest(".col-5");
        
            // Sélectionner les éléments par leur ID
            let pseudoContainer = document.getElementById('pseudoContainer');
            let mdpContainer = document.getElementById('mdpContainer');
            let photoContainer = document.getElementById('photoContainer');

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

            let selectElement = document.createElement('select');
            selectElement.id = 'photoSelect';

            // Ajouter des options avec des images
            let optionsHTML = `
                <option value="0">Image 1</option>
                <option value="1">Image 2</option>
                <option value="2">Image 3</option>
                <option value="3">Image 4</option>
            `;

            // Injecter les options dans le select
            selectElement.innerHTML = optionsHTML;

            // Remplacer le contenu de photoContainer par le select
            replaceElementWithNewOne(photoContainer, selectElement);

            $('#images').show();

            // Remplace le bouton "Modifier" par un bouton "Enregistrer"
            userAccountInfo.find("button:contains('Modifier')").replaceWith(`<button type="button" class="btn btn-success ml-auto" onclick="saveUserAccount(this)">Enregistrer</button>`); // Remplace le bouton "Modifier" par un bouton "Enregistrer" en utilisant la fonction replaceWith
        }

        function replaceElementWithNewOne(oldElement, newElement) {
            oldElement.parentNode.replaceChild(newElement, oldElement);
        }

        window.saveUserAccount = function(button) {

            // Récupère les nouvelles valeurs des champs
            let nouveauPseudo = document.getElementsByName('inputPseudo')[0];
            let nouveauPassword = document.getElementsByName('inputPassword')[0];
            let email = document.getElementById('emailContainer').innerText;
            let image = document.getElementById('photoSelect').value;
         
            $.ajax({
                type: "POST",
                url: "monProfil/modifierProfil",
                data: { pseudo: nouveauPseudo.value, password: nouveauPassword.value, email: email, photo_profil: image },
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

    });
    
})