<div >
    <br><br>
<H3 style="text-align: center;"><a href="<?php site_url("Laporan");?>" style="text-decoration: none;">Laporan Gabungan</a></H3>
 <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered">
                <table class="table table-striped table-hover table-bordered">
                <thead>
                    <th colspan="6">RENCANA BISNIS BANK</th>
                    <th colspan="9"">PERJANJIAN KERJASAMA</th>
                    <th colspan="5">PEMBAYARAN</th>
                </thead>
                <thead>
                        <th>Kode RBB</th>
                        <th>Program Kerja</th>
                        <th>Anggaran</th>
                        <th>GL</th>
                        <th>Nama Rek</th>
                        <th>Sisa Anggaran</th>
                <!-- PKS -->
                        <th>Nomor PKS</th>
                        <th>Kode RBB</th>
                        <th>Jenis</th>
                        <th>Kode Project</th>
                        <th>Nama Project</th>
                        <th>tanggal PKS</th>
                        <th>Nominal PKS</th>
                        <th>Sisa Anggaran</th>
                        <th>Nama Vendor</th>
                <!-- INVOICE -->
                        <th>Invoice</th>
                        <th>No. PKS</th>
                        <th>Tanggal invoice</th>
                        <th>Tahap</th>
                        <th>Nominal bayar</th>
                    </thead>
                    <?php foreach ($res as $a):?>
                        <tr>
                        <td><?php echo $a->KODE_RBB?></td>
                        <td><?php echo $a->PROGRAN_KERJA?></td>
                        <td><?php echo $a->ANGGARAB?></td>
                        <td><?php echo $a->GL?></td>
                        <td><?php echo $a->NAMA_REK?></td>
                        <td><?php echo $a->SISA_ANGGARAN?></td>
                        <?php if( isset($a[0])){
                          foreach ($a->PKS as $b):
                            echo "<td>";
                            echo $b->KODE_PKS;
                            echo "</td><td>";
                            echo $b->JENIS;
                            echo "</td>";
                          endforeach;
                          }?>
                      <?php endforeach; ?>




                        </tr>
                      </table>
                    </table>
                </div></div>