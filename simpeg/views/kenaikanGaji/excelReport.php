<br>
<legend>Kenaikan Gaji Berkala Bulan <?php echo $bulan; ?> Tahun <?php echo $tahun; ?></legend>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Unit Kerja</th>
            <th>Gol</th>
            <th>TMT Cpns</th>
            <th>Masa Kerja</th>
            <th>Gaji Lama</th>
            <th>Tmt Lama</th>
            <th>Gaji Baru</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $warna = '';
        if (empty($query)) {
            echo '<tr>';
            echo '<td colspan="7">Tida ada data pegawai</td>';
            echo '</tr>';
        } else {
//            $bulan = substr("0" . $_POST['bulan'], -2, 2);
//            $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $_POST['tahun']);
            $tanggalKenaikan = "31-" . $bulan . "-" . $tahun;
            $gajiBaru = Gaji::model()->findByPk(1);
            $kenaikanGaji = json_decode($gajiBaru->gaji, true);

            //mencari pegawai yg sudah kenaikan berkala pada tanggal tersebut
            $arrKenaikan = array();
            $model = KenaikanGaji::model()->findAll(array('index' => 'pegawai_id', 'condition' => 'month(tanggal)=' . $bulan . ' AND year(tanggal)=' . $tahun));
            foreach ($model as $val) {
                $arrKenaikan[] = $val->pegawai_id;
            }

//            logs($arrKenaikan);
            $no = 1;
            foreach ($query as $valPegawai) {
                $masakerjaTahun = Pegawai::model()->masaKerjaUntil(date("d-m-Y", strtotime($valPegawai->tmt_cpns)), $tanggalKenaikan, true, false);
                $masakerjaBulan = Pegawai::model()->masaKerjaUntil(date("d-m-Y", strtotime($valPegawai->tmt_cpns)), $tanggalKenaikan, false, true);
                $gajiBaru = (landa()->rp(isset($kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaTahun]) ? $kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaTahun] : 0));
                
                echo '<tr>';
                echo '<td>'.$no.'</td>';
                echo '<td>';
                echo (isset($valPegawai->nip) ? $valPegawai->nip.'&nbsp;' : "-");
                echo '</td>';
                echo '<td>' . (isset($valPegawai->nama) ? $valPegawai->nama : "-") . '</td>';
                echo '<td>' . (isset($valPegawai->JabatanStruktural->nama) ? $valPegawai->JabatanStruktural->nama : "-") . '</td>';
                echo '<td>' . (isset($valPegawai->Pangkat->Golongan->nama) ? $valPegawai->Pangkat->Golongan->nama : "-" ) . '</td>';
                echo '<td>' . (isset($valPegawai->tmt_cpns) ? landa()->date2Ind($valPegawai->tmt_cpns) : "-" ) . '</td>';
                echo '<td>' . $masakerjaTahun . " Tahun " . $masakerjaBulan . " Bulan" . '</td>';
                echo '<td>' . (landa()->rp(isset($valPegawai->Gaji->gaji) ? $valPegawai->Gaji->gaji : 0)) . '</td>';
                echo '<td>' . ((isset($valPegawai->Gaji->tmt_mulai) and $valPegawai->Gaji->tmt_mulai != '0000-00-00') ? date("d M Y", strtotime($valPegawai->Gaji->tmt_mulai)) : '-') . '</td>';
                echo '<td>' . $gajiBaru . '</td>';
                echo '</tr>';
//                }
            $no++;
            }
        }
        ?>
    </tbody>
</table>