<nav class="navbar navbar-fixed-top">
    <div class="container-fluid navmob">
        <div class="navbar-left">
            <img src="<?= base_url('assets\images\LOGO-WISDIL.jpg'); ?>" class="img-fluid img-logo-nav" alt="LOGO-WISDIL">
        </div>
        <div class="navbar-brand">
            <span class="text-light">Mitra Wisdil</span>
            <!-- <a href="index.html" class="text-light"> &ensp; Mitra Wisdil</a> -->
        </div>
        <?php if ($this->uri->segment(1) !== 'ResetPassword') { ?>
            <div class="navbar-right">
                <div class="user-account m-0 p-0">
                    <div class="dropdown">
                        <a href="<?= site_url('Profile'); ?>" style="font-size:25px; margin-top: 1px; margin-bottom: 1px;">
                            <i class="bi bi-person-circle text-light"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</nav>