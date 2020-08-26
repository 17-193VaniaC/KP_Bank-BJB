<br> <br>
<div class="container-xl" style="margin-top: 50px;">
    
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } 
    if(!empty($this->session->flashdata('search_invoice'))){
            empty($this->session->set_flashdata(array('search_invoice'=>$search)));
        }?>

    <div class="container-half">
        <h2><a href="<?= base_url('invoice/'); ?>" style="text-decoration: none; color: black;">Daftar <b>Invoice</b></a></h2>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
            <p> <a href="<?= base_url('invoice/add'); ?>" class="btn btn-success">+ Tambah Invoce</a></p>
        <?php endif; ?>
    </div>
    <div class="container-half right">
        <div class="form-group">
            <form method="post" action="<?php echo site_url('invoice/index') ?>" class="form-inline" style="float: right;">
                <input type="text" placeholder="No. PKS Invoice" name="searchById" id="searchById" class="form-control" style="width: auto; />
            <span class=" input-group-btn">
                <input type="submit" name="Search" class="btn btn-primary" value="Cari" />
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <div class="table-wrapper">
            <table class="table table-striped table-hover table-bordered">
                <thead style="background-color: #204d95; color: white;">
                    <tr class="text-center">
                        <td style="width: 12%;">Invoice</td>
                        <td style="width: 20%;">Nomor PKS</td>
                        <td style="width: 20%;">Nama Project</td>
                        <td style="width: 10%;">Tanggal Invoice</td>
                        <td style="width: 10%;">Tahap</td>
                        <td style="width: 10%;">Nominal Bayar</td>
                        <!-- <td>Sisa Anggaran PKS</td> -->
                    </tr>
                </thead>
                <tbody>
                    <div id="result"></div>
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
    <?php if ($pagination) : ?>
        <div class="row">
            <div class="col">
                <!--Tampilkan pagination-->
                <?php echo $pagination; ?>
            </div>
        </div>
    <?php endif; ?>