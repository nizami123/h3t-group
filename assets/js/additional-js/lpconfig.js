$(document).ready(function () {
    loadBannersTable();
    loadProdukTable();
    loadConfigTable();
});
//banner tab
let tableLpBanner;
let tableLpProduk;
let tableLpConfig;

function loadBannersTable() {
    if ($.fn.DataTable.isDataTable('#table-lpbanner')) {
        tableLpBanner.destroy();
    }

    tableLpBanner = $('#table-lpbanner').DataTable({
        "processing": true,
        "autoWidth": false,
        "ajax": {
            "url": base_url + 'LpConfig/get_banners',
            "type": "GET"
        },
        "columns": [
            {
                "title": "Nama Banner",
                "data": "banner_name",
                "className": "align-middle text-wrap",
                "width": "35%"
            },
            {
                "title": "Banner",
                "data": "banner_source",
                "orderable": false,
                "className": "align-middle text-center",
                "render": function (data, type, row) {
                    if (data) {
                        return '<img src="' + base_url + data + '" class="img-thumbnail" style="max-width: 120px; max-height: 60px; object-fit: cover;">';
                    }
                    return '<span class="text-muted">Tidak ada gambar</span>';
                }
            },
            {
                "title": "Aksi",
                "data": "id",
                "orderable": false,
                "className": "align-middle text-center",
                "render": function (data, type, row) {
                    return `
                        <button class="btn btn-danger btn-sm btn-delete" data-id="${data}">
                            <i class="icofont icofont-trash"></i> Hapus
                        </button>
                    `;
                },
                "width": "15%"
            }
        ]
    });
}

function loadProdukTable() {
    if ($.fn.DataTable.isDataTable('#table-lpproduk')) {
        tableLpProduk.destroy();
    }

    tableLpProduk = $('#table-lpproduk').DataTable({
        "processing": true,
        "responsive": true,
        // "scrollX": true,
        // "autoWidth": false,
        "ajax": {
            "url": base_url + 'LpConfig/get_produk',
            "type": "GET"
        },
        "columns": [
            {
                "title": "No",
                "data": null,
                "className": "text-center align-middle",
                "orderable": false,
                "render": function (data, type, row, meta) {
                    return meta.row + 1;
                },
                "width": "5%"
            },
            {
                "title": "Nama Produk",
                "data": "produk_name",
                "className": "align-middle",
                "orderable": false,
                "width": "20%"
            },
            {
                "title": "Harga",
                "data": "produk_price",
                "className": "align-middle",
                "orderable": false,
                "render": function (data) {
                    return 'Rp ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                },
                "width": "15%"
            },
            {
                "title": "Deskripsi",
                "data": "produk_desc",
                "className": "align-middle",
                "orderable": false,
                "width": "20%"
            },
            {
                "title": "WA Desc",
                "data": "wa_desc",
                "orderable": false,
                "className": "align-middle",
                "width": "20%"
            },
            {
                "title": "Gambar",
                "data": "produk_img",
                "className": "text-center align-middle",
                "orderable": false,
                "render": function (data) {
                    if (data) {
                        return '<img src="' + base_url + data + '" class="img-thumbnail" style="max-width: 80px; max-height: 80px; object-fit: cover;">';
                    }
                    return '<span class="text-muted">No Image</span>';
                },
                "width": "15%"
            },
            {
                "title": "Status",
                "data": "is_active",
                "className": "text-center align-middle",
                "orderable": false,
                "render": function (data) {
                    return data === 'yes' ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Non-Aktif</span>';
                },
                "width": "10%"
            },
            {
                "title": "Aksi",
                "data": "id",
                "className": "text-center align-middle",
                "orderable": false,
                "render": function (data) {
                    return `
                        <button class="btn btn-danger btn-sm btn-delete-produk" data-id="${data}">
                            <i class="icofont icofont-trash"></i> Hapus
                        </button>
                        <button class="btn btn-primary btn-sm btn-edit-produk" data-id="${data}">
                            <i class="icofont icofont-pencil"></i> Edit
                        </button>
                    `;
                },
                "width": "10%"
            }
        ]
    });
}

function loadConfigTable() {
    if ($.fn.DataTable.isDataTable('#table-lpconfig')) {
        tableLpConfig.destroy();
    }

    tableLpConfig = $('#table-lpconfig').DataTable({
        "processing": true,
        "responsive": true,
        "ajax": {
            "url": base_url + 'LpConfig/get_configs',
            "type": "GET"
        },
        "columns": [
            {
                "title": "Nama Config",
                "data": "cname",
                "className": "align-middle",
                "orderable": true,
                "width": "50%"
            },
            {
                "title": "Detail Config",
                "data": "cdetail",
                "className": "align-middle",
                "orderable": false,
                "width": "40%"
            },
            {
                "title": "Aksi",
                "data": "id",
                "className": "text-center align-middle",
                "orderable": false,
                "render": function (data) {
                    return `
                        <button class="btn btn-danger btn-sm btn-delete-config" data-id="${data}">
                            <i class="icofont icofont-trash"></i> Hapus
                        </button>
                    `;
                },
                "width": "10%"
            }
        ]
    });
}

$('#banner_image').change(function () {
    const file = this.files[0];

    if (!file) {
        $('#imagePreview').hide().attr('src', '');
        return;
    }

    const reader = new FileReader();

    reader.onload = function (e) {
        $('#imagePreview')
            .attr('src', e.target.result)
            .show();
    };

    reader.readAsDataURL(file);
});

$('#produk_image').change(function () {
    const file = this.files[0];

    if (!file) {
        $('#prdPreview').hide().attr('src', '');
        return;
    }

    const reader = new FileReader();

    reader.onload = function (e) {
        $('#prdPreview')
            .attr('src', e.target.result)
            .show();
    };

    reader.readAsDataURL(file);
});

$('#btnAddBanner').click(function (e) {
    e.preventDefault();

    var bannerName = $('#banner_name').val();
    var bannerFile = $('#banner_image')[0].files[0];

    if (!bannerName) {
        swal("Warning", "Nama banner harus diisi!", "warning");
        return;
    }

    if (!bannerFile) {
        swal("Warning", "File banner harus dipilih!", "warning");
        return;
    }

    var formData = new FormData();
    formData.append('banner_name', bannerName);
    formData.append('banner_file', bannerFile);

    $.ajax({
        url: base_url + 'LpConfig/insert_banner',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            $('#btnAddBanner').prop('disabled', true).text('Menyimpan...');
        },
        success: function (response) {
            $('#btnAddBanner').prop('disabled', false).text('Tambah Banner');
            if (response.status) {
                swal("Success", response.message, "success").then(() => {
                    $('#banner_name').val('');
                    $('#banner_image').val('');
                    $('#imagePreview').hide().attr('src', '');
                    loadBannersTable();
                });
            } else {
                swal("Gagal", response.message, "error");
            }
        },
        error: function (xhr, status, error) {
            $('#btnAddBanner').prop('disabled', false).text('Tambah Banner');
            swal("Gagal", "Terjadi kesalahan pada server: " + error, "error");
        }
    });
});

