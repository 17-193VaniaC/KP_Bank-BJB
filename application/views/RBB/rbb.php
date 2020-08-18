<!DOCTYPE html>
<html>

<head>
	<title><?= $title; ?></title>
</head>

<body><br>
	<div class="container-xl" style="margin-top: 50px;">
		<?php if ($this->session->flashdata('message')) { ?>
			<?php echo $this->session->flashdata('message') ?>
		<?php } ?>
		<h3>
			<div class="container-half">
				Rencana Bisnis Bank
			</div>
			<div class="container-half right">
				<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
					<a href="<?php echo site_url("rbb/add"); ?>">
						<button class="btn btn-primary"> + Tambah RBB </button>
					</a>
				<?php endif; ?>
			</div>

		</h3>

		<div class="table-responsive">
			<div class="table-wrapper">
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<th>Kode RBB</th>
						<th>Program Kerja</th>
						<th>Anggaran</th>
						<th>GL</th>
						<th>Nama Rek</th>
						<th>Sisa Anggaran</th>
						<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
							<th class="table-option-row">Opsi</th>
						<?php endif; ?>
					</thead>
					<?php foreach ($rbb as $listrbb) : ?>
						<tr>
							<td><a href="<?php echo site_url('') ?>"><?php echo $listrbb->KODE_RBB; ?></a></td>
							<td><?php echo $listrbb->PROGRAM_KERJA; ?></td>
							<td><?php echo $listrbb->ANGGARAN; ?></td>
							<td><?php echo $listrbb->GL; ?></td>
							<td><?php echo $listrbb->NAMA_REK; ?></td>
							<td><?php echo $listrbb->SISA_ANGGARAN; ?></td>
							<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
								<td class="table-option-row">
									<a href="<?php echo site_url('rbb/edit/' . $listrbb->KODE_RBB) ?>""><button class=" btn btn-success">Ubah</button></a>
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