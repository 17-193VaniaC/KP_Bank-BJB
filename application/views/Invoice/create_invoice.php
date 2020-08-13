<!DOCTYPE html>
<html>

<head>
    <title>Ajax Jquery - Belajarphp.net</title>
</head>

<body>
<br>
<div style="margin: 10px; ">
    
        <?php if($this->session->flashdata('success')){?>
        <?php 
        echo "<div class='alert alert-success' >";
        echo $this->session->flashdata('success');
        echo "</div>";
         ?>
        <?php }?>
        <?php if($this->session->flashdata('failed')){?>
        <?php 
        echo "<div class='alert alert-danger' >";
        echo "<strong>Gagal</strong><br>";
        echo $this->session->flashdata('failed');
        echo "</div>";
        ?>
        <?php }?>
        <?php if($this->session->flashdata('not_found')){?>
        <?php 
        echo "<div class='alert alert-danger><br>";
        echo "<strong>Gagal</strong>";
        echo $this->session->flashdata('not_found');
        echo "</div>";
        ?>
        <?php }?>
</div>
 <!--    <?php if ($this->session->flashdata('success')) { ?>
        <?php echo $this->session->flashdata('success'); ?>
    <?php } ?>
    <?php if ($this->session->flashdata('failed')) { ?>
        <?php echo $this->session->flashdata('failed'); ?>
    <?php } ?>
    <?php if ($this->session->flashdata('not_found')) { ?>
        <?php echo $this->session->flashdata('not_found'); ?>
    <?php } ?>
         -->
            <table  style="margin: 15%; margin-top: 100px; margin-bottom: 50PX;" >
    <form action="" form method="post" action="<?= base_url('Invoice/add') ?>">
                <tr>
                    <td>NO. PkS</td>
                    <td><input type="text" name="nopks" onkeyup="isi_otomatis()" id="NOPKS" class="form-control" >
                                    <small class="text-danger"><?php echo form_error('INVOICE') ?></small>
                    </td>


                </tr>
                    <input type="hidden" name="KODE_TERMIN" id="kodetermin" class="form-control" readonly>

                <tr>
                    <td>Termin ke</td>
                    <td><input type="text" id="termin" class="form-control"  readonly></td>

                </tr>
                <tr>
                    <td>Nominal</td>
                    <td><input type="text" name="NOMINAL" id="nominal" class="form-control"  readonly></td>
                </tr>
                <tr>
                    <td>Invoice</td>
                    <td><input type="text" name="INVOICE" class="form-control" >
                        <small class="text-danger"><?php echo form_error('INVOICE') ?></small>
                    </td>

                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td><input type="date" name="TGL_INVOICE" class="form-control" >
                        <small class="text-danger"><?php echo form_error('TGL_INVOICE') ?></small>
                    </td>

                </tr>
                <tr><td></td>
                    <td> <button type="submit" class="btn btn-info btn-user btn-block">
                            Simpan Invoice
                        </button></td>
                </tr>

    </form>
            </table>
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
</body>
<footer id="footer" class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto"><br>
            <span>Copyright &copy; Bank BJB <?= date('Y'); ?></span><br><br>
    </div>
        </div>
            
        <div class="bluefooter"></div>
        <div class="lightbluefooter"></div>
        <div class="yellowfooter"></div>
</div> <!-- END CONTAINER -->
</html>