jQuery(function($) {

    let meilleur_score = $('#meilleurScore').DataTable({
        ajax:{ 
            url: 'historique/1',
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
            }
        ],
        columns: [
            { data: 'pseudo', name:'Pseudo' },
            { data: 'meilleur_score', name:'Meilleur score' }
        ],
        order: {
            name: 'Meilleur score',
            dir: 'desc'
        }
    });

    let nbPartie = $('#nbParties').DataTable({
        ajax:{ 
            url: 'historique/2',
            type: 'GET',
            error: function(xhr, error, thrown) {
                console.log('Erreur:', error);
            }
        },
        columns: [
            { data: 'pseudo', name:'Pseudo' },
            { data: 'nombre_parties_gagnees', name:'Nombre de parties gagnées' }
        ],
        order: {
            name: 'Nombre de parties gagnées',
            dir: 'desc'
        }
    });

});
