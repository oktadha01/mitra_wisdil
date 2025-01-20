<style>
    .menu-proses-penarikan {
        cursor: pointer;
    }

    .menu-proses-penarikan.active {
        background: #17a2b8;
        color: aliceblue;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12 p-0">
            <ul class="d-flex list-unstyled box--shadow ul-border-saldo">
                <li class="li-border-icon-saldo">
                    <i class="fa-regular fa-credit-card"></i>
                </li>
                <li>
                    <span class="font-weight-bold">Saldo</span>
                    <br>
                    <h6 class="text-primary font-weight-bold">Rp. <span class="saldo"><?= number_format($saldo, 0, ',', '.'); ?></span></h6>
                </li>
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-12 p-0">
            <ul class="d-flex list-unstyled box--shadow ul-border-saldo menu-proses-penarikan">
                <li class="li-border-icon-saldo">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </li>
                <li>
                    <span class="font-weight-bold">Dalam Proses Penarikan</span>
                    <br>
                    <h6 class="text-warning font-weight-bold">Rp. <span class="total-proses-penarikan"></span></h6>
                </li>
            </ul>
        </div>
    </div>
    <hr>
    <div class="row border-blue">
        <div class="col-lg-12">
            <div class="table-wd" hidden>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped box--shadow" style="width:100%">
                        <thead>
                            <tr>
                                <th width=''>No WD</th>
                                <th width=''>Tanggal</th>
                                <th width=''>Nominal</th>
                                <th width=''>Biaya</th>
                                <th width=''>Total</th>
                            </tr>
                        </thead>
                        <tbody id="load-data-transaksi-proses"></tbody>
                    </table>
                    <tfoot>
                    </tfoot>
                </div>
                <button class="btn col-12 btn-dark font-weight-bold close-table-wd">Close</button>
            </div>
            <?php foreach ($sales as $row) { ?>
                <div class="row">
                    <div class=" col-12">
                        <h6 class="font-weight-bold"> AKUN MITRA </h6>
                        <ul class="ml-3 list-inline">
                            <li>
                                <span>Nama</span>
                                <span class="float-right"><?= $row->nama; ?></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>Gmail</span>
                                <span class="float-right"><?= $row->email; ?></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>Kontak</span>
                                <span class="float-right"><?= $row->no_wa; ?></span>
                                <hr class="m-1">
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <h6 class="font-weight-bold"> KIRIM KE </h6>
                        <ul class="ml-3 list-inline">
                            <li>
                                <span>Bank</span>
                                <span class="float-right"><?= $row->bank; ?></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>Atas Nama</span>
                                <span class="float-right"><?= $row->nama_pemilik; ?></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>No.Rekening</span>
                                <span class="float-right"><?= $row->no_rekening; ?></span>
                                <hr class="m-1">
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
            <div class="body table-responsive">
                <table class="table table-bordered table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th width=''>Pilih</th>
                            <th width=''>Event</th>
                            <th width=''>Profit</th>
                        </tr>
                    </thead>
                    <tbody id="load-data-transaksi"></tbody>
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-right font-weight-bold">Nominal Saldo Ditarik</td>
                            <td><span class="font-weight-bold">Rp. </span><span class="nominal font-weight-bold text-info">0</span></td>
                        </tr>
                        <tr id="tr-biaya-transaksi">
                            <td colspan="2" class="text-right font-weight-bold">Biaya Transaksi</td>
                            <td><span class="font-weight-bold">Rp. </span><span class="biaya font-weight-bold text-danger">2.775</span></td>
                        </tr>
                        <tr class="bg-primary text-white" id="tr-total-transaksi">
                            <td colspan="2" class="text-right font-weight-bold">Total Transaksi</td>
                            <td><span class="font-weight-bold">Rp. </span><span class="total font-weight-bold text-white">0</span></td>
                        </tr>
                    </tbody>
                </table>
                <button id="btn-withdrawal" class="btn btn-success w-100" disabled>Withdrawal</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Withdrawal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class=" col-12">
                        <h6 class="font-weight-bold"> AKUN MITRA </h6>
                        <ul class="ml-3 list-inline">
                            <li>
                                <span>Nama</span>
                                <span class="float-right"><?= $this->session->userdata('userdata')->nama; ?></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>Gmail</span>
                                <span class="float-right"><?= $this->session->userdata('userdata')->email; ?></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>Kontak</span>
                                <span class="float-right"><?= $this->session->userdata('userdata')->no_wa; ?></span>
                                <hr class="m-1">
                            </li>
                        </ul>
                    </div>
                    <div class=" col-12">
                        <h6 class="font-weight-bold"> KIRIM KE </h6>
                        <ul class="ml-3 list-inline">
                            <li>
                                <span>Bank</span>
                                <span class="float-right" id="bank"></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>Atas Nama</span>
                                <span class="float-right" id="atas-nama"></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>No.Rekening</span>
                                <span class="float-right" id="no-rekening"></span>
                                <hr class="m-1">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="body table-responsive">
                    <table class="table table-bordered table-hover table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width=''>Event</th>
                                <th width=''>Trasaksi</th>
                                <th width=''>Profit</th>
                            </tr>
                        </thead>
                        <tbody id="load-detail-withdrawal"></tbody>
                        <tbody>
                            <tr>
                                <td colspan="2" class="text-right font-weight-bold">Nominal Saldo Ditarik</td>
                                <td><span class="font-weight-bold">Rp. </span><span class="nominal font-weight-bold text-info">0</span></td>
                            </tr>
                            <tr id="tr-biaya-transaksi">
                                <td colspan="2" class="text-right font-weight-bold">Biaya Transaksi</td>
                                <td><span class="font-weight-bold">Rp. </span><span class="biaya font-weight-bold text-danger">2.775</span></td>
                            </tr>
                            <tr class="bg-primary text-white" id="tr-total-transaksi">
                                <td colspan="2" class="text-right font-weight-bold">Total Transaksi</td>
                                <td><span class="font-weight-bold">Rp. </span><span class="total font-weight-bold text-white">0</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>