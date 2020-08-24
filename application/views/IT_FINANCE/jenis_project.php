<br>	<div class="container-xl" style="margin-top: 50px;">
<!-- <div class="container-xl" style="margin-top: 20px; min-height: 80vh"> -->
	<?php if ($this->session->flashdata('success')) { ?>
		<?php
		echo "<div class='alert alert-success'>";
		echo $this->session->flashdata('success');
		$this->session->set_flashdata('success', '');
		echo "</div>";
		?>
	<?php } ?>
	<?php if (!empty($this->session->flashdata('failed')) | !empty(form_error('jenis'))) { ?>
		<?php
		echo "<div class='alert alert-danger'>";
		echo "<strong>Error</strong><br>";
		echo $this->session->flashdata('failed');
		echo form_error('jenis');
		echo "</div>";
		?>
	<?php } ?>

<br>
	 <div class="container-half">
        <h2><a href="<?= base_url('jproject/'); ?>" style="text-decoration: none; color: black;">Daftar <b>Jenis Project</b></a></h2>
        <p><?php if ($user['ROLE'] == 'IT FINANCE') : ?>
			<form action="<?php echo site_url('jproject/add') ?>" method="post" class="form-inline" >
				<input type="text" name="jenis" placeholder="Masukan nama jenis project baru" class="form-control" />
				<input type="submit" name="btn" value="+ Tambah Jenis Project" class="btn btn-success" />
			</form>
		<?php endif; ?></p>
    </div>
    <div class="container-half right">
        <div class="form-group">
            <form method="get" class="form-inline" style="float: right;">
                <input type="text" placeholder="Cari jenis project" name="searchById" id="searchById" class="form-control" style="width: auto; />
            	<span class=" input-group-btn">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>
    </div>


	<!-- ##############################################TABEL JENIS######################################################## -->
	<div class="table-responsive">
		<div class="table-wrapper">
			<table class="table table-striped table-hover table-bordered">
				<thead style="background-color: #204d95; color: white;">
					<tr class="text-center">
						<td>No</td>
						<td>Jenis Project</td>
						<!-- <td>Jumlah penggunaan</td> -->
						<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
							<td class="table-option-row">Opsi</td>
						<?php endif; ?>
					</tr>
				</thead><?php $counter = 1; ?>
				<?php
				foreach ($jenis as $listjenis) : ?>
					<tr>
						<td class="text-center">
							<?= $counter++ ?>
						</td>
						<td><?php echo $listjenis->jenis; ?></td>
						<!-- <td><?php echo $listjenis->STATUS; ?></td> -->
						<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
							<td class="table-option-row">
								<button id="editbutton" type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEdit" data-id="<?php echo $listjenis->KODE_JENISPROJECT; ?>" data-jenis="<?php echo $listjenis->jenis; ?>" data-status="<?php echo $listjenis->STATUS; ?>"> Edit</button>
								<a class="btn btn-danger" href="<?php echo site_url('jproject/delete/' . $listjenis->KODE_JENISPROJECT); ?>" onclick="return confirm('Hapus data jenis project?')">Hapus</a>
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
				<form action="" method="post">
					<div class="modal-body" id="modal-edit">
						<table style="margin: 8%;">
							<div class="notif-warning" id="notif-warning">
								<div class="alert-warning">
									<STRONG>Jenis Project ini sedang digunakan oleh data PKS</STRONG><br>
									Anda yakin ingin mengedit Jenis Project ini?
								</div>
							</div>
							<tr>
								<td style="margin-left: 3px; width: 20%; padding:10px;">
									Jenis Project
								</td>
								<td style="margin-left: 3px; width: 30%; padding:10px;">
									<input type="hidden" name="KODE_JENISPROJECT" id="kode_jenis" class="form-control" />
									<input type="text" name="jenis" id="nama_jenis" class="form-control" />
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
				</form>
			</div>

		</div>
				
	</div>
</div>

<script src="<?php echo base_url() . 'assets/js/jquery-3.5.1.min.js' ?>" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/js/jquery-ui.js' ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
	$(document).on('click', '#editbutton', function() {
		var n_jenis = $(this).data('jenis');
		var kode_jenis = $(this).data('id');
		var penggunaan = $(this).data('status');

		$(".modal-body #nama_jenis").val(n_jenis);
		$(".modal-body #kode_jenis").val(kode_jenis);

		if (penggunaan > 0) {
			document.getElementById("notif-warning").style.display = "block";
		} else {
			document.getElementById("notif-warning").style.display = "none";
		}

	});
</script>
<?php if ($pagination) : ?>
        <div class="row">
            <div class="col">
                <!--Tampilkan pagination-->
                <?php echo $pagination; ?>
            </div>
        </div>
    <?php endif; ?>