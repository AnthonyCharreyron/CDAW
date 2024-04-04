jQuery(function($) {

    let meilleur_score = $('#resultatPartie').DataTable({
        "paging":   false,
        "ordering": false,
        "info":     false,
        "searching": false,
        ajax:{ 
            url: '/jouer/resultat/'+codePartie,
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
            { data: 'score', name: 'Score' }
        ],
        order: {
            name: 'Score',
            dir: 'desc'
        }
    });
});