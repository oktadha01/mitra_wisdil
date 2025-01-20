<div class="container search mt-5">
    <input type="text" id="searchInput" placeholder="Search...">
    <button><i class="fa-solid fa-magnifying-glass"></i></button>
</div>
<div class="container mt-3">
    <!-- <div class="col-lg-12">
        <div class="card">
            <div class="header row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <h2>Histori Withdrawal</h2>
                </div>
                <div class="body table-responsive">
                    <table id="data-histori-withdrawal" class="table table-bordered table-hover table-striped"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width=''>No WD</th>
                                <th width=''>Tanggal Pengajuan - Diterima</th>
                                <th width=''>Nominal</th>
                                <th width=''>Biaya</th>
                                <th width=''>Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
    <ul id="historiList" class="list-group">
    </ul>
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
</div>