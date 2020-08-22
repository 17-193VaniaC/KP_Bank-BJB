<br>
<div style="margin-top: 50px; padding: 25px;"> 
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>
    <!-- <div class="container-xl"> -->        
    <div class="container-half">
        <h2><a href="<?= base_url('pks/'); ?>" style="text-decoration: none; color: black;">Daftar <b>PKS</b></a></h2>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
           <p> <a href="<?= base_url('pks/create'); ?>" class="btn btn-success">+ Tambah PKS</a></p>
        <?php endif; ?>
    </div>
    <div class="container-half right" >
        <div class="form-group">
        <form method="get" class="form-inline" style="float: right;">
            <input type="text" placeholder="Cari PKS dengan NO PKS" name="searchById" id="searchById" class="form-control" style="width: auto; />
            <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>
        </div>
    </div>
     <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-striped table-hover table-bordered">
                <thead  style="background-color: #204d95; color: white;">
                    <tr class="text-center">
                        <td>Nomor PKS</td>
                        <td>Kode RBB</td>
                        <td>Jenis</td>
                        <td>Kode Project</td>
                        <td>Nama Project</td>
                        <td>tanggal PKS</td>
                        <td>Nominal PKS</td>
                        <td>Sisa Anggaran</td>
                        <td>Nama Vendor</td>
                        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
                            <td>Opsi</td>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <div id="result"></div>
                    <?php foreach ($pks as $row) : ?>
                        <?php $id = str_replace('/', '_', $row->NO_PKS); ?>
                        <tr>
                            <td><a href="<?php echo site_url('Termin/termin_pks/' . $id); ?>" style="text-decoration: none;"><?= $row->NO_PKS ?></a></td>
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
                                        <a href="<?php echo site_url('pks/edit/' . $id); ?>"><button class="btn btn-info">Edit</button></a>
                                        <a href="<?php echo site_url('pks/delete/' . $id); ?>" style="margin-left: 3px;"><button class="btn btn-danger">Hapus</button></a>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <script src="<?php echo base_url() . 'assets/js/jquery-3.5.1.min.js' ?>" type="text/javascript"></script>
            <script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
            <script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
            <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
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
    <div class="row">
        <div class="col">
            <!--Tampilkan pagination-->
            <?php echo $pagination; ?>
        </div>
    </div>
</div>