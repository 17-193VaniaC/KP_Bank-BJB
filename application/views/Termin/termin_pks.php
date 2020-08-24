<div class="container-xl" style="margin-top: 100px;">
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>
    <?php if ($termin) :
        $pks_ = str_replace('/', '_', $no_pks); ?>
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Daftar <b>Termin PKS No. <?= $no_pks ?></b></h2>
                        </div>
                        <div class="container-half right" style="width: auto; right: 0;">
                            <?php if (isset($termin)) :
                                foreach ($termin as $row) :
                                    $baris++;
                                    $total += $row->NOMINAL;
                                endforeach;
                            ?>
                                <?php if ($user['ROLE'] == 'IT FINANCE' && $baris <= 15 && $total < $pks["NOMINAL_PKS"]) : ?>
                                    <a href="<?php echo base_url('Termin/addMore/' . $pks_ . '/' . $baris); ?>">
                                        <button class="btn btn-success"> + Tambah Termin </button>
                                    </a>
                                <?php endif;
                                $baris = 0;
                                $total = 0; ?>
                            <?php endif; ?>

                        </div>
                        <!-- <div class="col-sm-4">
                        <div class="row">
                            <div class="search-box">
                                <form method="get" class="form-inline">
                                    <input type="text" autocomplete="off" placeholder="Cari PKS dengan NO PKS" name="searchById" id="searchById" class="form-control" />
                                    <input type="submit" name="search">
                                </form>
                            </div>
                        </div>
                    </div> -->
                    </div>
                </div>

                <table class="table table-striped table-hover table-bordered" style="margin-top: 20px;">
                    <thead style="background-color: #204d95; color: white;">

                        <tr class="text-center">
                            <td>Termin</td>
                            <td>Tanggal Termin</td>
                            <td>Nominal</td>
                            <td>Status</td>
                            <td>Kategori</td>
                            <td>GL</td>
                            <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                                <td class="table-option-row">Opsi</td>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <div id="result"></div>
                        <?php if (isset($termin)) :
                            foreach ($termin as $row) : ?>
                                <tr>
                                    <?php $baris++ ?>
                                    <td><?= $row->TERMIN ?></td>
                                    <td><?= $row->TGL_TERMIN ?></td>
                                    <td><?= $row->NOMINAL ?></td> <?php $total += $row->NOMINAL ?>
                                    <td><?= $row->STATUS ?></td>
                                    <td><?= $row->KATEGORI ?></td>
                                    <td><?= $row->GL ?></td>
                                    <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                                        <td>
                                            <div class="table-option-row">
                                                <?php if ($row->STATUS == 'UNPAID') :
                                                    $pks_ = str_replace('/', '_', $row->NO_PKS);
                                                ?>

                                                    <a href="<?= site_url('Termin/edit/' . $row->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-info">Edit</button></a>
                                                    <a href="<?= site_url('Termin/delete/' . $row->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-danger">Hapus</button></a>
                                                <?php else :
                                                    $pks_ = str_replace('/', '_', $row->NO_PKS); ?>

                                                    <a href="<?= site_url('Termin/edit/0/' . $pks_) ?>"><button class="btn btn-info" style="">Edit</button></a>
                                                    <a href="<?= site_url('Termin/delete/0/' . $pks_) ?>"><button class="btn btn-danger">Hapus</button></a>
                                                <?php endif; ?>
                                                <!-- <a href="<?php echo site_url('pks/edit/' . $row->NO_PKS); ?>"><button class="btn btn-success">Edit</button></a>
                                            <a href="<?php echo site_url('pks/delete/' . $row->NO_PKS); ?>"><button class="btn btn-danger">Delete</button></a> -->
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>

                </table>

                <!-- <script type="text/javascript">
                $(document).ready(function() {
                    $("#searchById").autocomplete({
                        source: "<?php echo site_url('pks/search/?'); ?>"
                    });
                });
            </script> -->
            </div>
        </div>
        <p><b>Anggaran PKS yang digunakan:</b> <?= $total ?> dari <?= $pks['NOMINAL_PKS'] ?></p>
        <?php if ($total > $pks['NOMINAL_PKS']) : ?>
            <div class="alert alert-warning" role="alert">
                Total nominal termin melebihi nominal PKS! Harap cek kembali!
            </div>
        <?php endif; ?>
    <?php else : ?>
        <h1>Termin Kosong</h1>
        <?php if ($user['ROLE'] == 'IT FINANCE' && $baris < 13) :
            $pks_ = str_replace('/', '_', $no_pks); ?>
            <hr>
            <a href="<?= base_url('Termin/addMore/' . $pks_ . '/' . $baris); ?>">
                <button class="btn btn-success"> + Tambah Termin </button>
            </a>
        <?php endif; ?>
    <?php endif; ?>
    <hr>
    <a href="<?php echo site_url('pks'); ?>" class="btn btn-info">Kembali</a>

</div>