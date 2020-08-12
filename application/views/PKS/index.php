<div  style="margin-top: 50px; padding: 25px;">
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-4">
                        <a href="<?= base_url('pks/'); ?>" style="text-decoration: none;"><h2>Daftar <b>PKS</b></h2></a>
                    </div>
                        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                            <a href="<?= base_url('pks/create'); ?>" class="btn btn-success">Tambah PKS</a>
                        <?php endif; ?>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="search-box">
                                <form method="get" class="form-inline">
                                    <input type="text" autocomplete="off" placeholder="Cari PKS dengan NO PKS" name="searchById" id="searchById" class="form-control" />
                                    <input class="btn btn-primary" type="submit" name="search" value="Cari">
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
                            <td><?= $row->jenis ?></td>
                            <td><?= $row->KODE_PROJECT ?></td>
                            <td><?= $row->NAMA_PROJECT ?></td>
                            <td><?= $row->TGL_PKS ?></td>
                            <td><?= $row->NOMINAL_PKS ?></td>
                            <td><?= $row->SISA_ANGGARAN ?></td>
                            <td><?= $row->nama_vendor ?></td>
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