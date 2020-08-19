<!-- <body class="bg-gradient-primary"> -->
<div class="col h-100" style="background-color: #e3e4e6;">
    <div class="container">

        <?php if ($this->session->flashdata('message')) { ?>
            <?php echo $this->session->flashdata('message') ?>
        <?php } ?>
        <!-- Outer Row -->
        <div class="row justify-content-center" style="margin-top: 100px;">

            <div class="col-xl-7 col-lg-7 col-md-7">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Registrasi Akun</h1>
                                    </div>

                                    <form class="user" method="post" action="<?= base_url('register') ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama">
                                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                                <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password">
                                                <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control form-control-user" id="role" name="role">
                                                <option value="IT FINANCE">IT FINANCE</option>
                                                <option value="GROUP HEAD">GROUP HEAD</option>
                                            </select>
                                            <?= form_error('role', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>

                                        <button type="submit" class="btn btn-info btn-user btn-block">
                                            Buat Akun
                                        </button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>