<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
</head>
<body>


<table  class="table table-striped table-hover table-bordered">
		<tr>
			<th>Kode RBB</th>
			<th>Nominal</th>
			<th>Keterangan</th>
			<th>Tangga Mutasi</th>
		</tr>
		<?php foreach ($mutasirbb as $mutasi_rbb) : ?>
			<tr>
				<td><?php echo $mutasi_rbb->KODE_RBB; ?></td>
				<td><?php echo $mutasi_rbb->NOMINAL; ?></td>
				<td><?php echo $mutasi_rbb->KETERANGAN; ?></td>
				<td><?php echo $mutasi_rbb->TGL_MUTASI; ?></td>
			</tr>
		<?php endforeach;  ?>
		<tr>
			<td> </td>

		</tr>
			</table>
</body>
</html>