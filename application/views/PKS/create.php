<form class="user" method="post" action="<?= base_url('pks/create') ?>">

    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="no_pks" name="no_pks" placeholder="Nomor PKS...">
        <?= form_error('no_pks', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>

    <div class="form-group">
        <select class="form-control form-control-user" id="kode_rbb" name="kode_rbb">
            <?php foreach ($no_rbb as $row) : ?>
                <option value="<?= $row->KODE_RBB ?>"><?= $row->KODE_RBB ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('kode_rbb', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="jenis" name="jenis" placeholder="jenis...">
        <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="kode_project" name="kode_project" placeholder="Kode project...">
        <?= form_error('kode_project', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="nama_project" name="nama_project" placeholder="Nama project...">
        <?= form_error('nama_project', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="date" class="form-control form-control-user" id="tgl_pks" name="tgl_pks" placeholder="Tanggal PKS...">
        <?= form_error('tgl_pks', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" id="nominal_pks" name="nominal_pks" placeholder="Nominal pks...">
        <?= form_error('nominal_pks', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>
    <div class="form-group">
        <select class="form-control form-control-user" id="nama_vendor" name="nama_vendor">
            <?php foreach ($vendor as $row) : ?>
                <option value="<?= $row->VENDOR ?>"><?= $row->VENDOR ?></option>
            <?php endforeach; ?>
        </select>
        <?= form_error('nama_vendor', '<small class="text-danger pl-3">', '</small>'); ?>
    </div>

    <button type="submit" class="btn btn-info btn-user btn-block">
        Create PKS
    </button>

</form>