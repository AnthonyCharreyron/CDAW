import $ from 'jquery'; // Importer jQuery
import DataTable from 'datatables.net-dt'; // Importer DataTables

console.log("Chargement du datatable ...");

$(document).ready(function() {
    $('#liste-classement').DataTable({
        ajax: 'historique/1',
        columnDefs: [
            {
                targets: '_all',
                render: function(data, type, row, meta) {
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
