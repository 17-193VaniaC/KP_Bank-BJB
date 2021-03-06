<div class="row" style="background-color: #e3e4e6; min-height: 92vh; ">
    <div class="col h-100">
        <div class="container" style="min-height: 100%;">
            <div class="row justify-content-center" style="margin-top: 100px;">
                <div class="col-lg-9">
                    <!-- FLASH MESSAGE -->
                    <?php if ($this->session->flashdata('message')) { ?>
                        <?php echo $this->session->flashdata('message') ?>
                    <?php } ?>
                    <!-- END FLASH MESSAGE -->
                    <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #fff; margin-top: 0;">
                        <div class="card-body pb-20">
                            <div class="row justify-content-center" style="margin-top: 20px;">
                                <div class="col-lg">
                                    <div class="text-center">
                                        <h2>Tambah Termin</h2>
                                    </div>
                                    <?php $nopks = str_replace('/', '_', $no_pks) ?>
                                    <form action="<?php echo site_url("Termin/addMore/" . $nopks . "/" . $termin_ke) ?>" method="post">
                                        <table style="margin-top: 20px; width: 100%">
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="NOMINAL">Nominal</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="number" name="NOMINAL" placeholder="Nominal Termin" class="form-control" />
                                                    <small class="text-danger"><?php echo form_error('NOMINAL') ?></small>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="TGL_TERMIN">Tanggal Termin</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                    <input type="date" name="TGL_TERMIN" placeholder="Tanggal Termin" class="form-control" />
                                                    <small class="text-danger"><?php echo form_error('TGL_TERMIN') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="TERMIN">Termin Ke</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
                                                    <input type="text" name="TERMIN" value="<?php echo $termin_ke ?>" readonly class="form-control" />
                                                    <small class="text-danger"><?php echo form_error('TERMIN') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="KATEGORI">Kategori Termin</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
                                                    <select class="form-control" name="KATEGORI" id="KATEGORI">
                                                        <option value="">--- Pilih Kategori Termin ---</option>
                                                        <option value="Pengadaan">Pengadaan</option>
                                                        <option value="Maintenance">Maintenance</option>
                                                        <option value="Waranty">Waranty</option>
                                                        <option value="License">License</option>
                                                        <option value="Pembayaran Rutin Bulanan">Pembayaran Rutin Bulanan</option>
                                                    </select>
                                                    <small class="text-danger"><?php echo form_error('KATEGORI') ?></small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                    <label for="GL">GL</label>
                                                </td>
                                                <td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
                                                    <select class="form-control form-control-user" name="GL" id="GL">

                                                    </select>
                                                    <small class="text-danger"><?php echo form_error('GL') ?></small>
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
                                                <a href="<?php echo site_url("termin/termin_pks/" . $nopks); ?>" s class="btn btn-secondary">
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
<script src="<?php echo base_url() . 'assets/js/jquery-3.5.1.min.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#KATEGORI').change(function() {
            var kategori = $(this).val();
            $.ajax({
                url: "<?php echo site_url('termin/getCategoryGL'); ?>",
                method: "POST",
                data: {
                    KATEGORI: kategori
                },
                async: true,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option value=' + data[i].KODE_GL + '>' + data[i].KODE_GL + ' | ' + data[i].NAMA_GL + '</option>';
                    }
                    $('#GL').html(html);
                }
            });
            return false;
        });

    });
</script>