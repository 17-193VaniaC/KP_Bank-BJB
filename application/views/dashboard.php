<?php if ($this->session->flashdata('message')) { ?>
<br>
    <?php echo $this->session->flashdata('message') ?>
<?php } ?>
<style type="text/css">
.jumbotron{
    text-decoration: none;
    padding: 15px;
    height: auto;
    width: 300px;
    margin: auto;
    color: black;
 }
 .hupla{
    color: white;
 }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
<div style="background-image: url('<?php echo base_url('assets/image/bg.jpg');?>'); color: white; text-align: center;"><br>
   <br><br><br> <h3>Selamat datang di </h3>
        <h1>Sistem Informasi Finansial Bank BJB</h1>
        <br><br>
<div class="container" >
    <div class="row" style="text-align: center;">
        <a href="<?= base_url('rbb'); ?>" class="jumbotron">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                <h3>RBB</h3>
                Rencana Bisnis Bank
        </a>
        <a href="<?= base_url('pks'); ?>" class="jumbotron">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                <h3>PKS</h3>
                Perjanjian Kerjasama
        </a>
        <a href="<?= base_url('invoice'); ?>" class="jumbotron">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                <h3>Tambah Invoice</h3>
                Pembayaran
        </a>
 <!--        <div class="col-sm-4">
            <a href="<?= base_url('rbb'); ?>"><button>
                    <h3>RBB</h3>
                </button></a>
        </div>
        <div class="col-sm-4">
            <a href="<?= base_url('pks'); ?>"><button>
                    <h3>PKS</h3>
                </button></a>
        </div>
        <div class="col-sm-4">
            <a href="<?= base_url('invoice'); ?>"><button>
                    <h3>Invoice</h3>
                </button></a> -->
        </div>
    </div>
    <br>
   
<!--     <div class="row">
        <div class="col-sm-4">
            <a href="<?= base_url('vendor'); ?>"><button>
                    <h3>Vendor</h3>
                </button></a>
        </div>
        <div class="col-sm-4">
            <a href="<?= base_url('jenis_project'); ?>"><button>
                    <h3>Jenis Project</h3>
                </button></a>
        </div>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
            <hr>
            <div class="col-sm-4">
                <a href="<?= base_url('register'); ?>"><button>
                        <h3>Register Account</h3>
                    </button></a>
            </div>
        <?php endif; ?>
    </div>
</div> -->
<br><br><br>
<!-- <div class="container" style="width: 100%; padding: 0;">
    <div class="row" style="width: 100%; padding: auto;">
        <a href="<?= base_url('laporan'); ?>" class="jumbotron" style="width: 23%;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                Laporan Gabungan
        </a>
        <a href="<?= base_url('pks'); ?>" class="jumbotron" style="width: 23%;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                Vendor
        </a>
        <a href="<?= base_url('invoice'); ?>" class="jumbotron" style="width: 23%;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                Jenis Project
        </a>
        <a href="<?= base_url('register'); ?>" class="jumbotron" style="width: 23%;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                Tambah Akun
        </a>
    </div></div> -->
    <div class="container" style="width: 100%; padding: 0;">
    <div class="row" style="width: 100%; padding: auto;">
        <a href="<?= base_url('laporan'); ?>" class="hupla" style="width: 23%;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                Laporan Gabungan
        </a>
        <a href="<?= base_url('pks'); ?>" class="hupla" style="width: 23%;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                Vendor
        </a>
        <a href="<?= base_url('invoice'); ?>" class="hupla" style="width: 23%;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                Jenis Project
        </a>
        <a href="<?= base_url('register'); ?>" class="hupla" style="width: 23%;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
                Tambah Akun
        </a>
    </div></div>
    <br><br>
</div>
