<div style="background-image: url('<?php echo base_url('assets/image/bg2.jpeg'); ?>'); color: white; text-align: center; background-size: cover; min-height: 92vh;"><br>

    <?php if ($this->session->flashdata('message')) { ?>
        <br>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>
    <style type="text/css">
        .jumbotron {
            margin: auto;
            padding: 15px;
            min-height: 90px;
            width: 300px;
            color: black;
            min-height: 90px;
        }

        .hupla {
            margin: auto;
            padding: 15px;
            color: white;
            width: 23%;
            min-height: 90px;
            background-color: rgba(0, 0, 0, 0.7);
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
    <br><br><br><br>
    <h3>Selamat datang di </h3>
    <h2>Sistem Informasi Finansial Bank BJB</h2>
    <br><br><br><br><br><br>



    <div class="container">
        <div class="row" style="text-align: center;">
            <a href="<?= base_url('rbb'); ?>" class="jumbotron" style="text-decoration: none;">
                <div style="width: 30%; float: left;">
                    <img src="<?php echo base_url('assets/image/plan.png'); ?>" class="symbol-menu" style="width: 60px;">
                </div>
                <div>
                    <b>RBB</b><br>
                    Rencana Bisnis Bank
                </div>
            </a>
            <a href="<?= base_url('pks'); ?>" class="jumbotron" style="text-decoration: none;">
                <div style="width: 30%; float: left;">
                    <img src="<?php echo base_url('assets/image/agreement.png'); ?>" class="symbol-menu" style="width: 60px;">
                </div>
                <div>
                    <b>PKS</b><br>
                    Perjanjian Kerjasama
                </div>
            </a>
            <a href="<?= base_url('invoice'); ?>" class="jumbotron" style="text-decoration: none;">
                <div style="width: 30%; float: left;">
                    <img src="<?php echo base_url('assets/image/invoice.png'); ?>" class="symbol-menu" style="width: 50px;">
                </div>
                <div>
                    <b>Invoice</b><br>
                    Pembayaran
                </div>
            </a>

        </div>
    </div>

    <br><br>

    <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
        <div class="row" style="width: 100%; padding: auto; margin: auto;">
            <a href="<?= base_url('laporan'); ?>" class="hupla" style="text-decoration: none;">
                <img src="<?php echo base_url('assets/image/report.png'); ?>" class="symbol-menu" style="width: 55px; margin-right: 15px;">
                Laporan Gabungan
            </a>
            <a href="<?= base_url('vendor/daftar_vendor'); ?>" class="hupla" style="text-decoration: none;">
                <img src="<?php echo base_url('assets/image/vendor.png'); ?>" class="symbol-menu" style="width: 60px; margin-right: 15px;">
                Vendor
            </a>
            <a href="<?= base_url('JProject'); ?>" class="hupla" style="text-decoration: none;">
                <img src="<?php echo base_url('assets/image/jp.png'); ?>" class="symbol-menu" style="width: 60px; margin-right: 15px;">
                Jenis Project
            </a>
            <a href="<?= base_url('auth/seeAllUser'); ?>" class="hupla" style="text-decoration: none;">
                <img src="<?php echo base_url('assets/image/add_account.png'); ?>" class="symbol-menu" style="width: 40px; margin-right: 15px;">
                Daftar Pengguna
            </a>
        </div>
    <?php endif; ?>
    <?php if ($user['ROLE'] == 'GROUP HEAD') : ?>
        <div class="container">
            <div class="row" style="width: 100%; padding: auto; margin: auto;">
                <a href="<?= base_url('laporan'); ?>" style="width: 30%; text-decoration: none;" class="hupla">
                    <img src="<?php echo base_url('assets/image/report.png'); ?>" class="symbol-menu" style="width: 55px; margin-right: 15px;">
                    Laporan Gabungan
                </a>
                <a href="<?= base_url('vendor/daftar_vendor'); ?>" style="width: 30%; text-decoration: none;" class="hupla">
                    <img src="<?php echo base_url('assets/image/vendor.png'); ?>" class="symbol-menu" style="width: 60px; margin-right: 15px;">
                    Vendor
                </a>
                <a href="<?= base_url('JProject'); ?>" style="width: 30%; text-decoration: none;" class="hupla">
                    <img src="<?php echo base_url('assets/image/jp.png'); ?>" class="symbol-menu" style="width: 60px; margin-right: 15px;">
                    Jenis Project
                </a>
            </div>
        </div>
    <?php endif; ?>

    <br><br><br>
</div>