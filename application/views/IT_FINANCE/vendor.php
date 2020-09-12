<br>
<div>
<div class="container-xl" style="margin-top: 50px;">
	<!-- <div class="container-xl" style="margin-top: 20px; min-height: 80vh"> -->
	<?php if ($this->session->flashdata('success')) { ?>
		<?php
		echo "<div class='alert alert-success'>";
		echo $this->session->flashdata('success');
		$this->session->set_flashdata('success', '');
		echo "</div>";
		?>
	<?php } ?>
	<?php if (!empty($this->session->flashdata('failed')) | !empty(form_error('nama_vendor'))) { ?>
		<?php
		echo "<div class='alert alert-danger'>";
		echo "<strong>Error</strong><br>";
		echo $this->session->flashdata('failed');
		echo form_error('nama_vendor');
		echo "</div>";
		?>
	<?php }
	if (!empty($this->session->flashdata('search_vendor'))) {
		empty($this->session->set_flashdata(array('search_vendor' => $search)));
	}
	?>

	<br>
	<div class="container-half">
		<h2><a href="<?= base_url('vendor/'); ?>" style="text-decoration: none; color: black;">Daftar <b>Vendor</b></a></h2>
		<p><?php if ($user['ROLE'] == 'IT FINANCE') : ?>
				<form action="<?php echo site_url('vendor/add') ?>" method="post" class="form-inline">
					<input type="text" name="nama_vendor" placeholder="Nama vendor baru" class="form-control" />
					<input type="submit" name="btn" value="+ Tambah Vendor" class="btn btn-success" />
				</form>
			<?php endif; ?></p>
	</div>
	<div class="container-half right">
		<div class="form-group">
			<form method="post" action="<?php echo site_url('vendor/daftar_vendor') ?>" class="form-inline" style="float: right;">
				<input type="text" placeholder="Cari vendor" name="searchById" id="searchById" class="form-control" style="width: auto; " value="<?= $search ?>">
				<input type="submit" name="Search" class="btn btn-primary" value="Cari" />
			</form>
		</div>
	</div>
	<!-- 
	<div class="container-half">
		<h2>Daftar Vendor</h2>
	</div>

	<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
		<div class="container-half right">
			<form action="<?php echo site_url('vendor/add') ?>" method="post" class="form-inline" style="float: right;">
				<input type="text" name="nama_vendor" placeholder="Nama Vendor Baru" class="form-control" />
				<input type="submit" name="btn" value="+ Tambah Vendor" class="btn btn-success" />
			</form>
		</div>
		<br><br>
	<?php endif; ?> -->


	<!-- ##############################################TABEL VENDOR######################################################## -->
	<div class="table-responsive">
		<div class="table-wrapper">
			<table class="table table-striped table-hover table-bordered">
				<thead style="background-color: #204d95; color: white;">
					<tr class="text-center">
						<td style="width: 5%;">No</td>
						<td style="width: 23%;">Nama Vendor</td>
						<!-- <td>Jumlah penggunaan</td> -->
						<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
							<td style="width: 10%;" class="table-option-row">Opsi</td>
						<?php endif; ?>
					</tr>
				</thead>
				<?php $counter++;
				foreach ($vendor as $listvendor) : ?>
					<tr>
						<td class="text-center">
							<?= $counter++ ?>
						</td>
						<td><?php echo $listvendor->nama_vendor ?></td>
						<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
							<td class="table-option-row">
								<button id="editbutton" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit" data-id="<?php echo $listvendor->KODE_VENDOR; ?>" data-vendor="<?php echo $listvendor->nama_vendor; ?>" data-status="<?php echo $listvendor->STATUS; ?>"> Edit</button>
								<a class="btn btn-danger" href="<?php echo site_url('vendor/delete/' . $listvendor->KODE_VENDOR); ?>" onclick="return confirm('Hapus data vendor?')">Hapus</a>
							</td>
						<?php endif; ?>
					</tr>
				<?php endforeach;  ?>

			</table>
		</div>
	</div>
	<!-- +++++++++++++++++++++++++++++++++++++++ Modal edit ++++++++++++++++++++++++++++++++++++++++++++-->
	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Edit Vendor</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="<?php echo site_url('vendor/edit') ?>" method="post">
					<div class="modal-body" id="modal-edit">
						<table style="margin: 8%;">
							<div class="notif-warning" id="notif-warning">
								<div class="alert-warning">
									<STRONG>Vendor ini sedang digunakan oleh data PKS</STRONG><br>
									Anda yakin ingin mengedit Vendor ini?
								</div>
							</div>
							<tr>
								<td style="margin-left: 3px; width: 20%; padding:10px;">
									Nama Vendor
								</td>
								<td style="margin-left: 3px; width: 30%; padding:10px;">
									<input type="hidden" name="KODE_VENDOR" id="kode_vendor" class="form-control" />
									<input type="text" name="nama_vendor" id="nama_vendor" class="form-control" />
								</td>
							</tr>
							<tr>
								<td style="margin-left: 3px; width: 30%; padding:10px;"></td>
							</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<input type="submit" name="btn" value="Edit" class="btn btn-primary" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php if ($pagination) : ?>
	<!-- <div class="row"> -->
			<!--Tampilkan pagination-->
			<?php echo $pagination; ?>
<?php endif; ?>
	</div></div></div>
<script src="<?php echo base_url() . 'assets/js/jquery-3.5.1.min.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
	$(document).on('click', '#editbutton', function() {
		var n_vendor = $(this).data('vendor');
		var kode_vendor = $(this).data('id');
		var penggunaan = $(this).data('status');

		$(".modal-body #nama_vendor").val(n_vendor);
		$(".modal-body #kode_vendor").val(kode_vendor);

		if (penggunaan > 0) {
			document.getElementById("notif-warning").style.display = "block";
		} else {
			document.getElementById("notif-warning").style.display = "none";
		}

	});
	$(document).ready(function() {
		$("#form_edit").on("submit", (function(e) {
			e.preventDevaullt();
			$.ajax({
				url: <?php site_url('vendor/edit/') ?> + n_vendor,
				type: post,
				data: {
					nama_vendor: nama_vendor,
					KODE_VENDOR: KODE_VENDOR
				},
				success: function(data) {
					alert("data berhasil diubah");
					$("#modalEdit").modal("hide");
					location.reload();
				}
			});
		}));
	});

	// $(document).on("click", "#deletebutton", function(){
	// 	var n_vendor = $(this).data(vendor2);
	// 	$("#modal_body_delete #nama_vendor").val(n_vendor);
	// });

	// $(document).ready(function(){
	// 	$("#form_hapus").on("submit", (function(e){
	// 		e.preventDevaullt();
	//     	$.ajax({
	//     		url: <?php site_url('vendor/delete/') ?> + n_vendor,
	//     		type: post,
	//     		data: {nama_vendor:nama_vendor},
	//     		success: function(data){
	//     			alert("data berhasil dihapus");
	//     			$("#modalEdit").modal("hide");
	//     			location.reload();
	//     		}
	// 		});
	// 	}));
	// });
</script>