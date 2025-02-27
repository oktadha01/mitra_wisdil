<script>
    $(document).ready(function() {
        // var table;

        // table = $('#data-transaksi').DataTable({
        //     "paging": false,
        //     "info": false,
        //     "autoWidth": true,
        //     "search": false,
        //     "responsive": true,
        //     "processing": false,
        //     "serverSide": true,
        //     "ajax": {
        //         "url": "<?= site_url('Withdrawal/get_datatransaksi') ?>",
        //         "type": "POST",
        //     },
        //     "dom": 'lrtip', // Hilangkan search box
        // })
        load_data_transaksi();
        load_data_transaksi_proses();

        // function toggleCheck(row) {
        //     // Find the checkbox within the clicked row
        //     var checkbox = row.querySelector('input[type="checkbox"]');

        //     // If the checkbox exists, toggle its checked state
        //     if (checkbox) {
        //         checkbox.checked = !checkbox.checked; // Toggle checkbox state
        //     }
        // }
    });

    function load_data_transaksi() {
        $.ajax({
            url: "<?php echo base_url(); ?>Withdrawal/get_data_transaksi",
            method: "POST",
            data: {
                // limit: limit,
                // start: start
            },
            cache: false,
            success: function(data) {
                $('#load-data-transaksi').html(data);
                ceklis_data();

            }
        });
    }

    function load_data_transaksi_proses() {
        $.ajax({
            url: "<?php echo base_url(); ?>Withdrawal/get_data_transaksi_proses",
            method: "POST",
            data: {
                // You can include limit and start if needed
            },
            cache: false,
            dataType: "json", // Expect JSON response
            success: function(data) {
                let html = ''; // Initialize HTML variable
                let totalKeseluruhan = 0; // Initialize total variable for all total_transaksi values

                // Loop through the JSON data
                $.each(data, function(index, trans) {
                    html += '<tr class="btn-no-wd" data-no-wd="' + trans.no_wd + '" data-id-event="' + trans.id_event + '" data-nominal="' + trans.nominal_transaksi + '" data-biaya="' + trans.biaya_transaksi + '" data-total="' + trans.total_transaksi + '" data-toggle="modal" data-target="#exampleModalCenter">';
                    html += '<td class="font-weight-bold">' + trans.no_wd + '</td>';
                    html += '<td>' + trans.tgl_pengajuan + '</td>';
                    html += '<td class="text-info">Rp. ' + trans.nominal_transaksi + '</td>';
                    html += '<td class="text-danger">Rp. ' + trans.biaya_transaksi + '</td>';
                    html += '<td class="text-success">Rp. ' + trans.total_transaksi + '</td>';
                    html += '</tr>';

                    // Accumulate the total_transaksi values
                    totalKeseluruhan += parseFloat(trans.total_transaksi); // Ensure values are treated as numbers
                });

                // Update the HTML with the accumulated total
                $('.total-proses-penarikan').html(totalKeseluruhan.toFixed(3)); // Format to 2 decimal places if needed

                // Insert the HTML for each transaction row into the table body
                $('#load-data-transaksi-proses').html(html);
                btn_detail_no_wd();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ', error); // Log error for debugging
            }
        });
    }

    // Variable to store the event IDs
    var eventIds = []; // Array to store the selected event IDs
    function ceklis_data() {
        // Initial conversion of the nominal value
        var nominal = parseInt($('.nominal').text().toString().replace(/\./g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ''), 10) || 0;
        var saldo = parseInt($('.saldo').text().toString().replace(/\./g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ''), 10) || 0;
        // Attach click event handler to the checkboxes
        $('.cheklis-send').click(function() {
            if ($('.cek-payment').text() !== 'valid') {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-info",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "There is no payment data!",
                    text: "Please complete the payment details",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonText: "Create payment data",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '<?php echo base_url('Profile'); ?>';

                    } else {

                    }
                });
                return false;
            }

            // Get the data('id-event') value
            var eventId = $(this).data('id-event');

            // Check if the checkbox is checked or not
            if ($(this).is(":checked")) {
                nominal += parseInt($(this).val(), 10); // Add value if checked
                saldo -= parseInt($(this).val(), 10); // Subtract value if unchecked
                eventIds.push(eventId); // Add the event ID to the array
            } else {
                nominal -= parseInt($(this).val(), 10); // Subtract value if unchecked
                saldo += parseInt($(this).val(), 10); // Subtract value if unchecked
                eventIds = eventIds.filter(id => id !== eventId); // Remove the event ID from the array
            }

            // Update the nominal display with formatted number
            $('.nominal').text(nominal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

            var total = nominal - parseInt(2775, 10); // Subtract value if unchecked
            if (total == '-2775') {
                total = '0';
                $('#btn-withdrawal').attr('disabled', true);
            } else {
                $('#btn-withdrawal').removeAttr('disabled', true);
            }
            $('.total').text(total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));

            $('.saldo').text(saldo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
            // Convert the eventIds array to a comma-separated string and log it (or do something with it)
            // console.log(eventIds.join(','));
        });

    }
    $('#btn-withdrawal').click(function() {
        if ($('.cek-payment').text() !== 'valid') {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-info",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "There is no payment data!",
                text: "Please complete the payment details",
                icon: "error",
                showCancelButton: true,
                confirmButtonText: "Create payment data",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo base_url('Profile'); ?>';

                } else {

                }
            });
            return false;
        }
        swal({
                title: "Apakah Anda yakin ingin melakukan penarikan dana?",
                text: "Proses penarikan akan dilakukan dalam waktu 1x24 jam setelah konfirmasi. Pastikan semua data sudah benar sebelum melanjutkan.",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Tampilkan pesan konfirmasi setelah user menekan tombol "OK"
                    swal("Permintaan penarikan dana Anda telah dikonfirmasi. Proses penarikan akan dilakukan dalam waktu 1x24 jam. Terima kasih atas kepercayaan Anda.", {
                        icon: "success",
                    }).then(() => {
                        // Panggil AJAX setelah pesan sukses ditutup
                        $.ajax({
                            url: "<?php echo base_url(); ?>Withdrawal/pengajuan",
                            method: "POST",
                            data: {
                                id_event: eventIds,
                            },
                            cache: false,
                            success: function(response) {
                                // Buka link WhatsApp di tab baru
                                load_data_transaksi();
                                load_data_transaksi_proses();
                                $('.nominal').text('');
                                $('.total').text('');
                                window.open(response, '_blank');
                            }
                        });
                    });
                } else {
                    swal("Penarikan dana dibatalkan. Anda dapat melakukan permintaan penarikan kapan saja sesuai kebutuhan Anda.");
                }
            });

    });

    $('.table-wd').removeAttr('hidden', true).hide();
    $('.menu-proses-penarikan').click(function() {
        $('.table-wd').toggle(150, function() {
            if ($(this).is(':visible')) {
                $('.menu-proses-penarikan').addClass('active');
            } else {
                $('.menu-proses-penarikan').removeClass('active');
            }
        });
    });


    $('.close-table-wd').click(function() {
        $('.table-wd').hide(150);
        $('.menu-proses-penarikan').removeClass('active');
    });

    function btn_detail_no_wd() {

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
</script>