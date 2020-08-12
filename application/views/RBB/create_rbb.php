<!DOCTYPE html>
<html>
<head>
	<title>bdbd</title>
</head>
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<body>
	<?php if($this->session->flashdata('success')){?>
		<?php 
		echo "<div class='alert alert-success'>";
		echo $this->session->flashdata('success');
		echo "</div>";
		 ?>
		<?php }?>
		<?php if($this->session->flashdata('failed')){?>
		<?php 
			echo $this->session->flashdata('failed');
			echo "<strong>Gagal</strong>";
			echo "</div>";
		?>
		<?php }?>
<table style="margin: 15%; margin-top: 100px; margin-bottom: 50PX;" >
					<tr>
					<form action="<?php echo site_url('rbb/add') ?>" method="post">
					<td style="margin-left: 3px; width: 20%; padding:10px;">
						<label for="KODE_RBB">Kode RBB</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
							<input type="text" name="KODE_RBB" placeholder="Kode RBB" class="form-control" />
									<small class="text-danger"><?php echo form_error('KODE_RBB') ?></small>
					</td>

					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="PROGRAM_KERJA">Program Kerja</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="PROGRAM_KERJA" placeholder="Program Kerja" class="form-control"/>
									<small class="text-danger"><?php echo form_error('PROGRAM_KERJA') ?></small>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="ANGGARAN">Nominal Anggaran</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="number" name="ANGGARAN" placeholder="Nominal Anggaran" style="-moz-appearance: textfield;
  margin: 0;" class="form-control"/>
									<small class="text-danger"><?php echo form_error('ANGGARAN') ?></small>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="GL">GL</label>
						</td>
						<td style="margin-left: 3px; width: 30%; padding:10px;">
						 <select class="form-control form-control-user" name="GL">
                        <?php foreach ($gl as $row) : ?>
                            <option value="<?= $row->KODE_GL ?>"><?= $row->KODE_GL ?></option>
                        <?php endforeach; ?>
                    </select>
									<?php echo form_error('GL', '<small class="text-danger pl-3">', '</small>'); ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="NAMA_REKE">Nama Rekening</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="NAMA_REK" placeholder="Nama Rekening" class="form-control" />
									<small class="text-danger"><?php echo form_error('NAMA_REK') ?></small>
						</td>
					</tr>

					<tr><td style="margin-left: 3px; width: 30%; padding:10px;"></td>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
							<button value="save" type="submit" class="btn btn-success">
								Simpan
							</button>
							<a href="<?php echo site_url("rbb");?>"s class="btn btn-secondary">
								Batal
							</a>
						</td>
					</tr>
					</form>
			</table>
</body>
</html>