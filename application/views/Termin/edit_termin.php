<!DOCTYPE html>
<html>
<head>
	<title>Termin | Ubah</title>
</head>
<body>
	<?php	if(!empty($this->session->flashdata('success'))){?>
	<?php		echo $this->session->flashdata('success')?>
	<?php	}?>
<!-- else{
	echo "hupla";
} -->

<table style="margin: 8%;">
					<tr>
						<form action="" method="post">
					<tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="TERMIN">Termin</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;"><input type="hidden" name="KODE_TERMIN" value="<?php echo $termin->KODE_TERMIN ?>">
								<input type="text" name="TERMIN" placeholder="program Kerja"  value="<?php echo $termin->TERMIN ?>" />
									<?php echo form_error('TERMIN') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="NOMINAL">Nominal</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="number" name="NOMINAL" placeholder="Nominal"  value="<?php echo $termin->NOMINAL ?>"/>
									<?php echo form_error('NOMINAL') ?>
						</td>
					</tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="TGL_TERMIN">Bulan</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="TGL_TERMIN" placeholder=""  value="<?php echo $termin->TGL_TERMIN ?>"/>
									<?php echo form_error('TGL_TERMIN') ?>
						</td></tr><tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="STATUS">STATUS</label>
						</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="STATUS" placeholder="Status"  value="<?php echo $termin->STATUS?>"/>
									<?php echo form_error('STATUS') ?>
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