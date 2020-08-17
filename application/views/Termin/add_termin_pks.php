<br><br><table style="margin: 15%; margin-top: 100px; margin-bottom: 50PX;">
    <tr>
        <th>Nominal</th>
        <th>Tanggal Termin</th>
        <th>Termin</th>
        <th>Kategori</th>
        <th>GL</th>
    </tr>
    <tr>
        <td>    <?php $nopks= str_replace('/', '_', $no_pks)?>
            <form action="<?php echo site_url("Termin/addMore/" . $nopks . "/" . $termin_ke) ?>" method="post">
                <input type="number" name="NOMINAL" placeholder="Nominal Termin" class="form-control" />
                <?php echo form_error('NOMINAL') ?>
        </td>
        <td>
            <input type="date" name="TGL_TERMIN" placeholder="Tanggal Termin"  class="form-control" />
            <?php echo form_error('TGL_TERMIN') ?></td>
        <TD>
            <input type="text" name="TERMIN" value="<?php echo $termin_ke ?>" readonly  class="form-control" />
            <?php echo form_error('TERMIN') ?></td>
        <td>
            <select class="form-control" name="KATEGORI" id="kategori">
                <option value="Pengadaan">Pengadaan</option>
                <option value="Maintenance">Maintenance</option>
                <option value="Waranty">Waranty</option>
                <option value="License">License</option>
                <option value="Pembayaran Rutin Bulanan">Pembayaran Rutin Bulanan</option>
            </select>
        </td>
        <td>
            <select class="form-control form-control-user" name="GL" id="GL">

                    </select>
        </td> 
        <td>
            <button value="save" type="submit" class="btn btn-primary">
                Simpan</button>
        </td>
    </tr>
    <tr>
        <td> </td>
        </form>
    </tr>

</table>

<script src="<?php echo base_url() . 'assets/js/jquery-3.5.1.min.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
        $(document).ready(function(){
            $('#kategori').change(function(){ 
                var kategori=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('termin/getCategoryGL');?>",
                    method : "POST",
                    data : {KATEGORI: kategori},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].KODE_GL+'>'+data[i].KODE_GL+' | '+data[i].NAMA_GL+'</option>';
                        }
                        $('#GL').html(html);
                    }
                });
                return false;
            }); 
             
        });
    </script>