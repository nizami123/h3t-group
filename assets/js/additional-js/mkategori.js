var table;

function tablemrk(type) {
    if ($.fn.DataTable.isDataTable('#table-kategori')) {
        table.destroy();
    }
    table = $("#table-kategori").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [],
        "lengthMenu": [5],
        "dom": 'Bfrtip',
        "ajax": {
            "url": base_url + 'master-kategori/jsonkat/' + type,
            "type": "POST"
        },
        "columns": [
            { "data": "id_kategori" },
            { "data": "nama_kategori" },
            {
                "data": "id_kategori",
                "orderable": false, // Disable sorting for this column
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if (data) {
                            return `
                                <ul class="action">
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
    });
}

$(document).on('click', '#delete-btn', function (e) {
    e.preventDefault();

    var id_kategori = $(this).data('id');

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
                url: base_url + 'master-kategori/hapus/' + id_kategori,
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
    $('.change-modal').on('click', function () {
        var type = $(this).data('type');
        tablemrk(type);
    });
    $('#SubKategoriItem').on('show.bs.modal', function (event) {
        reload();
    });
    initSweetAlert();
});

function reload() {
    if (table) {
        table.clear().draw();
        table.ajax.reload();
    }
}

function initSweetAlert() {
    $(".add_merk").on("click", function () {
        var merk = $("#merek").val();
        var kode = "MRK";

        if (!merk) {
            swal("Error", "Form merek masih kosong", "error").then(() => {
                $("#merek").focus();
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "master-kategori/simpan-data",
            data: {
                kode: kode,
                merek: merk
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Berhasil! Kategori Baru telah ditambahkan!", {
                        icon: "success",
                    });
                    $("#merek").val('');
                } else {
                    swal("Gagal menambahkan kategori baru", {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                swal("Gagal ", {
                    icon: "error",
                });
            }
        });
    });

    $("#add_jenis").on("click", function(){
        var jenis = $("#jenis").val();
        var kode = "JNS";

        if (!jenis) {
            swal("Error", "Form jenis masih kosong", "error").then(() => {
                $("#jenis").focus();
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "master-kategori/addjenis",
            data: {
                kode: kode,
                jenis: jenis
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Berhasil! Kategori Baru telah ditambahkan!", {
                        icon: "success",
                    });
                    $("#jenis").val('');
                } else {
                    swal("Gagal menambahkan kategori baru", {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                swal("Gagal ", {
                    icon: "error",
                });
            }
        });
    });

    $("#add_warna").on("click", function(){
        var warna = $("#warna").val();
        var kode = "JNS";

        if (!warna) {
            swal("Error", "Form warna masih kosong", "error").then(() => {
                $("#warna").focus();
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "master-kategori/addwarna",
            data: {
                kode: kode,
                warna: warna
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Berhasil! Kategori Baru telah ditambahkan!", {
                        icon: "success",
                    });
                    $("#warna").val('');
                } else {
                    swal("Gagal menambahkan kategori baru", {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                swal("Gagal ", {
                    icon: "error",
                });
            }
        });
    });

    $("#add_storage").on("click", function(){
        var storage = $("#storage").val();
        var kode = "STR";

        if (!storage) {
            swal("Error", "Form storage masih kosong", "error").then(() => {
                $("#storage").focus();
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "master-kategori/addstorage",
            data: {
                kode: kode,
                storage: storage
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Berhasil! Kategori Baru telah ditambahkan!", {
                        icon: "success",
                    });
                    $("#storage").val('');
                } else {
                    swal("Gagal menambahkan kategori baru", {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                swal("Gagal ", {
                    icon: "error",
                });
            }
        });  
    });
    
    $("#add_variant").on("click", function(){
        var variant = $("#variant").val();
        var kode = "VRT";
        
        if (!variant) {
            swal("Error", "Form variant masih kosong", "error").then(() => {
                $("#variant").focus();
            });
            return;
        }

        $.ajax({
            type: "POST",
            url: "master-kategori/addvariant",
            data: {
                kode: kode,
                variant: variant
            },
            dataType: "json", 
            success: function (response) {
                if (response.status === 'success') {
                    swal("Berhasil! Kategori Baru telah ditambahkan!", {
                        icon: "success",
                    });
                    $("#variant").val('');
                } else {
                    swal("Gagal menambahkan kategori baru", {
                        icon: "error",
                    });
                }
            },
            error: function (error) {
                swal("Gagal ", {
                    icon: "error",
                });
            }
        });
    });    
}