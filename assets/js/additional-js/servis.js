var tableSRV;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
var monthNames = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];
$(document).ready(function() {
    tablesrv();
    modalsView();
});
function tablesrv() {
    if ($.fn.DataTable.isDataTable('#table-servis')) {
        tableSRV.destroy();
    }
    tableSRV = $("#table-servis").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [1, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'servis/tableservis',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            { "data": "sn_brg" },
            { 
                "data" : "no_imei",
                "render": function (data, type, row) {
                    return data ? data : '<span class="text-muted">Tidak ada IMEI</span>';
                }
            },
            { "data": "nama_brg" },
            { "data": "merk" },
            { "data": "id_masuk",
                "render": function (data, type, row) {
                    return `
                        <ul class="action">
                            <li class="delete">
                                <button class="btn servis-button" type="button" data-action="add" data-bs-toggle="modal" data-bs-target="#modalsView"><i class="fa fa-gear"></i></button>
                            </li>
                            <li class="edit">
                                <button class="btn selesai-button" type="button" data-id="${data}"><i class="icofont icofont-ui-check"></i></button>
                            </li>
                            <li class="delete">
                                <button class="btn" type="button" data-action="detail" data-bs-toggle="modal" data-bs-target="#modalsView"><i class="fa fa-info-circle"></i></button>
                            </li>
                        </ul>
                    `;
                },
                "orderable": false
            },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-4'B>>" +
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
                    tableSRV.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Laporan Servis',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]
            
    });
    // $('#table-pengecekan tbody').on('click', 'td.dt-expand', function (e) {
    //     let tr = e.target.closest('tr');
    //     let row = tableCD.row(tr);

    //     if (row.child.isShown()) {
    //         row.child.hide();
    //     } else {
    //         row.child('<div class="loading-detail">Loading detail...</div>').show();
    //         loadRowDetails(row, row.data());
    //     }
    // });
    // return tableCD;
}
function loadRowDetails(row, data) {
    $.ajax({
        url: base_url + 'pengecekan/tabledetailcekdata/' + data.no_fm,
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            if (response.data && Array.isArray(response.data) && response.data.length > 0) {
                let html = `
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>SN Barang</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="detail-pengecekan">
                                ${response.data.map(item => `
                                    <tr>
                                        <td>${item.nama_brg.trim()}</td>
                                        <td>${item.sn_brg}</td>
                                        <td><input class="form-control ket-input" style="width: 90%;" id="${item.id_masuk}" type="text"></td>
                                        <td>
                                            <div class="form-check radio radio-primary ps-0">
                                                <ul class="radio-wrapper">
                                                    <li> 
                                                        <input class="form-check-input" id="acc_${item.id_masuk}" data-id="${item.id_masuk}" type="radio" name="status_${item.id_masuk}" value="1">
                                                        <label class="form-check-label" for="acc_${item.id_masuk}"><i class="fa fa-check"></i><span>Terima</span></label>
                                                    </li>
                                                    <li> 
                                                        <input class="form-check-input" id="dcl_${item.id_masuk}" data-id="${item.id_masuk}" type="radio" name="status_${item.id_masuk}" value="2">
                                                        <label class="form-check-label" for="dcl_${item.id_masuk}"><i class="fa fa-times"></i><span>Tolak</span></label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-primary save-button">Simpan</button>
                    </div>
                `;
                row.child(html).show();

                // Only bind event AFTER row details have been shown
                row.child().find('.save-button').on('click', function () {
                    var dataCek = [];
                    row.child().find('#detail-pengecekan tr').each(function () {
                        const $row = $(this);
                        const checked = $row.find('input[type="radio"]:checked');
                        const ket = $row.find('.ket-input').val();
                        const id = checked.data('id');
                        if (checked.length > 0) {
                            dataCek.push({
                                id: id,
                                status: checked.val(),
                                ket: ket
                            });
                        }
                    });
                    $.ajax({
                        url: base_url + 'pengecekan/addItem',
                        type: 'POST',
                        data: { dataCek: dataCek },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                swal("Berhasil", {
                                    icon: "success",
                                    buttons: false,
                                    timer: 1000
                                });
                                tableCD.ajax.reload();
                            } else {
                                swal("Gagal", {
                                    icon: "error",
                                    buttons: false,
                                    timer: 1000
                                });
                            }
                        },
                        error: function () {
                            alert('Error occurred while saving data.');
                        }
                    });
                });

            } else {
                row.child('<div class="alert alert-warning">No detail data found.</div>').show();
            }
        },
        error: function () {
            row.child('<div class="alert alert-danger">Failed to load details.</div>').show();
        }
    });
}
function modalsView() {
    $(document).on('click', '[data-bs-toggle="modal"][data-bs-target="#modalsView"]', function () {
        const action = $(this).data('action');
        const $row = $(this).closest('tr');
        const rowData = tableSRV.row($row).data(); 

        const $modal = $('#modalsView');
        const $title = $modal.find('#titleMod');
        const $body = $modal.find('.modal-body');
        const $footer = $modal.find('.modal-footer');

        $body.html('<div class="text-center">Loading...</div>');

        switch (action) {
            case 'add':
                $title.text('Tambah Detail Servis');
                $body.html(`
                    <form class="row g-3" id="form-data" method="post">
                        <div class="col-md-6">
                            <label for="sn_brg" class="form-label">SN Barang</label>
                            <input type="text" class="form-control" readonly id="sn_brg" name="sn_brg" value="${rowData.sn_brg}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" readonly id="nama_barang" name="nama_barang" value="${rowData.nama_brg}" readonly>
                        </div>
                        <div class="col-md-12">
                            <label for="sel_srv" class="form-label">Item Servis</label>
                            <select class="form-select" id="sel_srv" name="sel_srv"></select>
                        </div>
                        <div class="order-history table-responsive wishlist">
                            <table class="table table-bordered" id="table-item" width="100%">
                                <thead>
                                    <tr>
                                        <th>SN Item</th>
                                        <th>Item</th>
                                        <th>Merk</th>
                                        <th>Jenis</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="list-item">
                                    <tr class="empty-row" style="display: table-row;">
                                        <td colspan="5" style="text-align:center; color: #888;">Tidak ada item</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                    </form>
                `);
                $body.find('#sel_srv').select2({
                    language: 'id',
                    dropdownParent: $modal,
                    width: '100%',
                    placeholder: 'Pilih Item Servis',
                    ajax: {
                        url: base_url + 'servis/getItemServis',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                searchTerm: params.term // search term
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: $.map(data, function (item) {
                                    return {
                                        id: item.id_masuk,
                                        text: item.sn_brg + ' | ' + item.nama_brg,
                                        merk: item.merk,
                                        jenis: item.jenis
                                    };
                                }),
                            };
                        },
                        cache: false
                    }
                })
                    .on('select2:select', function (e) {
                        const selectedData = e.params.data;
                        const itemId = selectedData.id;
                        const itemText = selectedData.text;
                        const itemMerk = selectedData.merk || '';
                        const itemJenis = selectedData.jenis || '';
                        $('#list-item .empty-row').hide();
                        // Check if the item already exists in the table
                        if ($('#list-item tr[data-id="' + itemId + '"]').length === 0) {
                            $('#list-item').append(`
                                <tr data-id="${itemId}"">
                                    <td>${itemText.split(' | ')[0]}</td>
                                    <td>${itemText.split(' | ')[1]}</td>
                                    <td>${itemMerk}</td>
                                    <td>${itemJenis}</td>
                                    <td style="cursor: pointer;"><i class="icon-trash"></i></td>
                                </tr>
                            `);
                        } else {
                            swal("Item sudah ada di daftar.", {
                                icon: "warning",
                                buttons: false,
                                timer: 1000
                            });
                        }
                    }
                );
                $body.find('#list-item').on('click', 'i.icon-trash', function () {
                    $(this).closest('tr').remove();

                    // Check if tbody is empty (no rows with data-id)
                    if ($('#list-item tr[data-id]').length === 0) {
                        $('#list-item .empty-row').show();
                    }
                });
                $footer.html(`
                        <button type="submit" id="submitBtn" class="btn btn-primary">
                            <span id="spinner_submitBtn" class="spinner-border spinner-border-sm text-light d-none" role="status" aria-hidden="true"></span>
                            <span id="tx_submitBtn">Simpan</span>
                        </button>
                `);
                $footer.find('#submitBtn').on('click', function (e) {
                    e.preventDefault();
                    const $this = $(this);
                    const $spinner = $this.find('#spinner_submitBtn');
                    const $text = $this.find('#tx_submitBtn');
                    const items = [];
                    $('#list-item tr[data-id]').each(function () {
                        items.push({
                            id: $(this).data('id')
                        });
                    });
                    var formData = new FormData($('#form-data')[0]);
                    formData.append('items', JSON.stringify(items));
                    formData.append('keterangan', $('#keterangan').val());

                    $spinner.removeClass('d-none');
                    $text.addClass('d-none');

                    // To display FormData contents in console:
                    // for (let pair of formData.entries()) {
                    //     console.log(pair[0]+ ':', pair[1]);
                    // }
                    for (var pair of formData.entries()) {
                        console.log(pair[0]+ ': ' + pair[1]);
                    }


                    $.ajax({
                        url: base_url + 'servis/addDetailServis',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        processData: false, // <-- wajib agar FormData tidak diproses jadi query string
                        contentType: false, 
                        success: function (response) {
                            if (response.status === 'success') {
                                swal("Berhasil", {
                                    icon: "success",
                                    buttons: false,
                                    timer: 1000
                                });
                                tableSRV.ajax.reload();
                                $modal.modal('hide');
                            } else {
                                swal("Gagal", response.message, {
                                    icon: "error",
                                    buttons: false,
                                    timer: 1000
                                });
                            }
                        },
                        error: function () {
                            swal("Error", "Terjadi kesalahan saat menyimpan data.", {
                                icon: "error",
                                buttons: false,
                                timer: 1000
                            });
                        },
                        complete: function () {
                            $spinner.addClass('d-none');
                            $text.removeClass('d-none');
                        }
                    });
                });
                break;
            case 'detail':
                $title.text('Detail List Servis');
				$body.html(`
                    <form class="row g-3" id="form-detail-item" method="post">
                        <div class="col-md-6">
                            <label for="sn_brg" class="form-label">SN Barang</label>
                            <input type="text" class="form-control" readonly id="sn_brg" name="sn_brg" value="${rowData.sn_brg}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" readonly id="nama_barang" name="nama_barang" value="${rowData.nama_brg}" readonly>
                        </div>
                        <div class="order-history table-responsive wishlist">
                            <table class="table table-bordered" id="table-detail-item" width="100%">
                                <thead>
                                    <tr>
                                        <th>SN Item</th>
                                        <th>Item</th>
                                        <th>Merk</th>
                                        <th>Jenis</th>
                                    </tr>
                                </thead>
                                <tbody id="list-detail-item">
                                    <tr class="empty-row" style="display: table-row;">
                                        <td colspan="5" style="text-align:center; color: #888;">Tidak ada item</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" readonly id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>
                    </form>
                `);
                $body.find('#list-detail-item').empty();
                $.ajax({
                    url: base_url + 'servis/tabledetailservis/' + rowData.id_masuk,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        const items = response.data;
                        if (items.length > 0) {
                            $('#list-detail-item .empty-row').hide();
                            items.forEach(item => {
                                $('#list-detail-item').append(`
                                    <tr data-id="${item.id_masuk}">
                                        <td>${item.sn_item}</td>
                                        <td>${item.item}</td>
                                        <td>${item.merk}</td>
                                        <td>${item.jenis}</td>
                                    </tr>
                                `);
                            });
                            $('#keterangan').val(items[0].keterangan || '');
                        }
                    },
                    error: function () {
                        swal("Error", "Terjadi kesalahan saat memuat detail servis.", {
                            icon: "error",
                            buttons: false,
                            timer: 1000
                        });
                    }
                });
                $footer.html(`
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                `);
                break;
            default:
                $title.text('Servis');
                $body.html('<p>Invalid action.</p>');
        }
    });
}