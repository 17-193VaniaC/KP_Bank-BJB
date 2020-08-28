<div class="container-xl" style=":margin-top 50px;">
<br><br><br><br>	
	<?php if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        ?>
    <?php } 
    if(!empty($this->session->flashdata('search_rbb'))){
            empty($this->session->set_flashdata(array('search_rbb'=>$search)));
     }?>

    <div class="container-half">
	<h2><a href="<?= base_url('rbb/'); ?>" style="text-decoration: none; color: black;">Daftar <b>RBB</b></a></h2>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
            <p> <a href="<?= base_url('rbb/add'); ?>" class="btn btn-success">+ Tambah RBB</a></p>
        <?php endif; ?>
    </div>
    <div class="container-half right">
        <div class="form-group">
            <form method="post" action="<?= base_url() ?>rbb/index/" class="form-inline" style="float: right;">
                <input type="text" placeholder="Kode RBB" value='<?= $search ?>' name="searchById" id="searchById" class="form-control" style="width: auto; />
            <span class=" input-group-btn">
                <input type="submit" name="Search" class="btn btn-primary" value="Cari" />
            </form>
        </div>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
        <div class="form-group" style="float: right; background-color: white; margin-top: 10px;">
        	<b>Import Data </b>
				Pilih file untuk upload data:<br>
           <form action="<?= base_url('Import/rbb'); ?>" method="post" enctype="multipart/form-data">
				<input type="file" name="upload_file" id="file"  style="float: left;  width: 210px; height: 40px; margin: 3px;" required/>
				<button type="submit" value="Upload" name="submit" class="btn btn-primary" style="float: left;">Upload</button>
			</form>
        </div>
        <?php endif; ?>

    </div>

		<div class="table-responsive">
			<div class="table-wrapper">
				<table class="table table-striped table-hover table-bordered">
					<thead style="background-color: #204d95; color: white;">
						<td style="width : 10%;">Kode RBB</td>
						<td style="width : 15%;">Program Kerja</td>
						<td style="width : 8%;">Anggaran</td>
						<td style="width : 8%;">GL</td>
						<td style="width : 12%;">Nama Rek</td>
						<td style="width : 8%;">Sisa Anggaran</td>
						<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
							<td style="width : 10%;" class="table-option-row">Opsi</td>
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
   <?php if ($pagination) : ?>
        <div class="row">
            <div class="col">
                <!--Tampilkan pagination-->
                <?php echo $pagination; ?>
            </div>
        </div>
    <?php endif; ?>
	</div>
</body>

</html>