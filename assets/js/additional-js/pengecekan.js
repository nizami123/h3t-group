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
            // { 
            //     "data": "harga_beli",
            //     "render": function (data, type, row) {
            //         return formatcur.format(data);
            //     }
            // },
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
                            return `<span class="badge rounded-pill badge-warning">BATAL</span>`;
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
									<th style="width: 30%;">Nama Barang</th>
									<th style="width: 15%;">Jumlah</th>
									<th style="width: 15%;">Qty</th>
                                    <th style="width: 40%;">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								${response.data.map(item => `
									<tr>
										<td>${item.nama_brg.trim()}</td>
										<td>${item.jumlah}</td>
                                        <td><input class="form-control qty-input" style="width: 90%;" id="${item.id_masuk}" type="number"></td>
                                        <td><input class="form-control ket-input" style="width: 90%;" id="${item.id_masuk}" type="text"></td>
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
			} else {
				row.child('<div class="alert alert-warning">No detail data found.</div>').show();
			}
		},
		error: function () {
			row.child('<div class="alert alert-danger">Failed to load details.</div>').show();
		}
	});
    // addCekItem(row);
    $('#table-pengecekan tbody').on('click', '.save-button', function () {
        let qty = $(this).closest('tr').find('.qty-input').val();
        let ket = $(this).closest('tr').find('.ket-input').val();
        let id = $(this).closest('tr').find('.qty-input').attr('id');
        $.ajax({
            url: base_url + 'pengecekan/addItem',
            type: 'POST',
            data: {
                id: id,
                qty: qty,
                ket: ket
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    alert('Data saved successfully!');
                    tableCD.ajax.reload();
                } else {
                    alert('Failed to save data.');
                }
            },
            error: function () {
                alert('Error occurred while saving data.');
            }
        });
    });
}
// function addCekItem($this) {
//     let id = $this.attr('data-id');
//     let qty = $this.closest('tr').find('.qty-input').val();
//     let ket = $this.closest('tr').find('.ket-input').val();
//     $.ajax({
//         url: base_url + 'pengecekan/addCekItem',
//         type: 'POST',
//         data: {
//             id: id,
//             qty: qty,
//             ket: ket
//         },
//         success: function (response) {
//             if (response.status === 'success') {
//                 alert('Data saved successfully!');
//                 tableCD.ajax.reload();
//             } else {
//                 alert('Failed to save data.');
//             }
//         },
//         error: function () {
//             alert('Error occurred while saving data.');
//         }
//     });
// }