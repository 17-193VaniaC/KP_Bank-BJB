<!DOCTYPE html>
<html>
<head>
	<title>bdbd</title>
</head>
<body>
<table style="margin: 8%;">
					<tr>
						<form action="<?php echo site_url('rbb/add') ?>" method="post" enctype="multipart/form-data" >
					<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="KODE_RBB">Kode RBB</label>
								</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input class="form-control <?php echo form_error('KODE_RBB') ? 'is-invalid':'' ?>"
								 type="text" name="KODE_RBB" placeholder="Kode RBB" />
					</td>
									<?php echo form_error('KODE_RBB') ?>

					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="PROGRAM_KERJA">Program Kerja</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input class="form-control <?php echo form_error('PROGRAM_KERJA') ? 'is-invalid':'' ?>"
								 type="text" name="PROGRAM_KERJA" placeholder="program Kerja" />
									<?php echo form_error('PROGRAM_KERJA') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="ANGGARAN">Anggaran</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input class="form-control <?php echo form_error('ANGGARAN') ? 'is-invalid':'' ?>"
								 type="number" name="ANGGARAN" placeholder="Anggaran" />
									<?php echo form_error('ANGGARAN') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="GL">GL</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input class="form-control <?php echo form_error('GL') ? 'is-invalid':'' ?>"
								 type="text" name="GL" placeholder="GL" />
									<?php echo form_error('GL') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="NAMA_REKENING">Nama Rekening</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input class="form-control <?php echo form_error('NAMA_REKENING') ? 'is-invalid':'' ?>"
								 type="text" name="NAMA_REKENING" placeholder="NAMA_REKENING" />
									<?php echo form_error('NAMA_REKENING') ?>
						</td>
					</tr>

					<tr><td style="margin-left: 3px; width: 30%; padding:10px;"></td>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
							<button value="save" type="submit">
								Simpan
							</button>
							<input type="submit" name="btn" value="save" />
						</td>
					</tr>
					</form>
			</table>
</body>
</html>