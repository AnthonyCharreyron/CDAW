
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

        // let liste_amis = $('#liste-amis').DataTable({
        //     "info": false,
        //     "searching": false,
        //     ajax:{ 
        //         url: '/listeAmi',
        //         type: 'GET',
        //         error: function(xhr, error, thrown) {
        //             console.log('Erreur:', error);
        //         }
        //     },
        //     columnDefs: [
        //         {
        //             targets: '_all',
        //             render: function(data) {
        //                 return data ? data : 0;
        //             },
        //             className: 'dt-center'
        //         }
        //     ],
        //     columns: [
        //         { 
        //             data: null, 
        //             name: 'Profil',
        //             render: function(data) {
        //                 return data == 1 ? 'Accepté' : 'Demande en attente';
        //             }
        //         }, 
        //         { data: 'pseudo', name: 'Pseudo' },
        //         { 
        //             data: 'est_accepte',
        //             name: 'Statut de la demande',
        //             render: function(data) {
        //                 return data == 1 ? 'Accepté' : 'Demande en attente';
        //             }
        //         }
        //     ]
        // });

        // Gestion de l'ouverture du modal au survol du bouton
        $('.img-voir-profil').hover(function() {
            var idAmi = $(this).data('id-ami');
            loadAmiInfo(idAmi); 
            //$('.btn-voir-profil').click(); 
            $('#modalProfilAmi').modal('show'); // Ouvrir le modal
        });

        // Fermeture du modal lorsque vous cliquez en dehors de celui-ci ou sortez la souris du modal
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.modal-content').length && !$(event.target).closest('.btn-voir-profil').length) {
                $('#modalProfilAmi').removeClass('show'); // Supprimer la classe 'show' pour fermer le modal
            }
        });

        // Détection de l'ouverture du modal
        $('#modalProfilAmi').on('show.bs.modal', function (event) {
            // Extraction des informations de l'ami depuis les attributs data de l'élément déclencheur
            var button = $(event.relatedTarget);
            var pseudo = button.data('pseudo');
            var photoProfil = button.data('photo-profil');
            var partiesJouees = button.data('parties-jouees');
            var partiesGagnees = button.data('parties-gagnees');
            var meilleurScore = button.data('meilleur-score');

            // Mise à jour des éléments du modal avec les informations de l'ami
            var modal = $(this);
            modal.find('#amiPseudo').text(pseudo);
            modal.find('#amiPseudoModal').text(pseudo);
            modal.find('#amiPhotoProfil').attr('src', photoProfil);
            modal.find('#amiPartiesJouees').text(partiesJouees);
            modal.find('#amiPartiesGagnees').text(partiesGagnees);
            modal.find('#amiMeilleurScore').text(meilleurScore);
        });

    });

    function loadAmiInfo(idAmi) {
        // Appel AJAX pour charger les informations de l'ami et les afficher dans le modal
        // Vous devrez implémenter cette fonction pour charger les informations de l'ami à partir de son ID
    }
    
})