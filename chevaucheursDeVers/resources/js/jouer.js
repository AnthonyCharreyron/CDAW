jQuery(function($){
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
    
    
        $('.create-btn').on('click', function() {
            $('.create-form').show();
            $('.create-btn').hide();
            $('.join-all').hide();
        });
    
        $('.join-btn').on('click', function() {
            $('.join-more').show();
            $('.join-btn').hide();
            $('.create-all').hide();
        });
    
        let table1 = $('#partiePublique').DataTable({
            ajax:{ 
                url: 'jouer/partie',
                type: 'GET',
                error: function(xhr, error, thrown) {
                    console.log('Erreur:', error);
                }
            },
            columnDefs: [
                {
                    targets: '_all',
                    render: function(data) {
                        return data ? data : '<span style="color: #f7b500;">Non défini</span>';
                    }
                }
            ],
            columns: [
                { data: 'id_partie', name:'Numéro de partie' },
                { data: 'nombre_joueurs', name:'Nombre de joueurs' },
                { data: 'temps_par_coup', name:'Temps par coup' },
                { data: null, orderable: false, name:'Rejoindre',
                    render: function ( data, type, row ) {
                        return '<button class="join-submit" data-code-partie="' + data.code + '">Rejoindre</button>';
                    }
                }
    
            ],
            searching: false, 
            lengthChange: false,
            info: false
        });
    
        $('body').on('click', '.join-submit', function() {
            let codePartie = $(this).data('code-partie');
            if(codePartie === undefined){
                codePartie = $('#code-partie').val();
            }
            console.log(codePartie)
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
                    if (data.success) {
                        window.location.href = data.redirect_url;
                    } else {
                        alert("Le code fourni ne correspond pas.");
                    }
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
                    if (data.success) {
                        window.location.href = data.redirect_url;
                    } else {
                        alert("Problème lors de la création.");
                    }
                },
                error: function(err) {
                    console.log("Erreur");
                    console.log(err);
    
                }
            });
        });
    });
});
