
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
            userAccountInfo.find("button:contains('Modifier')").replaceWith(`<button type="button" class="btn btn-success ml-auto" onclick="saveUserAccount(this)">Enregistrer</button>`);
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

        let liste_amis = $('#liste-amis').DataTable({
            "info": false,
            "searching": false,
            ajax:{ 
                url: '/listeAmi',
                type: 'GET',
                error: function(xhr, error, thrown) {
                    console.log('Erreur:', error);
                }
            },
            columnDefs: [
                {
                    targets: '_all',
                    render: function(data) {
                        return data ? data : 0;
                    },
                    className: 'dt-center'
                }
            ],
            columns: [
                {
                    data: null, 
                    name: 'Profil',
                    render: function(row) {
                        return `<img src="images/`+ row.photo_profil +`.png" style="height: 5vh;"  alt="Voir le profil" class="img-voir-profil" data-id-ami="`+ row.ami_id +`">`;
                    }
                }, 
                { data: 'pseudo', name: 'Pseudo' },
                {
                    data: null, 
                    name: 'Supprimer',
                    render: function(row) {
                        return `<button class='btn btn-danger btn-supprimer-ami' data-id-ami='`+ row.ami_id +`')>Supprimer</button>`;
                    }
                }
            ]
        });

        let demande_pour_moi = $('#demande-pour-moi').DataTable({
            "info": false,
            "searching": false,
            "paging": false,
            "ordering": false,
            ajax:{ 
                url: '/demandePourMoi',
                type: 'GET',
                error: function(xhr, error, thrown) {
                    console.log('Erreur:', error);
                }
            },
            columnDefs: [
                {
                    targets: '_all',
                    render: function(data) {
                        return data ? data : 0;
                    },
                    className: 'dt-center'
                }
            ],
            columns: [
                {
                    data: null, 
                    name: 'Profil',
                    render: function(row) {
                        return `<img src="images/`+ row.photo_profil +`.png" style="height: 5vh;"  alt="Voir le profil" class="img-voir-profil" data-id-ami="`+ row.id +`">`;
                    }
                }, 
                { data: 'pseudo', name: 'Pseudo' },
                { 
                    data: null, 
                    orderable: false,
                    render: function(data, type, row) {
                        return `<button class="btn btn-success btn-action" data-id="${row.id}">Accepter</button>
                        <button class="btn btn-danger btn-action" data-id="${row.id}">Refuser</button>`;
                    }
                }
            ]
        });

        $('#demande-pour-moi').on('click', '.btn-action', function() {
            let userId = $(this).data('id');
            let formData = new FormData();
            formData.append("id_user_friend", userId);
            let friendAction = $(this).text() == `Accepter` ? 'accepte' : 'refuse';
            console.log(friendAction);
            formData.append("demande_action", friendAction);
            $.ajax({
                url: '/gestionDemandeAmi',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(data){
                    console.log(data);
                    alert("Demande traitée");
                },
                error: function(err) {
                    console.log("Erreur");
                    console.log(err);
                }
            });
        });

        // Gestion de l'ouverture du modal au survol du bouton
        $('body').on('mouseenter', '.img-voir-profil', function() {
            var idAmi = $(this).data('id-ami');
            console.log(idAmi);
            $.ajax({
                type: "GET",
                url: "/infosAmi/"+idAmi,
                data: {id_user: idAmi},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(response) {
                    // Mise à jour des éléments du modal avec les informations de l'ami
                    $('#amiPseudo').text(response.pseudo);
                    $('#amiPseudoModal').text(response.pseudo);
                    $('#amiPhotoProfil').attr('src', response.photoProfil);
                    $('#amiPartiesJouees').text(response.partiesJouees);
                    $('#amiPartiesGagnees').text(response.partiesGagnees);
                    $('#amiMeilleurScore').text(response.meilleurScore);        
                    $('#modalProfilAmi').modal('show'); // Ouvrir le modal
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
           
        });
        

        // Fermeture du modal lorsque vous cliquez en dehors de celui-ci ou sortez la souris du modal
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.modal-content').length && !$(event.target).closest('.btn-voir-profil').length) {
                $('#modalProfilAmi').removeClass('show'); 
            }
        });

        $('#btn-voir-demande-amis').on('click', function() {
            $('#demande-pour-moi').toggle();
        });

        $('#btn-rechercher-amis').on('click', function() {
            $('#container-recherche-amis').toggle();
        });
        

        let demander_nouveaux_amis = $('#demander-nouveaux-amis').DataTable({
            lengthMenu: [[5, 10, 20], [5, 10, 20] ],
            ajax:{ 
                url: '/demandeNouveauxAmis',
                type: 'GET',
                error: function(xhr, error, thrown) {
                    console.log('Erreur:', error);
                }
            },
            columnDefs: [
                {
                    targets: '_all',
                    render: function(data) {
                        return data ? data : 0;
                    },
                    className: 'dt-center'
                }
            ],
            columns: [
                {
                    data: null, 
                    name: 'Profil',
                    render: function(row) {
                        return `<img src="images/`+ row.photo_profil +`.png" style="height: 5vh;"  alt="Voir le profil" class="img-voir-profil" data-id-ami="`+ row.id +`">`;
                    }
                }, 
                { data: 'pseudo', name: 'Pseudo' },
                { 
                    data: null, 
                    orderable: false,
                    render: function(data, type, row) {
                        return `<button class="btn btn-success btn-action" data-id="${row.id}">Demander</button>`;
                    }
                }
            ]
        });

        $(document).on('click', '.btn-supprimer-ami', function() {
            let button = $(this);
            var id_ami = button.data('id-ami');
            console.log(id_ami);

            $.ajax({
                type: "POST",
                url: "/supprimerAmi",
                data: {id_user_ami: id_ami},
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function() {
                    console.log("Ami supprimé");
                    button.closest('tr').remove();

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        })



    });
    
})