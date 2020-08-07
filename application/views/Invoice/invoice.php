<?php if ($this->session->flashdata('message')) { ?>
    <?php echo $this->session->flashdata('message') ?>
<?php } ?>
<script src="<?php echo base_url().'assets/js/jquery-3.5.1.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/js/jquery-ui.js'?>" type="text/javascript"></script>


<div class="search-box">
    <form method="get">
            <input type="text" autocomplete="off" placeholder="Cari PKS dengan NO PKS" name="searchById" id="searchById" />
            <input type="text" name="invoice_termin" id="invoice_termin" />
            <div class="result"></div>
            <input type="submit" name="search">
        </form>
</div>

<hr>
<a href="<?= base_url('Invoice/add'); ?>">Create</a>
<script type="text/javascript">
$(document).ready(function(){
        $( "#searchById" ).autocomplete({
            source: "<?php echo site_url('Termin/search/?');?>"

            select: function (event, ui) {
                    $('[name="title"]').val(ui.item.label); 
                    $('[name="description"]').val(ui.item.description); 
                }
        });
});
</script>