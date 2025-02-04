<?php $this->load->view('tmpt_mitra/header'); ?>

<body data-theme="light" class="font-nunito">
    <?php $this->load->view('tmpt_mitra/navbar'); ?>
    <?php if ($this->uri->segment(1) !== 'ResetPassword') { ?>

        <?php $this->load->view('tmpt_mitra/sidebar'); ?>
    <?php } ?>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="<?= base_url('assets/images/loader/logo.png') ?>" width="70" height="48"
                    alt="Iconic"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <div id="wrapper" class="theme-blue" style="
    height: -webkit-fill-available;
">
        <div class="main-content">
            <!-- <div class="container-fluid"> -->
            <?php $this->load->view($content); ?>
            <!-- </div> -->
        </div>
    </div>
    <?php $this->load->view('tmpt_mitra/footer'); ?>
    <?php $this->load->view($script); ?>

</body>