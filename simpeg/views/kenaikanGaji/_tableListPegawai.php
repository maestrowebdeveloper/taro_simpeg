<br>
<legend>Kenaikan Gaji Berkala Bulan <?php echo $bulan; ?> Tahun <?php echo $tahun; ?></legend>
<p>Ditemukan <b><?php echo count($query)?> </b> Data</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
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
            $tanggalKenaikan = "1-" . $bulan . "-" . $tahun;
            $gajiBaru = Gaji::model()->findByPk(1);
            $kenaikanGaji = json_decode($gajiBaru->gaji, true);

            //mencari pegawai yg sudah kenaikan berkala pada tanggal tersebut
            $arrKenaikan = array();
            $model = KenaikanGaji::model()->findAll(array('index' => 'pegawai_id', 'condition' => 'month(tanggal)=' . $bulan . ' AND year(tanggal)=' . $tahun));
            foreach ($model as $val) {
                $arrKenaikan[] = $val->pegawai_id;
            }

//            logs($arrKenaikan);
            foreach ($query as $valPegawai) {
                if (in_array($valPegawai->id, $arrKenaikan)) {
                    $checked = 'checked="checked"';
                    $warna = 'background-color:green;color:white';
                } else {
                    $checked = '';
                    $warna = 'background-color:#DCDCDC;color:black';
                }

                $masakerjaTahun = Pegawai::model()->masaKerjaUntil(date("d-m-Y", strtotime($valPegawai->tmt_cpns)), $tanggalKenaikan, true, false);
                $masakerjaBulan = Pegawai::model()->masaKerjaUntil(date("d-m-Y", strtotime($valPegawai->tmt_cpns)), $tanggalKenaikan, false, true);
                
                $gajiBaru = (landa()->rp(isset($kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaTahun]) ? $kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaTahun] : 0));
                echo '<tr style="' . $warna . '">';
                if ($gajiBaru == 'Rp. 0') {
                    echo '<td>&nbsp;</td>';
                } else {
                    echo '<td><input type="checkbox" ' . $checked . ' name="dibayar[]" class="dibayar" value="' . $valPegawai->id . '"></td>';
                }
                echo '<td>';
                echo '<input type="hidden" name="tanggal_sk_akhir['.$valPegawai->id.']" value="' . (isset($valPegawai->Pangkat->tanggal_sk_akhir) ? $valPegawai->Gaji->tanggal_sk_akhir : "-") . '">';
                echo '<input type="hidden" name="no_sk_akhir['.$valPegawai->id.']" value="' . (isset($valPegawai->Pangkat->no_sk_akhir) ? $valPegawai->Pangkat->no_sk_akhir : "-") . '">';
                echo '<input type="hidden" name="tmt_lama['.$valPegawai->id.']" value="' . (isset($valPegawai->Gaji->tmt_mulai) ? $valPegawai->Gaji->tmt_mulai : "-") . '">';
                echo '<input type="hidden" name="tmt_mulai['.$valPegawai->id.']" value="' . date("Y-m-d", strtotime($tanggalKenaikan)) . '">';
                echo '<input type="hidden" name="pegawai_id['.$valPegawai->id.']" value="' . $valPegawai->id . '">';
                echo '<input type="hidden" name="gaji_lama['.$valPegawai->id.']" value="' . (isset($valPegawai->Gaji->gaji) ? $valPegawai->Gaji->gaji : 0) . '">';
                echo '<input type="hidden" name="gaji_baru['.$valPegawai->id.']" value="' . (isset($kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaTahun]) ? $kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaTahun] : 0) . '">';
                echo (isset($valPegawai->nip) ? $valPegawai->nip : "-");
                echo '</td>';
                echo '<td>' . (isset($valPegawai->nama) ? $valPegawai->nama : "-") . '</td>';
                echo '<td>' . (isset($valPegawai->JabatanStruktural->nama) ? $valPegawai->JabatanStruktural->nama : "-") . '</td>';
                echo '<td>' . (isset($valPegawai->Pangkat->Golongan->nama) ? $valPegawai->Pangkat->Golongan->nama : "-" ) . '</td>';
                echo '<td>' . (isset($valPegawai->tmt_cpns) ? landa()->date2Ind($valPegawai->tmt_cpns) : "-" ) . '</td>';
                echo '<td>' . $masakerjaTahun . " Tahun " . $masakerjaBulan . " Bulan" . '</td>';
                echo '<td>' . (landa()->rp(isset($valPegawai->Gaji->gaji) ? $valPegawai->Gaji->gaji : 0)) . '</td>';
                echo '<td>' . ((isset($valPegawai->Gaji->tmt_mulai ) and $valPegawai->Gaji->tmt_mulai != '0000-00-00') ? date("d M Y",  strtotime($valPegawai->Gaji->tmt_mulai)) : '-') . '</td>';
                echo '<td>' . $gajiBaru . '</td>';
                echo '</tr>';
//                }
            }
        }
        ?>
    </tbody>
</table>
<div class="form-actions">
    <input type="submit" name="proses" value="Proses" class="btn btn-primary">
</div>