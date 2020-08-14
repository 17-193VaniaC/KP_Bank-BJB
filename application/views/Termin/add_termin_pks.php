<br><br><table style="margin: 15%; margin-top: 100px; margin-bottom: 50PX;">
    <tr>
        <th>Nominal</th>
        <th>Bulan</th>
        <th>Termin</th>
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
            <button value="save" type="submit" class="btn btn-primary">
                Simpan</button>
        </td>
    </tr>
    <tr>
        <td> </td>
        </form>
    </tr>

</table>