<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view("admin/_partials/head.php") ?>
</head>

<body id="page-top">
	<?php $this->load->view("admin/_partials/navbar.php") ?>
<div id="wrapper">
    <div id="layoutSidenav">
		<?php $this->load->view("admin/_partials/sidebar.php") ?>
		<br>
		<div id="content-wrapper"  style="width: 100%;">
				<main>
			<div class="container-fluid">
					

				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>

				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				<div class="card mb-3">
					<div class="card-header">

						<a href="<?php echo site_url('admin/products/') ?>"><i class="fas fa-arrow-left"></i>
							Back</a>
					</div>
					<div class="card-body">

						<form action="" method="post" enctype="multipart/form-data">

							<input type="hidden" name="id_p" value="<?php echo $product->id_p?>" />

							<div class="form-group">
								<label for="nama">Name*</label>
								<input class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>"
								 type="text" name="nama" placeholder="Product name" value="<?php echo $product->nama ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('nama') ?>
								</div>
							</div>

							<div class="form-group">
								<label for="harga">Price</label>
								<input class="form-control <?php echo form_error('harga') ? 'is-invalid':'' ?>"
								 type="number" name="harga" min="0" placeholder="Product price" value="<?php echo $product->harga ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('harga') ?>
								</div>
							</div>


							<div class="form-group">
								<label for="gambar">Photo</label>
								<input class="form-control-file <?php echo form_error('gambar') ? 'is-invalid':'' ?>"
								 type="file" name="gambar" />
								<input type="hidden" name="old_image" value="<?php echo $product->gambar ?>" />
								<div class="invalid-feedback">
									<?php echo form_error('gambar') ?>
								</div>
							</div>


							<div class="form-group">
								<label for="deskripsi">Description*</label>
								<textarea class="form-control <?php echo form_error('deskripsi') ? 'is-invalid':'' ?>"
								 name="deskripsi" placeholder="Product description..."><?php echo $product->deskripsi ?> 
								</textarea>
								<div class="invalid-feedback">
									<?php echo form_error('deskripsi') ?>
								</div>
							</div>

							<input class="btn btn-success" type="submit" name="btn" value="Save" />
						</form>

					</div>
				</div>

					<div class="card-footer small text-muted">
						* required fields
					</div>
			
				<?php $this->load->view("admin/_partials/footer.php") ?>



		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>

</div></main></div>
		</div>

</body>

</html>