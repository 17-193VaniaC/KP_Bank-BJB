<div class="container-xl" style="margin-top: 20px;">
		<?php if($this->session->flashdata('success')){?>
		<?php 
		echo "<div class='alert alert-success'>";
		echo $this->session->flashdata('success');
		$this->session->set_flashdata('success', '');
		echo "</div>";
		 ?>
		<?php }?>
		<?php if(!empty($this->session->flashdata('failed')) | !empty(form_error('nama_vendor'))){?>
		<?php 
			echo "<div class='alert alert-danger'>";
			echo "<strong>Gagal menambahkan data</strong><br>";
			echo $this->session->flashdata('failed');
			echo form_error('nama_vendor');
			echo "</div>";
		?>
		<?php }?>
		
	
	<div class="container-half">
		<h3>Daftar Vendor</h3>
	</div>
	<div class="container-half right">
			<form action="<?php echo site_url('vendor/add') ?>" method="post" class="form-inline justify-content-center">
				<input type="text" name="nama_vendor" placeholder="Nama Vendor" class="form-control"/><br>
				<input type="submit" name="btn" value="Tambah vendor" class="btn btn-primary" />
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
			foreach ($vendor as $listvendor) : ?>
				<tr>
					<td class="text-center">
						<?= $counter++ ?>
					</td>
					<td><?php echo $listvendor->nama_vendor ?></td>
					<td><?php echo $listvendor->STATUS ?></td>
					<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
						<td class="text-center">
							<button id="editbutton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit" data-id="<?php echo $listvendor->KODE_VENDOR;?>" data-vendor="<?php echo $listvendor->nama_vendor;?>"> Edit</button>
						</a>
							<!-- <button id="deletebutton" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" data-vendor2="<?php echo $listvendor->nama_vendor;?>">Hapus</button> -->

							<!-- <a href="<?php echo site_url('vendor/delete/' . $listvendor->nama_vendor); ?>">  -->
							<a class="btn btn-danger" href="<?php echo site_url('vendor/delete/' . $listvendor->KODE_VENDOR); ?>" onclick="return confirm('Are you sure?')">Hapus</a>

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
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form action="<?php site_url('rbb'); ?>" method="post" >
      <div class="modal-body" id="modal-edit">
      	<table style="margin: 8%;">
					<tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
						Nama Vendor
						</td>
						<td style="margin-left: 3px; width: 30%; padding:10px;">
						<input type="hidden" name="KODE_VENDOR" id="kode_vendor" class="form-control"/>
						<input type="text" name="nama_vendor" id="nama_vendor" class="form-control" />
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
   		var n_vendor = $(this).data('vendor');
   		var kode_vendor = $(this).data('id');
   		$(".modal-body #nama_vendor").val(n_vendor);
   		$(".modal-body #kode_vendor").val(kode_vendor);
    	});

    // $(document).ready(function(){
    // 	$("#form_edit").on("submit", (function(e){
    // 		e.preventDevaullt();
	   //     	$.ajax({
	   //     		url: <?php site_url('vendor/edit/')?> + n_vendor,
	   //     		type: post,
	   //     		data: {nama_vendor:nama_vendor, KODE_VENDOR: KODE_VENDOR},
	   //     		success: function(data){
	   //     			alert("data berhasil diubah");
	   //     			$("#modalEdit").modal("hide");
	   //     			location.reload();
	   //     		}
    // 		});
    // 	}));
   	// });

   	// $(document).on("click", "#deletebutton", function(){
   	// 	var n_vendor = $(this).data(vendor2);
   	// 	$("#modal_body_delete #nama_vendor").val(n_vendor);
   	// });

   	// $(document).ready(function(){
    // 	$("#form_hapus").on("submit", (function(e){
    // 		e.preventDevaullt();
	   //     	$.ajax({
	   //     		url: <?php site_url('vendor/delete/')?> + n_vendor,
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