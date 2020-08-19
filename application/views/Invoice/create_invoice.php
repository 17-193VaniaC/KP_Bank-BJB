<div class="col h-100" style="background-color: #e3e4e6;">
    <div class="container" style="min-height: 100%;">
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-lg-9">
                <!-- FLASH MESSAGE -->
                <?php if ($this->session->flashdata('success')) { ?>
                    <?php
                    echo "<div class='alert alert-success' >";
                    echo $this->session->flashdata('success');
                    echo "</div>";
                    ?>
                <?php } ?>
                <?php if ($this->session->flashdata('failed')) { ?>
                    <?php
                    echo "<div class='alert alert-danger' >";
                    echo "<strong>Gagal</strong><br>";
                    echo $this->session->flashdata('failed');
                    echo "</div>";
                    ?>
                <?php } ?>
                <?php if ($this->session->flashdata('not_found')) { ?>
                    <?php
                    echo "<div class='alert alert-danger><br>";
                    echo "<strong>Gagal</strong>";
                    echo $this->session->flashdata('not_found');
                    echo "</div>";
                    ?>
                <?php } ?>
                <!-- END FLASH MESSAGE -->

                <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #fff;">
                    <div class="card-body pb-20">
                        <div class="row justify-content-center" style="margin-top: 20px;">
                            <div class="col-lg">
                                <div class="text-center">
                                    <h2>Tambah Invoice</h2>
                                </div>
                                <form action="" form method="post" action="<?= base_url('Invoice/add') ?>">
                                    <table style="margin-top: 20px; width: 100%">
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="nopks">Nomor PKS</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <input type="text" name="nopks" onkeyup="isi_otomatis()" id="NOPKS" class="form-control" />
                                                <small class="text-danger"><?php echo form_error('INVOICE') ?></small>
                                            </td>

                                        </tr>
                                        <input type="hidden" name="KODE_TERMIN" id="kodetermin" class="form-control" readonly>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="termin">Termin Ke</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <input type="text" name="termin" id="termin" class="form-control" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="NOMINAL">Nominal</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
                                                <input type="text" name="NOMINAL" id="nominal" class="form-control" readonly />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="INVOICE">Invoice</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <input type="text" name="INVOICE" class="form-control" />
                                                <?php echo form_error('INVOICE', '<small class="text-danger pl-3">', '</small>'); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
                                                <label for="TGL_INVOICE">Tanggal</label>
                                            </td>
                                            <td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
                                                <input type="date" name="TGL_INVOICE" class="form-control" />
                                                <small class="text-danger"><?php echo form_error('TGL_INVOICE') ?></small>
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
                                            <a href="<?php echo site_url("invoice"); ?>" s class="btn btn-secondary">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
<script type="text/javascript">
    function isi_otomatis() {
        var nim = $("#NOPKS").val();
        $.ajax({
            url: '<?php echo site_url("Invoice/search") ?>',
            data: 'nim=' + nim,
        }).success(function(data) {
            var json = data,
                obj = JSON.parse(json);
            //  $('#NOKPS').val(obj.NOPKS);
            $('#kodetermin').val(obj.kodetermin);
            $('#nominal').val(obj.nominal);
            $('#termin').val(obj.termin);
        });
    }
    $(document).ready(function() {
        $("#NOKPS").autocomplete({
            source: "<?php echo site_url('Termin/search/?'); ?>"
        });
    });
</script>