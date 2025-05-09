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
                "data": "harga_beli",
                "render": function (data, type, row) {
                    return formatcur.format(data);
                }
            },
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
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nama Barang</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								${response.data.map(item => `
									<tr>
										<td>${item.nama_brg.trim()}</td>
										<td>${item.jumlah}</td>
										<td>${formatcur.format(item.harga)}</td>
										<td>${formatcur.format(item.total)}</td>
									</tr>
								`).join('')}
							</tbody>
						</table>
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
}
