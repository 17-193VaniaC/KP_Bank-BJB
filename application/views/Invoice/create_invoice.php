<!DOCTYPE html>
<html>

<head>
    <title>Ajax Jquery - Belajarphp.net</title>
</head>

<body>
    <?php if ($this->session->flashdata('success')) { ?>
        <?php echo $this->session->flashdata('success'); ?>
    <?php } ?>
    <?php if ($this->session->flashdata('failed')) { ?>
        <?php echo $this->session->flashdata('failed'); ?>
    <?php } ?>
    <?php if ($this->session->flashdata('not_found')) { ?>
        <?php echo $this->session->flashdata('not_found'); ?>
    <?php } ?>
    <?php if ($this->session->flashdata('empty')) { ?>
        <?php echo $this->session->flashdata('empty'); ?>
    <?php } ?>
    <form action="" form method="post" action="<?= base_url('Invoice/add') ?>">
        <div class="form-group">
            <table>
                <tr>
                    <td>NO. PkS</td>
                    <td><input type="text" name="nopks" onkeyup="isi_otomatis()" id="NOPKS"></td>
                </tr>
                <tr>
                    <td>Kode Termin</td>
                    <td><input type="text" name="KODE_TERMIN" id="kodetermin" readonly></td>
                </tr>
                <tr>
                    <td>Termin ke</td>
                    <td><input type="text" id="termin" readonly></td>
                </tr>
                <tr>
                    <td>Nominal</td>
                    <td><input type="text" name="NOMINAL" id="nominal" readonly></td>
                </tr>
                <tr>
                    <td>Invoice</td>
                    <td><input type="text" name="INVOICE"></td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td><input type="date" name="TGL_INVOICE"></td>
                </tr>
                <tr>
                    <td> <button type="submit" class="btn btn-info btn-user btn-block">
                            Simpan Invoice
                        </button></td>
                </tr>

            </table>
        </div>
    </form>
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

</html>