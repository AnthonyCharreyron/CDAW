jQuery(function($){
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    let gestionUser = $('#gestionUser').DataTable({
        ajax:{ 
            url: 'monitoring/users',
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
                }
            },
            {
                targets: -1,
                
            }
        ],
        columns: [
            { data: 'id', name:'Identifiant' },
            { data: 'pseudo', name:'Pseudo' },
            { data: 'est_bloque', name:'Bloqué' },
            { data: 'est_administrateur', name:'Administrateur' },
            { data: 'commentaires', name:'Commentaires' },
            { data: null, orderable: false,
                render: function(data, type, row) {
                    return `<button class="btn btn-success btn-action" data-action="admin" data-id="${row.id}">Ajouter en admin</button>
                            <button class="btn btn-danger btn-action" data-action="block" data-id="${row.id}">Bloquer</button>
                            <button type="button" class="btn btn-primary" data-id="${row.id} onclick="commentUser(this)">Ajouter un commentaire</button>
                            `;
                }
            } 
        ],
        lengthChange: false,
        info: false
    });

    $('#gestionUser').on('click', '.btn-action', function() {
        let action = $(this).data('action');
        let userId = $(this).data('id');
        let formData = new FormData();
        formData.append("id_user", userId);
        
        // Exécuter les actions appropriées
        switch(action) {
            case 'admin':
                $.ajax({
                    url: 'monitoring/admin',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'post',
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    success: function(data){
                        console.log(data);
                        alert("L'utilisateur est devenu admin.");
                        window.location.reload();
                    },
                    error: function(err) {
                        console.log("Erreur");
                        console.log(err);
                    }
                });
                break;
            case 'block':
                $.ajax({
                    url: 'monitoring/block',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'post',
                    headers: {'X-CSRF-TOKEN': csrfToken},
                    success: function(data){
                        console.log(data);
                        alert("L'utilisateur est maintenant bloqué.");
                        window.location.reload();
                    },
                    error: function(err) {
                        console.log("Erreur");
                        console.log(err);
                    }
                });
                break;
            default:
                console.log('Action inconnue');
        }
    });
    
    window.commentUser = function(button){
        let commentUser = $(button).closest(".btn");
        let userId = $(this).data('id');
        let commentaryContainer = document.getElementById(userId);
        let inputCommentary = document.createElement('input');
        
        inputCommentary.setAttribute('type', 'text');
        inputCommentary.setAttribute('value', commentaryContainer.textContent);
        commentaryContainer.parentNode.replaceChild(inputCommentary, commentaryContainer);

        commentUser.find("button:contains('commentaire')").replaceWith(`<button type="button" class="btn btn-success" data-id="${row.id} onclick="saveComment(this)">Enregistrer</button>`);
    }
});