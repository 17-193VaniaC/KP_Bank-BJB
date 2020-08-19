<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="<?= base_url('assets/'); ?>css/style.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/style.css">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/'); ?>css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?= $title ?> </title>
</head>

<body>
    <div id="content" class="d-flex flex-column">
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
                    <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                        <a href="<?php echo site_url('rbb/add'); ?>">Tambah RBB</a>
                        <a href="<?php echo site_url('mutasi_rbb/Penyesuaian_RBB'); ?>">Penyesuaian RBB</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn" disabled>PKS</button>
                <div class="dropdown-content">
                    <a href="<?php echo site_url('pks'); ?>">Daftar PKS</a>
                    <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                        <a href="<?php echo site_url('pks/create'); ?>">Tambah PKS</a>
                    <?php endif; ?>
                    <a href="<?php echo site_url('termin'); ?>">Daftar Termin PKS</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn" disabled>Invoice</button>
                <div class="dropdown-content">
                    <a href="<?php echo site_url('Invoice'); ?>">Daftar Invoice</a>
                    <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                        <a href="<?php echo site_url('Invoice/add'); ?>">Invoice Baru</a>
                    <?php endif; ?>

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
        <br>
        <br>
    </div> <!-- END CONTAINER -->
    <h1>apaa?</h1>
    <footer>
        <h2>apaaaaaaa?</h2>
    </footer>
    <!-- <footer id="footer" class="bg-black">
        <div class="container my-auto">
            <div class="copyright text-center my-auto"><br>
                <span>Copyright &copy; Bank BJB <?= date('Y'); ?></span><br><br>
            </div>
        </div>

        <div class="bluefooter"></div>
        <div class="lightbluefooter"></div>
        <div class="yellowfooter"></div>
    </footer> -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    <script src="<?php echo base_url() . 'assets/js/jquery-3.5.1.min.js' ?>" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
    <script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> -->
    <!-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
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