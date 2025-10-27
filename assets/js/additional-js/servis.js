var tableSRV;
var tableListServis;
var formatcur = new Intl.NumberFormat('id-ID', {
    style: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 0
});
function formatDateIndo(dateString) {
	const date = new Date(dateString);
	const day = String(date.getDate()).padStart(2, "0");
	const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	const month = months[date.getMonth()];
	const year = date.getFullYear();
	return `${day} ${month} ${year}`;
}
$(document).ready(function() {
    tablesrv();
    tablelistservis();
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
			{
				"data": "id_masuk",
				"render": function (data, type, row) {
					let html = `
						<ul class="action">
							<li class="delete">
								<button class="btn servis-button" type="button" data-action="add" data-bs-toggle="modal" data-bs-target="#modalsView">
									<i class="fa fa-gear"></i>
								</button>
							</li>
					`;
			
					if (userRole === 'OWNER' || userRole === 'QC') {
						html += `
							<li class="edit">
								<button class="btn selesai-button" type="button" data-id="${data}">
									<i class="icofont icofont-ui-check"></i>
								</button>
							</li>
						`;
					}
			
					html += `
							<li class="delete">
								<button class="btn" type="button" data-action="detail" data-bs-toggle="modal" data-bs-target="#modalsView">
									<i class="fa fa-info-circle"></i>
								</button>
							</li>
						</ul>
					`;
			
					return html;
				},
				"orderable": false
			}
			
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
    $('#table-servis tbody').on('click', 'button.selesai-button', function () {
        var id_masuk = $(this).data('id');
        swal({
            title: "Konfirmasi",
            text: "Apakah Anda yakin ingin untuk approve?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: base_url + 'servis/approveData',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: id_masuk },
                    success: function (response) {
                        if (response.status === 'success') {
                            swal("Berhasil", {
                                icon: "success",
                                buttons: false,
                                timer: 1000
                            });
                            tableSRV.ajax.reload();
                        } else {
                            swal("Gagal", response.message, {
                                icon: "error",
                                buttons: false,
                                timer: 1000
                            });
                        }
                    },
                    error: function () {
                        swal("Error", "Terjadi kesalahan saat menyelesaikan servis.", {
                            icon: "error",
                            buttons: false,
                            timer: 1000
                        });
                    }
                });
            }
        });
    }
    );
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
                        <div class="col-md-4">
                            <label for="sn_brg" class="form-label">SN Barang</label>
                            <input type="text" class="form-control" readonly id="sn_brg" name="sn_brg" value="${rowData.sn_brg}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" readonly id="nama_barang" name="nama_barang" value="${rowData.nama_brg}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="tgl_servis" class="form-label">Tanggal Servis</label>
                            <input type="date" class="form-control" id="tgl_servis" name="tgl_servis" required>
                        </div>
                        <div class="col-md-8">
                            <label for="sel_srv" class="form-label">Item Servis</label>
                            <select class="form-select" id="sel_srv" name="sel_srv"></select>
                        </div>
                        <div class="col-md-4">
                            <label for="sel_mekanik" class="form-label">Pilih Teknisi</label>
                            <select class="form-select" id="sel_mekanik" name="sel_mekanik" required></select>
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
                        <div class="col-md-12">
                            <label for="nominal" class="form-label">Nominal Servis Total</label>
                            <input type="text" class="form-control" id="nominal" name="nominal" onkeyup="formatRupiah(this)" required>
                        </div>
                    </form>
                `);
				$body.find('#sel_mekanik').select2({
                    language: 'id',
                    dropdownParent: $modal,
                    width: '100%',
                    placeholder: 'Pilih Item Servis',
                    ajax: {
                        url: base_url + 'servis/getTeknisiServis',
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
                                        id: item.id_user,
                                        text: item.nama_lengkap,
                                    };
                                }),
                            };
                        },
                        cache: false
                    }
                });
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
										<th>Tanggal</th>
										<th>Total Jasa</th>
										<th>Teknisi</th>
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
                                        <td>${formatDateIndo(item.tgl_servis)}</td>
                                        <td>${formatcur.format(item.nominal_teknisi)}</td>
                                        <td>${item.nama_lengkap}</td>
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
// NEW SERVIS
function tablelistservis() {
    if ($.fn.DataTable.isDataTable('#table-listservis')) {
        tableListServis.destroy();
    }
    function format(d) {
        let html = `
            <div class="table-responsive">
                <table class="table table-sm table-bordered mb-0" style="width: 100%; text-transform: uppercase;">
                    <thead>
                        <tr>
                            <th class="fw-bold text-center" colspan="2"><h6 class="f-w-600">DETAIL SERVIS</h6></th>
                        </tr>
                    </thead>
                    <tbody>`;

        // --- DETAIL SERVIS ---
        try {
            const servisItems = JSON.parse(d.data_servis);
            servisItems.forEach(item => {
                html += `<tr>
                            <td style="width: 50%;" class="fw-bold">${item.key}</td>
                            <td style="width: 50%;">${item.value}</td>
                        </tr>`;
            });
        } catch (e) {
            html += `<tr><td colspan="2">Invalid format</td></tr>`;
        }

        html += `
                    <tr class="${d.status !== 'Cancel User' && d.status !== 'Cancel Teknisi' ? 'd-none' : ''}">
                        <td class="fw-bold txt-danger">KETERANGAN CANCEL</td>
                        <td class="txt-danger">${d.keterangan_cancel || '-'}</td>
                    </tr>
                </tbody>
            </table>
        </div>`;

        // --- DATA CHECKER SECTION ---
        if (d.data_checker && d.data_checker.trim() !== '' && d.data_checker !== 'null') {
            try {
                const checker = JSON.parse(d.data_checker);

                html += `
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-bordered mb-0" style="width: 100%; text-transform: uppercase;">
                        <thead>
                            <tr>
                                <th class="fw-bold text-center" colspan="2"><h6 class="f-w-600">CHECKER</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold">Tanggal Checker</td>
                                <td>${checker.tgl_checker || '-'}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">PIC Checker</td>
                                <td>${checker.pic_checker || '-'}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Dibuat Oleh</td>
                                <td>${checker.id_user_create || '-'}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Dibuat Pada</td>
                                <td>${checker.created_at || '-'}</td>
                            </tr>`;

                if (checker.data_checker && Array.isArray(checker.data_checker)) {
                    html += `<tr><td class="text-center fw-bold" colspan="2"><h6 class="f-w-600">Detail Checker</h6></td></tr>`;
                    checker.data_checker.forEach(item => {
                        html += `
                            <tr>
                                <td style="width: 50%;" class="fw-bold">${item.key}</td>
                                <td style="width: 50%;">${item.value}</td>
                            </tr>`;
                    });
                }

                html += `
                        </tbody>
                    </table>
                </div>`;
            } catch (e) {
                html += `<div class="text-danger mt-2">Invalid JSON format for data_checker</div>`;
            }
        } else {
            html += `
                <div class="table-responsive mt-3">
                    <table class="table table-sm table-bordered mb-0" style="width: 100%; text-transform: uppercase;">
                        <thead>
                            <tr>
                                <th class="fw-bold text-center" colspan="2"><h6 class="f-w-600">CHECKER</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-center text-muted">Belum ada data checker</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            `;
        }

        return html;
    }
    tableListServis = $("#table-listservis").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [2, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'Servis/tableservis',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            {
                data: "control", // ✅ important to avoid search bug
                className: "dt-control text-center",
                orderable: false,
                searchable: false,
                defaultContent: '<i class="fa fa-caret-right text-primary fs-5"></i>',
                width: "30px",
                title: "E"
            },
            {
                data: "id",
                orderable: false,
                searchable: false,
                title: "A",
                className: "text-center align-middle",
                render: function (data, type, row) {
                    // Status-based visibility logic
                    const status = row.status || "";
                    const hEdit = (status==="Pengecekan" || status==="Proses Servis" || status === "Cancel User" || status === "Cancel Teknisi" || status === "Finish") ? "d-none" : "";
                    const hDelete = (status === "Cancel User" || status === "Cancel Teknisi" || status==="Pengecekan" || status === "Finish" || status === "Proses Servis") ? "d-none" : "";
                    const hCek = (status === "Proses Servis" || status === "Finish" || status === "Cancel User" || status === "Cancel Teknisi") ? "d-none" : "";
                    const hCancel = (status === "Finish" || status === "Cancel User" || status === "Cancel Teknisi") ? "d-none" : "";
                    const hFinish = (status==="Finish" || status === "Belum Proses" || status==="Pengecekan" || status==="Cancel User"|| status==="Cancel Teknisi") ? "d-none" : "";
                    const hProses = (status==="Proses Servis" || status==="Finish" || status==="Cancel User"|| status==="Cancel Teknisi" || status==="Belum Proses") ? "d-none" : "";
                    return `
                        <div class="btn-group" role="group">
                            <button 
                                type="button" 
                                class="btn btn-sm btn-primary dropdown-toggle" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false"
                            >
                                <i class="fa fa-bars"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <a class="dropdown-item ${hEdit} edit-servis-tab" href="#" data-id="${data}">
                                        <i class="fa fa-edit text-primary me-2"></i>Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item ${hDelete} delete-servis-tab" href="#" data-id="${data}">
                                        <i class="fa fa-trash text-danger me-2"></i>Delete
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item ${hCek} cek-servis-tab" href="#" data-id="${data}">
                                        <i class="fa fa-eye text-warning me-2"></i>Pengecekan
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item ${hCancel} cancel-servis-tab" href="#" data-id="${data}">
                                        <i class="fa fa-times text-danger me-2"></i>Cancel
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item ${hProses} proses-servis-tab" href="#" data-id="${data}">
                                        <i class="fa fa-cog text-info me-2"></i>Proses Servis
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item ${hFinish} finish-servis-tab" href="#" data-id="${data}">
                                        <i class="fa fa-check text-success me-2"></i>Finish
                                    </a>
                                </li>
                            </ul>
                        </div>
                    `;
                }
            },
            { "data": "servis_id", "title" : "Servis ID" },
            { "data": "tgl_servis", "title" : "Tanggal Diterima",
                "render": function (data, type, row) {
                    return formatDateIndo(data);
                }
            },
            { "data": "barang", "title" : "Barang Servis", orderable: false, },
            { "data": "nama_pelanggan", "title" : "Customer", orderable: false, },
            { "data": "toko_penerima", "title" : "Cabang", orderable: false, },
            { "data": "pic_penerima", "title" : "Penerima", orderable: false, },
            { "data": "status", "title" : "Status Servis",
                "render": function (data, type, row) {
                    let badgeClass = 'badge bg-secondary';
                    let statusText = 'Unknown';

                    switch (data) {
                        case 'Belum Proses':
                            badgeClass = 'badge bg-warning text-dark';
                            statusText = 'Belum Proses';
                            break;
                        case 'Pengecekan':
                            badgeClass = 'badge bg-primary';
                            statusText = 'Pengecekan';
                            break;
                        case 'Proses Servis':
                            badgeClass = 'badge bg-info text-dark';
                            statusText = 'Proses Servis';
                            break;
                        case 'Finish':
                            badgeClass = 'badge bg-success';
                            statusText = 'Finish';
                            break;
                        case 'Cancel User':
                            badgeClass = 'badge bg-danger';
                            statusText = 'Cancel User';
                            break;
                        case 'Cancel Teknisi':
                            badgeClass = 'badge bg-danger';
                            statusText = 'Cancel Teknisi';
                            break;

                    }

                    return `<span class="${badgeClass}">${statusText}</span>`;
                }
            },
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                "<'row'<'col-sm-12 col-md-4'B>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
        "buttons": [
            {
                "text": '<i class="icofont icofont-refresh"></i>',
                "className": 'custom-refresh-button',
                "attr": {
                    "id": "refresh-button"
                },
                "init": function (api, node, config) {
                    $(node).removeClass('btn-default');
                    $(node).addClass('btn-primary');
                    $(node).attr('title', 'Refresh');
                },
                "action": function () {
                    tableListServis.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="icofont icofont-download-alt"></i>',
                className: 'btn btn-success',
                init: function (api, node, config) {
                    $(node).attr('title', 'Export to Excel');
                },
                title: 'List Servis',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            },
            {
                "text": '<i class="icofont icofont-papers"></i>',
                "className": 'custom-template-button',
                "attr": {
                    "id": "template-button"
                },
                "init": function (api, node, config) {
                    $(node).removeClass('btn-default');
                    $(node).addClass('btn-primary');
                    $(node).attr('title', 'Refresh');
                },
                "action": function () {
                    // tableListServis.ajax.reload();
                }
            },
            {
                text: `
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Tambah List Servis
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item add-servis-tab" href="#" data-type="baru">Form Servis Customer</a></li>
                            <li><a class="dropdown-item add-servis-tab" href="#" data-type="lainnya">Form Servis Supplier</a></li>
                        </ul>
                    </div>
                `,
                tag: 'span', // 👈 prevent DataTables from wrapping with <button>
                className: 'custom-add-button',
                attr: { id: 'add-button' },
                init: function (api, node, config) {
                    // remove DataTables button styling
                    $(node)
                        .removeClass('dt-button')
                        .addClass('btn btn-primary btn-sm')
                        .css({
                            padding: 0,
                            border: 'none',
                            background: 'none'
                        });
                }
            }
        ]
    });
    $('#table-listservis tbody').off('click', 'td.dt-control').on('click', 'td.dt-control', function () {
        const tr = $(this).closest('tr');
        const row = tableListServis.row(tr);
        const icon = $(this).find('i');

        if (row.child.isShown()) {
            // 🔽 Close the expanded row
            row.child.hide();
            tr.removeClass('shown');
            icon.removeClass('fa-caret-down text-danger')
                .addClass('fa-caret-right text-primary');
        } else {
            // 🔼 Close any others first (optional)
            // $('#table-listservis tbody tr.shown').each(function() {
            //     const otherRow = tableListServis.row($(this));
            //     otherRow.child.hide();
            //     $(this)
            //         .removeClass('shown')
            //         .find('td.dt-control i')
            //         .removeClass('fa-caret-down text-danger')
            //         .addClass('fa-caret-right text-primary');
            // });

            // 🔽 Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
            icon.removeClass('fa-caret-right text-primary')
                .addClass('fa-caret-down text-danger');
        }
    });
    return tableListServis;
}
$(document).on('click', '.add-servis-tab', function (e) {
    e.preventDefault();
    var type = $(this).data('type');
    addServisTab(type);
});
$(document).on('click', '.edit-servis-tab', function (e) {
    e.preventDefault();
    const rowData = tableListServis.row($(this).closest('tr')).data(); // Get full row data
    editServisTab(rowData);
});
$(document).on('click', '.delete-servis-tab', function (e) {
    e.preventDefault();
    const servisId = $(this).data('id');
    deleteServis(servisId);
});
$(document).on('click', '.cancel-servis-tab', function (e) {
    e.preventDefault();
    const servisId = $(this).data('id');
    cancelServis(servisId);
});
$(document).on('click', '.cek-servis-tab', function (e) {
    e.preventDefault();
    const rowData = tableListServis.row($(this).closest('tr')).data();
    pengecekanServis(rowData);
});
$(document).on('click', '.proses-servis-tab', function (e) {
    e.preventDefault();
    const servisId = $(this).data('id');
    prosesServis(servisId);
});
$(document).on('click', '.finish-servis-tab', function (e) {
    e.preventDefault();
    const servisId = $(this).data('id');
    finishServis(servisId);
});
function prosesServis(id) {
    
}
function pengecekanServis(data) {
    const id = data.id;
    const newTabId = 'cservis-' + id;
    const existingTab = document.getElementById(`${newTabId}-tab`);
    if (existingTab) {
        // If tab exists, just show it and return
        const tabTrigger = new bootstrap.Tab(existingTab);
        tabTrigger.show();
        return;
    }
    const itemsServis = JSON.parse(data.data_servis || '[]');
    const itemsChecker = JSON.parse(data.data_checker || '[]');
    const newTab = `
        <li class="nav-item" id="li-${newTabId}">
            <a class="nav-link txt-primary py-2 d-inline-flex align-items-center gap-1" 
               id="${newTabId}-tab" data-bs-toggle="tab"
               href="#${newTabId}" role="tab" aria-controls="${newTabId}" aria-selected="false">
                <i class="fa fa-eye"></i> 
                <span>Pengecekan Form SV-${id}</span>
                <button class="btn-pill btn-sm btn-outline-danger border border-danger close-tab" 
                        data-tab="#${newTabId}" title="Tutup tab">
                    <i class="ms-2 fa fa-times"></i>
                </button>
            </a>
        </li>
    `;
        // 🔹 Create tab content
    const newTabContent = `
        <div class="tab-pane fade" id="${newTabId}" role="tabpanel" aria-labelledby="${newTabId}-tab">
            <div class="mt-2">
                <form id="form-cservis-${newTabId}" class="row g-3">
                    <div class="col-12">
                        <table class="table table-bordered" id="table-cekservis${newTabId}">
                            <tbody>
                                <tr>
                                    <td class="fw-bold text-center" colspan="2"><h6 class="f-w-600">INFORMASI CUSTOMER</h6></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Customer</td>
                                    <td>${data.nama_pelanggan}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">No Telepon</td>
                                    <td>${data.no_ponsel}</td>
                                </tr>                                
                                <tr>
                                    <td class="fw-bold">Alamat</td>
                                    <td>${data.alamat}</td>
                                </tr>                                
                                <tr>
                                    <td class="fw-bold text-center" colspan="2"><h6 class="f-w-600">DETAIL SERVIS</h6></td>
                                </tr>
                                ${itemsServis.map(item => `
                                    <tr>
                                        <td class="fw-bold">${item.key}</td>
                                        <td>${item.value}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex align-items-center my-2">
                        <hr class="flex-grow-1 border-2 border-secondary opacity-50">
                        <span class="mx-3 text-muted fw-semibold">DATA CHECKER</span>
                        <hr class="flex-grow-1 border-2 border-secondary opacity-50">
                    </div>                    
                    <div class="col-6 my-0">
                        <label class="form-label">Tanggal Checker</label>
                        <input type="date" class="form-control" id="ctgl_checker${newTabId}" value="${itemsChecker.tgl_checker || ''}" required>
                    </div>
                    <div class="col-6 my-0">
                        <label class="form-label">PIC Checker</label>
                        <input type="text" class="form-control" id="cpic_checker${newTabId}" value="${itemsChecker.pic_checker || ''}" required>
                    </div>
                    <div class="col-12 position-relative mt-4">
                        <button type="button" id="add-itemc${newTabId}" class="btn btn-warning w-100" title="untuk menambahkan detail data checker di tabel data checker"><i class="fa fa-plus-square"></i> Tambahkan Detail Data Checker</button>
                    </div>
                    <div class="col-12 position-relative">
                        <table class="table table-bordered" id="temp-tablec${newTabId}" width="100%">
                            <thead class="table-secondary">
                                <tr>
                                <th style="width:40%">Item</th>
                                <th style="width:50%">Detail</th>
                                <th style="width:10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${(itemsChecker.data_checker && Array.isArray(itemsChecker.data_checker) && itemsChecker.data_checker.length > 0) ? itemsChecker.data_checker.map((item, index) => `
                                    <tr data-item-id="${index + 1}">
                                        <td><input type="text" class="form-control" name="item_namec${index + 1}" value="${item.key}" placeholder="Ganti RAM / Ganti Processor" required></td>
                                        <td><input type="text" class="form-control" name="item_detailc${index + 1}" value="${item.value}" placeholder="Kisaran Harga / atau detail lainnya" required></td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-pill" role="group" aria-label="Basic outlined example">
                                                <button class="btn btn-outline-warning" id="copy-row${newTabId}" type="button"><i class="fa fa-arrow-down"></i></button>
                                                <button class="btn btn-outline-danger remove-row${newTabId}" type="button"><i class="fa fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                `).join('') : `
                                    <tr class="no-data">
                                        <td colspan="3" style="text-align:center; color: #888;" class="text-muted">Tidak ada detail data checker</td>
                                    </tr>
                                `}
                            </tbody>
                        </table>
                    </div>                    
                    <div class="col-6">
                        <button type="button" id="btnchecker${newTabId}" class="btn btn-outline-primary">
                            Proses Checker
                        </button>
                    </div>
                </form>
            </div>
        </div>
    `;

    // 🔹 Append tab & content to DOM
    $('#servis-tab').append(newTab);
    $('#icon-tabContent').append(newTabContent);

    // 🔹 Activate the new tab
    const newTabTrigger = new bootstrap.Tab(document.getElementById(`${newTabId}-tab`));
    newTabTrigger.show();

    // 🔹 Handle close tab
    $(document).on('click', `#li-${newTabId} .close-tab`, function (e) {
        e.stopPropagation();
        const tabId = $(this).data('tab').replace('#', '');
        if ($(`#${tabId}`).hasClass('active')) $('#servis-tab a:first').tab('show');
        $(`#li-${tabId}`).remove();
        $(`#${tabId}`).remove();
    });
    //date picker jakarta
    const jakartaDate = dayjs().tz("Asia/Jakarta").format("YYYY-MM-DD");
    $(`#ctgl_checker${newTabId}`).val(jakartaDate);
    // Add item checker
    let itemCounterC = 0;
    $(`#add-itemc${newTabId}`).on('click', function () {
        itemCounterC++;
        const newRow = `
            <tr data-item-id="${itemCounterC}">
                <td><input type="text" class="form-control" name="item_namec${itemCounterC}" placeholder="Ganti RAM / Ganti Processor" required></td>
                <td><input type="text" class="form-control" name="item_detailc${itemCounterC}" placeholder="Kisaran Harga / atau detail lainnya" required></td>
                <td class="text-center">
                    <div class="btn-group btn-group-pill" role="group" aria-label="Basic outlined example">
                        <button class="btn btn-outline-warning" id="copy-row${newTabId}" type="button"><i class="fa fa-arrow-down"></i></button>
                        <button class="btn btn-outline-danger remove-row${newTabId}" type="button"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `;
        $(`#temp-tablec${newTabId} tbody .no-data`).remove();
        $(`#temp-tablec${newTabId} tbody`).append(newRow);
    });
    // Remove item checker
    $(document).on('click', `.remove-row${newTabId}`, function () {
        $(this).closest('tr').remove();
        if ($(`#temp-tablec${newTabId} tbody tr`).length === 0) {
            $(`#temp-tablec${newTabId} tbody`).append(`
                <tr class="no-data">
                    <td colspan="3" style="text-align:center; color: #888;" class="text-muted">Tidak ada detail data checker</td>
                </tr>
            `);
        }
    });
        // Copy row
    $(document).on('click', '#copy-row'+newTabId, function () {
        const $tableBody = $('#temp-table'+newTabId+' tbody');
        const rowCount = $tableBody.find('tr').length;

        if (rowCount >= 10) {
            alert('Maksimum 10 item yang dapat ditambahkan.');
            return; // stop adding new rows
        }

        const $currentRow = $(this).closest('tr');
        const $clonedRow = $currentRow.clone();

        // Clear input values in the cloned row
        $clonedRow.find('input').val('');

        $currentRow.after($clonedRow);
    });
    // Proses Checker
    $(`#btnchecker${newTabId}`).on('click', function () {
        const checkerItems = [];
        $(`#temp-tablec${newTabId} tbody tr`).each(function () {
            const itemName = $(this).find('input[name^="item_namec"]').val();
            const itemDetail = $(this).find('input[name^="item_detailc"]').val();
            if (itemName && itemDetail) {
                checkerItems.push({
                    key: itemName,
                    value: itemDetail
                });
            }
        });
        const tgl_checker = $(`#ctgl_checker${newTabId}`).val();
        const pic_checker = $(`#cpic_checker${newTabId}`).val();

        if (checkerItems.length === 0) {
            return swal("Harap tambahkan minimal satu detail data checker.", "", "error");
        }
        const payload = {
            tgl_checker: tgl_checker,
            pic_checker: pic_checker,
            items_checker: checkerItems
        };
        
        $.ajax({
            url: base_url + 'Servis/prosesChecker/' + id,
            type: 'POST',
            data: JSON.stringify(payload),
            contentType: 'application/json',
            dataType: 'json',
            beforeSend: function () {
                $('#btnchecker' + newTabId).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            },
            success: function (response) {
                if (response.status === "success") {
                    swal(response.message, {
                        icon: "success",
                        buttons: false,
                        timer: 1000
                    });
                    tableListServis.ajax.reload(null, false);
                    $(`#li-${newTabId} .close-tab`).click();
                } else {
                    swal(response.message, {
                        icon: "error",
                        buttons: false,
                        timer: 1000
                    });
                }
            },
            error: function () {
                swal("Error!", "Terjadi kesalahan koneksi.", "error");
            }
        });
    });
}
function cancelServis(id) {
    swal({
    title: "Batalkan Servis?",
    text: "Silakan pilih jenis pembatalan.",
    icon: "warning",
    buttons: {
        cancelUser: {
            text: "Cancel User",
            value: "Cancel User",
            className: "btn-cancel-user"
        },
        cancelTeknisi: {
            text: "Cancel Teknisi",
            value: "Cancel Teknisi",
            className: "btn-cancel-teknisi"
        }
    },
    dangerMode: true
    }).then((choice) => {
        if (!choice || choice === "cancel") return;

        swal("Masukkan keterangan "+choice, {
            content: "input",
        }).then((keterangan) => {
            if (!keterangan) return swal("Harus diisi!", "", "error");

            $.ajax({
                url: base_url + 'Servis/cancelServis/' + id,
                type: 'POST',
                data: {
                    keterangan_cancel: keterangan,
                    cu: choice === "Cancel User",
                    ct: choice === "Cancel Teknisi"
                },
                dataType: 'json',
                success: function (res) {
                    if (res.status === "success") {
                        swal(res.message, {
                            icon: "success",
                            buttons: false,
                            timer: 1000
                        });
                        tableListServis.ajax.reload(null, false);
                    } else {
                        swal(res.message, {
                            icon: "error",
                            buttons: false,
                            timer: 1000
                        });
                    }
                },
                error: function () {
                    swal("Error!", "Terjadi kesalahan koneksi.", "error");
                }
            });
        });
    });
    $(".swal-footer").css({
        "display": "flex",
        "justify-content": "center",
        "align-items": "center",
        "gap": "10px"
    });
}
function deleteServis(id) {
    swal({
        title: "Apakah Anda yakin?",
        text: "Data servis yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: base_url + 'Servis/deleteServis/' + id,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        swal("Berhasil", {
                            icon: "success",
                            buttons: false,
                            timer: 1000
                        });
                        tableListServis.ajax.reload();
                    } else {
                        swal("Gagal", {
                            icon: "error",
                            buttons: false,
                            timer: 1000
                        });
                    }
                },
                error: function () {
                    alert('Error occurred while deleting data.');
                }
            });
        }
    });
}
function editServisTab(data) {
    const id = data.id;
    const newTabId = 'servis-' + id;
    const existingTab = document.getElementById(`${newTabId}-tab`);
    if (existingTab) {
        // If tab exists, just show it and return
        const tabTrigger = new bootstrap.Tab(existingTab);
        tabTrigger.show();
        return;
    }
    // 🔹 Create tab header
    const newTab = `
        <li class="nav-item" id="li-${newTabId}">
            <a class="nav-link txt-primary py-2 d-inline-flex align-items-center gap-1" 
               id="${newTabId}-tab" data-bs-toggle="tab"
               href="#${newTabId}" role="tab" aria-controls="${newTabId}" aria-selected="false">
                <i class="fa fa-edit"></i> 
                <span>Edit Form SV-${id}</span>
                <button class="btn-pill btn-sm btn-outline-danger border border-danger close-tab" 
                        data-tab="#${newTabId}" title="Tutup tab">
                    <i class="ms-2 fa fa-times"></i>
                </button>
            </a>
        </li>
    `;

    // 🔹 Create tab content
    const newTabContent = `
        <div class="tab-pane fade" id="${newTabId}" role="tabpanel" aria-labelledby="${newTabId}-tab">
            <div class="mt-2">
                <form id="form-eservis-${newTabId}" class="row g-3">

                    <div class="col-4">
                        <label class="form-label">Tanggal Form Servis</label>
                        <input type="date" class="form-control" id="etgl_servis${newTabId}" 
                               value="${data.tgl_servis || ''}" required>
                    </div>

                    <div class="col-4">
                        <label class="form-label">Nama Customer</label>
                        <input type="text" class="form-control" id="enama_cst${newTabId}" 
                               value="${data.nama_pelanggan || ''}" required>
                    </div>

                    <div class="col-4">
                        <label class="form-label">No Telpon Customer</label>
                        <input type="text" class="form-control" id="eno_telp${newTabId}" 
                               oninput="formatPhoneNumber(this)" value="${data.no_ponsel || ''}" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Alamat Customer</label>
                        <input type="text" class="form-control" id="ealamat_cst${newTabId}" 
                               value="${data.alamat || ''}" required>
                    </div>

                    <div class="col-6">
                        <label class="form-label">Cabang Penerima</label>
                        <select class="form-select" id="escabang${newTabId}" name="escabang${newTabId}" required></select>
                    </div>

                    <div class="col-6">
                        <label class="form-label">PIC Penerima</label>
                        <input type="text" class="form-control" id="epic_penerima${newTabId}" 
                               value="${data.pic_penerima || ''}">
                    </div>

                    <div class="d-flex align-items-center my-2">
                        <hr class="flex-grow-1 border-2 border-secondary opacity-50">
                        <span class="mx-3 text-muted fw-semibold">DATA SERVIS</span>
                        <hr class="flex-grow-1 border-2 border-secondary opacity-50">
                    </div>

                    <div class="col-12">
                        <button type="button" id="eadd-item${newTabId}" 
                                class="btn btn-warning w-100 mb-2">
                            <i class="fa fa-plus-square"></i> Tambahkan Detail Data Servis
                        </button>
                    </div>

                    <div class="col-12">
                        <table class="table table-bordered" id="temp-table${newTabId}">
                            <thead class="table-secondary">
                                <tr>
                                    <th style="width:40%">Item</th>
                                    <th style="width:50%">Detail</th>
                                    <th style="width:10%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${renderServisTableRows(data.data_servis)}
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6">
                        <button type="button" id="btnedit${newTabId}" class="btn btn-outline-primary">
                            Edit Form
                        </button>
                    </div>

                </form>
            </div>
        </div>
    `;

    // 🔹 Append tab & content to DOM
    $('#servis-tab').append(newTab);
    $('#icon-tabContent').append(newTabContent);

    // 🔹 Activate the new tab
    const newTabTrigger = new bootstrap.Tab(document.getElementById(`${newTabId}-tab`));
    newTabTrigger.show();

    // 🔹 Handle close tab
    $(document).on('click', `#li-${newTabId} .close-tab`, function (e) {
        e.stopPropagation();
        const tabId = $(this).data('tab').replace('#', '');
        if ($(`#${tabId}`).hasClass('active')) $('#servis-tab a:first').tab('show');
        $(`#li-${tabId}`).remove();
        $(`#${tabId}`).remove();
    });
    //add row data servis
    $(document).off('click', '#eadd-item' + newTabId).on('click', '#eadd-item' + newTabId, function () {
        const $tableBody = $('#temp-table'+newTabId+' tbody');
        const rowCount = $tableBody.find('tr').length;

        if (rowCount >= 10) {
            alert('Maksimum 10 item yang dapat ditambahkan.');
            return; // stop adding new rows
        }

        $tableBody.find('.no-data').remove();

        const newRow = `
            <tr>
                <td><input type="text" class="form-control item-key" placeholder="Nama Barang / RAM / SSD"></td>
                <td><input type="text" class="form-control item-value" placeholder="Contoh: ASUS TUF / 16GB / 1TB"></td>
                <td class="text-center">
                    <div class="btn-group btn-group-pill" role="group" aria-label="Basic outlined example">
                        <button class="btn btn-outline-warning copy-row" type="button"><i class="fa fa-arrow-down"></i></button>
                        <button class="btn btn-outline-danger remove-row" type="button"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `;

        $tableBody.append(newRow);
    });
    // Copy row
    $(document).off('click', '#temp-table' + newTabId + ' .copy-row').on('click', '#temp-table' + newTabId + ' .copy-row', function () {
        const $tableBody = $('#temp-table'+newTabId+' tbody');
        const rowCount = $tableBody.find('tr').length;

        if (rowCount >= 10) {
            alert('Maksimum 10 item yang dapat ditambahkan.');
            return; // stop adding new rows
        }

        const $currentRow = $(this).closest('tr');
        const $clonedRow = $currentRow.clone();

        // Clear input values in the cloned row
        $clonedRow.find('input').val('');

        $currentRow.after($clonedRow);
    });
    // Delete row
    $(document).off('click', '#temp-table' + newTabId + ' .remove-row').on('click', '.remove-row', function () {
        const $tableBody = $('#temp-table'+newTabId+' tbody');
        $(this).closest('tr').remove();

        // If no rows left, add "no data" message
        if ($tableBody.find('tr').length === 0) {
            $tableBody.append(`
                <tr class="no-data">
                    <td colspan="3" style="text-align:center; color: #888;" class="text-muted">Tidak ada detail data servis</td>
                </tr>
            `);
        }
    });
    $('#escabang'+newTabId).select2({
        language: 'id',
        placeholder: 'Pilih Cabang',
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
                            // id_total: item.id_toko
                        };
                    }),
                };
            },
            cache: false,
            dropdownParent: $('#'+newTabId),
        },
    });
    if (data.id_cabang && data.toko_penerima) {
        $('#escabang'+newTabId).append('<option value="' + data.id_cabang + '" selected>' + data.toko_penerima + '</option>').trigger('change');
    }
    // 🔹 Handle Edit Button
    $(document).on('click', '#btnedit' + newTabId, function () {
        const form = $('#form-eservis-' + newTabId);
        const id = data.id;
        const id_plg = data.id_pelanggan;
        const nama_cst = $('#enama_cst' + newTabId).val();
        const no_telp = $('#eno_telp' + newTabId).val();
        const alamat_cst = $('#ealamat_cst' + newTabId).val();
        const tgl_servis = $('#etgl_servis' + newTabId).val();
        const scabang = $('#escabang' + newTabId).val();
        const pic_penerima = $('#epic_penerima' + newTabId).val();

        // Collect table data_servis items
        const items = [];
        $('#temp-table' + newTabId + ' tbody tr').each(function () {
            const key = $(this).find('.item-key').val();
            const value = $(this).find('.item-value').val();
            if (key || value) {
                items.push({ key, value });
            }
        });
        
        if (items.length === 0) {
            swal("Data servis tidak boleh kosong!", {
                icon: "warning",
                buttons: false,
                timer: 1000
            });
            return;
        }

        // Validation
        if (!tgl_servis) {
            swal("Tanggal servis wajib diisi!", {
                icon: "warning",
                buttons: false,
                timer: 1000
            });
            return;
        }
        if (!scabang) {
            swal("Cabang penerima wajib dipilih!", {
                icon: "warning",
                buttons: false,
                timer: 1000
            }); 
            return;
        }

        // Prepare data to send
        const payload = {
            id,
            id_plg,
            nama_cst,
            no_telp,
            alamat_cst,
            tgl_servis,
            scabang,
            pic_penerima,
            items
        };

        // AJAX call
        $.ajax({
            url: base_url + 'Servis/updateServis/' + id,
            method: 'POST',
            data: JSON.stringify(payload),
            contentType: 'application/json',
            dataType: 'json',
            beforeSend: function () {
                $('#btnedit' + newTabId).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            },
            success: function (response) {
                if (response.status === 'success') {
                    swal("Form servis berhasil dirubah", {
                        icon: "success",
                        buttons: false,
                        timer: 1000
                    });
                    tableListServis.ajax.reload(null, false); // reload silently
                    // Optionally, close the tab after saving
                    $(`#li-${newTabId} .close-tab`).click();
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
                // Re-enable button and hide spinner
                $('#btnedit' + newTabId).prop('disabled', false).html('<i class="fa fa-save"></i> Edit Form');
            }
        });
    });
}
function renderServisTableRows(jsonString) {
    // Handle empty or null JSON safely
    if (!jsonString) {
        return `
            <tr class="no-data">
                <td colspan="3" class="text-center text-muted">Tidak ada detail data servis</td>
            </tr>
        `;
    }

    let html = "";

    try {
        const items = JSON.parse(jsonString);

        // Handle empty arrays
        if (!Array.isArray(items) || items.length === 0) {
            return `
                <tr class="no-data">
                    <td colspan="3" class="text-center text-muted">Tidak ada detail data servis</td>
                </tr>
            `;
        }

        // Generate editable rows
        items.forEach((item, index) => {
            html += `
                <tr>
                    <td><input type="text" class="form-control item-key" value="${item.key || ''}" placeholder="Nama Barang / RAM / SSD"></td>
                    <td><input type="text" class="form-control item-value" value="${item.value || ''}" placeholder="Contoh: ASUS TUF / 16GB / 1TB"></td>
                    <td class="text-center">
                        <div class="btn-group btn-group-pill" role="group">
                            <button class="btn btn-outline-warning copy-row" type="button"><i class="fa fa-arrow-down"></i></button>
                            <button class="btn btn-outline-danger remove-row" type="button"><i class="fa fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
            `;
        });

    } catch (err) {
        console.error("❌ Invalid JSON in data_servis:", err);
        html = `
            <tr>
                <td colspan="3" class="text-center text-muted">Format data_servis tidak valid</td>
            </tr>
        `;
    }

    return html;
}
function addServisTab(type) {
    // Generate unique ID for new tab
    var newTabId = 'servis-' + Date.now();
    
    // Create new tab with close button
    var newTab = `
        <li class="nav-item" id="li-${newTabId}">
            <a class="nav-link txt-primary py-2 d-inline-flex align-items-center gap-1" 
            id="${newTabId}-tab" data-bs-toggle="tab"
            href="#${newTabId}" role="tab" aria-controls="${newTabId}" aria-selected="false">
                <i class="fa fa-plus-circle"></i> 
                <span>${type === 'baru' ? 'Form Servis Customer' : 'Form Servis Supplier'}</span>
                <button class="btn-pill btn-sm btn-outline-danger border border-danger close-tab" data-tab="#${newTabId}" title="Tutup tab"><i class="ms-2 fa fa-times"></i></button>
            </a>
        </li>
    `;

    // Create new tab content
    var newTabContent = '';
    if (type === 'baru') {
        newTabContent = `
            <div class="tab-pane fade" id="${newTabId}" role="tabpanel" aria-labelledby="${newTabId}-tab">
                <div class="mt-2">
                    <form id="form-servis-${type}-${newTabId}" class="row g-3">
                        <div class="col-4 position-relative">
                            <label for="tgl_servis${newTabId}" class="form-label">Tanggal Form Servis</label>
                            <input type="date" class="form-control" id="tgl_servis${newTabId}" name="tgl_servis${newTabId}" required>
                        </div>
                        <div class="col-4 position-relative">
                            <label for="nama_cst${newTabId}" class="form-label">Nama Customer</label>
                            <input type="text" class="form-control" id="nama_cst${newTabId}" name="nama_cst${newTabId}" required>
                        </div>
                        <div class="col-4 position-relative">
                            <label for="no_telp${newTabId}" class="form-label">No Telpon Customer</label>
                            <input type="text" class="form-control" id="no_telp${newTabId}" oninput="formatPhoneNumber(this)" name="no_telp${newTabId}" required>
                        </div>
                        <div class="col-12 position-relative">
                            <label for="alamat_cst${newTabId}" class="form-label">Alamat Customer</label>
                            <input type="text" class="form-control" id="alamat_cst${newTabId}" name="alamat_cst${newTabId}" required>
                        </div>
                        <div class="col-6 position-relative">
                            <label for="scabang${newTabId}" class="form-label">Cabang Penerima</label>
                            <select class="form-select" id="scabang${newTabId}" name="scabang${newTabId}" required></select>
                        </div>
                        <div class="col-6 position-relative">
                            <label for="pic_penerima${newTabId}" class="form-label">PIC Penerima</label>
                            <input type="text" class="form-control" id="pic_penerima${newTabId}" name="pic_penerima${newTabId}" required>
                        </div>
                        <div class="d-flex align-items-center my-2">
                            <hr class="flex-grow-1 border-2 border-secondary opacity-50">
                            <span class="mx-3 text-muted fw-semibold">DATA SERVIS</span>
                            <hr class="flex-grow-1 border-2 border-secondary opacity-50">
                        </div>
                        <div class="col-12 position-relative mt-0">
                            <button type="button" id="add-item${newTabId}" class="btn btn-warning w-100" title="untuk menambahkan detail data servis di tabel data servis"><i class="fa fa-plus-square"></i> Tambahkan Detail Data Servis</button>
                        </div>
                        <div class="col-12 position-relative">
                            <table class="table table-bordered" id="temp-table${newTabId}" width="100%">
                                <thead class="table-secondary">
                                    <tr>
                                    <th style="width:40%">Item</th>
                                    <th style="width:50%">Detail</th>
                                    <th style="width:10%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="no-data">
                                        <td colspan="3" style="text-align:center; color: #888;" class="text-muted">Tidak ada detail data servis</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6 position-relative">
                            <button type="button" id="btnsave${newTabId}" class="btn btn-outline-primary">Simpan Form</button>
                        </div>
                    </form>
                </div>
            </div>
        `;
    } else {
        newTabContent = `
            <div class="tab-pane fade" id="${newTabId}" role="tabpanel" aria-labelledby="${newTabId}-tab">
                <div class="mt-2">
                    <form id="form-servis-${type}-${newTabId}" class="row g-3">
                        <div class="col-4 position-relative">
                            <label for="tgl_servis${newTabId}" class="form-label">Tanggal Form Servis</label>
                            <input type="date" class="form-control" id="tgl_servis${newTabId}" name="tgl_servis${newTabId}" required>
                        </div>
                    </form>
                </div>
            </div>
        `;
    }

    // Append the new tab and content
    $('#servis-tab').append(newTab);
    $('#icon-tabContent').append(newTabContent);

    // Activate the new tab
    var newTabTrigger = new bootstrap.Tab(document.getElementById(`${newTabId}-tab`));
    newTabTrigger.show();

    // Handle close button click
    $(document).on('click', `#li-${newTabId} .close-tab`, function (e) {
        e.stopPropagation();

        var targetTab = $(this).data('tab');
        var tabId = targetTab.replace('#', '');

        // If the closed tab is active, switch to the first tab
        if ($(`#${tabId}`).hasClass('active')) {
            $('#servis-tab a:first').tab('show');
        }

        // Remove tab and content
        $(`#li-${tabId}`).remove();
        $(`#${tabId}`).remove();
    });
    //add row data servis
    $(document).on('click', '#add-item' + newTabId, function () {
        const $tableBody = $('#temp-table'+newTabId+' tbody');
        const rowCount = $tableBody.find('tr').length;

        if (rowCount >= 10) {
            alert('Maksimum 10 item yang dapat ditambahkan.');
            return; // stop adding new rows
        }

        $tableBody.find('.no-data').remove();

        const newRow = `
            <tr>
                <td><input type="text" class="form-control item-key" placeholder="Nama Barang / RAM / SSD"></td>
                <td><input type="text" class="form-control item-value" placeholder="Contoh: ASUS TUF / 16GB / 1TB"></td>
                <td class="text-center">
                    <div class="btn-group btn-group-pill" role="group" aria-label="Basic outlined example">
                        <button class="btn btn-outline-warning" id="copy-row${newTabId}" type="button"><i class="fa fa-arrow-down"></i></button>
                        <button class="btn btn-outline-danger remove-row" type="button"><i class="fa fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        `;

        $tableBody.append(newRow);
    });
    // Copy row
    $(document).on('click', '#copy-row'+newTabId, function () {
        const $tableBody = $('#temp-table'+newTabId+' tbody');
        const rowCount = $tableBody.find('tr').length;

        if (rowCount >= 10) {
            alert('Maksimum 10 item yang dapat ditambahkan.');
            return; // stop adding new rows
        }

        const $currentRow = $(this).closest('tr');
        const $clonedRow = $currentRow.clone();

        // Clear input values in the cloned row
        $clonedRow.find('input').val('');

        $currentRow.after($clonedRow);
    });
    // Delete row
    $(document).on('click', '.remove-row', function () {
        const $tableBody = $('#temp-table'+newTabId+' tbody');
        $(this).closest('tr').remove();

        // If no rows left, add "no data" message
        if ($tableBody.find('tr').length === 0) {
            $tableBody.append(`
                <tr class="no-data">
                    <td colspan="3" style="text-align:center; color: #888;" class="text-muted">Tidak ada detail data servis</td>
                </tr>
            `);
        }
    });
    const jakartaDate = dayjs().tz("Asia/Jakarta").format("YYYY-MM-DD");
    $(`#tgl_servis${newTabId}`).val(jakartaDate);
    $('#scabang'+newTabId).select2({
        language: 'id',
        placeholder: 'Pilih Cabang',
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
                            // id_total: item.id_toko
                        };
                    }),
                };
            },
            cache: false,
        },
    });
    // Save form
    $(document).on('click', '#btnsave' + newTabId, function () {
        const $this = $(this);
        const $form = $('#form-servis-' + type + '-' + newTabId);
        const $spinner = $this.find('.spinner-border');
        const $text = $this.find('.btn-text');

        // Validate form fields
        if (!$form[0].checkValidity()) {
            $form[0].reportValidity();
            return;
        }

        // Collect data from the form
        const formData = {
            tgl_servis: $form.find('input[name="tgl_servis' + newTabId + '"]').val(),
            nama_cst: $form.find('input[name="nama_cst' + newTabId + '"]').val(),
            no_telp: $form.find('input[name="no_telp' + newTabId + '"]').val(),
            alamat_cst: $form.find('input[name="alamat_cst' + newTabId + '"]').val(),
            scabang: $form.find('select[name="scabang' + newTabId + '"]').val(),
            pic_penerima: $form.find('input[name="pic_penerima' + newTabId + '"]').val(),
            type_form: type,
            items: []
        };

        // Collect items from the table
        $('#temp-table' + newTabId + ' tbody tr').each(function () {
            const itemKey = $(this).find('.item-key').val().trim();
            const itemValue = $(this).find('.item-value').val().trim();
            if (itemKey && itemValue) {
                formData.items.push({ key: itemKey, value: itemValue });
            }
        });

        if (formData.items.length === 0) {
            alert('Silakan tambahkan minimal satu detail data servis.');
            return;
        }

        // Disable button and show spinner
        $this.prop('disabled', true);
        $spinner.removeClass('d-none');
        $text.addClass('d-none');

        // Send data via AJAX
        $.ajax({
            url: base_url + 'Servis/saveFormServis',
            type: 'POST',
            data: JSON.stringify(formData),
            contentType: 'application/json',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    swal("Form servis berhasil disimpan", {
                        icon: "success",
                        buttons: false,
                        timer: 1000
                    });
                    tableListServis.ajax.reload();
                    // Optionally, close the tab after saving
                    $(`#li-${newTabId} .close-tab`).click();
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
                // Re-enable button and hide spinner
                $this.prop('disabled', false);
                $spinner.addClass('d-none');
                $text.removeClass('d-none');
            }
        });
    });
}