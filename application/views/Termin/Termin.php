<!DOCTYPE html>
<html>
<head>
	<title>RBB</title>
</head>
<body>

<table>
	<tr>
		<th>Kode Termin</th>
		<th>No. PKS</th>
		<th>Termin</th>
		<th>Nominal</th>
		<th>Bulan</th>
		<th>Status</th>
		<th>Opsi</th>

	</tr>
		<?php foreach ($termin as $listtermin):?>
	<tr>
		<td><?php echo $listtermin->KODE_TERMIN; ?></td>
		<td><?php echo $listtermin->NO_PKS; ?></td>
		<td><?php echo $listtermin->TERMIN; ?></td>
		<td><?php echo $listtermin->NOMINAL; ?></td>
		<td><?php echo $listtermin->BULAN; ?></td>
		<td><?php echo $listtermin->STATUS; ?></td>
	</tr>
		<>
<?php endforeach;  ?>
	<tr><td> </td>
		
	</tr>

</table>


</body>
</html>