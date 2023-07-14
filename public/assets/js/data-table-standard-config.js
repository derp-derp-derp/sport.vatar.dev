let data_table_conf = {
    scrollX: true,
    paging: false,
    info: false,
    searching: false,
    fixedHeader: true,
    columnDefs: [
        {"className": "dt-center", "targets": "_all"}
    ]
};

$(document).ready(function(){
    $("tr:visible:even").css("background-color", "#141d1e");
});