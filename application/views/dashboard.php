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
    min-height: 90px;
    /*background-color: rgba(0,0,0,0.7);*/
 }
 .hupla{
    margin-left: auto;
    padding: 10px;
    color: white;
    width: 23%;
    background-color: rgba(0,0,0,0.7);
 }

</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
<div style="background-image: url('<?php echo base_url('assets/image/bg.jpg');?>'); color: white; text-align: center;"><br>
   <br><br><br> <h3>Selamat datang di </h3>
        <h2>Sistem Informasi Finansial Bank BJB</h2>
        <br><br><br><br><br><br>



<div class="container" >
        <div class="row" style="text-align: center;">
            <a href="<?= base_url('rbb'); ?>" class="jumbotron">
            <div style="width: 30%; float: left;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
            </div><div>
                <b>RBB</b><br>
                Rencana Bisnis Bank
            </div>
        </a>
        <a href="<?= base_url('pks'); ?>" class="jumbotron">
            <div style="width: 30%; float: left;">
                <img src="<?php echo base_url('assets/image/plan.png');?>" class="symbol-menu" style="width: 60px;">
            </div><div>
                <b>PKS</b><br>
                Perjanjian Kerjasama
            </div>
        </a>
        <a href="<?= base_url('invoice'); ?>" class="jumbotron">
            <div style="width: 30%; float: left;">
                <img src="<?php echo base_url('assets/image/invoice.png');?>" class="symbol-menu" style="width: 50px;">
            </div><div>
                <b>Tambah Invoice</b><br>
                Pembayaran
            </div>
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
<br><br>
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
    <div class="row" style="width: 100%; padding: auto;">
        <a href="<?= base_url('laporan'); ?>" class="hupla">
                <img src="<?php echo base_url('assets/image/report.png');?>" class="symbol-menu" style="width: 55px;">
                Laporan Gabungan
        </a>
        <a href="<?= base_url('pks'); ?>" class="hupla">
                <img src="<?php echo base_url('assets/image/vendor.png');?>" class="symbol-menu" style="width: 60px;">
                Vendor
        </a>
        <a href="<?= base_url('invoice'); ?>" class="hupla">
                <img src="<?php echo base_url('assets/image/project.png');?>" class="symbol-menu" style="width: 60px;">
                Jenis Project
        </a>
        <a href="<?= base_url('register'); ?>" class="hupla">
                <img src="<?php echo base_url('assets/image/add_account.png');?>" class="symbol-menu" style="width: 45px;">
                Tambah Akun
        </a>
    </div>
    <br><br>
</div>
