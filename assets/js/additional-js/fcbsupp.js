var tableCB;
var tableDet;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});

$(document).ready(function () {
    tablecb();
    detailcb();
});
function tablecb() {
    if ($.fn.DataTable.isDataTable('#table-cb')) {
        tableCB.destroy();
    }
    tableCB = $("#table-cb").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc']
        ],
        "ajax": {
            "url": base_url + 'finance-supplier/load-cb-supp/',
            "type": "POST"
        },
        "columns": [
            { "data": "id_supplier" },
            { "data": "nama_supplier" },
            { 
                "data": "total_cb",
                "render": function (data, type, row) {
                    return `
                        <strong class="text-primary">${formatcur.format(data)}</strong>
                    `;
                }
            },
            {
                "data": "id_supplier",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-primary" data-id="${data}" data-bs-toggle="modal" title="List Produk" data-bs-target="#ListProduk"><i class="fa fa-file-text"></i></i></button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-id="${data}" data-bs-toggle="modal" title="Detail Cashback" data-bs-target="#InfoDetail"><i class="fa fa-exclamation-circle"></i></i></button>
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            }            
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'col-sm-12 col-md-2'B>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
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
                        tableCB.ajax.reload();
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    title: 'Daftar DP Supplier',
                    exportOptions: {
                        columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                    }
                }
            ]
            
    });
    return tableCB;
}
function tabledet(id) {
    if ($.fn.DataTable.isDataTable('#table-detail')) {
        tableDet.destroy();
    }
    tableDet = $("#table-detail").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [1, 'asc']
        ],
        "ajax": {
            "url": base_url + 'finance-supplier/load-cb-produk/'+id,
            "type": "POST"
        },
        "columns": [
            { 
                "data": "id_keluar",
                "orderable": false,
                "render": function(data, type, row, meta) {
                  return '<input type="checkbox" class="checkbox_prod" id="checkbox_' + data + '" value="' + data + '">';
                }
            },
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "kondisi" },
            { 
                "data": "hrg_cashback",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'col-sm-12 col-md-2'B>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-6'p>>",
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
                        tableDet.ajax.reload();
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    title: 'Detail CB Supplier',
                },
                {
                    "text": 'Tambah', // Font Awesome icon for refresh
                    "attr": {
                        "id": "approve" // Set the ID attribute
                    },
                    "action": function () {
                        $('.checkbox_prod').each(function() {
                            if ($(this).is(':checked')) {
                                var id_keluar = $(this).val();
                                console.log(id_keluar);
                                // $.ajax({
                                //     url: base_url+'stock-opname/simpan-data-produk',
                                //     type: 'POST',
                                //     data: { 
                                //         idopname: id_opname,
                                //         idkeluar: id_keluar
                                //     },
                                //     dataType: "json", 
                                //     success: function(response) {
                                //         if (response.status === 'success') {
                                //                 swal("success", "Data berhasil ditambahkan", "success").then(() => {
                                //                     tablepr(id_toko);
                                //                     // reloadpr(id_toko);
                                //                     // $('#CariBarang').modal('hide');
                                //                 });
                                //         } else if(response.status === 'exists') {
                                //             swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                                //             });
                                //         }
                                //     },
                                //     error: function(xhr, status, error) {
                                //         swal("Gagal "+error, {
                                //             icon: "error",
                                //         });
                                //     }
                                // });
                            }
                        });
                    }
                }                
            ]
            
    });
    return tableDet;
}
function detailcb() {
    $('#ListProduk').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        tabledet(id);
        // $.ajax({
        //     url: base_url + 'FinSupp/getidsupp/'+id,
        //     dataType: "json",
        //     success: function(data) {
        //         $.each(data.get_id, function(index, item) {
        //             $('#dsi').text(item.id_supplier);
        //             $('#dnm').text(item.nama_supplier);
        //             $('#dtdp').text(formatcur.format(item.total_dp));
        //             tabledet(id);
        //         });
        //     }
        // });
    });
}