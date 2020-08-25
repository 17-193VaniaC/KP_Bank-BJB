<head>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/style.css">

    <!-- Bootstrap CSS -->
    <!--   <link href="<?= base_url('assets/'); ?>css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
</head>
<style type="text/css">
    h3 {
        text-align: center;
    }

    .receipt {
        height: 8.5in;
        width: 33%;
        float: left;
        border: 1px solid black;
    }

    .output {
        height;
        8.5in;
        width: 11in;
        border: 1px solid red;
        position: absolute;
        top: 0px;
        left: 0px;
    }

    @media print {
        .output {
            -ms-transform: rotate(270deg);
            /* IE 9 */
            -webkit-transform: rotate(270deg);
            /* Chrome, Safari, Opera */
            transform: rotate(270deg);
            top: 1.5in;
            left: -1in;
        }
    }
</style>

<body onload="window.print()">
    <H2 style="text-align: center;">Laporan Gabungan</H2>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th colspan="7">RENCANA BISNIS BANK</th>
                    <th colspan="9">PERJANJIAN KERJASAMA</th>
                    <th colspan="4">PEMBAYARAN</th>
                </tr>
            </thead>
            <thead>
                <tr>
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
                    <th>Nama Vendor</th>
                    <th>Mutasi PKS</th>
                    <th>Sisa Anggaran</th>
                    <!-- INVOICE -->
                    <th>Invoice</th>
                    <th>Tahap</th>
                    <th>Nominal</th>
                    <th>Tanggal Invoice</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($table as $a) :
                    $n_colspan = 0;
                    foreach ($a['pks'] as $bb) :
                        if (!empty($bb['invs'])) {
                            $n_colspan = count($bb['invs']) + $n_colspan;
                        } else {
                            $n_colspan = 1 + $n_colspan;
                        }

                    endforeach;
                    // echo $n_colspan;
                ?>
                    <tr>
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
                                        } ?>"><?php echo $a["NAMA_REK"] ?></td>

                        <!-- +++++++++++++++++++++++ PKS +++++++++++++++++++++++++++++ -->
                        <?php
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
                                ?>
                                <!-- ++++++++++++++++++++++++++++++ PEMBAYARAN +++++++++++++++++++++++++++++++= -->
                                <?php
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
                            echo "<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>";
                        } ?>
    </tr>
<?php endforeach; ?>
</tr>
            </tbody>
        </table>
    </div>
    </div>

</body>