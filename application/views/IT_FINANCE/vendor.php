<div class="container-xl" style="margin-top: 20px;">
		<?php if($this->session->flashdata('success')){?>
		<?php 
		echo "<div class='alert alert-success'>";
		echo $this->session->flashdata('success');
		echo "</div>";
		 ?>
		<?php }?>
		<?php if($this->session->flashdata('failed')){?>
		<?php 
			echo "<div class='alert alert-danger'>";
			echo "<strong>Gagal</strong>";
			echo form_error('nama_vendor');
			echo "</div>";
		?>
		<?php }?>

	<h3>
		<div class="container-half">
			Daftar Vendor
		</div>
	</h3>
	<div class="container-half right">
		<div class="row mt-3">
		<div class="col-lg">  
			<form action="<?php echo site_url('vendor/add') ?>" method="post" class="form-inline justify-content-center">
				<div class="form-group">
				<input type="text" name="nama vendor" placeholder="Nama Vendor" class="form-control"/>
				<input type="submit" name="btn" value="Tambah vendor" class="btn btn-primary" />
				</div>
			</form>
		</div>
		</div>
	</div>
	<br><br>
<div class="table-responsive">
    <div class="table-wrapper">
	<table class="table table-striped table-hover table-bordered">
			<thead class="">
				<tr class="text-center">
					<th>No</th>
					<th>Nama Vendor</th>
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
					<?php if ($user['ROLE'] == 'IT FINANCE') : ?>
						<td class="text-center">
							<button id="editbutton" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit" data-vendor="<?php echo $listvendor->nama_vendor;?>">Edit</button>
						</a>
							<button id="deletebutton" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete" data-vendor2="<?php echo $listvendor->nama_vendor;?>">Hapus</button>

							<!-- <a href="<?php echo site_url('vendor/delete/' . $listvendor->nama_vendor); ?>"> -->
							<!-- <button class="btn btn-danger">Hapus</button></a> -->
						</td>
					<?php endif; ?>
				</tr>
			<?php endforeach;  ?>

		</table>
	</div></div>


<!-- Modal edit -->
<div class="modal" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Vendor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
		<form action="" method="post" id="form_edit">
      <div class="modal-body" id="modal-edit">
      	<table style="margin: 8%;">
					<tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
							<label for="nama_vendor">Nama Vendor</label>
						</td>
						<td style="margin-left: 3px; width: 30%; padding:10px;">
						<input type="hidden" name="nama_vendor_1" id="nama_vendor_1" value="nama_vendor_1"/>
						<input type="text" name="nama_vendor" id="nama_vendor" class="form-controll" />
						<?php echo form_error('nama_vendor') ?>
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


<!-- Modal hapus -->
<div class="modal" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
      	<table style="margin: 8%;">
					<tr>
						<td style="margin-left: 3px; width: 20%; padding:10px;">
							<label for="nama_vendor">Hapus Vendor</label>
						</td>
						<td style="margin-left: 3px; width: 30%; padding:10px;">
							<input type="text" name="nama_vendor" id="nama_vendor" class="form-controll" />
							<?php echo form_error('nama_vendor') ?>
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
		<button class="btn btn-danger">Hapus</button></a>
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
   		// var n_vendor = $(nama_vendor).val();
   		$(".modal-body #nama_vendor").val(n_vendor);
   		$(".modal-body #nama_vendor_1").val(n_vendor);
    	});

    $(document).ready(function(){
    	$("#form_edit").on("submit", (function(e){
    		e.preventDevaullt();
	       	$.ajax({
	       		url: <?php site_url('vendor/edit/')?> + n_vendor,
	       		type: post,
	       		data: {nama_vendor:nama_vendor},
	       		success: function(data){
	       			alert("data berhasil diubah");
	       			$("#modalEdit").modal("hide");
	       			location.reload();
	       		}
    		});
    	}));
   	});

   	$(document).on("click", "#deletebutton", function(){
   		var n_vendor = $(this).data(vendor2);
   		$("#modal_body_delete #nama_vendor").val(n_vendor);
   	});

   	$(document).ready(function(){
    	$("#form_hapus").on("submit", (function(e){
    		e.preventDevaullt();
	       	$.ajax({
	       		url: <?php site_url('vendor/delete/')?> + n_vendor,
	       		type: post,
	       		data: {nama_vendor:nama_vendor},
	       		success: function(data){
	       			alert("data berhasil dihapus");
	       			$("#modalEdit").modal("hide");
	       			location.reload();
	       		}
    		});
    	}));
   	});

</script>