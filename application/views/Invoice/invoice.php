<br><div class="container-xl" style="margin-top: 50px;">
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>
    <div class="container-half">
        <h2><a href="<?= base_url('Invoice/'); ?>" style="text-decoration: none; color: black;">Daftar Invoice</a></h2></a>
    </div>
    <div class="container-half right">
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
            <a href="<?= base_url('Invoice/add'); ?>" class="btn btn-success">+ Tambah Invoice</a>
        <?php endif; ?>
    </div>
    <!-- <div class="container-half right">
        <form method="get" class="form-inline" style="float: right;">
            <input type="text" autocomplete="off" placeholder="Cari PKS dengan NO PKS" name="searchById" id="searchById" class="form-control" />
            <input class="btn btn-primary" type="submit" name="search" value="Cari">
        </form>
    </div> -->

    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-striped table-hover table-bordered">
                <thead style="background-color: #204d95; color: white;">
                    <tr class="text-center">
                        <td>Invoice</td>
                        <td>Nomor PKS</td>
                        <td>Tanggal Invoice</td>
                        <td>Tahap</td>
                        <td>Nominal Bayar</td>
                        <td>Sisa Anggaran PKS</td>
                    </tr>
                </thead>
                <tbody>
                    <div id="result"></div>
                    <?php $pks = null;
                    $sisa = 0 ?>
                    <?php foreach ($invoice as $row) : ?>
                        <tr>
                            <td><?= $row->INVOICE ?></td>
                            <td><?= $row->NO_PKS ?></td>
                            <td><?= $row->TGL_INVOICE ?></td>
                            <td><?= $row->TERMIN ?></td>
                            <td><?= $row->NOMINAL ?></td>

                            <?php if ($pks == $row->NO_PKS) : ?>
                                <?php $sisa -= $row->NOMINAL ?>
                                <td><?= $sisa ?></td>
                            <?php else : ?>
                                <?php $pks = $row->NO_PKS;
                                $sisa = $row->NOMINAL_PKS - $row->NOMINAL ?>
                                <td><?= $sisa ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- <script type="text/javascript">
                $(document).ready(function() {
                    $("#searchById").autocomplete({
                        source: "<?php echo site_url('pks/search/?'); ?>"
                    });
                });
            </script> -->

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