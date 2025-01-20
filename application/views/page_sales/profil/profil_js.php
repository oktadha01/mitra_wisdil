<script src="<?= base_url('assets'); ?>/js/email_validasi.js"></script>

<script>
    $('.menu-user').addClass('is-active');
    const menuLinks = document.querySelectorAll(".menu-user");
    menuLinks.forEach((link) => {
        link.addEventListener("click", () => {
            menuLinks.forEach((link) => {
                link.classList.remove("is-active");
            });
            link.classList.add("is-active");
        });
    })
    populateKota();
    var delayInMilliseconds = 700; //1 second
    setTimeout(function() {
        $('.select-kota').val($('.select-kota').attr('data-value')).trigger('change');
        $('#bank').val($('#bank').attr('data-value')).trigger('change');

        if ($('#bank').val() == '') {
            $('#btn-edit-payment').removeClass('btn-warning').addClass('btn-info').text('Tambah Payment');
            $('#btn-simpan-payment').attr('data-action', 'insert');
        } else {
            $('#btn-edit-payment').removeClass('btn-info').addClass('btn-warning').text('Edit Payment');
            $('#btn-simpan-payment').attr('data-action', 'update');
        }
    }, delayInMilliseconds);

    $('#btn-batal-edit-data, #btn-batal-edit-payment, #btn-simpan-data, #btn-simpan-payment').removeAttr('hidden', true).hide();
    $("#gender-" + $('#val-gender').val()).prop("checked", true);

    $('#btn-edit-data').click(function() {
        $('#kontak').removeAttr('readonly', true);
        $('#kota').removeAttr('disabled', true);
        $('#btn-batal-edit-data, #btn-simpan-data').show(200);
        $(this).hide(200);
        // $('.ubah-password, .ubah-email, .row-btn-logout').hide(200);
    });
    $('#btn-edit-payment').click(function() {
        $('#no-rekening, #nama-pemilik').removeAttr('readonly', true);
        $('#bank').removeAttr('disabled', true);
        $('#btn-batal-edit-payment, #btn-simpan-payment').show(200);
        $(this).hide(200);
        // $('.ubah-password, .ubah-email, .row-btn-logout').hide(200);
    });
    $('#btn-batal-edit-data').click(function() {
        batalorfinis_edit_data();
    });
    $('#btn-batal-edit-payment').click(function() {
        batalorfinis_edit_payment();
    });
    $('#btn-simpan-data').click(function() {
        let formData = new FormData();
        formData.append('kota', $('#kota').val());
        formData.append('kontak', $('#kontak').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Profile/update_profil'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                batalorfinis_edit_data();
                Swal.fire({
                    title: "Berhasil !",
                    text: "Data Berhasil Disimpan",
                    icon: "success"
                });
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    });
    $('#btn-simpan-payment').click(function(e) {
        e.preventDefault(); // Mencegah aksi default tombol

        // Selalu baca nilai terbaru dari atribut data-action
        let action = $(this).attr('data-action');

        // Tentukan URL berdasarkan action
        let urlpost;
        if (action === 'insert') {
            urlpost = "<?php echo site_url('Profile/insert_payment'); ?>";

            // Ubah atribut data-action ke 'update' setelah proses insert
            $(this).attr('data-action', 'update');
            $('#btn-edit-payment').removeClass('btn-info').addClass('btn-warning').text('Edit Payment');
            // alert('Insert Payment berhasil!');
        } else if (action === 'update') {
            urlpost = "<?php echo site_url('Profile/update_payment'); ?>";
            // alert('Update Payment berhasil!');
        } 
        // batalorfinis_edit_payment();
        // Swal.fire({
        //     title: "Berhasil !",
        //     text: "Data Berhasil Disimpan",
        //     icon: "success"
        // });
        let formData = new FormData();
        formData.append('bank', $('#bank').val());
        formData.append('no_rekening', $('#no-rekening').val());
        formData.append('nama_pemilik', $('#nama-pemilik').val());
        $.ajax({
            type: 'POST',
            url: urlpost,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                batalorfinis_edit_payment();
                Swal.fire({
                    title: "Berhasil !",
                    text: "Data Berhasil Disimpan",
                    icon: "success"
                });
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    });

    $('#notif-pass').hide();
    $('#notif-email').hide();
    $('.btn-ubah-email').click(function() {
        $('.email-baru').val($(this).data('email'));
    });
    $('.col-pass').hide();
    $('#email').on('input', function(e) {
        // alert('aaa')
        if ($('.valid_info').text() == 'The entered address is valid') {
            $('.col-pass').show();
        } else {
            $('.col-pass').hide();
        }
    });
    $('#password').on('input', function(e) {
        if ($(this).val() == '') {
            $('#btn-simpan-email').removeAttr('data-dismiss', true)
        } else {
            $('#btn-simpan-email').attr('data-dismiss', 'modal')
        }
    });

    $('#btn-simpan-email').click(function() {
        if ($('#password').val() == '') {
            $('.col-pass').show();
            $('.valid_pass').text('Password tidak boleh kosong !!')
        } else {

            let formData = new FormData();
            formData.append('email', $('.email-baru').val());
            formData.append('password', $('#password').val());
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Profile/update_email'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data == 'Email berhasil diubah') {
                        notif_email_success();
                        $('.text-email').text($('.email-baru').val());
                        $('.col-pass').hide();
                        $('.valid_pass').text('');
                        $('#password').val('');
                        $('#btn-simpan-email').removeAttr('data-dismiss', true);
                    } else {
                        batalorfinis_edit_data();
                        notif_email_gagal(data);
                        $('#password').val('');
                        $('#btn-simpan-email').removeAttr('data-dismiss', true);
                    }
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }
    });


    function batalorfinis_edit_data() {
        $('#kontak').attr('readonly', true);
        $('#kota').attr('disabled', true);
        $('#btn-batal-edit-data, #btn-simpan-data').hide(200);
        $('#btn-edit-data').show(200);
        // $('.ubah-password, .ubah-email, .row-btn-logout').show(200);
    }

    function batalorfinis_edit_payment() {
        $('#no-rekening, #nama-pemilik').attr('readonly', true);
        $('#bank').attr('disabled', true);
        $('#btn-batal-edit-payment, #btn-simpan-payment').hide(200);
        $('#btn-edit-payment').show(200);
        // $('.ubah-password, .ubah-email, .row-btn-logout').show(200);
    }

    function notif_email_success() {
        $('#notif-email').addClass('notif-success-email').text('Email Berhasil Di Ubah').show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-email').hide(300);
        }, delayInMilliseconds);
    };

    function notif_email_gagal(data) {
        $('#notif-email').addClass('notif-gagal-email').text(data).show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-email').hide(300);
        }, delayInMilliseconds);
    }

    function notif_pass_success() {
        $('#notif-pass').addClass('notif-success-pass').text('Password Berhasil Di Ubah').show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-pass').hide(300);
        }, delayInMilliseconds);
    };

    function notif_pass_gagal(data) {
        $('#notif-pass').addClass('notif-gagal-pass').text(data).show(300);
        var delayInMilliseconds = 2500; //1 second
        setTimeout(function() {
            $('#notif-pass').hide(300);
        }, delayInMilliseconds);
    }

    function populateKota() {
        $.ajax({
            url: '<?= base_url('Profile/get_ajax_kab') ?>',
            type: 'GET',
            success: function(data) {
                $('.select-kota').html(data);

            },
            error: function() {
                console.error('Error fetching data.');
            }
        });
    }
    $(function() {

        $('.select2').select2({
            // placeholder: "Pilih Kota/Kabupaten",
            allowClear: true,
            // minimumResultsForSearch: Infinity
        });
    });
