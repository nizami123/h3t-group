var tableBK;
var tableSP;
var tableDT;
function tablebk() {
    if ($.fn.DataTable.isDataTable('#table-bk')) {
        tableBK.destroy();
    }
    tableBK = $("#table-bk").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'pindah-barang/loadbk/',
            "type": "POST"
        },
        "columns": [
            { 
                "data": null,
                "sortable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                "searchable": false
            },            
            {
                "data": "nama_toko",
                "render": function (data, type, row, meta) {
                    return '<select class="select2" id="cab" value="'+row.id_toko+'" data-id_toko="'+row.id_toko+'" data-id_keluar="' + row.id_keluar + '" data-current-value="' + data + '" data-cab="' + row.id_toko + '"></select>';
                },
            },            
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },
            {
                "data": "spek",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        var formattedDeskripsi = data.replace(/\n/g, '<br>');
                        return formattedDeskripsi;
                    }
                    return data;
                }
            },
            { 
                "data": "kondisi",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "Baru") {
                            return `<span class="badge rounded-pill badge-light-primary">BARU</span>`;
                          } else {
                            return `<span class="badge rounded-pill badge-light-warning">BEKAS</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "1") {
                            return `<span class="badge rounded-pill badge-secondary">ON PROSES</span>`;
                        } else if(data ==="2"){
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-success">TERJUAL</span>`;
                        } else if(data==="4"){
                            return `<span class="badge rounded-pill badge-info">BOOKING</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },
            { 
                "data": "sn_brg",
                "render": function(data, type, full, meta) {
                  // You can customize the rendering of the image here
                  if (type === "display") {
                      if (data) {
                          return `<img class="img-fluid table-avtar img-90" src="${base_url+'assets/dhdokumen/snbarcode/'+data+'.jpg'}" alt="Image" loading="lazy">`;
                      } else {
                          return "No Image";
                      }
                  }
                  return data;
              }
            },          
        ],
        "drawCallback": function(settings) {
            $('.select2').each(function() {
                var $select = $(this);
                var currentValue = $select.data('current-value');
                var value = $select.data('id_toko');
                var id_keluar = $select.data('id_keluar');
        
                $select.select2({
                    language: 'id',
                    ajax: {
                        url: base_url + 'BarangTerima/loadstore',
                        type: 'GET',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        id: item.id_toko,
                                        text: item.nama_toko
                                    };
                                })
                            };
                        },
                        cache: true
                    }
                });
                if (currentValue) {
                    $select.append('<option value="' + value + '" selected>' + currentValue + '</option>').trigger('change');
                }

                $select.on('change', function() {
                    var newValue = $(this).val();
                    var toko = $(this).find('option:selected').text();
                    var id_keluar = $select.data('id_keluar');
                    console.log(id_keluar);
                    
                    $.ajax({
                        url: 'pindah-barang/update',
                        method: 'POST',
                        data: {
                            ids: id_keluar, // Array of IDs
                            cab: newValue // Value of cab
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                swal("Barang berhasil dipindah ke cabang "+toko, {
                                    icon: "success",
                                }).then((value) => {
                                    reload();
                                });
                            } else {
                                swal("Gagal pindah barang", {
                                    icon: "error",
                                });
                            }
                        },
                    });
                });
            });
        },
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
                        tableBK.ajax.reload();
                    }
                },
            ]
    });
    return tableBK;
}

$(document).ready(function () {
    // reload();
    setInterval(updateDateTime, 1000);
    getCabang();
    selectedSP();
    tablesp();
    addsp();
    deletesp();
    approve();
    printsp();
    dtsp();
});
function tablesp() {
    if ($.fn.DataTable.isDataTable('#table-sp')) {
        tableSP.destroy();
    }
    tableSP = $("#table-sp").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'pindah-barang/loadsp/',
            "type": "POST"
        },
        "columns": [
            { "data": "tgl_pindah" },
            { "data": "nosp" },
            { "data": "dari_cab" },
            { "data": "kpd_cab" },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "0") {
                            return `<span class="badge rounded-pill badge-secondary">ON PROSES</span>`;
                        } else if(data ==="1"){
                            return `<span class="badge rounded-pill badge-primary">KIRIM</span>`;
                        } else if(data==="2"){
                            return `<span class="badge rounded-pill badge-success">TERIMA</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
            },          
            {
                "data": "fcabang",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (full.status == 0) {
                            // If status is 0, display the first two buttons
                            return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-warning" id="approvesp" data-nosp="${full.nosp}" data-id="${full.id_pindah}"><i class="icofont icofont-ui-check"></i></button>
                                        <button class="btn btn-success" data-id="${data}" data-idp="${full.id_pindah}" data-sp="${full.nosp}" data-dcid="${full.fcabang+'|'+full.dari_cab}" data-kcid="${full.tcabang+'|'+full.kpd_cab}" data-bs-toggle="modal" data-bs-target="#PindahBarang"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-primary d-none" data-id="${full.id_pindah}" data-bs-toggle="modal" data-bs-target="#CariBarang"><i class="fa fa-exclamation-circle"></i></button>
                                        <button class="btn btn-secondary" id="delete-sp" data-fcabang="${full.fcabang}" data-id="${full.id_pindah}"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </ul>
                            `;
                        } else {
                            // If status is not 0, hide the first two buttons
                            return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-warning d-none" data-id="${full.id_pindah}"><i class="icofont icofont-ui-check"></i></button>
                                        <button class="btn btn-success d-none" data-id="${data}" data-idp="${full.id_pindah}" data-bs-toggle="modal" data-bs-target="#PindahBarang"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-primary" id="btn-printsp" data-id="${full.nosp}"><i class="fa fa-exclamation-circle"></i></button>
                                        <button class="btn btn-secondary d-none" id="delete-btn" data-id="${full.id_pindah}"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </ul>
                            `;
                        }
                    }
                    return data;
                }
            },                   
        ],
        "dom":  "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
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
                        tableSP.ajax.reload();
                    }
                },
            ]
    });
    return tableSP;    
}
function tabledt(idp) {
    if ($.fn.DataTable.isDataTable('#table-pr')) {
        tableDT.destroy();
    }
    tableDT = $("#table-pr").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'pindah-barang/load-detail/'+idp,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },
            { 
                "data": "id_detailp",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-secondary" id="delete-brg" data-id="${data}" data-fcabang="${full.fcabang}" data-idk="${full.id_keluar}" data-idp="${full.id_pindah}"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            },
        ],
        "dom":  "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
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
                        tableDT.ajax.reload();
                    }
                },
            ]
    });
    return tableDT;    
}
function updateDateTime() {
    var now = new Date();
    var year = now.getFullYear();
    var month = (now.getMonth() + 1).toString().padStart(2, '0');
    var day = now.getDate().toString().padStart(2, '0');
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    $('#tanggalwaktubarang').val(year + '-' + month + '-' + day + 'T' + hours + ':' + minutes);   
}
function selectedSP() {
    $('#f_cabang').on('select2:select', function(e) {
        var data = e.params.data;
        var cab = data.id.split('-');
        var get = cab[1].trim();
        var nowdate = new Date();
        var day = String(nowdate.getDate()).padStart(2, '0');
        var month = String(nowdate.getMonth() + 1).padStart(2, '0');
        var year = nowdate.getFullYear();
        var hours = String(nowdate.getHours()).padStart(2, '0');
        var minutes = String(nowdate.getMinutes()).padStart(2, '0');
        var seconds = String(nowdate.getSeconds()+1).padStart(2, '0');
        var formatsp = 'SP'+get+hours+minutes+seconds+day+month+year;
        $('#no_sp').val(formatsp);
    });
}
function getCabang() {
    $('#f_cabang').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadstore',
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
                            id: item.id_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    $('#t_cabang').select2({
        language: 'id',
        ajax: {
            url: base_url + 'BarangKeluar/loadstore',
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
                            id: item.id_toko,
                            text: item.id_toko+' | '+item.nama_toko,
                        };
                    }),
                };
            },
            cache: false,
        },
    });    
    $('#f_cabang, #t_cabang').on('change', function () {
        var f_cabang = $('#f_cabang').val();
        var t_cabang = $('#t_cabang').val();

        if (f_cabang && t_cabang && f_cabang === t_cabang) {
            swal({
                icon: 'warning',
                title: 'Warning',
                text: 'Tidak bisa memilih cabang yang sama dalam pemindahan barang',
            });
        }
    });
}
function addsp() {
    $("#addpindah").on("click", function () {
        var tgl = $("#tanggalwaktubarang").val();
        var fcab = $("#f_cabang").val();
        var tcab = $("#t_cabang").val();
        var sp = $("#no_sp").val();

        if (!tgl || !fcab || !tcab || !sp) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        }
        if (fcab && tcab && fcab === tcab){
            swal("Warning", "Tidak bisa memilih cabang yang sama dalam pemindahan barang", "warning");
            return;
        }
        
        $.ajax({
            type: "POST",
            url: base_url+"pindah-barang/buat-sp",
            data: {
                tglp: tgl,
                fcab: fcab,
                tcab: tcab,
                nsp: sp
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#f_cabang").val('0').trigger('change.select2');
                        $("#t_cabang").val('0').trigger('change.select2');
                        $("#no_sp").val('');
                        reloadsp();
                    });
                } else if(response.status === 'error') {
                    swal("Error", "Surat Pemindahan sudah diinput", "error").then(() => {
                        // $("#prodbaru").val($("#prodbaru").find('option').last().val()).trigger('change.select2');
                    });
                }
            },
            error: function (error) {
                swal("Gagal "+error, {
                    icon: "error",
                });
            }
        });
    });
}
function reloadsp() {
    var spreload = tablesp();
    if (spreload) {
        spreload.clear().draw();
        spreload.ajax.reload();
    }
}
function reloadtsp(idp) {
    var dtreload = tabledt(idp);
    if (dtreload) {
        dtreload.clear().draw();
        dtreload.ajax.reload();
    }
}
function dtsp(){
    $('#PindahBarang').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var fcab = button.data('id');
        var sp = button.data('sp');
        var idp = button.data('idp');
        var dcab = button.data('dcid');
        var kcab = button.data('kcid');
        setTimeout(function (){
            $('#carisnacc').val('').focus();
        }, 1000);
        $('#ns').text(sp+'-'+idp);
        $('#dc').text(dcab);
        $('#kc').text(kcab);
        $('#idk').val('');
        $('#hsnacc').val('');
        $("#merk").val('');
        $("#jenis").val('');
        $("#spek").val('');
        getProdukFCab(fcab);
        submitpindah();
        deletebrg();
        tabledt(idp);
    });
}
function debounce(func, wait) {
    let timeout;
    return function(...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
    };
}
function getProdukFCab(fcab) {
    $('#carisnacc').on('input', debounce(function() {
        var searchTerm = $(this).val();
        if (searchTerm.trim() === '') {
            $('#idk').val('');
            $('#hsnacc').val('');
            $('#merk').val('');
            $('#jenis').val('');
            $('#spek').val('');
            return;
        }
        $.ajax({
            url: base_url + 'BarangPindah/loadprodf/'+fcab+'/'+searchTerm,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.length === 1) {
                    var data = response[0];
                    var sn_brg = data.sn_brg;
                    var merk = data.merk;
                    var jenis = data.jenis;
                    var idk = data.id_keluar;
                    $('#idk').val(idk);
                    $('#hsnacc').val(sn_brg+' | '+data.nama_brg);
                    $('#merk').val(merk);
                    $('#jenis').val(jenis);
                    $('#spek').val(jenis);
                } else {
                    swal({
                        title: "error",
                        text: "Serial Number "+searchTerm+ " tidak ada",
                        icon: "error",
                        timer: 1000, // Time in milliseconds (2 seconds in this example)
                        buttons: false // Hides the "OK" button
                    }).then(() => {
                        $('#carisnacc').val('').focus();
                        $('#idk').val('');
                        $('#hsnacc').val('');
                        $('#merk').val('');
                        $('#jenis').val('');
                        $('#spek').val('');
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error searching serial number:', error);
            }
        });
    }, 500));
}
function getDataBM(data) {
    var $option = $('<span></span>');
    $option.text(data.text);
    $option.attr('data-hrg_hpp', data.hrg_hpp);
    $option.attr('data-hrg_jual', data.hrg_jual);
    $option.attr('data-merk', data.merk);
    $option.attr('data-spek', data.spek);
    $option.attr('data-jenis', data.jenis);
    return $option;
}
function submitpindah() {
    $("#tambahdata").off("click").on("click", function () {
        var idk = $("#idk").val();
        var idp = $("#ns").text().split('-');
        var kcab = $('#kc').text().split('|');
        var split_idp = idp[1].trim();
        var split_kc = kcab[0].trim();
        // if ($("#prod").val() === '0') {
        //     swal("Error", "Produk belum dipilih", "error");
        //     return;
        // }
        
        $.ajax({
            type: "POST",
            url: base_url+"pindah-barang/tambah-data",
            data: {
                idp: split_idp,
                idk: idk,
                kcab: split_kc
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Barang berhasil ditambahkan", "success").then(() => {
                        $('#carisnacc').val('').focus();
                        $('#idk').val('');
                        $('#hsnacc').val('');
                        $('#merk').val('');
                        $('#jenis').val('');
                        $('#spek').val('');
                        reloadtsp(split_idp)
                    });
                } else if(response.status === 'error') {
                    swal("Error", "Barang gagal ditambahkan", "error").then(() => {
                        $('#carisnacc').val('').focus();
                        $('#idk').val('');
                        $('#hsnacc').val('');
                        $('#merk').val('');
                        $('#jenis').val('');
                        $('#spek').val('');
                    });
                }
            },
            error: function (error) {
                swal("Gagal "+error, {
                    icon: "error",
                });
            }
        });
    });    
}
function deletebrg() {
    $(document).on("click", "#delete-brg", function (e) {
        e.preventDefault();

        var id_k = $(this).data('idk');
        var fcab = $(this).data('fcabang');
        var idtlp = $(this).data('id');
        var idp = $(this).data('idp');

        swal({
            title: 'Apa anda yakin?',
            text: 'Data yang sudah terhapus hilang dari produk list pemindahan barang & kembali ke stok cabang awal',
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
        }).then((result) => {
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'BarangPindah/deletebrg/',
                    // url: base_url + 'pindah-barang/hapus-brg/'+idtlp+'/'+id_k,
                    dataType: 'json',
                    data: {
                        idtl: idtlp,
                        idk: id_k,
                        idt: fcab
                    },
                    success: function (response) {
                        if (response.success) {
                            swal('Deleted!', response.message, 'success');
                            reloadtsp(idp);
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
function deletesp() {
    $(document).on('click', '#delete-sp', function (e) {
        e.preventDefault();
    
        var idp = $(this).data('id');
        var fcab = $(this).data('fcabang');
    
        swal({
            title: 'Apa anda yakin?',
            text: 'Surat pemindahan yang sudah terhapus hilang permanen & data produk pemindahan barang kembali ke stok cabang awal',
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
        }).then((result) => {
            if (result) {
                // User clicked 'Delete', proceed with the deletion
                $.ajax({
                    type: 'POST',
                    url: base_url + 'BarangPindah/deletesp/',
                    dataType: 'json',
                    data: {
                        idp: idp,
                        idt: fcab
                    },
                    success: function (response) {
                        if (response.success) {
                            swal('Deleted!', response.message, 'success');
                            reloadsp();
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
function approve() {
    $(document).on('click', '#approvesp', function() {
        var id = $(this).data('id');
        var fsp = $(this).data('nosp');
        $.ajax({
            type: "POST",
            url: "BarangPindah/approvesp",
            dataType: "json", 
            data: {
                nosp: id,
                fsp: fsp
            },
            success: function (response) {
                if (response.status === 'success') {
                    swal("Surat pindah barang berhasil disetujui", {
                        icon: "success",
                    }).then((value) => {
                        tableSP.ajax.reload();
                    });
                } else {
                    swal("Gagal approve surat keluar", {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                swal("Gagal", {
                    icon: "error",
                });
            }
        });
    });
}
function printsp() {
    $(document).on('click', '#btn-printsp', function() {
        var nosp = $(this).data('id');
        var printUrl = base_url + 'BarangPindah/printsp/' + nosp;
        window.open(printUrl, '_blank');
    });
}
function reload() {
    var bkReloaded = tablebk();
    if (bkReloaded) {
        bkReloaded.clear().draw();
        bkReloaded.ajax.reload();
    }
}