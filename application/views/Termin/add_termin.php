<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/'); ?>css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?= $title ?> </title>
</head>
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #204d95; position: fixed; width: 100%; padding-left: 0;">
<!-- <nav class="navbar_custom" > -->

    <a class="navbar-brand" href="<?= base_url('dashboard'); ?>">BJB</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="nav-item dropdown ml-auto">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $user['NAMA'] ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</nav>
<br>
<br>
<body>

<br>	<br><h2 style="text-align: center;">Form Termin PKS - <?php echo $nopks?></h2>
    	<table style="margin: 15%; margin-top: 100px; margin-bottom: 50PX;">
    <tr>
        <th>Nominal</th>
        <th>Bulan</th>
        <th>Termin</th>
    </tr>
    <tr>
        <td>    <?php $nopks_= str_replace('/', '_', $nopks)?>
            <form action="<?php echo site_url("Termin/add/" . $nopks_ . "/" . $npayment) ?>" method="post">
                <input type="number" name="NOMINAL" placeholder="Nominal Termin" class="form-control" />
                <?php echo form_error('NOMINAL') ?>
        </td>
        <td>
            <input type="date" name="TGL_TERMIN" placeholder="Tanggal Termin"  class="form-control" />
            <?php echo form_error('TGL_TERMIN') ?></td>
        <TD>
            <input type="text" name="TERMIN" value="<?php echo $npayment ?>" readonly  class="form-control" />
            <?php echo form_error('TERMIN') ?></td>
        <td>
            <button value="save" type="submit" class="btn btn-primary">
                Simpan</button>
        </td>
    </tr>
    <tr>
        <td> </td>
        </form>
    </tr>

</table>
<footer id="footer" class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto"><br>
            <span>Copyright &copy; Bank BJB <?= date('Y'); ?></span><br><br>
    </div>
        </div>
        	
        <div class="bluefooter"></div>
        <div class="lightbluefooter"></div>
        <div class="yellowfooter"></div>
</footer>
<!-- Footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->


<script src="<?php echo base_url() . 'assets/js/jquery-3.5.1.min.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css"> -->

<script>
    $(document).ready(function() {
        $(".dropdown-toggle").dropdown();
    });
</script>

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>