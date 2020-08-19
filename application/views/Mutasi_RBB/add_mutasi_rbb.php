<div class="col h-100" style="background-color: #e3e4e6;">
	<div class="container" style="min-height: 100%;">
		<div class="row justify-content-center" style="margin-top: 100px;">
			<div class="col-lg-9">
				<!-- FLASH MESSAGE -->
				<?php if ($this->session->flashdata('success')) { ?>
					<?php
					echo "<div class='alert alert-success'>";
					echo $this->session->flashdata('success');
					echo "</div>";
					?>
				<?php } ?>
				<?php if ($this->session->flashdata('failed')) { ?>
					<?php
					echo $this->session->flashdata('failed');
					echo "<strong>Gagal</strong>";
					echo "</div>";
					?>
				<?php } ?>
				<!-- END FLASH MESSAGE -->
				<div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #fff;">
					<div class="card-body pb-20">
						<div class="row justify-content-center" style="margin-top: 20px;">
							<div class="col-lg">
								<div class="text-center">
									<h2>Penyesuaian RBB</h2>
								</div>
								<form action="<?php echo site_url('mutasi_rbb/Penyesuaian_RBB') ?>" method="post">
									<table style="margin-top: 20px; width: 100%">
										<tr>
											<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
												<label for="KODE_RBB">Kode RBB</label>
											</td>
											<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
												<input type="text" class="form-control form-control-user" name="KODE_RBB" placeholder="Kode RBB" />
												<small class="text-danger"><?php echo form_error('KODE_RBB') ?></small>
											</td>

										</tr>
										<tr>
											<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
												<label for="NOMINAL">Nominal Penyesuaian RBB</label>
											</td>
											<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
												<input type="number" class="form-control form-control-user" name="NOMINAL" placeholder="Nominal Anggaran" />
												<small class="text-danger"><?php echo form_error('NOMINAL') ?></small>
											</td>
										</tr>
										<tr>
											<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
												<label for="KETERANGAN">Keterangan</label>
											</td>
											<td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
												<input type="text" class="form-control form-control-user" name="KETERANGAN" placeholder="Keterangan" />
												<small class="text-danger"><?php echo form_error('KETERANGAN') ?></small>
											</td>
										</tr>
									</table>
									<div class="row mx-1" style="float:right; margin-top : 3%;">
										<div class="col">
											<button value="save" type="submit" class="btn btn-success">
												Simpan
											</button>
										</div>
										<div class="col">
											<a href="<?php echo site_url("rbb"); ?>" s class="btn btn-secondary">
												Batal
											</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>