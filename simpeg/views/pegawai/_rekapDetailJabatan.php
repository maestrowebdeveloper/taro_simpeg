<?php if (!isset($_POST['report'])) { ?>
    <div style="text-align: right">
        <button class="print entypo-icon-printer button btn" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    </div>
<?php } ?>
<div class="report" id="report" style="width: 100%; margin-top: 25px;">
    <h3 style="text-align:center">LAPORAN REKAPITULASI PEGAWAI BERDASARKAN JABATAN</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th rowspan="2">UNIT KERJA</th>	
                <th colspan="<?php echo count($arrEselon) ?>">STRUKTURAL</th>
                <th colspan="<?php echo count($arrTertentu) ?>">FUNGSIONAL TERTENTU</th>
                <th rowspan="2">FUNGSIONAL UMUM</th>
                <th rowspan="2">JUMLAH</th>
            </tr>
            <tr>
                <?php
                foreach ($arrEselon as $key => $value) {
                    echo '<th >' . strtoupper($key) . '</th>';
                }
                foreach ($arrTertentu as $key => $value) {
                    echo '<th>' . strtoupper($key) . '</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($berdasarkan == 'all') {

                foreach ($unitKerja as $data) {
                    echo '<tr>';
                    echo '<td>' . $data->nama . '</td>';
                    $total = 0;
                    foreach ($arrEselon as $key => $value) {
                        echo '<td>' . $eselon[$data->id][$key] . '</td>';
                        $total += $eselon[$data->id][$key];
                    }
                    foreach ($arrTertentu as $key => $value) {
                        echo '<td>' . $tertentu[$data->id][$key] . '</td>';
                        $total += $tertentu[$data->id][$key];
                    }
                    $total += $umum[$data->id]['umum'];
                    echo '<td>' . $umum[$data->id]['umum'] . '</td>';
                    echo '<td>' . $total . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr>';
                echo '<td>' . $unitKerja . '</td>';
                $total = 0;
                foreach ($eselon as $key => $value) {
                    echo '<td>' . $value . '</td>';
                    $total += $value;
                }
                foreach ($tertentu as $key => $value) {
                    echo '<td>' . $value . '</td>';
                    $total += $value;
                }
                $total += $umum['umum'];
                echo '<td>' . $umum['umum'] . '</td>';
                echo '<td>' . $total . '</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>