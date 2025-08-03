var tableOL;
var tablePR;
var tablePROP;
var tablePRACC;
var tablePROPACC;

$(document).ready(function () {
    generateid();
    getSelect();
    setInterval(updateDateTime, 1000);
    addauditor();
    reload();
    getbarang();
    getbarangAcc();
    approveoplist();
    deleteop();
});

function generateid() {
    $.ajax({
        url: base_url+'StockOpname/generateid', 
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var def = response.defID;
            var opnameid = response.newID;

            if (opnameid != def){
                $('#idstockopname').val(opnameid);
            }else{
                $('#idstockopname').val(def);
            }
        },
        error: function(xhr, status, error) {
          console.error('Error fetching id data:', error);
        }
    });
}

function tableol() {
    if ($.fn.DataTable.isDataTable('#table-ol')) {
        tableOL.destroy();
    }
    tableOL = $("#table-ol").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc']
        ],
        "ajax": {
            "url": base_url + 'stock-opname/opname-list/',
            "type": "POST"
        },
        "columns": [
            { "data": "kode_opname" },
            { "data": "tgl_opname",
                "render": function (data, type, row) {
                    var date = new Date(data);
                    return formatDate(date);
                }
            },
            { "data": "nama_lengkap" },
            { "data": "nama_toko" },
            {
                "data": "id_opname",
                "orderable": false,
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-id="${data}" data-bs-toggle="modal" data-bs-target="#CariBarang">Unit <i class="fa fa-plus"></i></button>
                                        <button class="btn btn-warning" data-id="${data}" data-bs-toggle="modal" data-bs-target="#CariBarangAcc">Aksesoris <i class="fa fa-plus"></i></button>
                                        <button class="btn btn-primary" id="approveop-btn" data-id="${data}" data-idop="${full.kode_opname}"><i class="icofont icofont-ui-check"></i></button>
                                        <button class="btn btn-secondary" id="delete-btn" data-id="${data}"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            }            
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
                        tableOL.ajax.reload();
                    }
                },
            ]
            
    });
    return tableOL;
}
//unit
function tablepr(id_toko,ido) {
    if ($.fn.DataTable.isDataTable('#table-pr')) {
        tablePR.destroy();
    }
    tablePR = $("#table-pr").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'StockOpname/loadproduklist/'+id_toko+'/'+ido,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" }, 
            { 
                "data": "status_brg",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "2") {
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="6"){
                            return `<span class="badge rounded-pill badge-warning">UNVERIFIED</span>`;
                        }
                        return data; // return the original value for other cases
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
                        tablePR.ajax.reload();
                    }
                }
            ]
            
    });
    return tablePR;    
}
function tableprop(id_toko,ido) {
    if ($.fn.DataTable.isDataTable('#table-prop')) {
        tablePROP.destroy();
    }
    tablePROP = $("#table-prop").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'StockOpname/loadproplist/'+id_toko+'/'+ido,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "2") {
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="6"){
                            return `<span class="badge rounded-pill badge-warning">UNVERIFIED</span>`;
                        }
                        return data; // return the original value for other cases
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
                        tablePROP.ajax.reload();
                        // $('#cprod').text('0');
                    }
                }
            ]
            
    });
    return tablePROP;
}
//unit

//acc
function tablepracc(id_toko,ido) {
    if ($.fn.DataTable.isDataTable('#table-pracc')) {
        tablePRACC.destroy();
    }
    tablePRACC = $("#table-pracc").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'StockOpname/loadacclist/'+id_toko+'/'+ido,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },  
            { 
                "data": "status_brg",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "2") {
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="6"){
                            return `<span class="badge rounded-pill badge-warning">UNVERIFIED</span>`;
                        }
                        return data; // return the original value for other cases
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
                        tablePRACC.ajax.reload();
                    }
                }
            ]
            
    });
    return tablePRACC;    
}
function tablepropacc(id_toko,ido) {
    if ($.fn.DataTable.isDataTable('#table-propacc')) {
        tablePROPACC.destroy();
    }
    tablePROPACC = $("#table-propacc").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": base_url + 'StockOpname/loadpropacclist/'+id_toko+'/'+ido,
            "type": "POST"
        },
        "columns": [
            { "data": "sn_brg" },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "jenis" },
            { 
                "data": "status",
                "render": function (data, type, full, meta) {
                    // You can customize the rendering here
                    if (type === "display") {
                        if (data === "2") {
                            return `<span class="badge rounded-pill badge-primary">READY</span>`;
                        } else if(data==="6"){
                            return `<span class="badge rounded-pill badge-warning">UNVERIFIED</span>`;
                        }
                        return data; // return the original value for other cases
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
                        tablePROPACC.ajax.reload();
                        // $('#cprod').text('0');
                    }
                }
            ]
            
    });
    return tablePROPACC;
}
//acc

