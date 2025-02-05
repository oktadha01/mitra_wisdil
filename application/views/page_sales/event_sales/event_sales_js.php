<script>
    $(document).ready(function() {

        var agency = $('#select-agency');
        var email = $('#email');
        var kontak = $('#kontak');
        var alamat_agency = $('#alamat-agency');
        var nm_event = $('#nm-event');
        var kategori_event = $('#kategori-event');
        var tgl_event = $('#tgl-event');
        var jam_event = $('#jam-event');
        var mc = $('#mc');
        var lokasi = $('#lokasi');
        var kota = $('#kota');
        var alamat = $('#alamat');
        var deskripsi = $('#summernote');

        load_data_event();
        get_agency();
        ketegori_event();
        populateKota();
        $('.box-form').removeAttr('hidden').hide();
        $('.btn-tambah-event').click(function() {
            $('.text-form-agency').text('Form Input Agency');
            $('.text-form-event').text('Form Input Event');
            $(this).hide(300);
            $('.box-form').show(300);
            form_upload_pdf(1);
            resetForm();
        });

        $('#tambah-data, #ubah-event').on('shown.bs.modal', function() {
            $(function() {
                $('.select2').each(function() {
                    $(this).select2({
                        // theme: 'bootstrap3',
                    });
                });
            });
        });

        $('#select-agency').change(function() {
            if ($(this).val() == 'add') {
                Swal.fire({
                    title: "Tambahkan nama agency",
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    showCancelButton: true,
                    confirmButtonText: "Submit",
                    preConfirm: (name) => {
                        // Validasi input hanya huruf abjad
                        if (!name) {
                            Swal.showValidationMessage("Please enter a name.");
                        } else if (!/^[a-zA-Z\s]+$/.test(name)) {
                            Swal.showValidationMessage("Nama hanya boleh mengandung huruf.");
                        }
                        return name;
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const newOption = `<option value="${result.value}">${result.value}</option>`;
                        $('#select-agency').append(newOption).val(result.value).trigger('change');
                        form_input_agency(0);

                        // Reset input tambahan
                        email.val('');
                        kontak.val('');
                        alamat_agency.val('');
                    } else {
                        $('#select-agency').val('').trigger('change');
                    }
                });

            } else if ($(this).val() == '') {
                form_input_agency(0);
                email.val('');
                kontak.val('');
                alamat_agency.val('');
            } else {
                $.ajax({
                    url: "<?= site_url('Event_sales/get_data_select_agency') ?>", // Ganti dengan URL endpoint Anda
                    data: {
                        id_user: $(this).val(),
                    },
                    type: "POST",
                    dataType: "json",
                    success: function(response) {
                        if (response.length > 0) {
                            let userData = response[0]; // Akses objek pertama dalam array
                            // agency.val(userData.agency);
                            email.val(userData.email);
                            kontak.val(userData.kontak);
                            alamat_agency.val(userData.alamat);
                            if (userData.privilage == '') {
                                form_input_agency(0)
                            } else {
                                form_input_agency(1)
                            }
                        }
                    },
                    error: function() {
                        console.error('Error fetching data.');
                    }
                });
                // form_input_agency(1);
            }
        });

        var id_user = '';
        var id_event = '';
        var id_proposal = '';
        $('#save-event').submit(function() {
            event.preventDefault(); // Hentikan submit form
            let isValid = true; // Flag validasi
            $('.error-message').remove(); // Hapus pesan error sebelumnya
            $('input').removeClass('error'); // Hapus kelas error sebelumnya

            // Validasi input
            ['#select-agency', '#email', '#kontak', '#alamat-agency', '#nm-event', '#kategori-event', '#tgl-event', '#jam-event', '#mc', '#lokasi', '#kota', '#alamat'].forEach(function(selector) {
                let input = $(selector);
                if (input.val().trim() === '') {
                    isValid = false;
                    input.addClass('error').after('<span class="error-message" style="color: red;">Field wajib diisi.</span>');
                }
            });

            if (!isValid) return; // Jika tidak valid, hentikan proses

            var action = $(this).find('.simpan').data('action');
            alert(action);
            var id_user = $(this).find('.simpan').data('id-user');
            var id_event = $(this).find('.simpan').data('id-event');
            var id_proposal = $(this).find('.simpan').data('id-proposal');
            var sendUrl = action === 'simpan' ?
                '<?= site_url('Event_sales/simpan_data_event') ?>' :
                '<?= site_url('Event_sales/edit_data_event') ?>';

            // Buat FormData
            var formData = new FormData();

            if (action === 'edit') {
                formData.append('id_user', id_user);
                formData.append('id_event', id_event);
                formData.append('id_proposal', id_proposal);
            }

            // Tambahkan data form
            formData.append('agency', agency.val());
            formData.append('email', email.val());
            formData.append('kontak', kontak.val());
            formData.append('alamat_agency', alamat_agency.val());
            formData.append('nm_event', nm_event.val());
            formData.append('kategori_event', kategori_event.val());
            formData.append('text_kategori_event', kategori_event.text());
            formData.append('tgl_event', tgl_event.val());
            formData.append('batas_pesan', tgl_event.val());
            formData.append('jam_event', jam_event.val());
            formData.append('mc', mc.val());
            formData.append('lokasi', lokasi.val());
            formData.append('kota', kota.val());
            formData.append('text_kota', kota.text());
            formData.append('alamat', alamat.val());
            formData.append('deskripsi', $('textarea#summernote').summernote('code'));

            // Tambahkan file proposal jika ada
            var proposalFile = $('#proposal')[0]?.files[0];
            if (proposalFile) {
                formData.append('proposal_file', proposalFile);
            } else {
                return;
                // alert('Silakan pilih file sebelum mengirim.');
            }

            // Lakukan AJAX request
            $.ajax({
                url: sendUrl,
                type: "POST",
                data: formData,
                contentType: false, // Jangan set contentType untuk FormData
                processData: false, // Jangan proses FormData
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: "Berhasil !",
                            text: "Data Berhasil Disimpan",
                            icon: "success"
                        });
                        load_data_event(); // Panggil fungsi untuk reload data
                        $('.text-form-agency').text('Form Input Agency');
                        $('.text-form-event').text('Form Input Event');
                        $('.btn-tambah-event').show(300);
                        $('.box-form').hide(300);
                        $('.simpan').removeAttr('id-proposal data-id-event data-id-user').attr('data-action', 'simpan');
                        resetForm();
                    } else {
                        alert(response.message || 'Terjadi kesalahan.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Proses gagal: ' + (xhr.responseText || 'Terjadi kesalahan.'));
                }
            });
        });

        $('.batal').click(function() {
            $('.text-form-agency').text('Form Input Agency');
            $('.text-form-event').text('Form Input Event');
            $('.btn-tambah-event').show(300);
            $('.box-form').hide(300);
            $('.simpan').removeAttr('id-proposal data-id-event data-id-user').attr('data-action', 'simpan');
            resetForm();
        });


        $('.edit-event').click(function() {
            $('.text-form-agency').text('Form Edit Agency');
            $('.text-form-event').text('Form Edit Event');

            $('.box-form').show(300);
            // agency.val($('#li-text-agency').text());
            email.val($('#li-text-email').text());
            kontak.val($('#li-text-kontak').text());
            alamat_agency.val($('#li-text-alamatuser').text());
            nm_event.val($('#li-text-event').text());
            // kategori_event.val($('#li-text-kategori-event').text());
            tgl_event.val($('#li-text-tgl').text());
            jam_event.val($('#li-text-jam').text());
            mc.val($('#li-text-mc').text());
            lokasi.val($('#li-text-lokasi').text());
            // kota.val($('#li-text-kota').text());
            alamat.val($('#li-text-alamatevent').text());
            deskripsi.summernote('code', $('#li-text-desk').html());
            // Cari opsi berdasarkan teks
            // Set opsi yang sesuai untuk #agency
            $('#select-agency option').filter(function() {
                return $(this).text().trim() === $('#li-text-agency').text().trim();
            }).prop('selected', true);

            // Set opsi yang sesuai untuk #kota
            $('#kota option').filter(function() {
                return $(this).text().trim() === $('#li-text-kota').text().trim();
            }).prop('selected', true);

            // Set opsi yang sesuai untuk #kategori-event
            $('#kategori-event option').filter(function() {
                return $(this).text().trim() === $('#li-text-kategori-event').text().trim();
            }).prop('selected', true);

            // Trigger change event setelah memilih opsi
            $('#select-agency, #kota, #kategori-event').change();

            $('.simpan')
                .attr({
                    'data-action': 'edit', // Set the 'data-id-event' attribute
                    'data-id-proposal': $(this).data('id-proposal'), // Set the 'data-id-event' attribute
                    'data-id-event': $(this).data('id-event'), // Set the 'data-id-event' attribute
                    'data-id-user': $(this).data('id-user') // Set the 'data-id-user' attribute
                });

            $('.text-file-pdf').text($('#li-text-event').text());
            form_upload_pdf(0);

        });

        $('.btn-ubah-pdf').click(function() {
            if ($(this).val() == '0') {
                form_upload_pdf(2);
            } else {
                form_upload_pdf(0);
            }
        });
    });

    function form_input_agency(value) {
        if (value == '1') {
            $('#email, #kontak, #alamat-agency').attr('readonly', true);
        } else if (value == '0') {
            $('#email, #kontak, #alamat-agency').removeAttr('readonly', true);
        }
    }

    function form_upload_pdf(value) {
        if (value == 1) {
            $('#form-upload-pdf').show(200);
            $('#body-file-pdf').hide(200);
        } else if (value == 2) {
            $('.btn-ubah-pdf').text('Batal').removeClass('btn-warning').addClass('btn-danger').val('1');
            $('#body-file-pdf').show(200);
            $('#form-upload-pdf').show(200);
        } else {
            $('.btn-ubah-pdf').text('Ubah').removeClass('btn-danger').addClass('btn-warning').val('0');
            $('.dropify-clear').trigger('click');
            $('#form-upload-pdf').hide(200);
            $('#body-file-pdf').show(200);
        }
    }

    function load_data_event() {
        $.ajax({
            url: "<?= site_url('Event_sales/get_data_event') ?>", // Ganti dengan URL endpoint Anda
            type: "POST",
            dataType: "json",
            success: function(response) {
                var status_tiket = '';
                if (response.data && response.data.length > 0) {
                    $('#load-data-event').html('');
                    $.each(response.data, function(index, item) {
                        if (item.status_tiket == 'free') {

                            status_tiket = '<span class="small border-radius-gray text-warning"><i class="bi bi-ticket-perforated"></i> FREE</span>'
                        } else {

                            status_tiket = '';
                        }
                        var listItem = `
                            <li class="row li-list p-2 mb-3 btn-detail-event"  data-id-event="${item.id_event}" data-toggle="modal" data-target="#exampleModalCenter">
                                <div class="align-content-around col-2 pl-0">
                                    <span class="bg-border-span">${item.inisial}</span>
                                </div>
                                <div class="col-6 p-0 align-content-center">
                                    <h6 class="mb-0 font-weight-bold">${item.event}</h6>
                                    <span class="small border-radius-gray"><i class="bi bi-calendar4-week"></i> ${item.tgl_event}</span>
                                        ` + status_tiket + `
                                    </div>
                                <div class="align-content-center align-right col-4 p-0">
                                    <span class="span-status-event-${item.status_event_no}">${item.status_event}</span>
                                </div>
                            </li>
                        `;
                        $('#load-data-event').append(listItem);
                    });
                    action_detailEdit();
                } else {
                    $('#load-data-event').html('<li class="row li-list p-2 pl-4 mb-3 text-center">Tidak ada data tersedia</li>');
                }
            },
            error: function() {
                $('#load-data-event').html('<li class="list-group-item text-center text-danger">Gagal memuat data</li>');
            }
        });
    }


    function action_detailEdit() {
        $('.btn-detail-event').click(function() {
            // alert($(this).data('id-event'))
            $.ajax({
                url: "<?= site_url('Event_sales/get_detail_data_event') ?>", // Ganti dengan URL endpoint Anda
                data: {
                    id_event: $(this).data('id-event'),
                },
                type: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.length > 0) {
                        let eventData = response[0]; // Akses objek pertama dalam array
                        // Set nilai ke elemen HTML
                        $('#li-text-agency').text(eventData.agency);
                        $('#li-text-email').text(eventData.email);
                        $('#li-text-kontak').text(eventData.kontak);
                        $('#li-text-alamatuser').text(eventData.alamatuser);
                        $('#li-text-event').text(eventData.nm_event);
                        $('#li-text-kategori-event').text(eventData.nm_kategori_event);
                        $('#li-text-tgl').text(eventData.tgl_event);
                        $('#li-text-jam').text(eventData.jam_event);
                        $('#li-text-mc').text(eventData.mc_by);
                        $('#li-text-lokasi').text(eventData.lokasi);
                        $('#li-text-kota').text(eventData.nm_kota);
                        $('#li-text-alamatevent').text(eventData.alamatevent);
                        $('#li-text-desk').html(eventData.desc_event);
                        $('#li-a-proposal').attr('href', '<?= base_url('upload/proposals'); ?>/' + eventData.proposal_event);
                        $('#li-a-proposal').text(eventData.proposal_event);
                        // alert("Event Name: " + eventData.nm_event);
                        var idpropsal = eventData.id_proposal;
                        // alert(idpropsal)
                        if (idpropsal == null) {
                            idpropsal = '0';
                        }
                        if (eventData.status_event == '2') {
                            $('.edit-event')
                                .attr('hidden', true) // Ensure the 'hidden' attribute is set to true
                                .removeAttr('id-proposal data-id-event data-id-user'); // Remove multiple attributes by passing a space-separated string

                        } else {
                            $('.edit-event')
                                .removeAttr('hidden') // Ensure the 'hidden' attribute is removed
                                .attr({
                                    'data-id-proposal': idpropsal, // Set the 'data-id-event' attribute
                                    'data-id-event': eventData.id_event, // Set the 'data-id-event' attribute
                                    'data-id-user': eventData.id_user // Set the 'data-id-user' attribute
                                });
                        }
                    } else {
                        console.error('No event data found.');
                    }

                },
                error: function() {
                    console.error('Error fetching data.');
                }
            });
        })
    }

    // select agency
    function get_agency() {
        $.ajax({
            url: '<?= site_url('Event_sales/get_agency') ?>',
            type: 'GET',
            success: function(data) {
                $('#select-agency').html(data);
                $("#select-agency").select2({
                    templateResult: function(data) {
                        if (!data.id) {
                            return data.text; // Jika data kosong
                        }
                        // Tambahkan class untuk opsi tertentu
                        if (data.element && $(data.element).hasClass('bg-warning')) {
                            return $(
                                `<span style="background-color: yellow; padding: 2px 4px; border-radius: 4px;">${data.text}</span>`
                            );
                        }
                        return data.text; // Kembalikan teks biasa untuk opsi lainnya
                    },
                    templateSelection: function(data) {
                        return data.text; // Teks biasa untuk pilihan
                    }
                });
            },
            error: function() {
                console.error('Error fetching data.');
            }
        });
    }
    // kategori event
    function ketegori_event() {
        $.ajax({
            url: '<?= site_url('Event_sales/get_kategori_event') ?>',
            type: 'GET',
            success: function(data) {
                $('#kategori-event').html(data);
            },
            error: function() {
                console.error('Error fetching data.');
            }
        });
    }
    // untuk tambah data
    function populateKota() {
        $.ajax({
            url: '<?= site_url('Event_sales/get_ajax_kab') ?>',
            type: 'GET',
            success: function(data) {
                $('#kota').html(data);
            },
            error: function() {
                console.error('Error fetching data.');
            }
        });
    }

    $(function() {
        $('.select2').each(function() {
            $(this).select2({
                // theme: 'bootstrap3',
            });
        });
    });



    $('textarea#summernote').summernote({
        placeholder: 'Deskripsi Event *',
        tabsize: 2,
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline']],
            // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            // ['fontname', ['fontname']],
            // ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            // ['table', ['table']],
            // ['insert', ['link', 'picture', 'hr']],
            ['insert', ['link', 'hr']],
            // ['view', ['fullscreen', 'codeview']],
            ['view', ['fullscreen']],
            ['help', ['help']]
        ],
    });

    function resetForm() {
        $('#select-agency, #kategori-event, #kota').val('').trigger('change');
        $(' #email, #kontak, #alamat-agency, #nm-event,  #tgl-event, #jam-event, #mc, #lokasi,  #alamat').val('');
        $('#summernote').summernote('reset');
        $('.dropify-clear').trigger('click');
    }
</script>