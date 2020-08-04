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