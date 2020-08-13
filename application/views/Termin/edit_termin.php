<div class="row">
	<div class="col-md text-center my-">
		<h2>Edit Termin</h2>
	</div>
</div>
<table>
	<tr>
		<th>Nominal</th>
		<th>Bulan</th>
	</tr>
	<tr>
		<td>
			<form action="<?php echo site_url("Termin/edit/" . $termin->KODE_TERMIN . "/" . $termin->NO_PKS) ?>" method="post">
				<input type="text" name="NOMINAL" placeholder="Nominal Termin" value="<?= $termin->NOMINAL ?>" />
				<?php echo form_error('NOMINAL') ?>
		</td>
		<td>
			<input type="date" name="TGL_TERMIN" placeholder="Tanggal Termin" value="<?= $termin->TGL_TERMIN ?>" />
			<?php echo form_error('TGL_TERMIN') ?></td>>
		<td>
			<button value="save" type="submit">
				Simpan</button>
		</td>
	</tr>
	<tr>
		<td> </td>
		</form>
	</tr>

</table>