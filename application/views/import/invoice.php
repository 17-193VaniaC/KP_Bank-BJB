<form class="user" action="<?= base_url('import/invoice') ?>" method="post" id="import" enctype="multipart/form-data">
    <label for="upload_file">Select Excel File</label>
    <input type="file" name="upload_file" id="upload_file" required>
    <small class="text-danger"><?php echo form_error('name') ?></small>
    <button value="save" type="submit" class="btn btn-success">
        Simpan
    </button>
</form>