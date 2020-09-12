<br><br><br>      <br>  
    <div style="float: left;">
    <div class="container-half" style="margin-left: 10px;">
      <h2>  Laporan Gabungan - Pembayaran</h2>
        <?php if ($user['ROLE'] == 'IT FINANCE') : ?>
            <div style="float: left;">
            <form action="<?= base_url('laporan/laporan_pdf');?>" method="post">
                  <input type="hidden" name="keyword" value="<?= $keyword_ ?>" />
                  <input type="submit" name="submit" value="Print Laporan" class="btn btn-primary">
            </form>
            </div><div style="float: left; margin-left: 10px;">
            <form action="<?= base_url('laporan/exportAsExcel'); ?>" method="post" >
                  <input type="hidden" name="keyword" value="<?= $keyword_ ?>" />
                  <input type="submit" name="submit" value="Export as Excel" class="btn btn-success">
            </form>
            </div>
<!--                   <a href="<?= base_url('laporan/laporan_pdf'); ?>" style="margin-right: 5px;" class="btn btn-danger">Print Laporan</a>
                  <a href="<?= base_url('laporan/exportAsExcel'); ?>" class="btn btn-success">Save as Excel</a> -->
        <?php endif; ?>
    </div>
    <div class="container-half right" style="float: left; width: 48%;">
        <div class="form-group">
            <form method="post" action="<?= base_url("laporan/index") ?>" class="form-inline" style="float: right;">
                <input type="text" placeholder="Kata kunci" name="searchById" id="searchById" class="form-control" style="width: auto; " value='<?= $keyword_ ?>'/>
            <span class=" input-group-btn">
                <input type="submit" name="Search" class="btn btn-primary" value="Cari" />
            </form>
        </div>
    </div>
</div>
<div class="table-responsive">
      <table class="table table-striped table-hover table-bordered">
            <table class="table table-striped table-hover table-bordered">
                  <thead style="background-color: #204d95; color: white;">
                        <td colspan="5">RENCANA BISNIS BANK</td>
                        <td colspan="7">PERJANJIAN KERJASAMA</td>
                        <td colspan="4">PEMBAYARAN</td>
                  </thead>
                  <thead style="background-color:  #b5c8e1; color: black;">
                        <th>Kode RBB</th>
                        <th>Program Kerja</th>
                        <th>Anggaran</th>
                        <th>GL</th>
                        <th>Nama Rek</th>
<!--                         <th>Mutasi RBB</th>
                        <th>Sisa Anggaran</th> -->
                        <!-- PKS -->
                        <th>Nomor PKS</th>
                        <th>Jenis</th>
                        <th>Kode Project</th>
                        <th>Nama Project</th>
                        <th>tanggal PKS</th>
                        <th>Nominal PKS</th>
                        <th>Nama Vendor</th>
