<script>
    // $(document).ready(function() {
    //     var table;

    //     table = $('#data-transaksi').DataTable({
    //         "paging": true,
    //         "autoWidth": true,
    //         "search": true,
    //         "responsive": true,
    //         "processing": false,
    //         "serverSide": true,
    //         "ajax": {
    //             "url": "<?= site_url('Transaksi_event_sales/get_datatransaksi') ?>",
    //             "type": "POST",
    //         },

    //     })
    // });

    $(document).ready(function() {
        function loadTransaksi(value) {
            $.ajax({
                url: "<?= site_url('Transaksi_event_sales/get_datatransaksi') ?>", // Ganti dengan URL endpoint Anda
                type: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.data && response.data.length > 0) {
                        $('#transaksiList').html(''); // Kosongkan daftar sebelum memuat ulang

                        $.each(response.data, function(index, item) {
                            var listItem = `
                            <li class="row li-list p-2 mb-3">
                                <div class="align-content-around col-2 pl-0">
                                    <span class="bg-border-span">${item.inisial}</span>
                                </div>
                                <div class="col-6 p-0 align-content-center">
                                    <h6 class="mb-0 font-weight-bold">${item.event}</h6>
                                    <span class="small border-radius-gray"><i class="bi bi-calendar4-week"></i> ${item.tgl_event}</span>
                                    <span class="small border-radius-gray"><i class="bi bi-ticket-perforated"></i> ${item.count}</span>
                                </div>
                                <div class="align-content-center align-right col-4 p-0">
                                    <span class="span-price-${item.status_profit}">Rp. ${item.profit}</span>
                                </div>
                            </li>
                        `;
                            if (item.status_profit == '0') {
                                $('#transaksiList-0').append(listItem);
                            } else if (item.status_profit == '1') {
                                $('#transaksiList-1').append(listItem);
                            } else if (item.status_profit == '2') {
                                $('#transaksiList-2').append(listItem);
                            }
                            console.log(item.status_profit)
                            
                        });
                    } else {
                        $('#transaksiList-0, #transaksiList-1, #transaksiList-2').html('<li class="row li-list p-2 pl-4 mb-3">Tidak ada data tersedia</li>');
                    }
                },
                error: function() {
                    $('#transaksiList').html('<li class="list-group-item text-center text-danger">Gagal memuat data</li>');
                }
            });
        }

        // Panggil fungsi untuk memuat data
        loadTransaksi();
    });

    $("document").ready(function() {
        $(".tab-slider--body").hide();
        $(".tab-slider--body:first").show();
    });

    $("document").ready(function() {
        $(".tab-slider--body").hide();
        $(".tab-slider--body:first").show();
    });

    $(".tab-slider--nav li").click(function() {
        $(".tab-slider--body").hide();
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).fadeIn();

        if ($(this).attr("rel") == "tab2") {
            $('.tab-slider--tabs').removeClass('slide-right');
            $('.tab-slider--tabs').addClass('slide');
        } else if ($(this).attr("rel") == "tab3") {
            $('.tab-slider--tabs').removeClass('slide');
            $('.tab-slider--tabs').addClass('slide-right');
        } else {
            $('.tab-slider--tabs').removeClass('slide');
            $('.tab-slider--tabs').removeClass('slide-right');
        }

        $(".tab-slider--nav li").removeClass("active");
        $(this).addClass("active");
    });
</script>