$(document).ready(function(){

    $('#data-table').DataTable({
        scrollX: true,
        paging: false,
        info: false,
        searching: false,
        columnDefs: [
            {"className": "dt-center", "targets": "_all"}
        ]
    });

});