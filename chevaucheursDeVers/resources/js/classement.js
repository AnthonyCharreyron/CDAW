jQuery(function($) {

    let meilleur_score = $('#meilleurScore').DataTable({
        lengthMenu: [[10]],
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false,
        ajax:{ 
            url: 'historique/1',
            type: 'GET',
            error: function(xhr, error, thrown) {
                console.log('Erreur:', error);
            }
        },
        columnDefs: [
            {
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                },
                className: 'dt-center'
            },
            {
                targets: '_all',
                render: function(data) {
                    return data ? data : 0;
                },
                className: 'dt-center'
            }
        ],
        columns: [
            { data: null, name: 'Rang' }, 
            { data: 'pseudo', name: 'Pseudo' },
            { data: 'meilleur_score', name: 'Meilleur score' }
        ],
        order: {
            name: 'Meilleur score',
            dir: 'desc'
        }
    });
    

    let nbPartie = $('#nbParties').DataTable({
        lengthMenu: [[10]],
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false,
        ajax:{ 
            url: 'historique/2',
            type: 'GET',
            error: function(xhr, error, thrown) {
                console.log('Erreur:', error);
            }
        },
        columnDefs: [
            {
                targets: 0,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                },
                className: 'dt-center'
            },
            {
                targets: '_all',
                className: 'dt-center'
            }
          ],
        columns: [
            { data: null, name: 'Rang' }, 
            { data: 'pseudo', name:'Pseudo' },
            { data: 'nombre_parties_gagnees', name:'Nombre de parties gagnées' }
        ],
        order: {
            name: 'Nombre de parties gagnées',
            dir: 'desc'
        }
    });

});
