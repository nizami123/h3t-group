var tableLAP;
$(document).ready(function () {
    tableLAP();
    getselect();
    filtertglinv();
    filtertglbrg();
});
function tableLAP() {
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'LapBrand/laporanlist/',
        data: function(d) {
            d.cab = $('#cab').val();
            d.kond = $('#kondisi').val();
            d.jns = $('#tipe').val();
            d.fdinv = $('#fdinv').val();
            d.fdipt = $('#fdipt').val();
            d.catsum = $('#catsum').val();
        }
    };
    if ($.fn.DataTable.isDataTable('#table-lapbr')) {
        tableLAP.destroy();
    }
    tableLAP = $("#table-lapbr").DataTable({
        "processing": true,

        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [11, 'desc'] 
        ],
        "ajax": ajaxConfig,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "category_summary", orderable:false},
            { "data": "sales_id", orderable:false },
            { "data": "sales_name", orderable:false },
            { "data": "supervisor_name", orderable:false },
            { "data": "outlet_name", orderable:false },
            { "data": "outlet_code", orderable:false },
            { "data": "invoice_number", orderable:false },
            { "data": "invoice_date", orderable:false },
            { "data": "invoice_year", orderable:false },
            { "data": "invoice_month", orderable:false },
            { "data": "payment_method", orderable:false },
            { "data": "tanggal_input", orderable:false },
            { "data": "serial_number", orderable:false },
            { "data": "brand", orderable:false },
            { "data": "imei", orderable:false },
            { "data": "product_name", orderable:false },
            { "data": "product_category", orderable:false },
            { "data": "cost_price", orderable:false },
            { "data": "cogs", orderable:false },
            { "data": "final_price", orderable:false },
            { 
                "data": "kondisi",
                orderable: false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if(data ==="Baru"){
                            return `<span class="badge rounded-pill badge-primary">BARU</span>`;
                        } else if(data==="Bekas"){
                            return `<span class="badge rounded-pill badge-success">BEKAS</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-6'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
        "buttons": [
            {
                "text": 'Refresh', // Font Awesome icon for refresh
                "className": 'custom-refresh-button', // Add a class name for identification
                "attr": {
                    "id": "refresh-button" // Set the ID attribute
                },
                "init": function (api, node, config) {
                    $(node).removeClass('btn-default');
                    $(node).addClass('btn-primary');
                    $(node).attr('title', 'Refresh'); // Add a title attribute for tooltip
                },
                "action": function () {
                    tableLAP.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export Excel', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'LAPORAN BRAND',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            },
        ]
            
    });
    $('#tipe, #kondisi, #cab, #catsum').on('change', function() {
        tableLAP.draw();
    }); 
    return tableLAP;
}
function getselect(){
    $('#cab').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangTerima/loadstore',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var results = $.map(data, function (item) {
                    return {
                        id: item.id_toko,
                        text: item.id_toko+' | '+item.nama_toko,
                    };
                });
    
                results.unshift({
                    id: 'AllCab',
                    text: 'Semua Cabang',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
    $('#tipe').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBarang/loadjenis',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var results = $.map(data, function (item) {
                    return {
                        id: item.nama_kategori,
                        text: item.nama_kategori,
                    };
                });
    
                results.unshift({
                    id: 'all',
                    text: 'Semua Tipe',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
    $('#kondisi').select2({
        language: 'id',
        ajax: {
            url: base_url + 'PenList/loadkondisi',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, 
                };
            },
            processResults: function (data) {
                var results = $.map(data, function (item) {
                    return {
                        id: item.kondisi,
                        text: item.kondisi,
                    };
                });
    
                results.unshift({
                    id: 'all',
                    text: 'Semua Kondisi',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
    $('#catsum').select2();
}
function filtertglinv(){
	flatpickr("#fdinv", {
		mode: "range",
	});
    $('#fdinv').on('change', function() {
        tableLAP.draw();
    });
}
function filtertglbrg(){
	flatpickr("#fdipt", {
		mode: "range",
	});
    $('#fdipt').on('change', function() {
        tableLAP.draw();
    });
}