var table;

function tablebank() {
    if ($.fn.DataTable.isDataTable('#table-bank')) {
        table.destroy();
    }
    table = $("#table-bank").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [0, 'asc']
        ],
        "ajax": {
            "url": base_url + 'master-bank/loadbank/',
            "type": "POST"
        },
        "columns": [
            { "data": "no_rek" },
            { "data": "nama_bank" },
            { "data": "nama_rek" },
            {
                "data": "id_bank",
                "orderable": false, // Disable sorting for this column
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data) {
                            return `
                                <ul class="action">
                                    <li class="edit">
                                        <button class="btn" id="edit-btn" type="button" data-id="${data}" data-bs-toggle="modal" data-bs-target="#EditBank"><i class="icon-pencil"></i></button>
                                    </li>
                                    <li class="delete">
                                        <button class="btn" id="delete-btn" type="button" data-id="${data}"><i class="icon-trash"></i></button>
                                    </li>
                                </ul>
                            `;
                        }
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
                    "text": 'Refresh <i class="fa fa-refresh"></i>', // Font Awesome icon for refresh
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
                        table.ajax.reload();
                    }
                }
            ]
            
    });
}

$(document).on('click', '#delete-btn', function (e) {
    e.preventDefault();

    var id_bank = $(this).data('id');

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
    }).then((result) => {
        if (result) {
            // User clicked 'Delete', proceed with the deletion
            $.ajax({
                type: 'POST',
                url: base_url + 'master-bank/hapus/' + id_bank,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        swal('Deleted!', response.message, 'success');
                        reload();
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

$(document).ready(function () {
    $('#bank').select2({
        language: 'id',
        ajax: {
            url: base_url + 'MasterBank/bank_json',
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
                            id: item.name,
                            text: item.code + ' | ' + item.name,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    add();
    getid();
    reload();
});

function reload() {
    if (tablebank()) {
        table.clear().draw();
        table.ajax.reload();
    }
}

function add(){
    $("#tambah").on("click", function () {
        var bank = $("#bank").val();
        var no = $("#no_rek").val();
        var nama = $("#nama_rek").val();
        if (!bank || !no || !nama ) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        } 
        $.ajax({
            type: "POST",
            url: "master-bank/simpan-data",
            data: {
                no_rek: no,
                nama_bank: bank,
                nama_rek: nama,
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Data berhasil ditambahkan", {
                        icon: "success",
                    });
                    $("#bank").val('0').trigger('change.select2');
                    $("#no_rek").val('');
                    $("#nama_rek").val('');
                    reload();
                } else {
                    swal("Gagal menambahkan data", {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                swal("Gagal no rekening sudah terdaftar", {
                    icon: "error",
                });
            }
        });
    });
}

function getid(){
    $('#EditBank').on('show.bs.modal', function (e) {
        getselect();
        var button = $(e.relatedTarget);
        var id_bank = button.data('id');
        
        console.log(id_bank);
        $.ajax({
            url: base_url + "master-bank/edit/"+id_bank,
            dataType: "json",
            success: function(data) {
                $.each(data.get_id, function(index, item) {
                    $("#e_nama_bank").empty().append('<option value="' + item.nama_bank + '">' + item.nama_bank + '</option>').trigger('change.select2');
                    $("#e_no_rek").val(item.no_rek);
                    $("#e_nama_rek").val(item.nama_rek);
                });
            }
        });
        edit(id_bank);
    });
}

function getselect(){
    $('#e_nama_bank').select2({
        dropdownParent: $("#EditBank"),
        language: 'id',
        ajax: {
            url: base_url + 'MasterBank/bank_json',
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
                            id: item.name,
                            text: item.code + ' | ' + item.name,
                        };
                    }),
                };
            },
            cache: false,
        },
    });
}

function edit(id_bank){
    $("#edit").on("click", function (){
        var no = $("#e_no_rek").val();
        var bank = $("#e_nama_bank").val();
        var nama = $("#e_nama_rek").val(); 
        if (!no || !bank || !nama) {
            swal("Error", "Lengkapi form yang kosong", "error");
            return;
        }
        $.ajax({
            type: "POST",
            url: "master-bank/update-data",
            data: {
                e_no_rek: no,
                e_nama_bank: bank,
                e_nama_rek: nama,
                data_id: id_bank
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Data berhasil diupdate", {
                        icon: "success",
                    }).then((value) => {
                        $("#e_no_rek").val('');
                        $("#e_nama_bank").val('0').trigger('change.select2');
                        $("#e_nama_rek").val(''); 
                        $('#EditBank').modal('hide');
                        reload();
                    });
                } else {
                    swal("Gagal update data", {
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