<!--                         <th>Mutasi PKS</th>
                        <th>Sisa Anggaran</th> -->
                        <!-- INVOICE -->
                        <th>Invoice</th>
                        <th>Tahap</th>
                        <th>Nominal</th>
                        <th>Tanggal Invoice</th>
                  </thead>
                  <!-- ++++++++++++++++++  RBB   ++++++++++++++++++ -->
                  <!-- <?php foreach ($table as $a) :
                        $n_colspan = 0;
                        foreach ($a['pks'] as $bb) :
                              if (!empty($bb['invs'])) {
                                    $n_colspan = count($bb['invs']) + $n_colspan;
                              } else {
                                    $n_colspan = 1 + $n_colspan;
                              }

                        endforeach;
                        // echo $n_colspan;
                  ?> -->
                       <!--  <tr>
                              <td rowspan="<?php if ($n_colspan != 0) {
                                                      echo $n_colspan;
                                                } else {
                                                      echo $n_colspan + 1;
                                                } ?>"><?php echo $a["KODE_RBB"] ?></td>
                              <td rowspan="<?php if ($n_colspan != 0) {
                                                      echo $n_colspan;
                                                } else {
                                                      echo $n_colspan + 1;
                                                } ?>"><?php echo $a["PROGRAM_KERJA"] ?></td>
                              <td rowspan="<?php if ($n_colspan != 0) {
                                                      echo $n_colspan;
                                                } else {
                                                      echo $n_colspan + 1;
                                                } ?>"><?php echo $a["ANGGARAN"] ?></td>
                              <td rowspan="<?php if ($n_colspan != 0) {
                                                      echo $n_colspan;
                                                } else {
                                                      echo $n_colspan + 1;
                                                } ?>"><?php echo $a["GL"] ?></td>
                              <td rowspan="<?php if ($n_colspan != 0) {
                                                      echo $n_colspan;
                                                } else {
                                                      echo $n_colspan + 1;
                                                } ?>"><?php echo $a["NAMA_REK"] ?></td> -->

                              <!-- +++++++++++++++++++++++ PKS +++++++++++++++++++++++++++++ -->
                              <!-- <?php
                              $Mutasi_rbb = 0;
                              $Sisa_rbb = $a["ANGGARAN"];
                              if (!empty($a['pks'])) {
                                    $x = 1;
                                    foreach ($a['pks'] as $b) :
                                          $n_data = count($b);
                                          $n_colspan = 0;
                                          if (!empty($b['invs'])) {
                                                $n_colspan = count($b["invs"]);
                                          }
                                          if ($x != 1 & $x < $n_data) {
                                                echo "</tr><tr>";
                                          }
                                          $Mutasi_rbb = $Mutasi_rbb + $b['NOMINAL_PKS'];
                                          $Sisa_rbb = $Sisa_rbb - $b['NOMINAL_PKS'];
                              ?>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $Mutasi_rbb; ?></td>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $Sisa_rbb; ?></td>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $b["NO_PKS"] ?></td>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $b["jenis"] ?></td>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $b["KODE_PROJECT"] ?></td>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $b["NAMA_PROJECT"] ?></td>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $b["TGL_PKS"] ?></td>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $b["NOMINAL_PKS"] ?></td>
                                          <td rowspan="<?php if ($n_colspan != 0) {
                                                                  echo $n_colspan;
                                                            } else {
                                                                  echo $n_colspan + 1;
                                                            } ?>"><?php echo $b["nama_vendor"] ?></td>

                                          <?PHP $x = $x + 1;
                                          $Mutasi_pks = 0;
                                          $Sisa_pks = $b["NOMINAL_PKS"];
                                          ?> -->
                                          <!-- ++++++++++++++++++++++++++++++ PEMBAYARAN +++++++++++++++++++++++++++++++= -->
                                         <!--  <?php
                                          if (!empty($b['invs'])) {
                                                $y = 1;
                                                foreach ($b['invs'] as $c) :
                                                      if ($y != 1) {
                                                            echo "<tr>";
                                                      }
                                                      $Mutasi_pks = $Mutasi_pks + $c['NOMINAL'];
                                                      $Sisa_pks = $Sisa_pks - $c["NOMINAL"];
                                          ?>

                                                      <td><?php echo $Mutasi_pks; ?></td>
                                                      <td><?php echo $Sisa_pks; ?></td>
                                                      <td><?php echo $c["INVOICE"] ?></td>
                                                      <td><?php echo $c["TERMIN"] ?></td>
                                                      <td><?php echo $c["NOMINAL"] ?></td>
                                                      <td><?php echo $c["TGL_INVOICE"] ?></td>
                        </tr>
            <?PHP $y = $y + 1;
                                                endforeach;
                                          } else {
                                                echo "<td>-</td><td>";
                                                echo $b['NOMINAL_PKS'];
                                                echo "</td><td>-</td><td>-</td><td>-</td><td>-</td>";
                                          } ?>
            </tr>
<?php
                                    endforeach;
                              } else {
                                    echo "<td>-</td><td>";
                                    echo $a["ANGGARAN"];
                                    echo "</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>";
                              } ?> -->
<!-- </tr>
<?php endforeach; ?>
</tr> -->


  <?php  foreach ($table as $table) :?>
                  <tr>
                        <td><?php echo $table["KODE_RBB"]?></td>
                        <td><?= $table["PROGRAM_KERJA"]?></td>
                        <td><?= $table["ANGGARAN"]?></td>
                        <td><?= $table["GL"]?></td>
                        <td><?= $table["NAMA_REK"]?></td>
                        <td><?= $table["NO_PKS"]?></td>
                        
                        <td><?= $table["JENIS"]?></td>
                        <td><?= $table["KODE_PROJECT"]?></td>
                        <td><?= $table["NAMA_PROJECT"]?></td>
                        <td><?= $table["TGL_PKS"]?></td>
                        <td><?= $table["NOMINAL_PKS"]?></td>
                        <td><?= $table["nama_vendor"]?></td>

                        <td><?= $table["INVOICE"]?></td>
                        <td><?= $table["TERMIN"]?></td>
                        <td><?= $table["NOMINAL"]?></td>
                        <td><?= $table["TGL_INVOICE"]?></td>

                  </tr>

                  <?php endforeach;?>
            </table></table>
</div>
</div>