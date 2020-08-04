<!DOCTYPE html>
<html>
<head>
	<title>RBB</title>
</head>
<body>

<table>
	<tr>
		<th>Kode RBB</th>
		<th>Program Kerja</th>
		<th>Anggaran</th>
		<th>GL</th>
		<th>Nama Rek</th>
		<th>Sisa Anggaran</th>
		<th>Opsi</th>
	</tr>
		<?php foreach ($rbb as $listrbb):?>
	<tr>
		<td><?php echo $listrbb->KODE_RBB; ?></td>
		<td><?php echo $listrbb->PROGRAM_KERJA; ?></td>
		<td><?php echo $listrbb->ANGGARAN; ?></td>
		<td><?php echo $listrbb->GL; ?></td>
		<td><?php echo $listrbb->NAMA_REK; ?></td>
		<td><?php echo $listrbb->SISA_ANGGARAN; ?></td>
		<td>
			<a href="<?php echo site_url('rbb/edit/'.$listrbb->KODE_RBB) ?>"">
				<button>Ubah</button>
			<a href="<?php echo site_url('rbb/delete/'.$listrbb->KODE_RBB) ?>"">
				<button>Hapus</button>
			</a>
		</td>
	</tr>
<?php endforeach;  ?>
	<tr><td> </td>
		
	</tr>

</table>


</body>
</html>