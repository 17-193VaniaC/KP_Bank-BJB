<div class="row">
	<div class="col-md text-center page-title">
		<h2>Daftar Jenis Project</h2>
	</div>
</div>
<div class="row row-container">
	<div class="col-md-6">
		<table class="table table-hover table-bordered" style="width:100%; margin-top: 50px;">
			<thead class="table-secondary">
				<tr class="text-center">
					<th>No</th>
					<th>Jenis Project</th>
					<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
						<th>Action</th>
					<?php endif; ?>
				</tr>
			</thead>
			<?php foreach ($jenis as $listjenisproject) : ?>
				<tr>
					<td class="text-center">
						<?= $counter++ ?>
					</td>
					<td><?php echo $listjenisproject->jenis ?></td>
					<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
						<td class="text-center">
							<a href="<?php echo site_url('jproject/delete/' . $listjenisproject->jenis) ?>"><button class="btn btn-danger">Hapus</button></a>
						</td>
					<?php endif; ?>
				</tr>
			<?php endforeach;  ?>
		</table>
	</div>
	<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
		<div class=" col-md-6 my-auto">
			<div class="row">
				<div class="col text-center">
					<h4>Tambah Jenis Project</h4>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg">
					<form action="<?php echo site_url('jproject/add') ?>" method="post" class="form-inline justify-content-center">
						<div class="form-group">
							<input type="text" name="jenis" placeholder="Jenis Project" />
							<?php echo form_error('jenis') ?>
						</div>
						<input type="submit" name="btn" value="Save" class="save-button" />
					</form>
				</div>
			</div>
			<!-- <div class="row">
					<div class="col text-center"> -->

			<!-- </div>
				</div> -->
		<?php endif; ?>

		<!-- <table> -->
		<!-- <table style="margin: 8%;"> -->
		<!-- <tr> -->

		<!-- <td style="margin-left: 3px; width: 20%; padding:10px;"> -->
		<!-- <label for="jenis">Jenis Project</label> -->
		<!-- </td> -->
		<!-- <td style="margin-left: 3px; width: 30%; padding:10px;"> -->

		<!-- </td> -->
		<!-- </tr> -->
		<!-- <tr> -->
		<!-- <td style="margin-left: 3px; width: 30%; padding:10px;"></td> -->
		<!-- <td style="margin-left: 3px; width: 20%; padding:10px;"> -->

		<!-- </td> -->
		<!-- </tr> -->

		<!-- </table> -->

		</div>
</div>