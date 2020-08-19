<div class="col h-100" style="background-color: #e3e4e6;">
    <div class="container" style="min-height: 100%;">
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-lg-9">
                <!-- FLASH MESSAGE -->
                <?php if ($this->session->flashdata('message')) { ?>
                    <?php echo $this->session->flashdata('message') ?>
                <?php } ?>
                <!-- END FLASH MESSAGE -->
                <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #fff;">
                    <div class="card-body pb-20">
                        <div class="row justify-content-center" style="margin-top: 20px;">
                            <div class="col-lg">
                                <div class="text-center">
                                    <h2>Edit Termin</h2>
                                </div>
                                <?php $pks_ = str_replace('/', '_', $termin->NO_PKS); ?>
                                <form action="<?php echo site_url("Termin/edit/" . $termin->KODE_TERMIN . "/" . $pks_) ?>" method="post">
                                    <table style="margin-top: 20px; width: 100%">
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="NOMINAL">Nominal</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <input type="text" name="NOMINAL" placeholder="Nominal Termin" value="<?= $termin->NOMINAL ?>" class='form-control' />
                                                <small class="text-danger"><?php echo form_error('NOMINAL') ?></small>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="TGL_TERMIN">Tanggal Termin</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <input type="date" name="TGL_TERMIN" placeholder="Tanggal Termin" value="<?= $termin->TGL_TERMIN ?>" class='form-control' />
                                                <small class="text-danger"><?php echo form_error('TGL_TERMIN') ?></small>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="KATEGORI">Kategori Termin</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
                                                <select class="form-control" name="KATEGORI" id="kategori">
                                                    <?php
                                                    if ($termin->KATEGORI == 'Pengadaan') {
                                                        echo "<option value='Pengadaan' selected='selected'>Pengadaan</option>";
                                                    } else {
                                                        echo "<option value='Pengadaan'>Pengadaan</option>";
                                                    }
                                                    if ($termin->KATEGORI == 'Maintenance') {
                                                        echo "<option value='Maintenance' selected='selected'>Maintenance</option>";
                                                    } else {
                                                        echo "<option value='Maintenance'>Maintenance</option>";
                                                    }
                                                    if ($termin->KATEGORI == 'Waranty') {
                                                        echo "<option value='Waranty' selected='selected'>Waranty</option>";
                                                    } else {
                                                        echo "<option value='Waranty'>Waranty</option>";
                                                    }
                                                    if ($termin->KATEGORI == 'License') {
                                                        echo "<option value='License' selected='selected'>License</option>";
                                                    } else {
                                                        echo "<option value='License'>License</option>";
                                                    }
                                                    if ($termin->KATEGORI == 'Pembayaran Rutin Bulanan') {
                                                        echo "<option value='Pembayaran Rutin Bulanan'  selected='selected' >Pembayaran Rutin Bulanan</option>";
                                                    } else {
                                                        echo "<option value='Pembayaran Rutin Bulanan'>Pembayaran Rutin Bulanan</option>";
                                                    }
                                                    ?>
                                                    }
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
                                                    <?php foreach ($GL_ as $row) : ?>
                                                        <?php if ($row->KODE_GL == $termin->GL) : ?>
                                                            <option value="<?= $row->KODE_GL ?>" selected="selected"><?php echo $row->KODE_GL;
                                                                                                                        echo " | ";
                                                                                                                        echo $row->NAMA_GL; ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $row->KODE_GL ?>"><?php echo $row->KODE_GL;
                                                                                                    echo " | ";
                                                                                                    echo $row->NAMA_GL; ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
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
                                            <a href="<?php echo site_url("termin/termin_pks/" . $pks_); ?>" s class="btn btn-secondary">
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
        $('#kategori').change(function() {
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