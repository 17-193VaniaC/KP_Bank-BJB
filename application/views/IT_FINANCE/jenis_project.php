<!DOCTYPE html>
<html>
<head>
	<title>JENIS PROJECT</title>
</head>
<body>


<table style="margin: 8%;">
					<tr>
						<form action="<?php echo site_url('jproject/add') ?>" method="post">
					<td style="margin-left: 3px; width: 20%; padding:10px;">
								<label for="jenis">Jenis Project</label>
								</td><td style="margin-left: 3px; width: 30%; padding:10px;">
								<input type="text" name="jenis" placeholder="Jenis Project"/>
									<?php echo form_error('jenis') ?>
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
		<th>Jenis Project</th>
	</tr>
		<?php 
		$i=1;?>
		<?php
		foreach ($jenis as $listjenisproject): ?>
	<tr>
		<td><?php 
			echo $i+".";
			$i=$i+1;
			?>
		</td>
		<td><?php echo $listjenisproject->jenis ?></td>
		<td>
			<a href="<?php echo site_url('jproject/delete/'.$listjenisproject->jenis) ?>"">
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