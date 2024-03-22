jQuery(function(){
    console.log("Loading datatable ...");

    var table = $('#liste-classement').DataTable({
        order: [[1, 'asc']],
        language: { url: baseUrl + '/assets/locales/datatables_FR.json' },
        ajax: 'historique/1',
        columnDefs: [
            {
                targets: '_all',
                render: function (data, type, row, meta) {
                    return data ? data : '<span style="color: #f7b500;">Non défini</span>';
                }
                //defaultContent: 'Non défini'
            }
        ],
        columns: [
            {
                className: 'dt-control',
                orderable: false,
                data: null,
                defaultContent: '',
            },
            { data: 'pseudo' },
            { data: 'score' },
            { data: 'gagnant' }
        ]
    });
});