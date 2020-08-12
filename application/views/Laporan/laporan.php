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
                        <th >Kode RBB</th>
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
                <tbody>
            <?php foreach ($RBB as $a) : ?>
                   <tr>

                       <td><?php echo $a->KODE_RBB?></td>
                       <td>2</td>
                       <td>3</td>
                       <td>4</td>
                       <td>5</td>
                       <td>6</td>
            <?php foreach ($PKS as $b) : ?>
                       <td><?php $b->NO_PKS?></td>
                       <td>8</td>
                       <td>9</td>
                       <td>0</td>
                       <td>1</td>
                       <td>2</td>
                       <td>3</td>
                       <td>4</td>
                       <td>5</td>
                    <!-- <tr> -->
                <?PHP endforeach; ?>
                        <TR>
                       <td>6</td>
                       <td>7</td>
                       <td>8</td>
                       <td>9</td>
                       <td>0</td>
                        </TR>
                   </tr>
                </tr>
                <?PHP endforeach; ?>

                </tbody>
            </table>
</div>    