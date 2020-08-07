<div class="row">
	<div class="col-md text-center page-title">
		<h2>Daftar Vendor</h2>
	</div>
</div>
<div class="row row-container">
	<div class="col-md-6">
		<table class="table table-hover table-bordered" style="width:100%; margin-top: 50px;">
			<thead class="table-secondary">
				<tr class="text-center">
					<th>No</th>
					<th>Nama Vendor</th>
					<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
						<th>Action</th>
					<?php endif; ?>
				</tr>
			</thead>
			<?php
			foreach ($vendor as $listvendor) : ?>
				<tr>
					<td class="text-center">
						<?= $counter++ ?>
					</td>
					<td><?php echo $listvendor->nama_vendor ?></td>
					<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
						<td class="text-center">
							<a href="<?php echo site_url('vendor/delete/' . $listvendor->nama_vendor); ?>">
								<button class="btn btn-danger">Hapus</button></a>
						</td>
					<?php endif; ?>
				</tr>
			<?php endforeach;  ?>
		</table>
	</div>
	<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
		<div class="col-md-6 my-auto">
			<div class="row">
				<div class="col text-center">
					<h4>Tambah Vendor</h4>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg">
					<form action="<?php echo site_url('vendor/add') ?>" method="post" class="form-inline justify-content-center">
						<div class="form-group">
							<input type="text" name="VENDOR" placeholder="Nama Vendor" />
							<?php echo form_error('VENDOR') ?>
						</div>
						<input type="submit" name="btn" value="Save" class="save-button" />
					</form>
				</div>
			</div>
		</div>
	<?php endif; ?>