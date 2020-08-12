<div class="container-xl" style="margin-top: 20px;">
		<?php if($this->session->flashdata('success')){?>
		<?php 
		echo "<div class='alert alert-success'>";
		echo $this->session->flashdata('success');
		$this->session->set_flashdata('success', '');
		echo "</div>";
		 ?>
		<?php }?>
		<?php if(!empty($this->session->flashdata('failed')) | !empty(form_error('jenis')) ){?>
		<?php 
			echo "<div class='alert alert-danger'>";
			echo "<strong>Error</strong><br>";
			echo $this->session->flashdata('failed');
			echo form_error('jenis');
			echo "</div>";
		?>
		<?php }?>
		
	
	<div class="container-half">
		<h3>Daftar Vendor</h3>
	</div>
	<div class="container-half right">
			<form action="<?php echo site_url('JProject/add') ?>" method="post" class="form-inline justify-content-center">
				<input type="text" name="jenis" placeholder="Jenis Project" class="form-control"/><br>
				<input type="submit" name="btn" value="Tambah Jenis Project" class="btn btn-primary" />
			</form>

	<!-- <small class="text-danger" style="text-align: center;"><?php echo form_error('nama_vendor');?></small> -->
	</div>
	<br><br>


<!-- ##############################################TABEL VENDOR######################################################## -->
<div class="table-responsive">
    <div class="table-wrapper">
	<table class="table table-striped table-hover table-bordered">
			<thead class="">
				<tr class="text-center">
					<th>No</th>
					<th>Nama Vendor</th>
					<th>Jumlah penggunaan</th>

					<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
						<th class="table-option-row">Opsi</th>
					<?php endif; ?>
				</tr>
			</thead><?php $counter = 1;?>
			<?php
			foreach ($jenis as $listjenis) : ?>
				<tr>
					<td class="text-center">
						<?= $counter++ ?>
					</td>
					<td><?php echo $listjenis->jenis ?></td>
					<td><?php echo $listjenis->STATUS ?></td>

					<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
						<td class="text-center">
							<button id="editbutton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit" data-id="<?php echo $listjenis->KODE_JENISPROJECT;?>" data-jenis="<?php echo $listjenis->jenis;?>" data-status="<?php echo $listjenis->STATUS;?>"> Edit</button>
						</a>
							<!-- <button id="deletebutton" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" data-vendor2="<?php echo $listvendor->nama_vendor;?>">Hapus</button> -->

							<!-- <a href="<?php echo site_url('vendor/delete/' . $listvendor->nama_vendor); ?>">  -->
							<a class="btn btn-danger" href="<?php echo site_url('JProject/delete/' . $listjenis->KODE_JENISPROJECT); ?>" onclick="return confirm('Are you sure?')">Hapus</a>

							<!-- <button class="btn btn-danger" onclick="comfirm('are you sure?')" >Hapus</button> -->
						<!-- </a> -->
						</td>
					<?php endif; ?>
				</tr>
			<?php endforeach;  ?>

		</table>
	</div></div>


<!-- +++++++++++++++++++++++++++++++++++++++ Modal edit ++++++++++++++++++++++++++++++++++++++++++++-->
<div class="modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Jenis Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form action="" method="post" >
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
						<input type="hidden" name="KODE_JENISPROJECT" id="KODE_JENISPROJECT" class="form-control"/>
						<input type="text" name="jenis" id="jenis" class="form-control" />
						</td>
					</tr>
					<tr><td style="margin-left: 3px; width: 30%; padding:10px;"></td>			
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


<!--+++++++++++++++++++++++++++++++++++++++++++++++++++ Modal hapus ++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- <div class="modal" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Hapus Vendor </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form  method="post" id="form_hapus">
      <div class="modal-body" id="modal_body_delete">
      	<table style="margin: 10%;">
					<tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
							<label for="nama_vendor">Hapus Vendor</label>
						</td>
						<td style="margin-left: 3px; width: 30%; padding:10px;">
							<input type="text" name="nama_vendor" id="nama_vendor" class="form-controll" />
							?
						</td>
					</tr>
					<tr><td style="margin-left: 3px; width: 30%; padding:10px;"></td>
					</tr>
				</table>
		    </div>
	    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a href="<?php echo site_url('vendor/delete/' . $listvendor->nama_vendor); ?>">
		<button class="btn btn-danger">Hapus</button></a> -->
       <!--  <a href="<?php echo site_url('vendor/edit/' . $listvendor->nama_vendor) ?>""><button class="btn btn-success">Ubah</button></a> -->
      </div>
  </form>
    </div>
  </div>
</div>

<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
</div>
</div>
<?php endif; ?>
</div>



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script>
   	$(document).on('click', '#editbutton', function(){
   		var n_jenis = $(this).data('jenis');
   		var kode_jenis = $(this).data('id');
   		var penggunaan = $(this).data('status');

   		$(".modal-body #jenis").val(n_jenis);
   		$(".modal-body #KODE_JENISPROJECT").val(kode_jenis);

   		if(penggunaan > 0){
   			document.getElementById("notif-warning").style.display = "block";
   		}
   		else{
   			document.getElementById("notif-warning").style.display = "none";
   		}
    	});


</script>