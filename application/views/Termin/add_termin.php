<!DOCTYPE html>
<html>
<head>
	<title>RBB</title>
</head>
<body>

<table>
	<tr>
		<th>Nominal</th>
		<th>Bulan</th>
		<th>Termin</th>
	</tr>
	<tr><td>
		<form action="<?php echo site_url("Termin/add/".$nopks."/".$ntermin."/".$npayment) ?>" method= "post">
		<input type="text" name="NOMINAL" placeholder="Nominal Termin" val/>
		<?php echo form_error('NOMINAL') ?></td><td>
		<input type="month" name="BULAN" placeholder="BULAN"/>
		<?php echo form_error('BULAN') ?></td><TD>
		<input type="text" name="TERMIN" value="<?php echo $npayment?>" readonly/>
		<?php echo form_error('TERMIN') ?></td>
		<td>
				<button value="save" type="submit">
								Simpan</button>
		</td>
	</tr>
	<tr><td> </td>
		</form>
	</tr>

</table>


</body>
</html>