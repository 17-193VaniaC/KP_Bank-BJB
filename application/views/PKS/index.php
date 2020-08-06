<?php if ($this->session->flashdata('message')) { ?>
    <?php echo $this->session->flashdata('message') ?>
<?php } ?>
<script src="<?php echo base_url().'assets/js/jquery-3.5.1.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>


<div class="search-box">
    <form method="get">
            <input type="text" autocomplete="off" placeholder="Cari PKS dengan NO PKS" name="searchById" id="searchById" />
            <div class="result"></div>
            <input type="submit" name="search">
        </form>
</div>
<table style="width:100%">
    <tr>
        <th>Nomor PKS</th>
        <th>Kode RBB</th>
        <th>Jenis</th>
        <th>Kode Project</th>
        <th>Nama Project</th>
        <th>tanggal PKS</th>
        <th>Nominal PKS</th>
        <th>Nama Vendor</th>
        <th></th>
    </tr>

    <div id="result"></div>
    <?php foreach ($pks as $row) : ?>
        <tr>
            <td><a href="<?php echo site_url('Termin/Termin_pks/'.$row->NO_PKS);?>"><?= $row->NO_PKS ?></a></td>
            <td><?= $row->KODE_RBB ?></td>
            <td><?= $row->JENIS ?></td>
            <td><?= $row->KODE_PROJECT ?></td>
            <td><?= $row->NAMA_PROJECT ?></td>
            <td><?= $row->TGL_PKS ?></td>
            <td><?= $row->NOMINAL_PKS ?></td>
            <td><?= $row->NAMA_VENDOR ?></td>

            <td>
                <div class="btn-group">
                    <a href="<?php echo site_url('pks/edit/' . $row->NO_PKS); ?>" class="btn btn-success"><button>Edit</button></a>
                    <a href="<?php echo site_url('pks/delete/' . $row->NO_PKS); ?>" class="btn btn-danger"><button>Delete</button></a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<hr>
<a href="<?= base_url('pks/create'); ?>">Create</a>
<script type="text/javascript">
$(document).ready(function(){
        $( "#searchById" ).autocomplete({
            source: "<?php echo site_url('pks/search/?');?>"
        });
});
</script>