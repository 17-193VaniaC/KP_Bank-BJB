<div class="container-xl" style="margin-top: 50px;">
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Daftar <b>PKS</b></h2>
                    </div>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="search-box">
                                <form method="get" class="form-inline">
                                    <input type="text" autocomplete="off" placeholder="Cari PKS dengan NO PKS" name="searchById" id="searchById" class="form-control" />
                                    <input type="submit" name="search">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Nomor PKS</th>
                        <th>Kode RBB</th>
                        <th>Jenis</th>
                        <th>Kode Project</th>
                        <th>Nama Project</th>
                        <th>tanggal PKS</th>
                        <th>Nominal PKS</th>
                        <th>Sisa Anggaran</th>
                        <th>Nama Vendor</th>
                        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                            <th>Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <div id="result"></div>
                    <?php foreach ($pks as $row) : ?>
                        <tr>
                            <td><a href="<?php echo site_url('Termin/termin_pks/' . $row->NO_PKS); ?>"><?= $row->NO_PKS ?></a></td>
                            <td><?= $row->KODE_RBB ?></td>
                            <td><?= $row->JENIS ?></td>
                            <td><?= $row->KODE_PROJECT ?></td>
                            <td><?= $row->NAMA_PROJECT ?></td>
                            <td><?= $row->TGL_PKS ?></td>
                            <td><?= $row->NOMINAL_PKS ?></td>
                            <td><?= $row->SISA_ANGGARAN ?></td>
                            <td><?= $row->NAMA_VENDOR ?></td>
                            <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('pks/edit/' . $row->NO_PKS); ?>"><button class="btn btn-success">Edit</button></a>
                                        <a href="<?php echo site_url('pks/delete/' . $row->NO_PKS); ?>"><button class="btn btn-danger">Delete</button></a>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                <hr>
                <a href="<?= base_url('pks/create'); ?>">Create</a>
            <?php endif; ?>
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#searchById").autocomplete({
                        source: "<?php echo site_url('pks/search/?'); ?>"
                    });
                });
            </script>
            <!-- CALON PAGING  -->
            <!-- <div class="clearfix">
                <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                </ul>
            </div> -->
        </div>
    </div>
</div>