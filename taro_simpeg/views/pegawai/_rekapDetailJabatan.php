<div style="text-align: right">
    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/pegawai/rekapExcel?" . $berdasarkan); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%; margin-top: 25px;">
    <h3 style="text-align:center">LAPORAN REKAPITULASI PEGAWAI BERDASARKAN JABATAN</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="2">UNIT KERJA</th>	
                <th colspan="<?php echo count($eselon) ?>">STRUKTURAL</th>
                <th colspan="<?php echo count($tertentu) ?>">FUNGSIONAL TERTENTU</th>
                <th rowspan="2">FUNGSIONAL UMUM</th>
                <th rowspan="2">JUMLAH</th>
            </tr>
            <tr>
                <?php
                foreach ($eselon as $key => $value) {
                    echo '<th >' . strtoupper($key) . '</th>';
                }
                foreach ($tertentu as $key => $value) {
                    echo '<th>' . strtoupper($key) . '</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
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
            ?>
        </tbody>
    </table>
</div>