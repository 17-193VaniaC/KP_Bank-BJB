<!DOCTYPE html>
<html>
<head>
	<title>bdbd</title>
</head>
<body>


<table style="margin: 8%;">
					<tr>
						<form action="" method="post">
					<tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="PROGRAM_KERJA">Program Kerja</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;"><input type="hidden" name="KODE_RBB" value="<?php echo $rbb->KODE_RBB ?>">
								<input type="text" name="PROGRAM_KERJA" placeholder="program Kerja"  value="<?php echo $rbb->PROGRAM_KERJA ?>" 
									<?php echo form_error('PROGRAM_KERJA') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="ANGGARAN">Anggaran</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="number" name="ANGGARAN" placeholder="Anggaran"  value="<?php echo $rbb->ANGGARAN ?>"/>
									<?php echo form_error('ANGGARAN') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="GL">GL</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="GL" placeholder="GL"  value="<?php echo $rbb->GL ?>"/>
									<?php echo form_error('GL') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="NAMA_REKE">Nama Rekening</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="NAMA_REK" placeholder="NAMA_REK"  value="<?php echo $rbb->NAMA_REK ?>"/>
									<?php echo form_error('NAMA_REK') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="SISA_ANGGARAN">Sisa Anggaran</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="SISA_ANGGARAN" placeholder="SISA_ANGGARAN"  value="<?php echo $rbb->SISA_ANGGARAN ?>"/>
									<?php echo form_error('SISA_ANGGARAN') ?>
						</td>
					</tr>

					<tr><td style="margin-left: 3px; width: 30%; padding:10px;"></td>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
							<button value="save" type="submit">
								Ubah
							</button>
						</td>
					</tr>
					</form>
			</table>
</body>