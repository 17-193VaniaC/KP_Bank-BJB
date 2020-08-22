<br> <br>
<div class="container-xl" style="margin-top: 50px;">
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
        </div>
    </div>
</div>