$('#table-lpbanner').on('click', '.btn-delete', function (e) {
    e.preventDefault();
    var id = $(this).data('id');

    swal({
        title: 'Apa anda yakin?',
        text: 'Banner yang sudah terhapus hilang permanen!',
        icon: 'warning',
        buttons: ["Batal", "Ya, Hapus!"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url + 'LpConfig/delete_banner/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        swal("Terhapus!", response.message, "success");
                        loadBannersTable();
                    } else {
                        swal("Gagal!", response.message, "error");
                    }
                },
                error: function (xhr, status, error) {
                    swal("Error!", "Terjadi kesalahan pada server.", "error");
                }
            });
        }
    });
});

// Toggle between input and textarea for Detail Config
$('input[name="inputTypeSwitch"]').change(function() {
    if ($(this).val() === 'input') {
        $('#inputContainer').show();
        $('#textareaContainer').hide();
        $('#detail_config_textarea').val('');
    } else {
        $('#inputContainer').hide();
        $('#textareaContainer').show();
        $('#detail_config_input').val('');
    }
});

//produk tab
function resetProdukForm() {
    $('#produk_id').val('');
    $('#produk_name').val('');
    $('#produk_price').val('');
    $('#produk_description').val('');
    $('#wa_desc').val('');
    $('#produk_image').val('');
    $('#prdPreview').hide().attr('src', '');
    $('#btnAddProduk').text('Tambah Produk');
    $('#btnCancelProduk').hide();
}

$('#btnCancelProduk').click(function () {
    resetProdukForm();
});

$('#table-lpproduk').on('click', '.btn-edit-produk', function (e) {
    e.preventDefault();
    var id = $(this).data('id');

    $.ajax({
        url: base_url + 'LpConfig/get_produk_by_id/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (!response.status) {
                swal("Gagal", response.message, "error");
                return;
            }

            var produk = response.data;
            $('#produk_id').val(produk.id);
            $('#produk_name').val(produk.produk_name);
            $('#produk_price').val(String(produk.produk_price).replace(/\B(?=(\d{3})+(?!\d))/g, "."));
            $('#produk_description').val(produk.produk_desc);
            $('#wa_desc').val(produk.wa_desc);
            $('#produk_image').val('');

            if (produk.produk_img) {
                $('#prdPreview').attr('src', base_url + produk.produk_img).show();
            } else {
                $('#prdPreview').hide().attr('src', '');
            }

            $('#btnAddProduk').text('Update Produk');
            $('#btnCancelProduk').show();
            $('html, body').animate({ scrollTop: $('#produk_name').offset().top - 100 }, 300);
        },
        error: function () {
            swal("Error!", "Terjadi kesalahan pada server.", "error");
        }
    });
});

