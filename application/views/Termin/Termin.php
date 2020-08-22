<!-- <body style="background: rgb(53,150,255);background: linear-gradient(299deg, rgba(53,150,255,1) 0%, rgba(119,182,250,1) 50%, rgba(255,221,118,1) 100%);"> -->
<br>
<div class="container-xl" style="margin-top: 50px;">
	<h2 style="text-align: center; ">Daftar Termin</h2>
	<br>
	<table class="table table-striped table-hover table-bordered">
		<thead style="background-color: #204d95; color: white;">
			<td>No. PKS</td>
			<td>Termin</td>
			<td>Nominal</td>
			<td>Tanggal Termin</td>
			<td>Status</td>
			<td>Kategori</td>
			<td>GL</td>
			<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
				<td>Opsi</td>
			<?php endif; ?>
		</thead>
		<?php foreach ($termin as $listtermin) : ?>
			<tr>
				<td><?php echo $listtermin->NO_PKS; ?></td>
				<td><?php echo $listtermin->TERMIN; ?></td>
				<td><?php echo $listtermin->NOMINAL; ?></td>
				<td><?php echo $listtermin->TGL_TERMIN; ?></td>
				<td><?php echo $listtermin->STATUS; ?></td>
				<td><?php echo $listtermin->KATEGORI; ?></td>
				<td><?php echo $listtermin->GL; ?></td>
				<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
					<td>
						<?php if ($listtermin->STATUS == 'UNPAID') :
							$pks_ = str_replace('/', '_', $listtermin->NO_PKS); ?>
							<a href="<?= site_url('Termin/edit/' . $listtermin->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-info">Edit</button></a>
							<a href="<?= site_url('Termin/delete/' . $listtermin->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-danger">Delete</button></a>
						<?php else :
							$pks_ = str_replace('/', '_', $listtermin->NO_PKS); ?>
							<a href="<?= site_url('Termin/edit/0/' . $pks_) ?>"><button class="btn btn-info">Edit</button></a>
							<a href="<?= site_url('Termin/delete/0/' . $pks_) ?>"><button class="btn btn-danger">Delete</button></a>
						<?php endif; ?>
					</td>
				<?php endif; ?>

			</tr>
		<?php endforeach;  ?>

	</table>
	</body>

	</html>