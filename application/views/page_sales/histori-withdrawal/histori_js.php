<script>
    // $(document).ready(function() {
    //     var table;

    //     table = $('#data-histori-withdrawal').DataTable({
    //         "paging": true,
    //         "autoWidth": true,
    //         "searching": true, // Corrected property name from "search" to "searching"
    //         "responsive": true,
    //         "processing": false,
    //         "serverSide": true,
    //         "ajax": {
    //             "url": "<?= site_url('Histori_withdrawal/get_histori_withdrawal') ?>",
    //             "type": "POST",
    //         },
    //     });

    //     // Use delegated event handling for dynamically loaded elements
    function action_view_detail() {

        $('.btn-no-wd').click(function() {

            $('.nominal').text($(this).data('nominal'));
            $('.biaya').text($(this).data('biaya'));
            $('.total').text($(this).data('total'));
            $.ajax({
                url: "<?php echo base_url(); ?>Histori_withdrawal/detail_withdrawal_event",
                method: "POST",
                data: {
                    event_id: $(this).data('id-event'),
                    no_wd: $(this).data('no-wd'),
                },
                cache: false,
                dataType: "json", // Expect JSON response
                success: function(response) {
                    let html = ''; // Initialize HTML variable
                    $.each(response.events, function(index, trans) {
                        html += '<tr>';
                        html += '<td>' + trans.nm_event + '</td>';
                        html += '<td>' + trans.count + '</td>';
                        html += '<td>Rp. ' + trans.nominal + '</td>';
                        html += '</tr>';
                    });

                    // Update event details
                    $('#load-detail-withdrawal').html(html);

                    // Update bank details
                    $('#bank').text(response.bank_nm);
                    $('#atas-nama').text(response.rekening_an);
                    $('#no-rekening').text(response.rekening_no);
                }
            });
        });
    }
    // });
    $(document).ready(function() {
        function loadTransaksi(value) {
            $.ajax({
                url: "<?= site_url('Histori_withdrawal/get_histori_withdrawal') ?>", // Ganti dengan URL endpoint Anda
                type: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.data && response.data.length > 0) {
                        // $('#transaksiList').empty(); // Kosongkan daftar sebelum memuat ulang

                        $.each(response.data, function(index, item) {
                            var listItem = `
                           <li class="row li-list p-2 mb-3 btn-no-wd" data-no-wd="${item.no_wd}" data-id-event="${item.event_id}" data-nominal="${item.nominal_transaksi}" data-biaya="${item.biaya_transaksi}" data-total="${item.total_transaksi}"  data-toggle="modal" data-target="#exampleModalCenter">
                                <div class="align-content-around col-2 pl-0">
                                    <span class="bg-border-span">${item.no}</span>
                                </div>
                                <div class="col p-0 align-content-center">
                                    <h6 class="mb-0 font-weight-bold">${item.no_wd}</h6>
                                    <span class="small border-radius-gray"><i class="bi bi-calendar4-week"></i> ${item.tgl_pembayaran}</span>
                                </div>
                                <div class="align-content-center align-right col p-0">
                                    <span class="span-price-2">Rp.${item.total_transaksi}</span>
                                </div>
                            </li>
                        `;
                            $('#historiList').append(listItem);

                        });
                    } else {
                        $('#historiList').html('<li class="row li-list p-2 pl-4 mb-3 text-center">Tidak ada data tersedia</li>');
                    }
                    action_view_detail();
                },
                error: function() {
                    $('#historiList').html('<li class="list-group-item text-center text-danger">Gagal memuat data</li>');
                }
            });
        }

        // Panggil fungsi untuk memuat data
        loadTransaksi();
    });
</script>