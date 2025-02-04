<section class="container" style="margin-top: 6rem;height: 100%;margin-bottom: 5rem;">
    <!-- <div class="card">
        <div class="card-header">
            <h5>Profil</h5>
        </div> -->
    <!-- <div class="card-body"> -->
    <div class="row">
        <div class="col-12 p-0">
            <div class="alert alert-warning" role="alert">
                <span class="text-cek-bio">Silakan lengkapi biodata diri Anda dengan mengunggah KTP dan data Payment.</span>
            </div>
        </div>
    </div>
    <?php foreach ($sales as $data) { ?>
        <div class="row">
            <div class="col-lg-6 cla-md-6 col-12 p-0">
                <div class="card border-navy min-vh-28">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-lg-4 col-md-4 col-12">
                                <?php if ($data->ktp == '') { ?>
                                    <div id="btn-upload-file" class="border-in-ktp" hidden>
                                        <i class="bi bi-file-earmark-arrow-up" style="font-size: xx-large;"></i>
                                        <span>Upload file KTP</span>
                                    </div>
                                    <input type="file" id="btn-in-file" accept="image/*" hidden>
                                    <img id="preview-file" class="img-fluid" src="">
                                    <button id="btn-edit-file" class="btn btn-sm btn-warning col-12 mt-1 p-0" value="edit" hidden>Edit File</button>

                                <?php } else { ?>
                                    <div id="btn-upload-file" class="border-in-ktp" hidden>
                                        <i class="bi bi-file-earmark-arrow-up" style="font-size: xx-large;"></i>
                                        <span>Upload file KTP</span>
                                    </div>
                                    <input type="file" id="btn-in-file" accept="image/*" hidden>
                                    <img id="preview-file" src="<?= base_url('upload/ktp/') . $data->ktp; ?>" class="img-fluid border-img" alt="">
                                    <button id="btn-edit-file" class="btn btn-sm btn-warning col-12 mt-1 p-0" value="edit" hidden>Edit File</button>
                                <?php } ?>
                            </div>
                            <div class="col-lg-8 col-md-8 col-12 pt-3">
                                <h4 class="text-uppercase font-weight-bold"><?= $data->nama; ?></h4>
                                <ul class="pl-3">
                                    <li>
                                        <i class="bi bi-envelope"></i>
                                        <span><?= $data->email; ?></span>
                                    </li>
                                    <li>
                                        <span>kode referral :</span>
                                        <span>Kun123</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 cla-md-6 col-12 p-0">
                <div class="card border-navy min-vh-28">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <i>Data Domisili & No WhatsApp</i>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="input-wrapper mb-3 ml-0 mr-0">
                                    <label class="label-in-profile">Domisili</label>
                                    <select class="select2 select-kota" id="kota" required="" disabled data-value="<?= $data->domisili; ?>">
                                        <option value=''>-- Pilih Kota --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="input-group mb-3">
                                    <input type="number" id="kontak" class="w-100" required="" readonly value="<?= $data->no_wa; ?>">
                                    <label class="label-in-profile">No Whatsapp</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button id="btn-edit-data" class="col-12 btn btn-warning float-right">Edit data</button>
                            </div>
                            <div class="col-6">
                                <button id="btn-batal-edit-data" class="btn btn-danger text-light" hidden>Batal</button>
                            </div>
                            <div class="col-6">
                                <button id="btn-simpan-data" class="btn btn-info text-light float-right" hidden>Simpan data</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card border-navy pb-4">
                <div class="card-body pb-0">
                    <div class="col-12 mb-4">
                        <i>Data Payment</i>
                    </div>
                </div>
                <div class="row card-body card-in-pay pb-0" hidden>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="input-wrapper mb-3 ml-0 mr-0">
                            <label class="label-in-profile">Bank</label>
                            <select class="select2" id="bank" required="" disabled data-value="<?= $data->bank; ?>">
                                <option value=''>-- Pilih Nama Bank --</option>
                                <option value='BCA'>BCA</option>
                                <option value='BNI'>BNI</option>
                                <option value='BRI'>BRI</option>
                                <option value='BSI'>BSI</option>
                                <option value='BTN'>BTN</option>
                                <option value='Mandiri'>Mandiri</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="input-group mb-3">
                            <input type="number" id="no-rekening" class="w-100" required="" readonly value="<?= $data->no_rekening; ?>">
                            <label class="label-in-profile">No Rekening</label>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="input-group mb-3">
                            <input type="text" id="nama-pemilik" class="w-100" required="" readonly value="<?= $data->nama_pemilik; ?>">
                            <label class="label-in-profile">Nama Pemilik</label>
                        </div>
                    </div>
                </div>
                <div class="row card-body pt-0 pb-0">
                    <div class="col-12">
                        <button id="btn-edit-payment" class="col-12 btn btn-warning float-right">Edit payment</button>
                    </div>
                    <div class="col-6">
                        <button id="btn-batal-edit-payment" class="btn btn-danger text-light" hidden>Batal</button>
                    </div>
                    <div class="col-6">
                        <button id="btn-simpan-payment" class="btn btn-info text-light float-right" data-action="update" hidden>Simpan Payment</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card border-navy btn-ubah-email" data-email="<?= $data->email; ?>" data-toggle="modal" data-target="#modal-email">
                <div class="card-body">

                    <div class="col-12 ">
                        <span class="">Ubah Email ></span>
                        <span class="float-right text-email"><?= $data->email; ?></span>
                        <p id="notif-email"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card border-navy btn-ubah-password" data-action="page" data-toggle="modal" data-target="#modal-pass">
                <div class="card-body">
                    <div class="col-12">
                        <span class="">Ubah Password ></span>
                        <span class="float-right">*******</span>
                        <p id="notif-pass"></p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- </div> -->
    <!-- <div class="card-footer"> -->

    <!-- </div> -->
    <!-- </div> -->
    <div class="row row-btn-logout">
        <div class="col p-0">
            <a href="<?= base_url('Login/logout'); ?>">
                <button class="btn btn-danger col-12">Logout</button>
            </a>
        </div>
    </div>
</section>
<div class="modal fade" id="modal-email" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Ubah Email</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Ubah Email Baru</label>
                            <input type="email" id="email" class="form-control email-baru" required="">
                            <span class="valid_info"></span>
                        </div>
                    </div>
                    <div class="col-12 col-pass">
                        <div class="form-group">
                            <label>Validasi Password</label>
                            <input type="password" id="password" class="form-control" required="">
                            <span class="valid_pass"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                <button type="button" id="btn-simpan-email" class="btn btn-info text-light">Simpan Email</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-pass" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="">Ubah Password</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Password Lama</label>
                            <input type="text" id="pass-lama" class="form-control" required="">
                            <span id="validasi-pass-lama"></span>
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="text" id="pass-baru" class="form-control" readonly required="">
                            <span id="validasi-pass-baru"></span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-close-updt-pass" data-dismiss="modal">CLOSE</button>
                <button type="button" id="btn-simpan-pass" class="btn btn-info text-light">Simpan Password</button>
            </div>
        </div>
    </div>
</div>