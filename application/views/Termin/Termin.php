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
		<th>Tanggal Termin</th>
		<th>Status</th>
		<th>Opsi</th>

	</tr>
		<?php foreach ($termin as $listtermin):?>
	<tr>
		<td><?php echo $listtermin->KODE_TERMIN; ?></td>
		<td><?php echo $listtermin->NO_PKS; ?></td>
		<td><?php echo $listtermin->TERMIN; ?></td>
		<td><?php echo $listtermin->NOMINAL; ?></td>
		<td><?php echo $listtermin->TGL_TERMIN; ?></td>
		<td><?php echo $listtermin->STATUS; ?></td>
		<td><a href="<?php echo site_url('termin/edit/' . $listtermin->KODE_TERMIN) ?>"><button>Edit</button></a>
            <a href="<?php echo site_url('termin/delete/' . $listtermin->KODE_TERMIN) ?>"><button>Delete</button></a>
        </td>
	</tr>
<?php endforeach;  ?>
	<tr><td> </td>
		
	</tr>

</table>


</body>
</html>