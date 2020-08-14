<br><br>
	<div class="col-md text-center my-">
		<h2>Edit Termin</h2>
	</div>
<table style="margin: 15%; margin-top: 100px; margin-bottom: 50PX;">
	<tr>
		<th>Nominal</th>
		<th>Bulan</th>
	</tr>
	<tr>
		<td><?php 
		$pks_ = str_replace('/', '_', $termin->NO_PKS);
		?>
			<form action="<?php echo site_url("Termin/edit/" . $termin->KODE_TERMIN . "/" . $pks_) ?>" method="post">
				<input type="text" name="NOMINAL" placeholder="Nominal Termin" value="<?= $termin->NOMINAL ?>" class='form-control'/>
				<?php echo form_error('NOMINAL') ?>
		</td>
		<td>
			<input type="date" name="TGL_TERMIN" placeholder="Tanggal Termin" value="<?= $termin->TGL_TERMIN ?>" class='form-control'/>
			<?php echo form_error('TGL_TERMIN') ?></td>
		<td>
			<button value="save" type="submit" class='btn btn-primary'>
				Simpan</button>
		</td>
	</tr>
	<tr>
		<td> </td>
		</form>
	</tr>

</table>