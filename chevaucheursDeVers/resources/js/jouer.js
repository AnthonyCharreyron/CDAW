jQuery(function($){
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
    
        $('#create-btn').on('click', function() {
            $('.create-form').show();
            $('#create-btn').hide();
            $('.join-all').hide();
        });
    
        $('#join-btn').on('click', function() {
            $('.join-more').show();
            $('.join-btn').hide();
            $('.create-all').hide();
        });
    
        let table1 = $('#partiePublique').DataTable({
            ajax:{ 
                url: '/jouer/parties',
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
                { data: 'code', name:'Code de la partie' },
                { data: 'nombre_joueurs', name:'Nombre de joueurs' },
                { data: 'temps_par_coup', name:'Temps par coup' },
                { data: null, orderable: false, name:'Rejoindre',
                    render: function ( data, type, row ) {
                        return '<button class="join-submit btn btn-primary" data-code-partie="' + data.code + '">Rejoindre</button>';
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
            let formData = new FormData();
            formData.append("partie_code", codePartie);
    
            $.ajax({
                url: '/jouer/rejoindre',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                asynch: false,
                method: 'post',
                headers: {'X-CSRF-TOKEN': csrfToken},
                success: function(data){
                    console.log(data);
                    if (data.success) {
                        window.location.href = data.redirect_url;
                        sendUserJoinPartie(data.codePartie, data.pseudo, data.nb_joueurs);
                    } else {
                        alert("Problème pour rejoindre la partie.");
                    }
                },
                error: function(err) {
                    console.log("Erreur");
                    console.log(err);
                    alert("Problème pour rejoindre la partie");
                }
            });
        });
    });
});
