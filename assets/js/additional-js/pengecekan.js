var tableCD;
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
    tablecd();
});
function tablecd() {
    if ($.fn.DataTable.isDataTable('#table-pengecekan')) {
        tableCD.destroy();
    }
    tableCD = $("#table-pengecekan").DataTable({
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>',
        },
        "serverSide": true,
        "order": [
            [1, 'desc'] 
        ],
        "ajax": {
            "url": base_url + 'pengecekan/tablecekdata',
            "type": "POST"
        },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "columns": [
            {
                "data": "no_fm",
                "orderable": false,
				"className": "dt-expand",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-id="${data}" >Unit <i class="fa fa-plus"></i></button>
                                    </div>
                                </ul>
                            `;
                    }
                    return data;
                }
            },
            { "data": "no_fm" },
            { 
                "data": "tanggal",
                "render": function (data, type, row) {
                    if (type === 'display' || type === 'filter') {
                        var date = new Date(data);
                        var day = ('0' + date.getDate()).slice(-2);
                        var month = monthNames[date.getMonth()];
                        var year = date.getFullYear();
                        var hours = ('0' + date.getHours()).slice(-2);
                        var minutes = ('0' + date.getMinutes()).slice(-2);
                        return `${day} ${month} ${year} <br><b>${hours}:${minutes}</b>`;
                    }
                    return data;
                }
            },
            { "data": "nama_supplier" },
            { "data": "alamat" },
            { 
                "data": "status_pem",
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        if(data ==="0"){
                            return `<span class="badge rounded-pill badge-danger">Belum Lunas</span>`;
                        }else if(data ==="1"){
                            return `<span class="badge rounded-pill badge-primary">DP</span>`;
                        } else if(data==="2"){
                            return `<span class="badge rounded-pill badge-success">LUNAS</span>`;
                        } else if(data==="3"){
                            return `<span class="badge rounded-pill badge-warning">INDENT</span>`;
                        } else if(data==="9"){
                            return `<span class="badge rounded-pill badge-warning">GESTUN</span>`;
                        }
                        return data; // return the original value for other cases
                    }
                    return data;
                }
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
                    tableCD.ajax.reload();
                }
            },
            {
                extend: 'excelHtml5', // Specify the Excel button
                text: 'Export', // Text for the button
                className: 'btn btn-success', // Add a class for styling
                title: 'Laporan Pengecekan',
                exportOptions: {
                    columns: ':visible:not(:last-child):not(:nth-last-child(1))'
                }
            }
        ]
            
    });
    $('#table-pengecekan tbody').on('click', 'td.dt-expand', function (e) {
        let tr = e.target.closest('tr');
        let row = tableCD.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
        } else {
            row.child('<div class="loading-detail">Loading detail...</div>').show();
            loadRowDetails(row, row.data());
        }
    });
    return tableCD;
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