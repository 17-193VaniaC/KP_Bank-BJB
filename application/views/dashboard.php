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
                <a href="<?= base_url('pks'); ?>"><button>
                        <h3>PKS</h3>
                    </button></a>
            </div>
            <div class="col-sm-4">
                <a href=""><button>
                        <h3>Invoice</h3>
                    </button></a>
            </div>
        </div>
        <div class="row">
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
    </div>