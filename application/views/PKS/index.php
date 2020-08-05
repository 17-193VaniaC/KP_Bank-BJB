<?php if ($this->session->flashdata('message')) { ?>
    <?php echo $this->session->flashdata('message') ?>
<?php } ?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>    

<script type="text/javascript">
$(document).ready(function(){

    function show_data(query){
        $.ajax({
            url:"<?php echo base_url(); ?>PKS/search"
            method:"POST";
            data:{query:query}
            success:function(data){
                $(#result).html(data);
            }
        })
    }

    $('#searchById').keyup(function)(){
        var keyword = $(this).val;
        if(empty(keyword)){
            show_data();
        }
        else{
            show_data(keyword);
        }
    }
});


    // $('.search-box input[type="text"]').on("keyup input", function(){
    //     var inputVal = $(this).val();
    //     var resultDropdown = $(this).siblings(".result");
    //     if(inputVal.length){
    //         $.get(site_url('KPR/search'), {term: inputVal}).done(function(data){
    //             resultDropdown.html(data);
    //         });
    //     } else{
    //         resultDropdown.empty();
    //     }
    // });
    
    //    $(document).on("click", ".result p", function(){
    //     $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
    //     $(this).parent(".result").empty();
    // });
</script>

<div class="search-box">
            <input type="text" autocomplete="off" placeholder="Cari PKS dengan NO PKS" name="searchById" id="searchById" />
            <div class="result"></div>
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
            <td><?= $row->NO_PKS ?></td>
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