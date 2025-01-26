<nav class="navbar navbar-fixed-top">
    <div class="container-fluid navmob">
        <div class="navbar-left">
            <img src="<?= base_url('assets\images\LOGO-WISDIL.jpg'); ?>" class="img-fluid img-logo-nav" alt="LOGO-WISDIL">
        </div>
        <div class="navbar-brand">
            <span class="text-light">Mitra Wisdil</span>
            <!-- <a href="index.html" class="text-light"> &ensp; Mitra Wisdil</a> -->
        </div>
        <div class="navbar-right">
            <div class="user-account m-0 p-0">
                <div class="dropdown">
                    <a href="<?= site_url('Profile'); ?>" style="font-size:25px; margin-top: 1px; margin-bottom: 1px;"><i class="bi bi-person-circle text-light"></i></a>
                    <!-- <ul class="dropdown-menu dropdown-menu-right account">
                        <li><a href="<?= site_url('Profile'); ?>"><i class=" fa fa-user-md"></i>My Profile</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= base_url('Login/logout'); ?>" class="icon-menu"><i
                                    class="fa fa-sign-out"></i>Logout</a>
                        </li>
                    </ul> -->
                </div>
            </div>
        </div>
    </div>
</nav>