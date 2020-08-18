<div class="container-xl" style="margin-top: 50px;">
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>
    <?php if ($termin) : ?>
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Daftar <b>Termin PKS No. <?= $no_pks ?></b></h2>
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

                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Termin</th>
                            <th>Tanggal Termin</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Kategori</th>
                            <th>GL</th>
                            <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <div id="result"></div>
                        <?php if (isset($termin)):
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
                                        <div class="btn-group">
                                            <?php if ($row->STATUS == 'UNPAID') : 
                                            $pks_ = str_replace('/', '_', $row->NO_PKS);
                                            ?>

                                                <a href="<?= site_url('Termin/edit/' . $row->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-success">Edit</button></a>
                                                <a href="<?= site_url('Termin/delete/' . $row->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-danger">Delete</button></a>
                                            <?php else : 
                                                    $pks_ = str_replace('/', '_', $row->NO_PKS);?>

                                                <a href="<?= site_url('Termin/edit/0/' . $pks_) ?>"><button class="btn btn-success">Edit</button></a>
                                                <a href="<?= site_url('Termin/delete/0/' . $pks_) ?>"><button class="btn btn-danger">Delete</button></a>
                                            <?php endif; ?>
                                            <!-- <a href="<?php echo site_url('pks/edit/' . $row->NO_PKS); ?>"><button class="btn btn-success">Edit</button></a>
                                            <a href="<?php echo site_url('pks/delete/' . $row->NO_PKS); ?>"><button class="btn btn-danger">Delete</button></a> -->
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; 
                        endif;?>
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
        <?php if ($user['ROLE'] == 'IT FINANCE' && $baris < 13) : ?>
            <hr>

            <!-- redirect('Termin/add/' . $data['no_pks'] . "/" . $n_termin . "/1"); -->
            <a href="<?= base_url('Termin/addMore/' . $pks_ . '/' . $baris); ?>">Create</a>
        <?php endif; ?>
        <p>Total Nominal Termin: <?= $total ?> dari <?= $pks['NOMINAL_PKS'] ?></p>
        <?php if ($total > $pks['NOMINAL_PKS']) : ?>
            <div class="alert alert-warning" role="alert">
                Total nominal termin melebihi nominal PKS! Harap cek kembali!
            </div>
        <?php endif; ?>
    <?php else : ?>
        <h1>Termin Kosong</h1>
        <?php if ($user['ROLE'] == 'IT FINANCE' && $baris < 13) : 
            $pks_ = str_replace('/', '_', $no_pks);
       
        ?>
            <hr>

            <a href="<?= base_url('Termin/addMore/' . $pks_ . '/' . $baris); ?>">Create</a>
        <?php endif; ?>
    <?php endif; ?>
    <hr>
    <a href="<?php echo site_url('pks'); ?>">Back</a>

</div>