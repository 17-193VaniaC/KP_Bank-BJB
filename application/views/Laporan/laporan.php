<div >
      <br><br>
<H2 style="text-align: center;">Laporan Gabungan</H2>
<div class="table-responsive">
      <table class="table table-striped table-hover table-bordered">
            <table class="table table-striped table-hover table-bordered">
            <thead>
                  <th colspan="7" >RENCANA BISNIS BANK</th>
                  <th colspan="9">PERJANJIAN KERJASAMA</th>
                  <th colspan="4">PEMBAYARAN</th>
            </thead>
            <thead>
                  <th>Kode RBB</th>
                  <th>Program Kerja</th>
                  <th>Anggaran</th>
                  <th>GL</th>
                  <th>Nama Rek</th>
                  <th>Mutasi RBB</th>
                  <th>Sisa Anggaran</th>
          <!-- PKS -->
                  <th>Nomor PKS</th>
                  <th>Jenis</th>
                  <th>Kode Project</th>
                  <th>Nama Project</th>
                  <th>tanggal PKS</th>
                  <th>Nominal PKS</th>
                  <th>Mutasi PKS</th>
                  <th>Sisa Anggaran</th>
                  <th>Nama Vendor</th>
          <!-- INVOICE -->
                  <th>Invoice</th>
                  <th>Tahap</th>
                  <th>Nominal</th>
                  <th>Tanggal Invoice</th>
            </thead>
<!-- ++++++++++++++++++  RBB   ++++++++++++++++++ -->
            <?php foreach ($table as $a):
                  $n_colspan = 0;
                  foreach ($a['pks'] as $bb):
                        if(!empty($bb['invs'])){
                              $n_colspan = count($bb['invs']) + $n_colspan;
                        }
                        else{
                              $n_colspan = 1 + $n_colspan;
                        }

                  endforeach;
                  // echo $n_colspan;
            ?>
                  <tr>
                  <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
                  else{echo $n_colspan+1;}?>"><?php echo $a["KODE_RBB"]?></td>
                  <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
                  else{echo $n_colspan+1;}?>"><?php echo $a["PROGRAM_KERJA"]?></td>
                  <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
                  else{echo $n_colspan+1;}?>"><?php echo $a["ANGGARAN"]?></td>
                  <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
                  else{echo $n_colspan+1;}?>"><?php echo $a["GL"]?></td>
                  <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
                  else{echo $n_colspan+1;}?>"><?php echo $a["NAMA_REK"]?></td>
                  <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
                  else{echo $n_colspan+1;}?>"><?php echo $a['Mutasi']?></td>
                  <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
                  else{echo $n_colspan+1;}?>"><?php echo $a["SISA_ANGGARAN"]?></td>
 <!-- +++++++++++++++++++++++ PKS +++++++++++++++++++++++++++++ -->
                  <?php 
			                        if(!empty($a['pks'])){
			                              $x=1;
			                              foreach ($a['pks'] as $b):
			                                 $n_data = count($b);
                                                   $n_colspan=0;
			                              if(!empty($b['invs'])){
  	         		                              $n_colspan = count($b["invs"]);
      			                        }	                        
			                              if($x!=1 & $x<$n_data){
      			                              echo "</tr><tr>";
      			                        }
			                        ?>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b["NO_PKS"]?> <?php echo $n_colspan?></td>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b["jenis"]?></td>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b["KODE_PROJECT"]?></td>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b["NAMA_PROJECT"]?></td>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b["TGL_PKS"]?></td>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b["NOMINAL_PKS"]?></td>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b['Mutasi']?></td>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b["SISA_ANGGARAN"]?></td>
			                        <td rowspan="<?php if($n_colspan!=0){echo $n_colspan;}
			                        else{echo $n_colspan+1;}?>"><?php echo $b["nama_vendor"]?></td>
			                        <?PHP $x=$x+1;?>
			<!-- ++++++++++++++++++++++++++++++ PEMBAYARAN +++++++++++++++++++++++++++++++= -->
							                        <?php 
							                        if(!empty($b['invs'])){
							                              $y=1;
							                              foreach ($b['invs'] as $c):
							                                    if($y!=1){
							                                        echo "<tr>";
							                                    }?>
							                                    <td ><?php echo $c["INVOICE"]?></td>
							                                    <td ><?php echo $c["TERMIN"]?></td>  
							                                    <td ><?php echo $c["NOMINAL"]?></td>
							                                    <td ><?php echo $c["TGL_INVOICE"]?></td>
							                                  </tr>
							                                    <?PHP $y=$y+1;
							                              endforeach;
							                        }
							                        else{
							                              echo "<td>-</td><td>-</td><td>-</td><td>-</td>";
							                        }?>
							                        </tr>
							                  <?php
							                        endforeach;
			                  }
                  else{
                        echo "<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>";

                  }?>
                  </tr>
                  <?php endforeach; ?>
            </tr>
      </table>
</div></div>