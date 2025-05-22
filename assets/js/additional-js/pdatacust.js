var tkust;
$(document).ready(function () {
    reload();
    getid();
    deletedata();
});
function reload() {
    if ($.fn.DataTable.isDataTable('#data-kustomer')) {
      tkust.destroy();
    }  
    tkust = $("#data-kustomer").DataTable({
        "processing": true,
        "language": { 
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
            // "url": '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json',            
        },
        "serverSide": true,
        "order": [
            [0, 'asc']
        ],
        "ajax": {
            "url": base_url+'master-kustomer/jsonkus',
            "type": "POST"
        },
        "columns": [
            { "data": "id_plg"},
            { "data": "nama_plg"},
            { "data": "no_ponsel"},
            { "data": "email" },
            { "data": "alamat" },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'col-sm-12 col-md-2'B>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
        "buttons": [
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Download Data', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Data Customer',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]        
    });    
}