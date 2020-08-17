<!DOCTYPE html>
<html>

<head>
	<title>Daftar Termin</title>
</head>

<body>
<br><BR	>
	<h2 style="text-align: center; ">Daftar Termin</h2>
        <div class="container-xl" style="margin-top: 50px;">

	<table class="table table-striped table-hover table-bordered">
		<tr>
			<th>No. PKS</th>
			<th>Termin</th>
			<th>Nominal</th>
			<th>Tanggal Termin</th>
			<th>Status</th>
			<th>Kategori</th>
			<th>GL</th>
			<th>Opsi</th>

		</tr>
		<?php foreach ($termin as $listtermin) : ?>
			<tr>
				<td><?php echo $listtermin->NO_PKS; ?></td>
				<td><?php echo $listtermin->TERMIN; ?></td>
				<td><?php echo $listtermin->NOMINAL; ?></td>
				<td><?php echo $listtermin->TGL_TERMIN; ?></td>
				<td><?php echo $listtermin->STATUS; ?></td>
				<td><?php echo $listtermin->KATEGORI; ?></td>
				<td><?php echo $listtermin->GL; ?></td>
				<td><a href="<?php echo site_url('termin/edit/' . $listtermin->KODE_TERMIN) ?>" class="btn btn-primary">Edit</a>
					<a href="<?php echo site_url('termin/delete/' . $listtermin->KODE_TERMIN) ?>" class="btn btn-danger"> Hapus</a>
				</td>
			</tr>
		<?php endforeach;  ?>

	</table>
</body>

</html>