<br> <br>
<div class="container-xl" style="margin-top: 50px;">
    
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>

    <div class="container-half">
        <h2><a href="<?= base_url('invoice/'); ?>" style="text-decoration: none; color: black;">Daftar <b>Invoice</b></a></h2>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
            <p> <a href="<?= base_url('invoice/add'); ?>" class="btn btn-success">+ Tambah Invoce</a></p>
        <?php endif; ?>
    </div>
    <div class="container-half right">
        <div class="form-group">
            <form method="get" class="form-inline" style="float: right;">
                <input type="text" placeholder="Cari Invoice dengan No. PKS" name="searchById" id="searchById" class="form-control" style="width: auto; />
            <span class=" input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-striped table-hover table-bordered">
                <thead style="background-color: #204d95; color: white;">
                    <tr class="text-center">
                        <td>Invoice</td>
                        <td>Nomor PKS</td>
                        <td>Nama Project</td>
                        <td>Tanggal Invoice</td>
                        <td>Tahap</td>
                        <td>Nominal Bayar</td>
                        <!-- <td>Sisa Anggaran PKS</td> -->
                    </tr>
                </thead>
                <tbody>
                    <div id="result"></div>
                  <!--   <?php $pks = null;
                    $sisa = 0 ?> -->
                    <?php foreach ($invoice as $row) : ?>
                        <tr>
                            <td><?= $row->INVOICE ?></td>
                            <td><?= $row->NO_PKS ?></td>
                            <td><?= $row->NAMA_PROJECT?></td>
                            <td><?= $row->TGL_INVOICE ?></td>
                            <td><?= $row->TERMIN ?></td>
                            <td><?= $row->NOMINAL ?></td>
<!-- 
                            <?php if ($pks == $row->NO_PKS) : ?>
                                <?php $sisa -= $row->NOMINAL ?>
                                <td><?= $sisa ?></td>
                            <?php else : ?>
                                <?php $pks = $row->NO_PKS;
                                $sisa = $row->NOMINAL_PKS - $row->NOMINAL ?>
                                <td><?= $row->SISA_ANGGARAN ?></td> -->
                            <!-- <?php endif; ?> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <!--Tampilkan pagination-->
        <?php echo $pagination;?>
    </div>
</div>