</script>

<script>
    $('#pass-lama').on('input', function(e) {
        let formData = new FormData();
        formData.append('password', $('#pass-lama').val());
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('Profile/cek_password'); ?>",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                // alert(data);
                if (data == 'valid') {
                    $('#pass-lama').addClass('valid-pass-success').removeClass('invalid-pass-error')
                    $('#validasi-pass-lama').addClass('text-success').removeClass('text-danger').text(
                        'Password valid');
                    $('#pass-baru').removeAttr('readonly', true);

                } else {
                    $('#pass-lama').addClass('invalid-pass-error').removeClass('valid-pass-success')
                    $('#validasi-pass-lama').addClass('text-danger').removeClass('text-success').text(
                        'Password invalid');
                }
            },
            error: function() {
                alert("Data Gagal Diupload");
            }
        });
    });
    $('#pass-baru').on('input', function() {
        $('#pass-lama').attr('readonly', true);
        if ($('#pass-lama').val() == $('#pass-baru').val()) {
            $('#pass-baru').addClass('invalid-pass-error').removeClass('valid-pass-success')
            $('#validasi-pass-baru').addClass('text-danger').removeClass('text-success').text(
                'Password tidak boleh sama!')
            $('#btn-simpan-pass').removeAttr('data-dismiss', 'modal');
        } else {
            $('#pass-baru').addClass('valid-pass-success').removeClass('invalid-pass-error')
            $('#validasi-pass-baru').addClass('text-success').removeClass('text-danger').text('Password valid')
            $('#btn-simpan-pass').attr('data-dismiss', 'modal');
        }
        if ($('#pass-baru').val() == '') {
            $('#pass-baru').removeClass('invalid-pass-error').removeClass('valid-pass-success')
            $('#validasi-pass-baru').text('')
            $('#btn-simpan-pass').removeAttr('data-dismiss', 'modal');

        }
    });
    $('.btn-ubah-password').click(function() {
        $action = $(this).data('action');
    });
    $('#btn-simpan-pass').click(function() {

        if ($('#pass-lama').val() == '' || $('#pass-baru').val() == '') {
            if ($('#pass-lama').val() == '') {
                $('#pass-lama').addClass('invalid-pass-error').removeClass('valid-pass-success')
                $('#validasi-pass-lama').addClass('text-danger').removeClass('text-success').text(
                    'Password tidak boleh kosong!')
            }
            if ($('#pass-baru').val() == '') {
                $('#pass-baru').addClass('invalid-pass-error').removeClass('valid-pass-success')
                $('#validasi-pass-baru').addClass('text-danger').removeClass('text-success').text(
                    'Password tidak boleh kosong!')
            }
        } else {
            let formData = new FormData();
            formData.append('pass-lama', $('#pass-lama').val());
            formData.append('pass-baru', $('#pass-baru').val());
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Profile/update_password'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    // alert(data);
                    closeORsuccess();

                    // alert(data);
                    $('#btn-simpan-pass').removeAttr('data-dismiss', 'modal');
                    if (data == 'valid') {
                        if ($action == 'nav') {
                            notif_success();
                        } else {
                            notif_pass_success();
                        }
                    } else {
                        if ($action == 'nav') {
                            notif_error(data);
                        } else {
                            notif_pass_gagal(data);
                        }

                    }
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        }

    });
    $('.btn-close-updt-pass').click(function() {
        closeORsuccess();
    });

    function notif_success() {
        Swal.fire({
            title: "Berhasil!",
            text: "Password berhasil di ubah !",
            icon: "success"
        });
    }

    function notif_error(data) {
        Swal.fire({
            title: "Proses Gagal!",
            text: data,
            icon: "error"
        });
    }

    function closeORsuccess() {
        $('#pass-baru').attr('readonly', true).val('').removeClass('valid-pass-success').removeClass('invalid-pass-error');
        $('#pass-lama').removeAttr('readonly', true).val('').removeClass('valid-pass-success').removeClass(
            'invalid-pass-error');
        $('#validasi-pass-lama').text('').removeClass('text-danger').removeClass('text-success');
        $('#validasi-pass-baru').text('').removeClass('text-danger').removeClass('text-success');
    }
</script>