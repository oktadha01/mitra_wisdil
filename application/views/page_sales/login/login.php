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
                        <i class="fa fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required autofocus autocomplete="current-email" />
                    </div>
                    <div class="input-field form-login">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" name="password" required autofocus autocomplete="current-password" />
                        <i class="toggle-password fa fa-eye" onclick="togglePasswordVisibility('password')"></i>
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
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <form class="sign-up-form" style="align-items:normal">
                    <!-- <div class="card-body"> -->

                    <h2 class="title text-center mb-4">Daftar Akun Mitra</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <!-- <label>Nama</label> -->
                                <input type="text" name="nama" id="nama" placeholder="Nama Lengkap" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <!-- <label>Email</label> -->
                                <input type="email" name="email" id="email" placeholder="Email" required="" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <!-- <label>No Wa</label> -->
                                <input type="number" name="no_wa" id="no_wa" placeholder="No Wa" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <!-- <label>Kota / kabupaten</label> -->
                                <select name="domisili" id="domisili" class="select2 form-control">

                                </select>
                                <!-- <input type="text"  name="domisili" placeholder="Domisili Kota/Kabupaten" required="" class="form-control"> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <!-- <label>No Wa</label> -->
                                <input type="text" name="code_referral" id="code_referral" placeholder="Code Referral" class="form-control">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <!-- <label>No Wa</label> -->
                                <input type="text" name="nm_marketing" id="nm_marketing" readonly class="form-control" hidden>
                            </div>
                        </div>
                    </div>
                    <div id="row-upload-foto" class="row">
                        <i class="ml-4 small">Silahkan upload foto ktp anda *</i>

                        <div class="col-12">
                            <div class="main-wrapper">
                                <div class="upload-main-wrapper">
                                    <div class="upload-wrapper">
                                        <input type="file" id="upload-file" accept="image/*">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid meet" viewBox="224.3881704980842 176.8527621722847 221.13266283524905 178.8472378277154" width="221.13" height="178.85">
                                            <defs>
                                                <path d="M357.38 176.85C386.18 176.85 409.53 204.24 409.53 238.02C409.53 239.29 409.5 240.56 409.42 241.81C430.23 246.95 445.52 264.16 445.52 284.59C445.52 284.59 445.52 284.59 445.52 284.59C445.52 309.08 423.56 328.94 396.47 328.94C384.17 328.94 285.74 328.94 273.44 328.94C246.35 328.94 224.39 309.08 224.39 284.59C224.39 284.59 224.39 284.59 224.39 284.59C224.39 263.24 241.08 245.41 263.31 241.2C265.3 218.05 281.96 199.98 302.22 199.98C306.67 199.98 310.94 200.85 314.93 202.46C324.4 186.96 339.88 176.85 357.38 176.85Z" id="b1aO7LLtdW"></path>
                                                <path d="M306.46 297.6L339.79 297.6L373.13 297.6L339.79 255.94L306.46 297.6Z" id="c4SXvvMdYD"></path>
                                                <path d="M350.79 293.05L328.79 293.05L328.79 355.7L350.79 355.7L350.79 293.05Z" id="b11si2zUk"></path>
                                            </defs>
                                            <g>
                                                <g>
                                                    <g>
                                                        <use xlink:href="#b1aO7LLtdW" opacity="1" fill="#ffffff" fill-opacity="1"></use>
                                                    </g>
                                                    <g>
                                                        <g>
                                                            <use xlink:href="#c4SXvvMdYD" opacity="1" fill="#363535" fill-opacity="1"></use>
                                                        </g>
                                                        <g>
                                                            <use xlink:href="#b11si2zUk" opacity="1" fill="#363535" fill-opacity="1"></use>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="file-upload-text">Upload Foto KTP</span>
                                        <div class="file-success-text">
                                            <svg version="1.1" id="check" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" xml:space="preserve">
                                                <circle style="fill:rgba(0,0,0,0);stroke:#ffffff;stroke-width:10;stroke-miterlimit:10;" cx="49.799" cy="49.746" r="44.757" />
                                                <polyline style="fill:rgba(0,0,0,0);stroke:#ffffff;stroke-width:10;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="27.114,51 41.402,65.288 72.485,34.205" />
                                            </svg> <span>Successfully</span>
                                        </div>
                                    </div>
                                    <p id="file-upload-name"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="row-file-ktp" class="row li-list mb-4" hidden>
                        <div class="align-content-around col-2 pl-0">
                            <span class="bg-border-span btn-view-ktp"><i class="bi bi-filetype-pdf"></i></span>
                        </div>
                        <div class="col-6 p-0 align-content-center">
                            <h6 class="mb-0 font-weight-bold btn-view-ktp">file Foto KTP</h6>
                            <!-- <span class="small border-radius-gray text-file-pdf">text file pdf</span> -->
                        </div>
                        <div class="align-content-center align-right col-4 p-0">
                            <button type="button" class="btn btn-sm btn-ubah-ktp float-end" value="ubah">Lihat</button>
                        </div>
                    </div>
                    <div id="row-text-verifikasi" class="row mt-4" hidden>
                        <div class="col-12">
                            <i class="small">*Data sedang diverifikasi untuk memastikan keakuratannya. Kami akan memberikan informasi melalui email atau WhatsApp setelah proses selesai.*</i>
                        </div>
                    </div>
                    <div id="row-text-cekulang" class="row">
                    </div>
                    <div id="row-token" class="row" hidden>

                        <div class="col-12">
                            <i class="small">*Silahkan cek email anda untuk mendapatkan kode konfirmasi*</i>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <!-- <label>No Wa</label> -->
                                <input type="text" name="token" id="token" placeholder="Kode Konfirmasi" class="form-control">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <button type="button" id="btn-not-send-email" class="btn btn-sm-coral solid w-100">Tidak menerima Kode</button>
                            </div>
                        </div>
                    </div>
                    <div id="row-input-password" class="row" hidden>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <input type="text" id="pass-sign-up" placeholder="Password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-12">
                            <button type="submit" id="btn-daftar" class="btn solid  w-100 ">Daftar</button>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <button type="button" id="btn-konfirmasi" class="btn bg-success solid w-100 float-right" data-action="konfir" hidden>Konfirmasi</button>
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
        var code_referral = $('#code_referral');
        var nama = $('#nama');
        var email = $('#email');
        var no_wa = $('#no_wa');
        var domisili = $('#domisili');
        $('#btn-konfirmasi,#row-upload-foto, #row-token,#row-file-ktp,#row-text-verifikasi, #nm_marketing, #row-input-password').removeAttr('hidden').hide();

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
                history.replaceState(null, '', window.location.origin + '/mitra_wisdil/' + $(this).data('page'));

            });
            $('.sign-up-form').submit(function() {
                event.preventDefault(); // Hentikan submit form

                let isValid = true; // Flag validasi
                $('.error-message').remove(); // Hapus pesan error sebelumnya
                $('input').removeClass('error'); // Hapus kelas error sebelumnya

                // Validasi input
                ['#nama', '#email', '#no_wa', '#domisili'].forEach(function(selector) {
                    let input = $(selector);
                    if (input.val().trim() === '') {
                        isValid = false;
                        input.addClass('error').after('<span class="error-message" style="color: red;">Field wajib diisi.</span>');
                    }
                });

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
                    },
                    cache: false,
                    dataType: "json", // Expect JSON response
                    success: function(response) {

                        if (response.status == 'success') {
                            Swal.fire({
                                title: "Proses Berhasil",
                                text: "Silahkan cek email anda untuk verfikasi email",
                                icon: "success"
                            });
                            $('#btn-daftar').hide();
                            $('#row-upload-foto').show();
                            $('#btn-konfirmasi').show();
                            $('#row-token').show();
                            nama.attr('readonly');
                            email.attr('readonly');
                            no_wa.attr('readonly');
                            domisili.attr('disabled');
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
                    title: "Kirim ulang verifikasi email",
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
                            url: "<?= base_url('Daftar/send_ulang_token') ?>",
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
                                    html: 'Sistem telah mengirimkan kode OTP ke email <span style="font-weight: bold;">' + emailInput + '</span>',
                                    icon: "success"
                                });

                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error: ', error); // Log error for debugging
                            }
                        });


                        // Lakukan sesuatu dengan emailInput, misalnya kirim AJAX atau form submit
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

            $('#btn-konfirmasi').click(function() {
                if ($(this).data('action') == 'konfir') {
                    konfirmasi_akun();
                } else if ($(this).data('action') == 'update') {
                    konfirmasi_ulang_akun();
                } else if ($(this).data('action') == 'login') {
                    konfirmasi_login();
                }
            });

            $('.btn-view-ktp').click(function() {
                Swal.fire({
                    title: "",
                    text: "",
                    imageUrl: "<?= base_url('upload/ktp/'); ?>" + $(this).data('ktp'),
                    imageWidth: 350,
                    imageHeight: 200,
                    imageAlt: "Custom image"
                });
            });

            $('.btn-ubah-ktp').click(function() {

                if ($(this).text() == 'Ubah') {
                    $('#row-upload-foto').show(200);
                    $('#row-file-ktp').hide(200);

                } else if ($(this).text() == 'Lihat') {
                    Swal.fire({
                        title: "",
                        text: "",
                        imageUrl: "<?= base_url('upload/ktp/'); ?>" + $(this).data('ktp'),
                        imageWidth: 350,
                        imageHeight: 200,
                        imageAlt: "Custom image"
                    });
                }
            })

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
                // $('#code_referral').val(codeReferral);
                $('#nama').val(nama).attr('readonly', true);
                $('#email').val(email).attr('readonly', true);
                $('#no_wa').val(noWa).attr('readonly', true);
                $('#domisili').val(domisili).change().attr('disabled', true);

                cek_statusdaftar(email);
            } else {
                console.error('Cookie userdata tidak ditemukan.');
                $('#btn-daftar').show().attr('type', 'submit');;
                $('#row-upload-foto').hide();
                $('#btn-konfirmasi').hide();
                $('#row-token').hide();

            }
        }

        function cek_statusdaftar(email) {
            // alert('oke')
            // var email = 'oktadha01@gmail.com';
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
                                $('#row-upload-foto, #btn-konfirmasi, #row-token').show();
                                // console.log('aaaaa')
                            } else if (item.trim() === '0') {
                                $('#btn-daftar').hide().attr('type', 'button');
                                $('#row-file-ktp, #row-text-verifikasi').show();
                                $('#row-upload-foto, #btn-konfirmasi, #row-token, #row-text-cekulang').hide();
                                $('.btn-view-ktp').attr('data-ktp', response.ktp || '');
                                $('.btn-ubah-ktp').text('Lihat').attr('data-ktp', response.ktp || '');
                            } else if (item.trim() === '1') {
                                // alert('oke')
                                $('#row-text-verifikasi .small').text('*Akun anda telah berhasil di aktivasi. Silahkan Input password untuk login ke akun mitra wisdil.*');
                                $('#row-text-verifikasi').addClass('position-absolute').show();
                                $('#btn-konfirmasi').removeClass('bg-success').addClass('bg-primary text-light').attr('data-action', 'login').text('Submit').show()
                                $('#no_wa, #code_referral, #nm_marketing, #btn-daftar').hide();
                                $('#domisili').select2('destroy').hide();
                                $('#row-input-password').addClass('mt-4').show();
                            }

                            if (item.trim() === 'cekulang') {
                                $('#btn-daftar').hide().attr('type', 'button');
                                $('#row-file-ktp, #row-text-cekulang').show();
                                $('#btn-konfirmasi').attr('data-action', 'update').show();
                                $('.btn-view-ktp').attr('data-ktp', response.ktp || '');
                                $('.btn-ubah-ktp').attr('data-ktp', response.ktp || '');
                                $('#row-text-verifikasi').hide();
                                cekulang_input();
                            } else if (item.trim() === 'nama') {
                                console.log('nama');
                                $('#nama').addClass('error').attr('data-input', 'invalid').removeAttr('readonly').after('<span class="error-message" style="color: red;">Invalid Nama</span>');
                                html += '<li class="small">Pastikan Nama cocok dengan indentitas <sup class="text-danger">*</sup></li>';
                            } else if (item.trim() === 'no_wa') {
                                console.log('no_wa');
                                $('#no_wa').addClass('error').attr('data-input', 'invalid').removeAttr('readonly').after('<span class="error-message" style="color: red;">Invalid No Wa</span>');
                                html += '<li class="small">Gunakan No Whatsapp yang  aktif <sup class="text-danger">*</sup></li>';

                            } else if (item.trim() === 'ktp') {
                                console.log('ktp');
                                $('#upload-file').attr('data-input', 'update');
                                $('.btn-ubah-ktp').text('Ubah').attr('style', 'background: #fff6a4 !important; color: #e7ad00 !important');
                                html += '<li class="small">Pastikan KTP anda benar <sup class="text-danger">*</sup></li>';
                            } else {
                                // console.error("Status tidak dikenali:", item.trim());
                            }
                        });
                        $('#row-text-cekulang').append(html);
                    } else {
                        console.error("Response status bukan string:", response.status);
                    }
                    // Periksa code_referral
                    if (response.code_referral.trim() !== '' && response.status.trim() !== '1') {
                        $('#code_referral, #nm_marketing').show().attr('readonly', true);
                        $('#code_referral').val(response.code_referral).trigger('input');
                    } else if (response.code_referral.trim() !== '' && response.status.trim() == '1') {
                        $('#code_referral, #nm_marketing').hide();
                    } else {

                        $('#code_referral, #nm_marketing').hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Kesalahan AJAX:", status, error);
                    alert("Data Gagal Diupload");
                }
            });
        }

        function konfirmasi_akun() {

            const cookieData = getCookie('userdaftar');
            if (cookieData) {
                // Decode JSON string from cookie
                const userData = JSON.parse(cookieData);
                const userdaftar = userData.userdaftar || {};
                const token = userdaftar.token || '';
                const email = userdaftar.email || '';
                if ($('#token').val() == token) {

                    // console.log(token);

                    // Validasi input file
                    let fileInput = $('#upload-file')[0]; // Asumsikan ada input file dengan ID 'upload-file'
                    if (!fileInput || fileInput.files.length === 0) {
                        Swal.fire({
                            title: "Prosess Gagal",
                            text: "File gambar harus diunggah sebelum melanjutkan!",
                            icon: "error"
                        });
                        return; // Hentikan eksekusi jika file gambar kosong
                    }
                    // hapus error input token
                    $('.error-message').remove(); // Hapus pesan error sebelumnya
                    $('#token').removeClass('error'); // Hapus kelas error sebelumnya

                    // Buat objek FormData untuk mengirim data termasuk gambar
                    let formData = new FormData();
                    formData.append('ktp', fileInput.files[0]);

                    $.ajax({
                        url: "<?= base_url('Daftar/konfirmasi_akun') ?>",
                        method: "POST",
                        data: formData,
                        cache: false,
                        contentType: false, // Penting untuk pengiriman FormData
                        processData: false, // Jangan proses data agar FormData tidak diubah
                        dataType: "json", // Expect JSON response
                        success: function(response) {
                            // console.log(response);

                            if (response.status == 'success') {
                                Swal.fire({
                                    title: "Konfirmasi Berhasil",
                                    text: "Infokan ke admin untuk verifikasi lebih lanjut",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Jalankan window.open setelah tombol "OK" diklik
                                        window.open(
                                            "https://wa.me/6285864900443?text=Halo%20Admin%2C%0ASaya%20bermaksud%20mengajukan%20pembuatan%20akun%20mitra.%20Berikut%20adalah%20data%20saya%3A%0A%0A*Nama%20%3A*%20%5B" +
                                            $('#nama').val() +
                                            "%5D%0A*Domisili%20%3A*%20%5B" +
                                            $('#domisili').find(":selected").text() +
                                            "%5D%0A%0AMohon%20informasi%20lebih%20lanjut%20mengenai%20langkah%20pendaftaran%20dan%20persyaratan%20yang%20diperlukan.%0ATerima%20kasih%20atas%20perhatian%20dan%20bantuannya.%0A%0AHormat%20saya%2C%0A" + $('#nama').val() + "%20",
                                            "_blank"
                                        );
                                    }
                                });

                                cek_statusdaftar(email);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log('AJAX Error: ' + status + ' ' + error + ' ' + xhr.responseText); // Log error jika ada
                        }
                    });
                } else if ($('#token').val() == '') {
                    $('#token').addClass('error').after('<span class="error-message" style="color: red;">Kode wajib diisi.</span>');

                } else {
                    $('#token').addClass('error').after('<span class="error-message" style="color: red;">Invalid Kode</span>');
                }
            }
        }

        function konfirmasi_login() {
            if ($('#pass-sign-up').val() == '') {
                $('#pass-sign-up').addClass('error').after('<span class="error-message" style="color: red;">Password tidak boleh kosong !!</span>');
                return;
            }
            $.ajax({
                url: "<?= base_url('Daftar/konfirmasi_login') ?>",
                method: "POST",
                data: {
                    password: $('#pass-sign-up').val()
                },
                cache: false,
                success: function(response) {
                    // console.log(response);
                    window.location.href = "<?= base_url('') ?>";
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error: ' + status + ' ' + error + ' ' + xhr.responseText); // Log error jika ada
                }
            });
        }

        function cekulang_input() {
            const cookieData = getCookie('userdaftar');
            if (cookieData) {
                // Decode JSON string from cookie
                const userData = JSON.parse(cookieData);
                const userdaftar = userData.userdaftar || {};
                const nama = userdaftar.nama || '';
                const no_wa = userdaftar.no_wa || '';
                $('#nama').on('input', function() {
                    if ($(this).val() == nama) {
                        $(this).addClass('error').after('<span class="error-message" style="color: red;">Invalid Nama</span>');
                        $(this).attr('data-input', 'invalid');
                    } else {
                        $(this).attr('data-input', 'valid');
                        $(this).removeClass('error').next('.error-message').remove();
                    }
                });
                $('#no_wa').on('input', function() {
                    if ($(this).val() == no_wa) {
                        $(this).attr('data-input', 'invalid');
                        $(this).addClass('error').after('<span class="error-message" style="color: red;">Invalid No WA</span>');
                    } else {
                        $(this).attr('data-input', 'valid');
                        $(this).removeClass('error').next('.error-message').remove();
                    }
                });
            }
        }

        function konfirmasi_ulang_akun() {
            // Validasi input file
            var filektp = '';
            if ($('#upload-file').attr('data-input') == 'update') {
                let fileInput = $('#upload-file')[0]; // Asumsikan ada input file dengan ID 'upload-file'
                if (!fileInput || fileInput.files.length === 0) {
                    Swal.fire({
                        title: "Proses Gagal",
                        text: "File KTP harus diunggah sebelum melanjutkan!",
                        icon: "error"
                    });
                    return; // Hentikan eksekusi jika file gambar kosong
                }
                var filektp = fileInput.files[0];
            }

            // Validasi input nama
            let namaInput = $('#nama');
            if (namaInput.data('input') === 'invalid') {
                Swal.fire({
                    title: "Input Tidak Valid",
                    text: "Nama tidak valid! Silakan periksa kembali.",
                    icon: "error"
                });
                return; // Hentikan eksekusi jika nama tidak valid
            }

            // Validasi input no_wa
            let noWAInput = $('#no_wa');
            if (noWAInput.data('input') === 'invalid') {
                Swal.fire({
                    title: "Input Tidak Valid",
                    text: "Nomor WA tidak valid! Silakan periksa kembali.",
                    icon: "error"
                });
                return; // Hentikan eksekusi jika nomor WA tidak valid
            }

            // Hapus error sebelumnya
            $('.error-message').remove(); // Hapus pesan error sebelumnya
            $('#token').removeClass('error'); // Hapus kelas error sebelumnya

            // Buat objek FormData untuk mengirim data termasuk gambar
            let formData = new FormData();
            formData.append('nama', namaInput.val());
            formData.append('no_wa', noWAInput.val());
            formData.append('ktp', filektp);

            // Lakukan AJAX request
            $.ajax({
                url: "<?= base_url('Daftar/konfirmasi_ulang_akun') ?>", // URL server-side handler
                method: "POST",
                data: formData,
                cache: false,
                processData: false, // Jangan proses data seperti query string
                contentType: false, // Jangan set header content-type
                dataType: "json", // Expected JSON response
                success: function(response) {
                    if (response.status == 'berhasil') {
                        Swal.fire({
                            title: "Konfirmasi Berhasil",
                            text: "Infokan ke admin untuk verifikasi lebih lanjut",
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Jalankan window.open setelah tombol "OK" diklik
                                window.open(
                                    "https://wa.me/6285864900443?text=Halo%20Admin%2C%0ASaya%20bermaksud%20mengajukan%20pembuatan%20akun%20mitra.%20Berikut%20adalah%20data%20saya%3A%0A%0A*Nama%20%3A*%20%5B" +
                                    $('#nama').val() +
                                    "%5D%0A*Domisili%20%3A*%20%5B" +
                                    $('#domisili').find(":selected").text() +
                                    "%5D%0A%0AMohon%20informasi%20lebih%20lanjut%20mengenai%20langkah%20pendaftaran%20dan%20persyaratan%20yang%20diperlukan.%0ATerima%20kasih%20atas%20perhatian%20dan%20bantuannya.%0A%0AHormat%20saya%2C%0AWisdil.com%20",
                                    "_blank"
                                );
                            }
                        });
                        var email = $('#email').val();
                        cek_statusdaftar(email);
                        $('#row-text-cekulang').hide();
                        namaInput.attr('readonly', true)
                        noWAInput.attr('readonly', true)
                    } else {
                        Swal.fire({
                            title: "Proses Gagal",
                            text: "Terjadi kesalahan. Silakan coba lagi.",
                            icon: "error"
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', error); // Log error for debugging
                    Swal.fire({
                        title: "Proses Gagal",
                        text: "Terjadi kesalahan pada proses pengiriman data.",
                        icon: "error"
                    });
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
                passwordInput.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
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