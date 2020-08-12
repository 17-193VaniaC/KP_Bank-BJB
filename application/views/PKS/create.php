<div class="row">
    <div class="col-md text-center my-">
        <h2>Create PKS</h2>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <form class="user" method="post" action="<?= base_url('pks/create') ?>">
                <div class="form-group">
                    <label for="no_pks">Nomor PKS</label>
                    <input type="text" class="form-control form-control-user" id="no_pks" name="no_pks" placeholder="Nomor PKS...">
                    <?= form_error('no_pks', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="kode_rbb">Kode RBB</label>
                    <select class="form-control form-control-user" id="kode_rbb" name="kode_rbb">
                        <?php foreach ($no_rbb as $row) : ?>
                            <option value="<?= $row->KODE_RBB ?>"><?= $row->KODE_RBB ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('kode_rbb', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="jenis">Jenis</label>
                    <select class="form-control form-control-user" id="jenis" name="jenis">
                        <?php foreach ($jenis as $row) : ?>
                            <option value="<?= $row->jenis ?>"><?= $row->jenis ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <!-- <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="jenis" name="jenis" placeholder="jenis...">
                    <?= form_error('jenis', '<small class="text-danger pl-3">', '</small>'); ?>
                </div> -->
                <div class="form-group">
                    <label for="kode_project">Kode Project</label>
                    <input type="text" class="form-control form-control-user" id="kode_project" name="kode_project" placeholder="Kode project...">
                    <?= form_error('kode_project', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama_project">Nama Project</label>
                    <input type="text" class="form-control form-control-user" id="nama_project" name="nama_project" placeholder="Nama project...">
                    <?= form_error('nama_project', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="tgl_pks">Tanggal PKS</label>
                    <input type="date" class="form-control form-control-user" id="tgl_pks" name="tgl_pks" placeholder="Tanggal PKS...">
                    <?= form_error('tgl_pks', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nominal_pks">Nominal PKS</label>
                    <input type="number" class="form-control form-control-user" id="nominal_pks" name="nominal_pks" placeholder="Nominal pks...">
                    <?= form_error('nominal_pks', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama_vendor">Nama Vendor</label>
                    <select class="form-control form-control-user" id="nama_vendor" name="nama_vendor">
                        <?php foreach ($vendor as $row) : ?>
                            <option value="<?= $row->nama_vendor ?>"><?= $row->nama_vendor ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('nama_vendor', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="termin">Jumlah termin (optional)</label>
                    <input type="text" class="form-control form-control-user" id="termin" name="termin" placeholder="Kosongkan jika tanpa termin">
                    <?= form_error('termin', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-info btn-user btn-block">
                    Create PKS
                </button>
            </form>
        </div>
    </div>
</div>