function getSelect() {
    $('#auditor').select2({
        language: 'id',
    });
    $('#cabang').select2({
        language: 'id',
        ajax: {
            url: base_url + 'StockOpname/loadcabang',
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
    $('#cabang').on('select2:select', function(e) {
        var data = e.params.data;
        var id_toko = data.id;

        $('#auditor').select2({
            language: 'id',
            ajax: {
                url: base_url + 'StockOpname/loadauditor/'+id_toko,
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
                                id: item.id_user,
                                text: item.id_user+' | '+item.nama_lengkap,
                            };
                        }),
                    };
                },
                cache: false,
            },
        });
    });
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

function addauditor() {
    $("#addauditor").on("click", function () {
        var idop = $("#idstockopname").val();
        var tgl = $("#tanggalwaktubarang").val();
        var cab = $("#cabang").val();
        var aud = $("#auditor").val();
        if (!cab || !aud ) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: base_url+"stock-opname/simpan-data",
            data: {
                idstockopname: idop,
                tanggalwaktubarang: tgl,
                cabang: cab,
                auditor: aud,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("success", "Data berhasil ditambahkan", "success").then(() => {
                        $("#cabang").val('0').trigger('change.select2');
                        $("#auditor").val('0').trigger('change.select2');
                        reload();
                        generateid();
                    });
                } else if(response.status === 'exists') {
                    swal("Warning", "Opname sudah diinputkan", "warning").then(() => {
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

function reload() {
    var olReloaded = tableol();
    olReloaded.on('draw.dt', function () {
        var counting = olReloaded.rows().count();
        // if (counting === 0) {
        //     $('#simpanopnm').addClass('d-none');
        // } else {
        //     $('#simpanopnm').removeClass('d-none');
        // }
    });
    if (olReloaded) {
        olReloaded.clear().draw();
        olReloaded.ajax.reload();
    }
}
function formatDate(date) {
    var options = { day: 'numeric', month: 'long', year: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}
function debounce(func, wait) {
    let timeout;
    return function(...args) {
        const context = this;
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(context, args), wait);
    };
}
function getProdOP() {
    $('#carisn').off('input').on('input', debounce(function() {
        var idt = $(this).attr('data-idt');
        var idop = $(this).attr('data-idop');
        var otgl = $(this).attr('data-otgl');
        var searchTerm = $(this).val();
        if (searchTerm.trim() === '') {
            return; // Do nothing if the search term is empty
        }
        $.ajax({
            url: base_url + 'StockOpname/searchSN/' + idt + '/' + idop + '/' + searchTerm,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.data.length === 1 && response.is_not == 1) {
                    var data = response.data[0];
                    var sn_brg = data.sn_brg;
                    var merk = data.merk;
                    var jenis = data.jenis;
                    var spek = data.spek;
                    var idk = data.id_keluar;
                    $('#hsn').val(sn_brg);
                    $('#merk').val(merk);
                    $('#jenis').val(jenis);
                    $('#spek').val(spek);
                    $.ajax({
                        url: base_url + 'StockOpname/addpr',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            idopname: idop,
                            idkeluar: idk
                        },
                        success: function(response) {
                            swal({
                                title: "Success",
                                text: "Produk ditambahkan",
                                icon: "success",
                                timer: 1000, // Time in milliseconds (2 seconds in this example)
                                buttons: false // Hides the "OK" button
                            }).then(() => {
                                $('#carisn').val('');
                                $('#carisn').focus();
                                tablePROP.ajax.reload();
                                tablePR.ajax.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error inserting data:', error);
                        }
                    });
                } else if(response.data.length === 1 && response.is_alr == 1) {
                    swal({
                        title: "warning",
                        text: "Serial Number "+searchTerm+ " sudah diopname",
                        icon: "warning",
                        timer: 1500, // Time in milliseconds (2 seconds in this example)
                        buttons: false // Hides the "OK" button
                    }).then(() => {
                        $('#carisn').val('');
                        $('#hsn').val('');
                        $('#merk').val('');
                        $('#jenis').val('');
                        $('#spek').val('');
                        $('#carisn').focus();
                    });
                } else {
                    swal({
                        title: "error",
                        text: "Serial Number "+searchTerm+ " tidak ada",
                        icon: "error",
                        timer: 1000, // Time in milliseconds (2 seconds in this example)
                        buttons: false // Hides the "OK" button
                    }).then(() => {
                        $('#carisn').val('');
                        $('#hsn').val('');
                        $('#merk').val('');
                        $('#jenis').val('');
                        $('#spek').val('');
                        $('#carisn').focus();
                    });
                    // swal("error", "Serial Number " + searchTerm + " tidak ada", "error").then(() => {
                    // });
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 400 || xhr.status === 500) {
                    swal({
                        title: "Error",
                        text: "Serial Number "+searchTerm+ " tidak ada",
                        icon: "error",
                        timer: 1000,
                        buttons: false
                    }).then(() => {
                        $('#carisn').val('');
                        $('#hsn').val('');
                        $('#merk').val('');
                        $('#jenis').val('');
                        $('#carisn').focus();
                    });
                } else {
                    console.error('Error searching serial number:', error);
                }
            }
        });
    }, 500)); // Adjust the debounce wait time as needed
}
function inputacc() {
    $('#carisnacc').off('input').on('input', debounce(function() {
        var idtacc = $(this).attr('data-idtacc');
        var idopacc = $(this).attr('data-idopacc');
        var otglacc = $(this).attr('data-otglacc');
        var searchTerm = $(this).val();
        if (searchTerm.trim() === '') {
            return; // Do nothing if the search term is empty
        }
        $.ajax({
            url: base_url + 'StockOpname/searchAccSN/'+idtacc+'/'+idopacc+'/'+searchTerm,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.data.length === 1 && response.is_not == 1) {
                    var data = response.data[0];
                    var sn_brg = data.sn_brg;
                    var merk = data.merk;
                    var jenis = data.jenis;
                    var idk = data.id_keluar;
                    $('#hsnacc').val(sn_brg);
                    $('#merkacc').val(merk);
                    $('#jenisacc').val(jenis);
                    $.ajax({
                        url: base_url + 'StockOpname/addprodacc',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            idopname: idopacc,
                            idkeluar: idk
                        },
                        success: function(response) {
                            swal({
                                title: "Success",
                                text: "Produk ditambahkan",
                                icon: "success",
                                timer: 1000, // Time in milliseconds (2 seconds in this example)
                                buttons: false // Hides the "OK" button
                            }).then(() => {
                                $('#carisnacc').val('');
                                $('#carisnacc').focus();
                                tablePROPACC.ajax.reload();
                                tablePRACC.ajax.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error('Error inserting data:', error);
                        }
                    });
                } else if(response.data.length === 1 && response.is_alr == 1) {
                    swal({
                        title: "warning",
                        text: "Serial Number "+searchTerm+ " sudah diopname",
                        icon: "warning",
                        timer: 1500, // Time in milliseconds (2 seconds in this example)
                        buttons: false // Hides the "OK" button
                    }).then(() => {
                        $('#carisnacc').val('');
                        $('#hsnacc').val('');
                        $('#merkacc').val('');
                        $('#jenisacc').val('');
                        $('#carisnacc').focus();
                    });
                } else {
                    swal({
                        title: "error",
                        text: "Serial Number "+searchTerm+ " tidak ada",
                        icon: "error",
                        timer: 1000, // Time in milliseconds (2 seconds in this example)
                        buttons: false // Hides the "OK" button
                    }).then(() => {
                        $('#carisnacc').val('');
                        $('#hsnacc').val('');
                        $('#merkacc').val('');
                        $('#jenisacc').val('');
                        $('#carisnacc').focus();
                    });
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 400 || xhr.status === 500) {
                    swal({
                        title: "Error",
                        text: "Serial Number "+searchTerm+ " tidak ada",
                        icon: "error",
                        timer: 1000,
                        buttons: false
                    }).then(() => {
                        $('#carisnacc').val('');
                        $('#hsnacc').val('');
                        $('#merkacc').val('');
                        $('#jenisacc').val('');
                        $('#carisnacc').focus();
                    });
                } else {
                    console.error('Error searching serial number:', error);
                }
            }
        });
    }, 500));
       
}
function getbarang(){
    $('#CariBarang').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        setTimeout(function (){
            $('#carisn').focus();
        }, 1000);
        
        $.ajax({
            url: base_url + "stock-opname/getbarang/"+id,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    var date = new Date(item.tgl_opname);
                    var year = date.getFullYear();
                    var month = (date.getMonth() + 1).toString().padStart(2, '0');
                    var day = date.getDate().toString().padStart(2, '0');
                    var tgl = year + '-' + month + '-' + day;
                    var formattedDate = formatDate(date);
                    var id_opname = item.id_opname;
                    $('#ido').text(item.kode_opname);
                    $('#aud').text(item.nama_lengkap);
                    $('#cab').text(item.id_toko+'|'+item.nama_toko);
                    $('#dtgl').text(formattedDate);
                    $('#carisn').attr({
                        'data-idt': item.id_toko,
                        'data-idop': item.id_opname,
                        'data-otgl': tgl
                    });
                    getProdOP();
                    tableprop(item.id_toko,id_opname);
                    tablepr(item.id_toko,id_opname);
                });
            }
        });
    });
}
function getbarangAcc(){
    $('#CariBarangAcc').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget);
        var id = button.data('id');
        setTimeout(function (){
            $('#carisnacc').focus();
        }, 1000);
        
        $.ajax({
            url: base_url + "stock-opname/getbarang/"+id,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    var date = new Date(item.tgl_opname);
                    var year = date.getFullYear();
                    var month = (date.getMonth() + 1).toString().padStart(2, '0');
                    var day = date.getDate().toString().padStart(2, '0');
                    var tgl = year + '-' + month + '-' + day;
                    var formattedDate = formatDate(date);
                    var id_opname = item.id_opname;
                    $('#idoacc').text(item.kode_opname);
                    $('#audacc').text(item.nama_lengkap);
                    $('#cabacc').text(item.id_toko+'|'+item.nama_toko);
                    $('#dtglacc').text(formattedDate);
                    $('#carisnacc').attr({
                        'data-idtacc': item.id_toko,
                        'data-idopacc': item.id_opname,
                        'data-otglacc': tgl
                    });
                    inputacc();
                    tablepropacc(item.id_toko,id_opname);
                    tablepracc(item.id_toko,id_opname);
                });
            }
        });
    });
}
function addproduk(id_opname) {
    var cabText = $('#cab').text(); // Get the text inside the #cab element
    var cabParts = cabText.split('|'); // Split the text by '|'

    var id_toko = cabParts[0].trim();
    $('.checkbox_prod').each(function() {
        if ($(this).is(':checked')) {
            var id_keluar = $(this).val();
            $.ajax({
                url: base_url+'stock-opname/simpan-data-produk',
                type: 'POST',
                data: { 
                    idopname: id_opname,
                    idkeluar: id_keluar
                },
                dataType: "json", 
                success: function(response) {
                    if (response.status === 'success') {
                            swal("success", "Data berhasil ditambahkan", "success").then(() => {
                                tablepr(id_toko);
                            });
                    } else if(response.status === 'exists') {
                        swal("Warning", "Barang sudah diinputkan", "warning").then(() => {
                        });
                    }
                },
                error: function(xhr, status, error) {
                    swal("Gagal "+error, {
                        icon: "error",
                    });
                }
            });
        }
    });
}
function simpanop() {
    $.ajax({
        url: base_url+'stock-opname/approve',
        type: 'POST',
        dataType: "json", 
        success: function(response) {
            if (response.status === 'success') {
                swal("success", "List opname berhasil disetujui", "success").then(() => {
                    reload();
                    generateid();
                });
            }
        },
        error: function(xhr, status, error) {
            swal("Gagal "+error, {
                icon: "error",
            });
        }
    });
}
function deleteop() {
    $('#table-ol').on('click', '#delete-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
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
                    url: base_url + 'stock-opname/hapus/' + id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            swal('Deleted!', response.message, 'success');
                            reload();
                            generateid();
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
function approveoplist() {
    $('#table-ol').on('click', '#approveop-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var idop = $(this).data('idop');
        swal({
            title: 'Apa anda yakin?',
            text: 'Data yang sudah disetujui tidak dapat ditambahkan lagi!',
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
                    text: 'Approve',
                    value: true,
                    visible: true,
                    className: 'btn-success',
                    closeModal: true
                }
            }
        }).then((willApprove) => {
            if (willApprove) {
                $.ajax({
                    type: 'POST',
                    url: base_url + 'StockOpname/approvebyop/' + id,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 'success') {
                            swal('Success!', "Stock opname dengan id "+idop+" berhasil disetujui", 'success');
                            reload();
                        } else {
                            swal('Error!', "Gagal!", 'error');
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