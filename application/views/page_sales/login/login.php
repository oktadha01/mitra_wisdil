<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/vendor/bootstrap/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/input_file.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/alert.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/login/style.css">
    <!-- Bootstrap Core Css -->
    <title>Sign in & Sign up Form</title>
    <!-- <link rel="icon" href="" type="image/gif" sizes="25x12"> -->
    <style>
        .form-control {

            border-radius: 10px;
            border: 2px solid #607D8B;

        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 2px solid #607D8B;
            border-radius: 10px;
            height: 42px;
            padding: 6px 8px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 10px;
            right: 10px;
            width: 20px;
        }

        .select2-container {
            width: -webkit-fill-available !important;
        }

        label {
            display: inline-block;
            margin-bottom: 0.5rem;
            margin-left: 15px;
        }

        .p-form {
            padding: 1px;
        }

        form {
            padding: 0rem 4rem;
        }

        .btn-sm-coral {

            font-size: small;
            margin: 0;
            height: 38px;
            border-radius: 9px;
            background: coral !important;

        }

        @media only screen and (min-width: 200px) and (max-width: 1024px) and (orientation: portrait) {
            form {
                padding: 0 1.5rem;
            }

        }

        @media only screen and (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
            form {
                padding: 0rem 2rem;
            }
        }

        .btn-lupa-pass {
            left: 108px;
            position: relative;
            color: blue;
            cursor: pointer;
        }

        .btn-danger {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .notif-email {
            right: 95px;
            position: relative;
            font-size: small;
            margin-bottom: 11px;
        }

        .invalid-email {
            border: 2px solid #ff00008c;
            color: red;
        }

        .valid-email {
            border: 2px solid #4CAF50;
            color: #4CAF50;
        }

        .error {
            border: 1px solid red;
        }

        .error-message {
            font-size: 12px;
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 100%;">
        <div class="forms-container">
            <div class="signin-signup">
                <form class="sign-in-form" action="<?= base_url('Login/login') ?>" method="POST">

                    <!-- Alert -->
                    <?php
                    if (validation_errors() || $this->session->flashdata('result_login')) {
                    ?>
                        <div class="alert" id="autoCloseAlert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong style=" padding: 5px 5px 5px 5px;">Warning!</strong>
                            <?php echo validation_errors(); ?>
                            <?php echo $this->session->flashdata('result_login'); ?>
                        </div>

                    <?php } ?>

                    <?php
                    $data = $this->session->flashdata('sukses');
                    if ($data != "") {
                    ?>
                        <div class="alert alert-success"><strong>Sukses! </strong> <?= $data; ?></div>
                        <div class="alert alert-success" id="autoCloseAlert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </strong> <?= $data; ?>
                        </div>
                    <?php } ?>
                    <!-- Akhir Alert -->
                    <h2 class="title title-form">Sign in</h2>
                    <p class="social-text mb-0 text-center form-rest-pass" hidden>Masukkan alamat email Anda di bawah ini untuk mengatur ulang kata sandi Anda</p>
                    <div class="input-field form-login">
                        <i class="bi bi-envelope-at"></i>
                        <input type="email" placeholder="Email" name="email" required autofocus autocomplete="current-email" />
                    </div>
                    <div class="input-field form-login">
                        <i class="bi bi-lock"></i>
                        <input type="password" placeholder="Password" id="password" name="password" required autofocus autocomplete="current-password" />
                        <i class="toggle-password bi bi-eye-slash" onclick="togglePasswordVisibility('password')"></i>
                    </div>
                    <div class="remember" hidden>
                        <input type="checkbox" id="remember" name="remember" value="" checked="true">
                        <label for="remember"> Remember</label>
                    </div>
                    <span class="btn-lupa-pass form-login">Lupa Password ?</span>
                    <input type="submit" value="Login" class="btn solid form-login " />

                    <!-- form reset password -->
                    <div class="input-field form-email-rest mb-0 form-rest-pass" hidden>
                        <i class="fa fa-envelope"></i>
                        <input type="email" class="email-rest" placeholder="Email" autofocus autocomplete="current-email" />
                    </div>
                    <span class="notif-email form-rest-pass" hidden style="border: none;"></span>
                    <div class="row form-rest-pass" hidden>
                        <div class="col-6">
                            <button id="btn-batal" class="btn btn-danger">Batal</button>
                        </div>
                        <div class="col-6">
                            <button id="btn-submit" class="btn btn-primary" disabled>Submit</button>
                        </div>
                    </div>

                    <p class="social-text">Informasi Tentang System Bisa Lihat Sosial Media dibawah ini</p>
                    <div class="social-media gap-5">
                        <a href="#" class="social-icon">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="bi bi-envelope-at"></i>
                        </a>
                    </div>
                </form>
                <form class="sign-up-form" style="align-items:normal">
                    <!-- <div class="card-body"> -->

                    <h2 class="title text-center mb-4">Daftar Akun Mitra</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-1">
                                <label class="text-black-50 mb-0">Nama Lengkap <sup class="text-danger">*</sup></label>
                                <input type="text" name="nama" id="nama" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-1">
                                <label class="text-black-50 mb-0">Email <sup class="text-danger">*</sup></label>
                                <input type="email" name="email" id="email" required="" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group mb-1">
                                <label class="text-black-50 mb-0">No Whatsapp <sup class="text-danger">*</sup></label>
                                <input type="number" name="no_wa" id="no_wa" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group mb-1">
                                <label class="text-black-50 mb-0">Domisil <sup class="text-danger">*</sup></label>
                                <select name="domisili" id="domisili" class="select2 form-control">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="row-password" class="row">
                        <div class="col-12">
                            <div class="form-group mb-1">
                                <label class="text-black-50 mb-0">Buat Password <sup class="text-danger">*</sup></label>
                                <input id="in-pass" type="password" class="form-control" value="">
                                <span toggle="#password-field" class="bi bi-eye-slash field-icon toggle-password"></span>
                            </div>
                            <div class="form-group mb-1">
                                <label class="text-black-50 mb-0">Ulangi Password <sup class="text-danger">*</sup></label>
                                <input id="pass-sign-up" type="password" class="form-control" value="">
                                <span toggle="#password-field" class="bi bi-eye-slash field-icon toggle-password"></span>
                            </div>
                        </div>
                    </div>
                    <div id="row-referral" class="row">
                        <div class="col-6">
                            <div class="form-group mb-1">
                                <label class="text-black-50 mb-0">Code Referral </label>
                                <input type="text" name="code_referral" id="code_referral" class="form-control">
                            </div>
                        </div>

                        <div class="col-6 pt-4">
                            <div class="form-group mb-1">
                                <!-- <label class="text-black-50 mb-0">Marketing <sup class="text-danger">*</sup></label> -->
                                <input type="text" name="nm_marketing" id="nm_marketing" readonly class="form-control">
                            </div>
                        </div>
                    </div>
                    <div id="row-aktivasi" class="row" hidden>
                        <div class="col-12 mt-2 mb-2">
                            <i class="small">*Silahkan cek email Anda untuk aktivasi akun mitra*</i>
                            <p class="small">Jika tidak menerima pesan email, silahkan klik tombol "Kirim Ulang Email".</p>
                        </div>
                        <div class="col-7">
                            <div class="form-group mb-1">
                                <button type="button" id="btn-not-send-email" class="btn btn-sm-coral solid w-100">Kirim Ulang Email</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <button type="submit" id="btn-daftar" class="btn solid  w-100 ">Daftar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Belum Punya Akun ?</h3>
                    <p>
                        Please klik Sign up untuk membuat akun baru !!!
                    </p>
                    <button class="btn transparent" id="sign-up-btn" data-page="Daftar">
                        Sign up
                    </button>
                </div>
                <img src="<?= base_url('assets/login/'); ?>img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3> Sudah Punya Akun</h3>
                    <p>
                        Silahkan Klik Sign in Untuk Masuk Ke System
                    </p>
                    <button class="btn transparent" id="sign-in-btn" data-page="Login">
                        Sign in
                    </button>
                </div>
                <img src="<?= base_url('assets/login/'); ?>img/reg.svg" class="image" alt="" />
            </div>
        </div>
    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="<?= base_url(); ?>assets/login/input_file.js"></script>
    <script src="<?= base_url(); ?>assets/login/app.js"></script>



    <script>
        <?php if ($this->session->flashdata('response')): ?>
            Swal.fire({
                title: '<?= $this->session->flashdata('response')['status'] ?>',
                text: '<?= $this->session->flashdata('response')['message'] ?>',
                icon: 'success',
            });
        <?php endif; ?>

        var code_referral = $('#code_referral');
        var nama = $('#nama');
        var email = $('#email');
        var no_wa = $('#no_wa');
        var domisili = $('#domisili');
        var pass_sign_up = $('#pass-sign-up');
        $('#nm_marketing, #row-input-password, #row-aktivasi').removeAttr('hidden').hide();
        $(document).ready(function() {
            if ("<?= $script; ?>" == "daftar") {
                populateKota();
                $('#sign-up-btn').trigger('click');
            }
            $('#sign-up-btn, #sign-in-btn').click(function() {
                // alert('ya');
                if ($(this).data('page') == 'Daftar') {
                    populateKota();
                }
                history.replaceState(null, '', window.location.origin + '/' + $(this).data('page'));

            });

            $('.sign-up-form').submit(function() {
                event.preventDefault(); // Hentikan submit form

                let isValid = true; // Flag validasi
                $('.error-message').remove(); // Hapus pesan error sebelumnya
                $('input').removeClass('error'); // Hapus kelas error sebelumnya

                // Validasi input
                ['#nama', '#email', '#no_wa', '#domisili', '#in-pass', '#pass-sign-up'].forEach(function(selector) {
                    let input = $(selector);
                    if (input.val().trim() === '') {
                        isValid = false;
                        input.addClass('error').after('<span class="error-message" style="color: red;">Field wajib diisi.</span>');
                    }
                });

                if ($('#in-pass').val() !== $('#pass-sign-up').val()) {
                    isValid = false;
                    $('#pass-sign-up').addClass('error').after('<span class="error-message" style="color: red;">Invalid Password!!</span>');
                    Swal.fire({
                        title: "Invalid Password !!",
                        // text: "You clicked the button!",
                        icon: "error"
                    });
                }

                if (!isValid) return; // Jika tidak valid, hentikan proses

                // Lakukan AJAX jika validasi lolos
                $.ajax({
                    url: "<?= base_url('Daftar/pengajuan_akun_mitra') ?>",
                    method: "POST",
                    data: {
                        code_referral: code_referral.val(),
                        nama: nama.val(),
                        email: email.val(),
                        no_wa: no_wa.val(),
                        domisili: domisili.val(),
                        password: pass_sign_up.val(),
                    },
                    cache: false,
                    dataType: "json", // Expect JSON response
                    success: function(response) {

                        if (response.status == 'success') {
                            Swal.fire({
                                title: "Proses Berhasil",
                                html: 'Sistem telah mengirimkan email aktivasi akun mitra ke <span style="font-weight: bold;">' + email.val() + '</span>',
                                icon: "success"
                            });
                            window.open('https://mail.google.com/', '_blank');
                            $('#btn-daftar,#row-password').hide();
                            $('#row-aktivasi').show();
                            nama.attr('readonly');
                            email.attr('readonly');
                            no_wa.attr('readonly');
                            domisili.attr('disabled');
                            if (code_referral.val() !== '') {
                                code_referral.attr('readonly');
                            } else {
                                code_referral.hide();
                            }
                        } else if (response.status == 'error') {
                            Swal.fire({
                                title: "Proses Gagal",
                                text: "Email sudah terdaftar, Gunakan Email Lainnya !!",
                                icon: "error"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', error);
                        console.log('Response: ', xhr.responseText); // Inspect response
                    }
                });
            });

            $('#btn-not-send-email').click(function() {
                Swal.fire({
                    title: "Kirim ulang email",
                    text: 'Harap gunakan email yang aktif untuk proses lebih lanjut.',
                    input: "text",
                    inputAttributes: {
                        autocapitalize: "off"
                    },
                    inputValue: $('#email').val(), // Isi dengan nilai dari input email
                    showCancelButton: true,
                    confirmButtonText: "Kirim Ulang",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Proses untuk mengirim ulang verifikasi
                        let emailInput = result.value; // Ambil nilai input yang baru
                        $.ajax({
                            url: "<?= base_url('Daftar/send_ulang_aktivasi') ?>",
                            method: "POST",
                            data: {
                                email: emailInput,
                            },
                            cache: false,
                            // dataType: "json", // Expect JSON response
                            success: function(response) {
                                $('#email').val(emailInput);
                                Swal.fire({
                                    title: "Berhasil Mengirim Ulang!",
                                    html: 'Sistem telah mengirimkan email aktivasi akun mitra ke <span style="font-weight: bold;">' + emailInput + '</span>',
                                    icon: "success"
                                });
                                window.open('https://mail.google.com/', '_blank');

                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error: ', error); // Log error for debugging
                            }
                        });

                    } else {
                        // Cancel button pressed
                        console.log('Proses dibatalkan');
                    }
                });

            });
            $('#code_referral').on('input', function() {
                // alert($(this).val());
                $.ajax({
                    url: "<?= base_url('Daftar/cek_kodereferral') ?>",
                    method: "POST",
                    data: {
                        code_referral: code_referral.val(), // Kirimkan nilai code_referral
                    },
                    cache: false,
                    dataType: "json", // Expect JSON response
                    success: function(response) {
                        // console.log(response.nama); // Tampilkan nama yang dikembalikan dari server
                        if (response.nama !== '') {
                            $('#nm_marketing').val(response.nama).show();
                        } else {

                            $('#nm_marketing').val('').hide();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error: ' + status + ' ' + error + ' ' + xhr.responseText); // Log error jika ada
                    }
                });
            });


            $('#in-pass').on('input', function() {
                $('#pass-sign-up').val('').removeClass('error');
                $('.error-message').remove();
            });

            $('#pass-sign-up').on('input', function() {
                if ($(this).val() !== $('#in-pass').val()) {
                    $('.error-message').remove();
                    $(this).addClass('error').after('<span class="error-message" style="color: red;">Invalid Password!!</span>');
                } else {
                    $(this).removeClass('error');
                    $('.error-message').remove();
                }
            });

            $(".toggle-password").click(function() {
                var input = $(this).siblings('input');
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                    $(this).removeClass("bi-eye-slash").addClass('bi bi-eye');
                } else {
                    input.attr("type", "password");
                    $(this).addClass("bi-eye-slash").removeClass('bi-eye');
                }
            });

        });



        $('.form-rest-pass').removeAttr('hidden', true).hide();
        $('.btn-lupa-pass').click(function() {
            $('.form-login').hide();
            $('.form-rest-pass').show(200);
            $('.title-form').text('Reset Password');
        });


        $('#sign-up-btn, #btn-batal').click(function() {
            $('.form-login').show(200);
            $('.form-rest-pass').hide();
            $('.title-form').text('Sign in');
            $('.email-rest').val('');
            $('.notif-email').removeClass('valid-email').removeClass('invalid-email').text('');
            $('.form-email-rest').removeClass('valid-email').removeClass('invalid-email');
            $('#btn-submit').attr('disabled', true);
        });

        $('.email-rest').on('input', function() {
            let formData = new FormData();
            formData.append('email', $('.email-rest').val());
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Auth/cek_email_rest_pass'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    action_email_rest(data)

                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        });
        $('#btn-submit').on('click', function() {
            let formData = new FormData();
            formData.append('email', $('.email-rest').val());
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Auth/ins_token_pass'); ?>",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    // alert(data);
                    Swal.fire({
                        title: "Proses Berhasil !",
                        text: "Silakan periksa email Anda untuk mengubah kata sandi Anda",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed || result.dismiss === Swal.DismissReason.cancel) {
                            // Redirect to the appropriate URL after user interaction
                            $('.form-login').show(200);
                            $('.form-rest-pass').hide();
                            $('.title-form').text('Sign in');
                            $('.email-rest').val('');
                            $('.notif-email').removeClass('valid-email').removeClass('invalid-email').text('');
                            $('.form-email-rest').removeClass('valid-email').removeClass('invalid-email');
                            $('#btn-submit').attr('disabled', true);
                            window.open('https://mail.google.com/', '_blank');
                        }
                    });
                },
                error: function() {
                    alert("Data Gagal Diupload");
                }
            });
        });

        function getCookie(name) {
            const cookies = document.cookie.split('; ');
            for (let i = 0; i < cookies.length; i++) {
                const parts = cookies[i].split('=');
                if (parts[0] === name) {
                    return decodeURIComponent(parts[1]);
                }
            }
            return null;
        }

        function cek_userdaftar() {
            const cookieData = getCookie('userdaftar');
            if (cookieData) {
                // Decode JSON string from cookie
                const userData = JSON.parse(cookieData);

                // Akses data yang diperlukan
                const userdaftar = userData.userdaftar || {};
                const codeReferral = userdaftar.code_referral || '';
                const nama = userdaftar.nama || '';
                const email = userdaftar.email || '';
                const noWa = userdaftar.no_wa || '';
                const domisili = userdaftar.domisili || '';
                const ktp = userdaftar.ktp || '';


                // Contoh: Mengisi input dengan data
                $('#code_referral').val(codeReferral).attr('readonly', true);
                $('#nama').val(nama).attr('readonly', true);
                $('#email').val(email).attr('readonly', true);
                $('#no_wa').val(noWa).attr('readonly', true);
                $('#domisili').val(domisili).change().attr('disabled', true);

                if (codeReferral == '') {
                    $('#row-referral').hide();
                } else {
                    $('#row-referral').show();
                }

                cek_statusdaftar(email);
            } else {
                // console.error('Cookie userdata tidak ditemukan.');
                $('#btn-daftar').show().attr('type', 'submit');

            }
        }

        // cek_statusdaftar(email);
        function cek_statusdaftar(email) {

            // var email = 'drachmawati43@gmail.com';
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('Daftar/cek_statusdaftar'); ?>",
                data: {
                    email: email,
                },
                cache: false,
                dataType: "json", // Harapkan respons dalam format JSON
                success: function(response) {
                    var html = '';
                    // Cek apakah response.status adalah string
                    if (typeof response.status === 'string') {
                        // Ubah string menjadi array menggunakan split
                        const statusArray = response.status.split(',');

                        // Iterasi setiap item dalam array status
                        statusArray.forEach(function(item, index) {
                            // console.log(`Status ${index + 1}:`, item.trim());

                            if (item.trim() === 'notfound') {
                                $('#btn-daftar').hide().attr('type', 'button');
                                $('#row-aktivasi').show();
                                $('#row-password').hide();

                                // console.log('bbb')
                            } else if (item.trim() == '0') {
                                // console.log('aaaaa')
                            }
                        });
                    } else {
                        console.error("Response status bukan string:", response.status);
                    }
                    // Periksa code_referral
                },
                error: function(xhr, status, error) {
                    console.error("Kesalahan AJAX:", status, error);
                    alert("Data Gagal Diupload");
                }
            });
        }

        function action_email_rest(data) {
            if (data == 1) {
                $('.form-email-rest').addClass('valid-email').removeClass('invalid-email');
                $('.notif-email').addClass('valid-email').removeClass('invalid-email').text('Email ini tersedia !');
                $('#btn-submit').removeAttr('disabled', true);
            } else {
                $('.form-email-rest').addClass('invalid-email').removeClass('valid-email');
                $('.notif-email').addClass('invalid-email').removeClass('valid-email').text('Email ini tidak valid !');
                $('#btn-submit').attr('disabled', true);
            }
        }
        // show password
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            var icon = document.querySelector(' .toggle-password');
            if (passwordInput.type === "password") {
                $('#password').attr('type', 'password');
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                $('#password').attr('type', 'text');
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        // untuk tambah data
        function populateKota() {
            $.ajax({
                url: '<?= site_url('Daftar/get_ajax_kab') ?>',
                type: 'GET',
                success: function(data) {
                    $('#domisili').html(data);
                    cek_userdaftar();

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
    </script>
</body>

</html>