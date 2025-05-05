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
                "render": function (data, type, full, meta) {
                    if (type === "display") {
                        return `
                                <ul class="action">
                                    <div class="btn-group">
                                        <button class="btn btn-success" data-id="${data}" data-bs-toggle="modal" data-bs-target="#CariBarang">Unit <i class="fa fa-plus"></i></button>
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
            // {
            //     "data": "kode_penjualan",
            //     "orderable": false,
            //     "render": function (data, type, full, meta) {
            //         if (type === "display") {
            //             return `
            //                     <ul class="action">
            //                         <div class="btn-group">
            //                             <button class="btn btn-primary" 
            //                             data-id="${data}" data-total="${full.total}" data-idksr="${full.id_ksr}"
            //                             data-sales="${full.nama_ksr}" data-hj="${full.total_harga_jual}" data-dis="${full.total_diskon}" 
            //                             data-cb="${full.total_cb}" data-lb="${full.total_laba}" data-cst="${full.nama_plg}" data-tb="${full.cara_bayar}" 
            //                             data-btf="${full.bank_tf}" data-nr="${full.no_rek}" data-tn="${full.tunai}" data-status="${full.status}"
            //                             data-bnk="${full.bank}" data-krd="${full.kredit}" data-toko="${full.nama_toko}" data-tgltr="${full.tgl_transaksi}"
            //                             data-jasa="${full.jasa}" data-jasanom="${full.jml_donasi}"
            //                             data-bs-toggle="modal" data-bs-target="#DetailLapPenjualan" title="detail penjualan"><i class="fa fa-exclamation-circle"></i></button>
            //                         </div>
            //                     </ul>
            //                 `;
            //         }
            //         return data;
            //     }
            // }      
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
    return tableCD;
}