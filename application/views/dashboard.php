<body>
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>

    <div class="jumbotron text-center">
        <h1>Selamat datang di BJB</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <a href="<?= base_url('rbb'); ?>"><button>
                        <h3>RBB</h3>
                    </button></a>
            </div>
            <div class="col-sm-4">
                <a href="<?= base_url('pks/index'); ?>"><button>
                        <h3>PKS</h3>
                    </button></a>
            </div>
            <div class="col-sm-4">
                <a href=""><button>
                        <h3>Invoice</h3>
                    </button></a>
            </div>
        </div>
    </div>