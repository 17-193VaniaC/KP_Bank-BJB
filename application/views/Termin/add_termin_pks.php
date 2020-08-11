<table>
    <tr>
        <th>Nominal</th>
        <th>Bulan</th>
        <th>Termin</th>
    </tr>
    <tr>
        <td>
            <form action="<?php echo site_url("Termin/addMore/" . $no_pks . "/" . $termin_ke) ?>" method="post">
                <input type="text" name="NOMINAL" placeholder="Nominal Termin" val />
                <?php echo form_error('NOMINAL') ?>
        </td>
        <td>
            <input type="month" name="TGL_TERMIN" placeholder="Tanggal Termin" />
            <?php echo form_error('TGL_TERMIN') ?></td>
        <TD>
            <input type="text" name="TERMIN" value="<?php echo $termin_ke ?>" readonly />
            <?php echo form_error('TERMIN') ?></td>
        <td>
            <button value="save" type="submit">
                Simpan</button>
        </td>
    </tr>
    <tr>
        <td> </td>
        </form>
    </tr>

</table>