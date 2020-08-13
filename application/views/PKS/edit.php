<form class="user" method="post" action="">
    <div class="form-group">
        <label for="tgl_pks">Jenis Project</label>
        <select class="form-control form-control-user" id="jenis" name="jenis" value="<?= $pks['JENIS'] ?>">
            <?php foreach ($jenis as $row) : ?>
                <?php if ($row->KODE_JENISPROJECT == $pks['JENIS']) : ?>
                    <option value="<?= $row->KODE_JENISPROJECT ?>" selected="selected"><?= $row->jenis ?></option>
                <?php else : ?>
                    <option value="<?= $row->KODE_JENISPROJECT ?>"><?= $row->jenis ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="tgl_pks">Kode Project</label>
        <input type="text" class="form-control form-control-user" id="kode_project" name="kode_project" value="<?= $pks['KODE_PROJECT'] ?>">
        <?= form_error('kode_project', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="tgl_pks">Nama Project</label>
        <input type="text" class="form-control form-control-user" id="nama_project" name="nama_project" value="<?= $pks['NAMA_PROJECT'] ?>">
        <?= form_error('nama_project', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="tgl_pks">Tanggal PKS</label>
        <input type="date" class="form-control form-control-user" id="tgl_pks" name="tgl_pks" value="<?= $pks['TGL_PKS'] ?>">
        <?= form_error('tgl_pks', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <label for="tgl_pks">Vendor</label>
        <select class="form-control form-control-user" id="nama_vendor" name="nama_vendor" value="<?= $pks['NAMA_VENDOR'] ?>">
            <?php foreach ($vendor as $row) : ?>
                <?php if ($row->KODE_VENDOR == $pks['NAMA_VENDOR']) : ?>
                    <option value="<?= $row->KODE_VENDOR ?>" selected="selected"><?= $row->nama_vendor ?></option>
                <?php else : ?>
                    <option value="<?= $row->KODE_VENDOR ?>"><?= $row->nama_vendor ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <?= form_error('nama_vendor', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>

    <button type="submit" class="btn btn-info btn-user btn-block">
        Save Changes
    </button>

</form>