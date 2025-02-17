var tableDP;
var tableDet;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});

$(document).ready(function () {
    updateDateTime();
    reload();
    loadgenerated();
    loadselect();
    add_dp();
    detaildp();
    delete_dp();
});
function updateDateTime() {
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0');
    var day = now.getDate().toString().padStart(2, '0');
    var formattedDate = year + '-' + month + '-' + day;
    $('#tgl_tg').val(formattedDate);
    $('#tgl_tg').attr('max', formattedDate);
}
function loadselect() {
    $('#dh_supp').select2({
        language: 'id',
        ajax: {
            url: base_url + 'InventoriStok/loadsupp',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // Add the search term to your AJAX request
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_supplier,
                            text: item.id_supplier+' | '+item.nama_supplier,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#bank_acc').select2({
        language: 'id',
        ajax: {
            url: base_url + 'FinSupp/loadbank',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            id: item.id_bank,
                            text: item.nama_bank+' | '+item.no_rek+' | '+item.nama_rek,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
}
function loadgenerated() {
    $.ajax({
        url: base_url+'FinSupp/generateinv', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var def = response.defINV;
            var invoicedp = response.newINV;

            if (invoicedp != def){
                $('#invdp').val(invoicedp);
            }else{
                $('#invdp').val(def);
            }
        },
        error: function(xhr, status, error) {
          console.error('Error fetching invoice data:', error);
        }
    });
    $.ajax({
        url: base_url+'FinSupp/generateid', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var idtrans = response.newTR;
            $('#transid').val(idtrans);
        },
        error: function(xhr, status, error) {
          console.error('Error fetching invoice data:', error);
        }
    });
}

function tabledps() {
    if ($.fn.DataTable.isDataTable('#table-dp')) {
        tableDP.destroy();
    }
    tableDP = $("#table-dp").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc']
        ],
        "ajax": {
            "url": base_url + 'finance-supplier/load-dp-supp/',
            "type": "POST"
        },
        "columns": [
            { "data": "id_supplier" },
            { "data": "nama_supplier" },
            { 
                "data": "total_dp",
                "render": function (data, type, row) {
                    return formatcur.format(data);
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
                                        <button class="btn btn-success" data-id="${data}" data-bs-toggle="modal" data-bs-target="#DetailDPSupp"><i class="fa fa-exclamation-circle"> Detail</i></i></button>
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
                        tableDP.ajax.reload();
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
    return tableDP;
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
            [0, 'asc']
        ],
        "ajax": {
            "url": base_url + 'finance-supplier/load-dp-detail/'+id,
            "type": "POST"
        },
        "columns": [
            { "data": "tgl_dp" },
            { "data": "invoice_dp" },
            { "data": "id_transaksi_dp" },
            { 
                "data": "nominal_dp",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
            { "data": "bank_acc" },
            { 
                "data": "catatan",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        var formattedDeskripsi = data.replace(/\n/g, '<br>');
                        return formattedDeskripsi;
                    }
                    return data;
                }
            },
            {
                "data": "id_transaksi_dp",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-danger" data-id="${data}" id="delete-btn"><i class="icon-trash"></i></i></button>
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
                        tableDet.ajax.reload();
                    }
                },
                {
                    extend: 'excelHtml5', // Specify the Excel button
                    text: 'Export', // Text for the button
                    className: 'btn btn-success', // Add a class for styling
                    title: 'Detail DP Supplier',
                    exportOptions: {
                        columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                    }
                }
            ]
            
    });
    return tableDet;
}
function detaildp() {
    $('#DetailDPSupp').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        $.ajax({
            url: base_url + 'FinSupp/getidsupp/'+id,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    $('#dsi').text(item.id_supplier);
                    $('#dnm').text(item.nama_supplier);
                    $('#dtdp').text(formatcur.format(item.total_dp));
                    tabledet(id);
                });
            }
        });
    });
}
function reload() {
    var tdps = tabledps();
    if (tdps) {
        tdps.clear().draw();
        tdps.ajax.reload();
    }
}
function reloaddt(idsupp) {
    $.ajax({
        url: base_url + 'FinSupp/getidsupp/'+idsupp,
        dataType: "json",
        success: function(data) {
            $.each(data.get_id, function(index, item) {
                $('#dtdp').text(formatcur.format(item.total_dp));
            });
        }
    });
}
function add_dp() {
    $('#form_dp').submit(function(e) {
        e.preventDefault();
        var isValid = true;

        $('#form_dp input[required]').each(function() {
            if ($(this).val().trim() === '') {
                isValid = false;
                $(this).addClass('error');
            } else {
                $(this).removeClass('error');
            }
        });

        if (isValid) {
            var idtrans = $("#transid").val();
            var inv = $("#invdp").val();
            var mut = $("#no_m").val();
            var tg = $("#tgl_tg").val();
            var supp = $("#dh_supp").val();
            var bank = $("#bank_acc").val();
            var nom = parseFloat($("#nominal_dp").val().replace(/\D/g, ''));
            var cat = $("#cat_trans").val();
            $.ajax({
                type: "POST",
                url: base_url+"finance-supplier/tambah-dp",
                data: {
                    idtr: idtrans,
                    invdp: inv,
                    nomut: mut,
                    tgldp: tg,
                    ids: supp,
                    idb: bank,
                    nominal: nom,
                    catat: cat,
                },
                dataType: "json", 
                success: function (response) {
                    if (response.status === 'success') {
                        swal("success", "DP baru telah ditambahkan", "success").then(() => {
                            $("#no_m").val('');
                            $("#nominal_dp").val('');
                            $("#cat_trans").val('');
                            $("#dh_supp").val('0').trigger('change.select2');
                            $("#bank_acc").val('0').trigger('change.select2');
                            loadgenerated();
                            reload();
                        });
                    }
                },
                error: function (error) {
                    swal("Gagal "+error, {
                        icon: "error",
                    });
                }
            });
        }
    });
}
function delete_dp() {
    $('#table-detail').on('click', '#delete-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var idsupp = $('#dsi').text();
        var rowCount = tableDet.rows().count();
        swal({
            title: 'Apa anda yakin?',
            text: 'Data yang sudah terhapus hilang permanen!',
            icon: 'warning',
            buttons: {
                cancel: {
                    text: 'Cancel',
                    value: null,
                    visible: true,
                    className: 'btn-secondary',
                    closeModal: true,
                },
                confirm: {
                    text: 'Delete',
                    value: true,
                    visible: true,
                    className: 'btn-danger',
                    closeModal: true
                }
            }
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'finance-supplier/hapus/' + id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            swal('Deleted!', response.message, 'success');
                            reload();
                            reloaddt(idsupp)
                            tableDet.ajax.reload();
                        } else {
                            swal('Error!', response.message, 'error');
                        }
                    },
                    error: function (error) {
                        swal('Error!', 'An error occurred while processing the request.', 'error');
                    }
                });
            }
        });        
    });
}