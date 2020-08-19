<style type="text/css">
    .dropbtn {
        height: 100%;
        background-color: #204d95;
        color: white;
        padding: 16px;
        margin-left: 10px;
        margin-right: 10px;
        font-size: 16px;
        border: none;
    }

    .dropdown {
        border-left: 1px solid white;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .dropdown-content a {
        color: #204d95;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropdown {
        background-color: #007bff;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #204d95; position: fixed; width: 100%; padding-left: 0; z-index: 100; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.3);">
    <a class="navbar-brand" href="<?= base_url('dashboard'); ?>" style="margin-left: 20px; color: white; margin-right: 20px;">Bank BJB</a>
    <!--    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> -->

    <!-- DROPDOWN MENU NAVBAR-->
    <div class="dropdown">
        <button class="dropbtn" disabled>RBB</button>
        <div class="dropdown-content">
            <a href="<?php echo site_url('rbb'); ?>">Daftar RBB</a>
            <a href="<?php echo site_url('rbb/add'); ?>">Tambah RBB</a>
            <a href="<?php echo site_url('mutasi_rbb/Penyesuaian_RBB'); ?>">Penyesuaian RBB</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn" disabled>PKS</button>
        <div class="dropdown-content">
            <a href="<?php echo site_url('pks'); ?>">Daftar PKS</a>
            <a href="<?php echo site_url('pks/create'); ?>">Tambah PKS</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn" disabled>Invoice</button>
        <div class="dropdown-content">
            <a href="<?php echo site_url('Invoice'); ?>">Daftar Invoice</a>
            <a href="<?php echo site_url('Invoice/add'); ?>">Invoice Baru</a>
        </div>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="nav-item dropdown ml-auto">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="text-decoration: none; margin-right: 70px; color: white;">
                <?= $user['NAMA'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>"><img src="<?php echo base_url() . 'assets/image/logout.png' ?>" style="width: 15px;"><b> Logout</b></a>
            </div>
        </div>
    </div>
</nav>