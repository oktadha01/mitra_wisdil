<style>

</style>
<div class="container">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-12 p-1">
            <ul class="d-flex list-unstyled box--shadow ul-border">
                <li class="li-border-icon">
                    <i class="fa fa-file-movie-o "></i>
                </li>
                <li>
                    <span class="font-weight-bold">Events</span>
                    <br>
                    <h3 class="text-primary font-weight-bold"><?= $total_event; ?></h3>
                </li>
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-12 p-1">
            <ul class="d-flex list-unstyled box--shadow ul-border">
                <li class="li-border-icon">
                    <i class="fa-solid fa-money-bill-transfer"></i>
                </li>
                <li>
                    <span class="font-weight-bold">Transaction</span>
                    <br>
                    <h3 class="text-primary font-weight-bold"><?= $total_transaksi; ?></h3>
                </li>
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-12 p-1">
            <ul class="d-flex list-unstyled box--shadow ul-border">
                <li class="li-border-icon">
                    <i class="fa-solid fa-sack-dollar"></i>
                </li>
                <li>
                    <span class="font-weight-bold">Profit</span>
                    <br>
                    <h3 class="text-primary font-weight-bold">Rp. <?= number_format($total_profit, 0, ',', '.'); ?></h3>
                </li>
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-12 p-1">
            <ul class="d-flex list-unstyled box--shadow ul-border">
                <li class="li-border-icon">
                    <i class="fa-solid fa-sack-dollar"></i>
                </li>
                <li>
                    <span class="font-weight-bold">In Withdrawal Process</span>
                    <br>
                    <h3 class="text-primary font-weight-bold">Rp. <?= number_format($dalam_proses_penarikan, 0, ',', '.'); ?></h3>
                </li>
            </ul>
        </div>
    </div>
</div>