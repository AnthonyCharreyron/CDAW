jQuery(function($) {
    console.log("Loading datatable ...");

    $('#classement').DataTable({
        ajax: 'historique/1',
        columnDefs: [
            {
                targets: '_all',
                render: function(data) {
                    return data ? data : '<span style="color: #f7b500;">Non défini</span>';
                }
            }
        ],
        columns: [
            { data: 'pseudo' },
            { data: 'score' },
            { data: 'gagnant' }
        ]
    });
});
