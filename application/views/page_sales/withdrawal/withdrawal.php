<style>
    .menu-proses-penarikan {
        cursor: pointer;
        transition: 1s;
    }

    .menu-proses-penarikan.active {
        background: #17a2b8;
        color: aliceblue;
        transition: 1s;
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
                    <span class="font-weight-bold">Balance</span>
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
                    <span class="font-weight-bold">In Withdrawal Process</span>
                    <br>
                    <h6 class="text-warning font-weight-bold">Rp. <span class="total-proses-penarikan"></span></h6>
                </li>
            </ul>
        </div>
    </div>
    <div class="row table-wd" hidden>
        <div class="card">
            <div class="card-body border-img box--shadow card-body p-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th class="th-cus" width=''>No WD</th>
                                <th class="th-cus" width=''>Date</th>
                                <th class="th-cus" width=''>Nominal</th>
                                <th class="th-cus" width=''>Cost</th>
                                <th class="th-cus" width=''>Total</th>
                            </tr>
                        </thead>
                        <tbody id="load-data-transaksi-proses"></tbody>
                    </table>
                    <tfoot>
                    </tfoot>
                </div>
                <button class="btn col-12 btn-dark font-weight-bold close-table-wd">Close</button>
            </div>
        </div>
    </div>
    <hr>
    <div class="row border-blue">
        <div class="col-lg-12">
            <?php foreach ($sales as $row) { ?>
                <div class="row">
                    <div class=" col-12">
                        <h6 class="font-weight-bold"> Account Mitra </h6>
                        <ul class="ml-3 list-inline">
                            <li>
                                <span>Name</span>
                                <span class="float-right"><?= $row->nama; ?></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>Gmail</span>
                                <span class="float-right"><?= $row->email; ?></span>
                                <hr class="m-1">
                            </li>
                            <li>
                                <span>Contact</span>
                                <span class="float-right"><?= $row->no_wa; ?></span>
                                <hr class="m-1">
                            </li>
                        </ul>
                    </div>

                    <div class="col-12">
                        <h6 class="font-weight-bold"> SEND TO </h6>
                        <?php if ($row->bank == null) { ?>
                            <div class="col-12">
                                <div class="alert alert-warning" role="alert">
                                    <span class="cek-payment">You have not entered the transaction bank, <a href="<?= base_url('Profile'); ?>">click here</a> to complete the transaction bank data</span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <span class="cek-payment" hidden>valid</span>
                            <ul class="ml-3 list-inline">
                                <li>
                                    <span>Bank</span>
                                    <span class="float-right"><?= $row->bank; ?></span>
                                    <hr class="m-1">
                                </li>
                                <li>
                                    <span>Owner</span>
                                    <span class="float-right"><?= $row->nama_pemilik; ?></span>
                                    <hr class="m-1">
                                </li>
                                <li>
                                    <span>Account number</span>
                                    <span class="float-right"><?= $row->no_rekening; ?></span>
                                    <hr class="m-1">
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div class="body table-responsive">
                <table class="table table-bordered table-hover table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th width=''>Choose</th>
                            <th width=''>Events</th>
                            <th width=''>Profit</th>
                        </tr>
                    </thead>
                    <tbody id="load-data-transaksi"></tbody>
                    <tbody>
                        <tr>
                            <td colspan="2" class="text-right font-weight-bold">Total Balance Withdrawn</td>
                            <td><span class="font-weight-bold">Rp. </span><span class="nominal font-weight-bold text-info">0</span></td>
                        </tr>
                        <tr id="tr-biaya-transaksi">
                            <td colspan="2" class="text-right font-weight-bold">Transaction Fees</td>
                            <td><span class="font-weight-bold">Rp. </span><span class="biaya font-weight-bold text-danger">2.775</span></td>
                        </tr>
                        <tr class="bg-primary text-white" id="tr-total-transaksi">
                            <td colspan="2" class="text-right font-weight-bold">Total Transactions</td>
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
                        <?php foreach ($sales as $row) { ?>

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
                        <?php } ?>
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