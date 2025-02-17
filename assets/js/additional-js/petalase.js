var Tetalase;
var cabr;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'decimal',
    // currency: 'IDR',
    minimumFractionDigits: 0
});
$(document).ready(function () {
    table_etalase();
    getselect();
    detailbrg();
});
function table_etalase() {
    getselect();
    var ajaxConfig = {
        type: "POST",
        url: base_url + 'etalase-toko/produk-list/',
        data: function(d) {
                d.cabr = $('#cabr').val();
                d.supp = $('#cab').val();
                d.tipe = $('#tipe').val();
        }
    };
    if ($.fn.DataTable.isDataTable('#table-etalase')) {
        Tetalase.destroy();
    }
    Tetalase = $("#table-etalase").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [1, 'asc']
        ],
        "ajax": ajaxConfig,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { 
                "data": "id_keluar",
                "orderable": false,
                "render": function (data, type, row, meta) {
                    var checkboxId = 'checkbox-' + data;
                    return `
                        <input class="checkbox-class" type="checkbox" id="${checkboxId}" data-id="${data}" data-input-id="${checkboxId}-hpp" data-input-pub="${checkboxId}-pub" data-input-mar="${checkboxId}-mar" data-input-cb="${checkboxId}-cb">
                    `;
                }
            },
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "nama_toko" },
            { "data": "nama_supplier" },
            { 
                "data": "hrg_hpp",
                "render": function (data, type, row, meta) {
                    var inputId = 'checkbox-' + row.id_keluar + '-hpp';
                    return `
                        <div class="input-group has-validation">
                            <span class="input-group-text" style="padding-left: 10px;border-left-width: 1px;border-left-style: solid;padding-right: 10px;padding-top: 1px;padding-bottom: 1px;">Rp</span>
                            <input class="form-control input-hpp" id="${inputId}" value="${formatcur.format(data)}" type="text" onkeyup="formatRupiah(this);" disabled>
                        </div>
                    `;
                }
            },
            { 
                "data": "hrg_jual",
                "render": function (data, type, row, meta) {
                    var inputId = 'checkbox-' + row.id_keluar + '-pub';
                    return `
                        <div class="input-group has-validation">
                            <span class="input-group-text" style="padding-left: 10px;border-left-width: 1px;border-left-style: solid;padding-right: 10px;padding-top: 1px;padding-bottom: 1px;">Rp</span>
                            <input class="form-control input-pub" id="${inputId}" value="${formatcur.format(data)}" type="text" onkeyup="formatRupiah(this);" disabled>
                        </div>
                    `;
                }
            },            
            { 
                "data": "margin", 
                "render": function (data, type, row, meta) {
                    var inputId = 'checkbox-' + row.id_keluar + '-mar';
                    return `
                        <div class="input-group has-validation">
                            <input class="form-control input-mar" id="${inputId}" value="${data}" type="text" disabled readonly>
                        </div>
                    `;
                }
            },            
            { 
                "data": "hrg_cashback",
                "render": function (data, type, row, meta) {
                    var inputId = 'checkbox-' + row.id_keluar + '-cb';
                    return `
                        <div class="input-group has-validation">
                            <input class="form-control cb-input" id="${inputId}" value="${formatcur.format(data)}" type="text" onkeyup="formatRupiah(this);" disabled>
                        </div>
                    `;
                }
            },
            {
                "data": "id_keluar",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <div class="d-flex justify-content-center"> <!-- Added d-flex and justify-content-center classes -->
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-id="${data}" data-bs-toggle="modal" data-bs-target="#InfoDetail"><i class="fa fa-exclamation-circle"></i></button>
                                    </div>
                                </div>
                            `;
                    }
                    return data;
                }
            }                        
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
               "<'row'<'col-sm-12 col-md-2'B>>" +
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
                        Tetalase.ajax.reload();
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
                },
                {
                    "text": 'Update', // Font Awesome icon for refresh
                    "attr": {
                        "id": "update" // Set the ID attribute
                    },
                    "action": function () {
                        var checkedData = [];
                        
                        $('.checkbox-class:checked').each(function() {
                            var row = Tetalase.row($(this).closest('tr')).data();
                            var hppInputId = 'checkbox-' + row.id_keluar + '-hpp';
                            var pubInputId = 'checkbox-' + row.id_keluar + '-pub';
                            var marInputId = 'checkbox-' + row.id_keluar + '-mar';
                            var cbInputId = 'checkbox-' + row.id_keluar + '-cb';
                            var hppValue = $('#' + hppInputId).val().replace(/\D/g, '');
                            var pubValue = $('#' + pubInputId).val().replace(/\D/g, '');
                            var marValue = $('#' + marInputId).val();
                            var cbValue = $('#' + cbInputId).val().replace(/\D/g, '');
                            checkedData.push({
                                idk: row.id_keluar,
                                idm: row.id_masuk,
                                ehpp: parseFloat(hppValue),
                                ehj: parseFloat(pubValue),
                                emg: marValue,
                                ecb: parseFloat(cbValue),
                            });
                        });
                        if (checkedData.length==0){
                            console.log('no data');
                        }else{
                            var jsonData = JSON.stringify(checkedData);
                        
                            // Send JSON data via AJAX POST
                            $.ajax({
                                url: base_url + 'etalase-toko/update-data',
                                type: 'POST',
                                dataType: 'json',
                                contentType: 'application/json',
                                data: jsonData,
                                success: function(response) {
                                    if (response.status === 'success') {
                                        swal("success", "harga sudah diperbarui", "success").then(() => {
                                            Tetalase.ajax.reload();
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error updating data:', error);
                                }
                            });
                        }
                    }
                }
            ]
            
    });
    $('#table-etalase').on('change', '.checkbox-class', function() {
        var inputId = $(this).data('input-id');
        var inputPub = $(this).data('input-pub');
        var inputMar = $(this).data('input-mar');
        var inputCb = $(this).data('input-cb');
        var inputField = $('#' + inputId);
        var inputPubField = $('#'+ inputPub);
        var inputMarField = $('#'+ inputMar);
        var inputCbField = $('#'+ inputCb);
        inputField.prop('disabled', !this.checked);
        inputPubField.prop('disabled', !this.checked);
        inputMarField.prop({
            'disabled': !this.checked,
            'readonly': true
        });
        inputCbField.prop('disabled', !this.checked);
        inputCbField.on('click', function() {
            // If the value is "0", clear the value
            if ($(this).val() === "0") {
                $(this).val('');
            }
        });
    });
    $('#table-etalase').on('input', '.input-hpp, .input-pub', function() {
        var row = Tetalase.row($(this).closest('tr')).data();
        var hppInputId = 'checkbox-' + row.id_keluar + '-hpp';
        var pubInputId = 'checkbox-' + row.id_keluar + '-pub';
        var marInputId = 'checkbox-' + row.id_keluar + '-mar';
    
        var hppValue = parseFloat($('#' + hppInputId).val().replace(/\D/g, ''));
        var pubValue = parseFloat($('#' + pubInputId).val().replace(/\D/g, ''));
    
            var margin = ((pubValue - hppValue) / hppValue) * 100;
            $('#' + marInputId).val(margin.toFixed(2));
    });   
    $('#cabr, #cab, #tipe').on('change', function() {
        Tetalase.draw();
    }); 
    return Tetalase;
}
function getselect(){
    $('#cab').select2({
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
                var results = $.map(data, function (item) {
                    return {
                        id: item.id_supplier,
                        text: item.id_supplier+' | '+item.nama_supplier,
                    };
                });
    
                results.unshift({
                    id: '0',
                    text: 'Semua Supplier',
                    value: '0',
                });
    
                return {
                    results: results,
                };
            },
            cache: false,
        },
    });
    $('#cabr').select2({
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
                    id: '0',
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
                    id: '0',
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
}
function detailbrg() {
    $('#InfoDetail').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        $.ajax({
            url: base_url + 'PenEtalase/infoBrg/'+id,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    var tgl_keluar = item.tgl_keluar;
                    var datePart = tgl_keluar.split(' ')[0];
                    var timePart = tgl_keluar.split(' ')[1];
                    $('#bardh').attr('src', base_url+'assets/dhdokumen/snbarcode/'+item.sn_brg+'.jpg').css('width', '100px');
                    $('#dhsn').text(item.sn_brg);
                    $('#H3TSUPP').text(item.nama_supplier);
                    $('#dhnm').text(item.nama_brg);
                    $('#dhkon').text(item.kondisi);
                    $('#dhmerk').text(item.merk);
                    $('#dhjen').text(item.jenis);
                    $('#spek').text(item.spek);
                    $('#dhdreg').text(datePart);
                    $('#dhtreg').text(timePart);
                    $('#dhcab').text(item.nama_toko);
                });
            }
        });
    });
}