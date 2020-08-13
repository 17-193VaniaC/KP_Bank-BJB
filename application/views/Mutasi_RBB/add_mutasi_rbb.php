<!DOCTYPE html>
<html>

<head>
	<title><?= $title ?></title>
</head>

<body>
	<?php if ($this->session->flashdata('failed')) { ?>
		<?php echo $this->session->flashdata('failed'); ?>
	<?php } ?>
	<?php if ($this->session->flashdata('success')) { ?>
		<?php echo $this->session->flashdata('success'); ?>
	<?php } ?>

	<table style="margin: 8%;">
		<tr>
			<form action="<?php echo site_url('mutasi_rbb/Penyesuaian_RBB') ?>" method="post">
				<td style="margin-left: 3px; width: 20%; padding:10px;">
					<label for="KODE_RBB">Kode RBB</label>
				</td>
				<td style="margin-left: 3px; width: 30%; padding:10px;">
					<input type="text" name="KODE_RBB" placeholder="Kode RBB" />
					<?php echo form_error('KODE_RBB') ?>
				</td>

		</tr>
		<tr>
			<td style="margin-left: 3px; width: 20%; padding:10px;">
				<label for="NOMINAL">Nominal Penyesuaian RBB</label>
			</td>
			<td style="margin-left: 3px; width: 30%; padding:10px;">
				<input type="number" name="NOMINAL" placeholder="Nominal Anggaran" />
				<?php echo form_error('NOMINAL') ?>
			</td>
		</tr>
		<tr>
			<td style="margin-left: 3px; width: 20%; padding:10px;">
				<label for="KETERANGAN">Keterangan</label>
			</td>
			<td style="margin-left: 3px; width: 30%; padding:10px;">
				<input type="text" name="KETERANGAN" placeholder="Keterangan" />
				<?php echo form_error('KETERANGAN') ?>
			</td>
		</tr>
		<tr>
			<td style="margin-left: 3px; width: 30%; padding:10px;"></td>
			<td style="margin-left: 3px; width: 20%; padding:10px;">
				<button value="save" type="submit">
					Simpan
				</button>
			</td>
		</tr>
		</form>
	</table>
</body>

</html>