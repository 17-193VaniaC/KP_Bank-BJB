<div class="row" style="background-color: #e3e4e6; min-height: 92vh;">
	<div class="col">
		<div class="container">
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
										<h2>Edit RBB</h2>
									</div>
									<form action="" method="post">
										<table style="margin-top: 20px; width: 100%">
											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="PROGRAM_KERJA">Program Kerja</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
													<input type="hidden" name="KODE_RBB" value="<?php echo $rbb->KODE_RBB ?>">
													<input type="text" name="PROGRAM_KERJA" placeholder="Program Kerja" class="form-control" value="<?php echo $rbb->PROGRAM_KERJA ?>" />
													<small class="text-danger"><?php echo form_error('PROGRAM_KERJA') ?></small>
												</td>

											</tr>
											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="GL">GL</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 80%; padding-top:20px; padding-right: 20px">
													<select class="form-control form-control-user" name="GL" value="<?php echo $rbb->GL ?>">
														<?php foreach ($gl as $row) : ?>
															<option value="<?= $row->KODE_GL ?>"><?php echo $row->KODE_GL;
																									echo " | ";
																									echo $row->NAMA_GL; ?></option>
														<?php endforeach; ?>
													</select>
													<small class="text-danger"><?php echo form_error('GL') ?></small>
												</td>
											</tr>
											<tr>
												<td class="text-right" style="margin-left: 3px; width: 20%; padding-top:20px; padding-right: 20px">
													<label for="NAMA_REKE">Nama Rekening</label>
												</td>
												<td class="text-left" style="margin-left: 3px; width: 30%; padding-top:20px; padding-right: 20px">
													<input type="text" name="NAMA_REK" placeholder="NAMA_REK" value="<?php echo $rbb->NAMA_REK ?>" class="form-control" />
													<small class="text-danger"><?php echo form_error('NAMA_REK') ?></small>
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
</div>