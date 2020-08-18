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
				<td>
					<?php if ($listtermin->STATUS == 'UNPAID') : 
                        $pks_ = str_replace('/', '_', $listtermin->NO_PKS);?>
                                <a href="<?= site_url('Termin/edit/' . $listtermin->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-success">Edit</button></a>
                                <a href="<?= site_url('Termin/delete/' . $listtermin->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-danger">Delete</button></a>
                    <?php else : 
                        $pks_ = str_replace('/', '_', $listtermin->NO_PKS);?>
                                <a href="<?= site_url('Termin/edit/0/' . $pks_) ?>"><button class="btn btn-success">Edit</button></a>
                                <a href="<?= site_url('Termin/delete/0/' . $pks_) ?>"><button class="btn btn-danger">Delete</button></a>
                    <?php endif; ?>
				</td>
			</tr>
		<?php endforeach;  ?>

	</table>
</body>

</html>