$('#btnAddProduk').click(function (e) {
    e.preventDefault();

    var produkId = $('#produk_id').val();
    var produkFile = $('#produk_image')[0].files[0];

    if (!$('#produk_name').val() || !$('#produk_price').val()) {
        swal("Warning", "Mohon lengkapi Nama dan Harga Produk!", "warning");
        return;
    }

    if (!produkId && !produkFile) {
        swal("Warning", "Mohon pilih Gambar Produk!", "warning");
        return;
    }

    var formData = new FormData();
    formData.append('produk_name', $('#produk_name').val());
    formData.append('produk_price', $('#produk_price').val().replace(/[^0-9]/g, ''));
    formData.append('produk_desc', $('#produk_description').val());
    formData.append('wa_desc', $('#wa_desc').val());

    if (produkFile) {
        formData.append('produk_file', produkFile);
    }

    var url = 'LpConfig/insert_produk';
    if (produkId) {
        formData.append('produk_id', produkId);
        url = 'LpConfig/update_produk';
    }

    $.ajax({
        url: base_url + url,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            $('#btnAddProduk').prop('disabled', true).text('Menyimpan...');
        },
        success: function (response) {
            $('#btnAddProduk').prop('disabled', false);
            if (response.status) {
                swal("Success", response.message, "success").then(() => {
                    resetProdukForm();
                    loadProdukTable();
                });
            } else {
                $('#btnAddProduk').text(produkId ? 'Update Produk' : 'Tambah Produk');
                swal("Gagal", response.message, "error");
            }
        },
        error: function () {
            $('#btnAddProduk').prop('disabled', false).text(produkId ? 'Update Produk' : 'Tambah Produk');
            swal("Gagal", "Terjadi kesalahan pada server.", "error");
        }
    });
});

$('#table-lpproduk').on('click', '.btn-delete-produk', function (e) {
    e.preventDefault();
    var id = $(this).data('id');

    swal({
        title: 'Apa anda yakin?',
        text: 'Produk yang sudah terhapus hilang permanen!',
        icon: 'warning',
        buttons: ["Batal", "Ya, Hapus!"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url + 'LpConfig/delete_produk/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        swal("Terhapus!", response.message, "success");
                        loadProdukTable();
                    } else {
                        swal("Gagal!", response.message, "error");
                    }
                },
                error: function () {
                    swal("Error!", "Terjadi kesalahan pada server.", "error");
                }
            });
        }
    });
});

//config tab
$('#btnAddConfig').click(function (e) {
    e.preventDefault();

    var cname = $('#config_name').val();
    var inputType = $('input[name="inputTypeSwitch"]:checked').val();
    var cdetail = inputType === 'input' ? $('#detail_config_input').val() : $('#detail_config_textarea').val();

    if (!cname || !cdetail) {
        swal("Warning", "Mohon isi Nama Config dan Detail Config!", "warning");
        return;
    }

    $.ajax({
        url: base_url + 'LpConfig/insert_config',
        type: 'POST',
        data: {
            cname: cname,
            cdetail: cdetail
        },
        dataType: 'json',
        beforeSend: function () {
            $('#btnAddConfig').prop('disabled', true).text('Menyimpan...');
        },
        success: function (response) {
            $('#btnAddConfig').prop('disabled', false).text('Tambah Config');
            if (response.status) {
                swal("Success", response.message, "success").then(() => {
                    $('#config_name').val('');
                    $('#detail_config_input').val('');
                    $('#detail_config_textarea').val('');
                    loadConfigTable();
                });
            } else {
                swal("Gagal", response.message, "error");
            }
        },
        error: function () {
            $('#btnAddConfig').prop('disabled', false).text('Tambah Config');
            swal("Gagal", "Terjadi kesalahan pada server.", "error");
        }
    });
});

$('#table-lpconfig').on('click', '.btn-delete-config', function (e) {
    e.preventDefault();
    var id = $(this).data('id');

    swal({
        title: 'Apa anda yakin?',
        text: 'Konfigurasi yang sudah terhapus hilang permanen!',
        icon: 'warning',
        buttons: ["Batal", "Ya, Hapus!"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url + 'LpConfig/delete_config/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        swal("Terhapus!", response.message, "success");
                        loadConfigTable();
                    } else {
                        swal("Gagal!", response.message, "error");
                    }
                },
                error: function () {
                    swal("Error!", "Terjadi kesalahan pada server.", "error");
                }
            });
        }
    });
});
