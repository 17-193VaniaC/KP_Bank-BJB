<div class="row" style="background-color: #e3e4e6; min-height: 92vh;">
    <div class="col">
        <div class="container">
            <div class="row justify-content-center" style="margin-top: 100px;">
                <div class="col-lg-9">
                    <!-- FLASH MESSAGE -->
                    <?php if ($this->session->flashdata('message')) { ?>
                        <?php
                        echo $this->session->flashdata('message');
                        ?>
                    <?php } ?>
                    <!-- END FLASH MESSAGE -->
                    <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #fff;">
                        <div class="card-body pb-20">
                            <div class="row justify-content-center" style="margin-top: 20px;">
                                <div class="col-lg">
                                    <div class="text-center">
                                        <h2>Tanggal Laporan</h2>
                                    </div>
                                    <form action="<?php echo site_url('Laporan/export') ?>" method="post">
                                        <table style="margin-top: 20px; width: 100%">
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="tanggal_awal">Tanggal Awal</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="date" name="tanggal_awal" class="form-control" />
                                                    <small class="text-danger"><?php echo form_error('tanggal_awal') ?></small>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="tanggal_akhir">Tanggal Akhir</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="date" name="tanggal_akhir" class="form-control" />
                                                    <small class="text-danger"><?php echo form_error('tanggal_akhir') ?></small>
                                                </td>

                                            </tr>
                                        </table>
                                        <div class="row mx-1" style="float:right; margin-top : 3%;">
                                            <div class="col">
                                                <button value="save" type="submit" class="btn btn-success">
                                                    Simpan
                                                </button>
                                            </div>
                                            <div class="col">
                                                <a href="<?php echo site_url("laporan"); ?>" s class="btn btn-secondary">
                                                    Batal
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>