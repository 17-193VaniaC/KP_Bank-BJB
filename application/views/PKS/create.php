<div style="background-color: #e3e4e6;">
    <div class="col" style="background-color: #e3e4e6;">
        <div class="container" style="min-height: 100%;">
            <div class="row justify-content-center" style="margin-top: 100px;">
                <div class="col-lg-9">
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
                    <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #fff;">
                        <div class="card-body pb-20">
                            <div class="row justify-content-center" style="margin-top: 20px;">
                                <div class="col-lg">
                                    <div class="text-center">
                                        <h2>Create PKS</h2>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('pks/create') ?>">
                                        <table style="margin-top: 20px; width: 100%">
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="no_pks">Nomor PKS</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="text" class="form-control form-control-user" id="no_pks" name="no_pks" placeholder="Nomor PKS">
                                                    <small class="text-danger"><?php echo form_error('no_pks') ?></small>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="kode_rbb">Kode RBB</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <select class="form-control form-control-user" id="kode_rbb" name="kode_rbb">
                                                        <?php foreach ($no_rbb as $row) : ?>
                                                            <option value="<?= $row->KODE_RBB ?>"><?= $row->KODE_RBB ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <small class="text-danger"><?php echo form_error('kode_rbb') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="jenis">Jenis</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
                                                    <select class="form-control form-control-user" id="jenis" name="jenis">
                                                        <?php foreach ($jenis as $row) : ?>
                                                            <option value="<?= $row->KODE_JENISPROJECT ?>"><?= $row->jenis ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <small class="text-danger"><?php echo form_error('jenis') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="kode_project">Kode Project</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="text" class="form-control form-control-user" id="kode_project" name="kode_project" placeholder="Kode project">
                                                    <small class="text-danger"><?php echo form_error('kode_project') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="nama_project">Nama Project</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="text" class="form-control form-control-user" id="nama_project" name="nama_project" placeholder="Nama project">
                                                    <small class="text-danger"><?php echo form_error('nama_project') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="tgl_pks">Tanggal PKS</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="date" class="form-control form-control-user" id="tgl_pks" name="tgl_pks" placeholder="Tanggal PKS">
                                                    <small class="text-danger"><?php echo form_error('tgl_pks') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="nominal_pks">Nominal PKS</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="number" class="form-control form-control-user" id="nominal_pks" name="nominal_pks" placeholder="Nominal pks">
                                                    <small class="text-danger"><?php echo form_error('nominal_pks') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="nama_vendor">Nama Vendor</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <select class="form-control form-control-user" id="nama_vendor" name="nama_vendor">
                                                        <?php foreach ($vendor as $row) : ?>
                                                            <option value="<?= $row->KODE_VENDOR ?>"><?= $row->nama_vendor ?></option>
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