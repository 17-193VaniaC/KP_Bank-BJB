<form class="user" method="post" action="">
    <div class="form-group">
        <select class="form-control form-control-user" id="kode_rbb" name="kode_rbb" value="<?= $pks['KODE_RBB'] ?>">
            <?php foreach ($no_rbb as $row) : ?>
                <?php if ($row->KODE_RBB == $pks['KODE_RBB']) : ?>
                    <option value="<?= $row->KODE_RBB ?>" selected="selected"><?= $row->KODE_RBB ?></option>
                <?php else : ?>
                    <option value="<?= $row->KODE_RBB ?>"><?= $row->KODE_RBB ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <?= form_error('kode_rbb', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="jenis" name="jenis" value="<?= $pks['JENIS'] ?>">
        <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="kode_project" name="kode_project" value="<?= $pks['KODE_PROJECT'] ?>">
        <?= form_error('kode_project', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="nama_project" name="nama_project" value="<?= $pks['NAMA_PROJECT'] ?>">
        <?= form_error('nama_project', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="date" class="form-control form-control-user" id="tgl_pks" name="tgl_pks" value="<?= $pks['TGL_PKS'] ?>">
        <?= form_error('tgl_pks', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="nominal_pks" name="nominal_pks" value="<?= $pks['NOMINAL_PKS'] ?>">
        <?= form_error('nominal_pks', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <select class="form-control form-control-user" id="nama_vendor" name="nama_vendor" value="<?= $pks['NAMA_VENDOR'] ?>">
            <?php foreach ($vendor as $row) : ?>
                <?php if ($row->nama_vendor == $pks['NAMA_VENDOR']) : ?>
                    <option value="<?= $row->nama_vendor ?>" selected="selected"><?= $row->nama_vendor ?></option>
                <?php else : ?>
                    <option value="<?= $row->nama_vendor ?>"><?= $row->nama_vendor ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <?= form_error('nama_vendor', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>

    <button type="submit" class="btn btn-info btn-user btn-block">
        Save Changes
    </button>

</form>