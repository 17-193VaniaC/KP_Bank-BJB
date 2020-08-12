<!DOCTYPE html>
<html>
<head>
	<title>bdbd</title>
</head>
<body>


<table style="margin: 15%; margin-top: 100px; margin-bottom: 50PX;" >
					<tr>
						<form action="" method="post">
					<tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="PROGRAM_KERJA">Program Kerja</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;"><input type="hidden" name="KODE_RBB" value="<?php echo $rbb->KODE_RBB ?>">
								<input type="text" name="PROGRAM_KERJA" placeholder="Program Kerja" class="form-control" value="<?php echo $rbb->PROGRAM_KERJA ?>" 
									<?php echo form_error('PROGRAM_KERJA') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="GL">GL</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
							 <select class="form-control form-control-user" name="GL" value="<?php echo $rbb->GL ?>">
		                        <?php foreach ($gl as $row) : ?>
		                            <option value="<?= $row->KODE_GL ?>"><?= $row->KODE_GL ?></option>
		                        <?php endforeach; ?>
		                    </select>
									<?php echo form_error('GL') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="NAMA_REKE">Nama Rekening</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="NAMA_REK" placeholder="NAMA_REK"  value="<?php echo $rbb->NAMA_REK ?>" class="form-control"/>
									<?php echo form_error('NAMA_REK') ?>
						</td>
					</tr>

					<tr><td style="margin-left: 3px; width: 30%; padding:10px;"></td>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
							<button value="save" type="submit" class="btn btn-success">
								Ubah
							</button>
							<a href="<?php echo site_url("rbb");?>" class="btn btn-secondary">
								Batal
							</a>
						</td>
					</tr>
					</form>
			</table>
</body>