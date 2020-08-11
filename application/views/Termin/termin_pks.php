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
                            <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <div id="result"></div>
                        <?php foreach ($termin as $row) : ?>
                            <tr>
                                <td><?= $row->TERMIN ?></td>
                                <td><?= $row->TGL_TERMIN ?></td>
                                <td><?= $row->NOMINAL ?></td> <?php $total += $row->NOMINAL ?>
                                <td><?= $row->STATUS ?></td>
                                <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                                    <td>
                                        <div class="btn-group">
                                            <a href="#"><button class="btn btn-success">Edit</button></a>
                                            <a href="#"><button class="btn btn-danger">Delete</button></a>
                                            <!-- <a href="<?php echo site_url('pks/edit/' . $row->NO_PKS); ?>"><button class="btn btn-success">Edit</button></a>
                                            <a href="<?php echo site_url('pks/delete/' . $row->NO_PKS); ?>"><button class="btn btn-danger">Delete</button></a> -->
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                    <hr>
                    <a href="<?= base_url('Termin/add'); ?>">Create</a>
                <?php endif; ?>
                <!-- <script type="text/javascript">
                $(document).ready(function() {
                    $("#searchById").autocomplete({
                        source: "<?php echo site_url('pks/search/?'); ?>"
                    });
                });
            </script> -->
            </div>
        </div>
        <p>Total : <?= $total ?> dari <?= $pks['NOMINAL_PKS'] ?></p>
    <?php else : ?>
        <h1>Termin Kosong</h1>
    <?php endif; ?>
    <hr>
    <a href="<?php echo site_url('pks'); ?>">Back</a>

</div>