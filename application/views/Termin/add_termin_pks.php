<div class="col h-100" style="background-color: #e3e4e6;">
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