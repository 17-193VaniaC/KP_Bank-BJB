<!DOCTYPE html>
<html lang="en">
<head>
<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script> -->
 <?php $this->load->view('admin/_partials/head.php')?> 
<link href="<?php echo base_url('css/styles.css') ?>" rel="stylesheet">

	<title>
		
	</title>
</head>

<body id=page-top>


	<?php $this->load->view("admin/_partials/navbar.php")?>
	<div id="wrapper" >

    <div id="layoutSidenav">


		<?php
		$this->load->view("admin/_partials/sidebar.php")
		?>

		<div class='content_wrapper'  style="width: 100%;">
<div id="layoutSidenav_content">
		<div class="container-fluid">
				<br>
				<?php  $this->load->view("admin/_partials/breadcrumb.php")?>
				<div class="card mb-3">
					<div class="card-header">
						<a href="<?php echo site_url('admin/products/add') ?>">Add+</a>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class = "table tablle-hover" id='dataTable' width="100%">
								<thead>
									<tr>
										<th>Nama</th>
										<th>Harga</th>
										<th>Foto</th>
										<th>Deskripsi</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($products as $product):?>
									<tr>
										<td width="150">
											<?php echo $product->nama ?>
											
										</td>
										<td>
											<?php echo $product->harga ?>
										</td>
										<td>
											<img src="<?php echo base_url('upload/product/'.$product->gambar) ?>" width="64" />
										</td>
										<td class="small">
											<?php  echo substr($product->deskripsi, 0, 120)?>...
										</td>
										<td width="250">
											<a href="<?php echo site_url('admin/products/edit/'.$product->id_p) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Edit</a>
<!-- 											<a onclick="deleteConfirm('<?php //echo site_url('admin/products/delete/'.$product->id_p) ?>')"
											 href="#!" class="btn btn-small text-danger"><i class="fas fa-trash"></i> Hapus</a> -->
											 <a href="<?php echo site_url('admin/products/delete/'.$product->id_p) ?>"
											 class="btn btn-small"><i class="fas fa-edit"></i> Delete</a>
										</td>

									</tr>
								<?php  endforeach; ?>
								</tbody>

							</table>
							
						</div>
						
					</div>
					
				</div>

			


</div>
		<?php $this->load->view("admin/_partials/footer.php") ?>				
		<?php $this->load->view("admin/_partials/scrolltop.php") ?>
		<?php $this->load->view("admin/_partials/modal.php") ?>
</div>

</div>
		</div>
</div>
		<?php $this->load->view("admin/_partials/js.php") ?>
<script type="text/javascript">
function deleteConfirm(url){
	$("#btn-delete").attr('href', url);
	$("#deleteModal").modal();
}
</script>
</body>
</html>