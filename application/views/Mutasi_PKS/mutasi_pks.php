<div class="container-xl" style="margin-top: 50px;">
    <?php if ($this->session->flashdata('message')) { ?>
        <?php echo $this->session->flashdata('message') ?>
    <?php } ?>
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8">
                        <h2>Daftar Mutasi<b>PKS</b></h2>
                    </div>
                </div>
            </div>

            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Kode Mutasi</th>
                        <th>Kode PKS</th>
                        <th>Nominal</th>
                        <th>tanggal Mutasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mutasi_pks as $row) : ?>
                        <tr>
                            <td><?= $row->KODE_MUTASI ?></td>
                            <td><?= $row->KODE_PKS ?></td>
                            <td><?= $row->NOMINAL ?></td>
                            <td><?= $row->TANGGAL_MUTASI ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>