jQuery(function($) {
    console.log("Loading datatable ...");

    let table1 = $('#meilleurScore').DataTable({
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
                    return data ? data : '<span style="color: #f7b500;">Non défini</span>';
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

    let table2 = $('#nbParties').DataTable({
        ajax:{ 
            url: 'historique/2',
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
            { data: 'pseudo', name:'Pseudo' },
            { data: 'nb_parties', name:'Nombre de parties gagnées' }
        ],
        order: {
            name: 'Nombre de parties gagnées',
            dir: 'desc'
        }
    });

});
