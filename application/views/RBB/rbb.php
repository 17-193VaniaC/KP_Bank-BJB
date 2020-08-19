<br><br><br>
	<div class="container-xl" style=":margin-top 50px;">
		<?php if ($this->session->flashdata('message')) { ?>
			<?php echo $this->session->flashdata('message') ?>
		<?php } ?>
			<div class="container-half">
			<h2>Rencana Bisnis Bank</h2>
			</div>
			<div class="container-half right">
				<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
					<a href="<?php echo site_url("rbb/add"); ?>">
						<button class="btn btn-success"> + Tambah RBB </button>
					</a>
				<?php endif; ?>
			</div>
		<div class="table-responsive">
			<div class="table-wrapper">
				<table class="table table-striped table-hover table-bordered">
					<thead style="background-color: #204d95; color: white;">
						<td>Kode RBB</td>
						<td>Program Kerja</td>
						<td>Anggaran</td>
						<td>GL</td>
						<td>Nama Rek</td>
						<td>Sisa Anggaran</td>
						<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
							<td class="table-option-row">Opsi</td>
						<?php endif; ?>
					</thead>
					<?php foreach ($rbb as $listrbb) : ?>
						<tr>
							<td ><?php echo $listrbb->KODE_RBB; ?></td>
							<td><?php echo $listrbb->PROGRAM_KERJA; ?></td>
							<td><?php echo $listrbb->ANGGARAN; ?></td>
							<td><?php echo $listrbb->GL; ?></td>
							<td><?php echo $listrbb->NAMA_REK; ?></td>
							<td><?php echo $listrbb->SISA_ANGGARAN; ?></td>
							<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
								<td class="table-option-row">
									<a href="<?php echo site_url('rbb/edit/' . $listrbb->KODE_RBB) ?>""><button class=" btn btn-info">Edit</button></a>
									<a href=" <?php echo site_url('rbb/delete/' . $listrbb->KODE_RBB) ?>""><button class=" btn btn-danger">Hapus</button></a>
								</td>
							<?php endif; ?>
						</tr>
					<?php endforeach;  ?>

				</table>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<!--Tampilkan pagination-->
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
</body>

</html>