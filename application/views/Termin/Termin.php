<!-- <body style="background: rgb(53,150,255);background: linear-gradient(299deg, rgba(53,150,255,1) 0%, rgba(119,182,250,1) 50%, rgba(255,221,118,1) 100%);"> -->
<div class="container-xl" style="margin-top: 50px;">
	<br><br>
	 <div class="container-half">
        <h2><a href="<?= base_url('termin/'); ?>" style="text-decoration: none; color: black;">Daftar <b>Termin</b></a></h2>
    </div>
    <?php
	if(!empty($this->session->flashdata('search_termin'))){
            empty($this->session->set_flashdata(array('search_termin'=>$search)));
    }
    ?>
    <div class="container-half right">
        <div class="form-group">
            <form method="post" action="<?= base_url() ?>termin/index/" class="form-inline" style="float: right;">
                <input type="text" placeholder="No. PKS Termin" name="searchById" id="searchById" class="form-control" value='<?= $search?>' style="width: auto; />
            <span class=" input-group-btn">
                <input type="submit" name="Search" class="btn btn-primary" value="Cari"/>
            </form>
        </div>
    </div>
	<br>
	<table class="table table-striped table-hover table-bordered">
		<thead style="background-color: #204d95; color: white;">
			<td style="width : 13%;">No. PKS</td>
			<td style="width : 8%;">No. Termin</td>
			<td style="width : 10%;">Nominal</td>
			<td style="width : 10%;">Tanggal Termin</td>
			<td style="width : 8%;">Status</td>
			<td style="width : 13%;">Kategori</td>
			<td style="width : 10%;">GL</td>
			<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
				<td style="width : 13%; text-align: center;">Opsi</td>
			<?php endif; ?>
		</thead>
		<?php foreach ($termin as $listtermin) : ?>
			<tr>
				<td><?php echo $listtermin->NO_PKS; ?></td>
				<td><?php echo $listtermin->TERMIN; ?></td>
				<td><?php echo $listtermin->NOMINAL; ?></td>
				<td><?php echo $listtermin->TGL_TERMIN; ?></td>
				<td><?php echo $listtermin->STATUS; ?></td>
				<td><?php echo $listtermin->KATEGORI; ?></td>
				<td><?php echo $listtermin->GL; ?></td>
				<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
					<td>
						<?php if ($listtermin->STATUS == 'UNPAID') :
							$pks_ = str_replace('/', '_', $listtermin->NO_PKS); ?>
							<a href="<?= site_url('Termin/edit/' . $listtermin->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-info">Edit</button></a>
							<a href="<?= site_url('Termin/delete/' . $listtermin->KODE_TERMIN . '/' . $pks_) ?>"><button class="btn btn-danger">Delete</button></a>
						<?php else :
							$pks_ = str_replace('/', '_', $listtermin->NO_PKS); ?>
							<a href="<?= site_url('Termin/edit/0/' . $pks_) ?>"><button class="btn btn-info">Edit</button></a>
							<a href="<?= site_url('Termin/delete/0/' . $pks_) ?>"><button class="btn btn-danger">Delete</button></a>
						<?php endif; ?>
					</td>
				<?php endif; ?>

			</tr>
		<?php endforeach;  ?>

	</table>
	<div class="row">
    <div class="col">
        <!--Tampilkan pagination-->
        <?php echo $pagination;?>
    </div>
</div>
	</body>

	</html>