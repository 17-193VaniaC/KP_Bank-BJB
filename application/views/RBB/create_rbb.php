<!DOCTYPE html>
<html>
<head>
	<title>bdbd</title>
</head>
<body>


<table style="margin: 8%;">
					<tr>
						<form action="<?php echo site_url('rbb/add') ?>" method="post">
					<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="KODE_RBB">Kode RBB</label>
								</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="KODE_RBB" placeholder="Kode RBB"/>
									<?php echo form_error('KODE_RBB') ?>
					</td>

					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="PROGRAM_KERJA">Program Kerja</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="PROGRAM_KERJA" placeholder="program Kerja" />
									<?php echo form_error('PROGRAM_KERJA') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="ANGGARAN">Anggaran</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="number" name="ANGGARAN" placeholder="Anggaran" />
									<?php echo form_error('ANGGARAN') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="GL">GL</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="GL" placeholder="GL" />
									<?php echo form_error('GL') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="NAMA_REKE">Nama Rekening</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="NAMA_REK" placeholder="NAMA_REK" />
									<?php echo form_error('NAMA_REK') ?>
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