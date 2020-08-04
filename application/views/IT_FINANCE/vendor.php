<!DOCTYPE html>
<html>
<head>
	<title>VENDOR</title>
</head>
<body>


<table style="margin: 8%;">
					<tr>
						<form action="<?php echo site_url('vendor/add') ?>" method="post">
					<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="VENDOR">Kode RBB</label>
								</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="VENDOR" placeholder="Nama Vendor"/>
									<?php echo form_error('VENDOR') ?>
					</td></tr>
		<tr><td style="margin-left: 3px; width: 30%; padding:10px;"></td>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
							<input type="submit" name="btn" value="Save" class="save-button" />
						</td>
					</tr>
					</form>
			</table>


<table>
	<tr>
		<th>No</th>
		<th>Nama Vendor</th>
	</tr>
		<?php 
		$i=1;?>
		<?php
		foreach ($vendor as $listvendor): ?>
	<tr>
		<td><?php 
			echo $i+".";
			$i=$i+1;
			?>
		</td>
		<td><?php echo $listvendor->VENDOR ?></td>
		<td>
			<a href="<?php echo site_url('vendor/delete/'.$listvendor->VENDOR) ?>"">
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