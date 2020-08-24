<?php if ($this->session->flashdata('message')) { ?>
    <br>
    <?php echo $this->session->flashdata('message') ?>
<?php } ?>
<style type="text/css">
    .jumbotron {
        text-decoration: none;
        padding: 15px;
        height: auto;
        width: 300px;
        margin: auto;
        color: black;
        min-height: 90px;
    }

    .hupla {
        margin: auto;
        padding: 15px;
        color: white;
        width: 23%;
        background-color: rgba(0, 0, 0, 0.7);
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
<div style="background-image: url('<?php echo base_url('assets/image/bg2.jpeg'); ?>'); color: white; text-align: center; background-size: cover; min-height: 92vh;"><br>
    <br><br><br>
    <h3>Selamat datang di </h3>
    <h2>Sistem Informasi Finansial Bank BJB</h2>
    <br><br><br><br><br><br>



    <div class="container">
        <div class="row" style="text-align: center;">
            <a href="<?= base_url('rbb'); ?>" class="jumbotron">
                <div style="width: 30%; float: left;">
                    <img src="<?php echo base_url('assets/image/plan.png'); ?>" class="symbol-menu" style="width: 60px;">
                </div>
                <div>
                    <b>RBB</b><br>
                    Rencana Bisnis Bank
                </div>
            </a>
            <a href="<?= base_url('pks'); ?>" class="jumbotron">
                <div style="width: 30%; float: left;">
                    <img src="<?php echo base_url('assets/image/agreement.png'); ?>" class="symbol-menu" style="width: 60px;">
                </div>
                <div>
                    <b>PKS</b><br>
                    Perjanjian Kerjasama
                </div>
            </a>
            <a href="<?= base_url('invoice'); ?>" class="jumbotron">
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

    <div class="row" style="width: 100%; padding: auto;">
        <a href="<?= base_url('laporan'); ?>" class="hupla">
            <img src="<?php echo base_url('assets/image/report.png'); ?>" class="symbol-menu" style="width: 55px; margin-right: 15px;">
            Laporan Gabungan
        </a>
        <a href="<?= base_url('vendor'); ?>" class="hupla">
            <img src="<?php echo base_url('assets/image/vendor.png'); ?>" class="symbol-menu" style="width: 60px; margin-right: 15px;">
            Vendor
        </a>
        <a href="<?= base_url('JProject'); ?>" class="hupla">
            <img src="<?php echo base_url('assets/image/jp.png'); ?>" class="symbol-menu" style="width: 60px; margin-right: 15px;">
            Jenis Project
        </a>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
        <a href="<?= base_url('register'); ?>" class="hupla">
            <img src="<?php echo base_url('assets/image/add_account.png'); ?>" class="symbol-menu" style="width: 40px; margin-right: 15px;">
            Tambah Akun
        </a>
    <?php endif;?>
    </div>
    <br><br><br>
</div>