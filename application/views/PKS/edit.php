<div style="background-color: #e3e4e6;">
<div class="col h-100" >
    <div class="container" style="min-height: 100%;">
        <!-- FLASH MESSAGE -->
        <?php if ($this->session->flashdata('success')) { ?>
            <?php
            echo "<div class='alert alert-success'>";
            echo $this->session->flashdata('success');
            echo "</div>";
            ?>
        <?php } ?>
        <?php if ($this->session->flashdata('failed')) { ?>
            <?php
            echo $this->session->flashdata('failed');
            echo "<strong>Gagal</strong>";
            echo "</div>";
            ?>
        <?php } ?>
        <!-- END FLASH MESSAGE -->

        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-lg-9">
                <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #fff;">
                    <div class="card-body pb-20">
                        <div class="row justify-content-center" style="margin-top: 20px;">
                            <div class="col-lg">
                                <div class="text-center">
                                    <h2>Edit PKS</h2>
                                </div>
                                <form class="user" method="post" action="">
                                    <table style="margin-top: 20px; width: 100%">
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="tgl_pks">Jenis Project</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <select class="form-control form-control-user" id="jenis" name="jenis" value="<?= $pks['JENIS'] ?>">
                                                    <?php foreach ($jenis as $row) : ?>
                                                        <?php if ($row->KODE_JENISPROJECT == $pks['JENIS']) : ?>
                                                            <option value="<?= $row->KODE_JENISPROJECT ?>" selected="selected"><?= $row->jenis ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $row->KODE_JENISPROJECT ?>"><?= $row->jenis ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-danger"><?php echo form_error('jenis') ?></small>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="tgl_pks">Kode Project</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <input type="text" class="form-control form-control-user" id="kode_project" name="kode_project" value="<?= $pks['KODE_PROJECT'] ?>">
                                                <small class="text-danger"><?php echo form_error('kode_project') ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="tgl_pks">Nama Project</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
                                                <input type="text" class="form-control form-control-user" id="nama_project" name="nama_project" value="<?= $pks['NAMA_PROJECT'] ?>">
                                                <small class="text-danger"><?php echo form_error('nama_project') ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="tgl_pks">Tanggal PKS</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <input type="date" class="form-control form-control-user" id="tgl_pks" name="tgl_pks" value="<?= $pks['TGL_PKS'] ?>">
                                                <?php echo form_error('tgl_pks', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="tgl_pks">Vendor</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <select class="form-control form-control-user" id="nama_vendor" name="nama_vendor" value="<?= $pks['NAMA_VENDOR'] ?>">
                                                    <?php foreach ($vendor as $row) : ?>
                                                        <?php if ($row->KODE_VENDOR == $pks['NAMA_VENDOR']) : ?>
                                                            <option value="<?= $row->KODE_VENDOR ?>" selected="selected"><?= $row->nama_vendor ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $row->KODE_VENDOR ?>"><?= $row->nama_vendor ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="text-danger"><?php echo form_error('nama_vendor') ?></small>
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
                                            <a href="<?php echo site_url("pks"); ?>" s class="btn btn-secondary">
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