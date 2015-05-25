<br>
<legend>Kenaikan Gaji Berkala Bulan <?php echo $bulan; ?> Tahun <?php echo $tahun; ?></legend>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Golongan</th>
            <th>Gaji Lama</th>
            <th>Gaji Baru</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (empty($query)) {
            echo '<tr>';
            echo '<td colspan="7">Tida ada data pegawai</td>';
            echo '</tr>';
        } else {
            $bulan = substr("0" . $_POST['bulan'], -2, 2);
            $jumHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $_POST['tahun']);
            $tanggalKenaikan = $jumHari . "-" . $bulan . "-" . $_POST['tahun'];
            $gajiBaru = Gaji::model()->findByPk(1);
            $kenaikanGaji = json_decode($gajiBaru->gaji, true);
            foreach ($query as $valPegawai) {
                $masakerjaPegawai = KenaikanGaji::model()->masaKerja(date("d-m-Y", strtotime($valPegawai->tmt_cpns)), $tanggalKenaikan, true, false);
                if (isset($kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaPegawai]) and $kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaPegawai] > 0) {
                    echo '<tr>';
                    echo '<td>';
                    echo '<input type="hidden" name="tmt_lama[]" value="' . (isset($valPegawai->Gaji->tmt_mulai) ? $valPegawai->Gaji->tmt_mulai : "-"). '">';
                    echo '<input type="hidden" name="tmt_mulai[]" value="' . date("Y-m-d", strtotime($tanggalKenaikan)) . '">';
                    echo '<input type="hidden" name="pegawai_id[]" value="' . $valPegawai->id . '">';
                    echo '<input type="hidden" name="gaji_lama[]" value="' . (isset($valPegawai->Gaji->gaji) ? $valPegawai->Gaji->gaji : 0) . '">';
                    echo '<input type="hidden" name="gaji_baru[]" value="' . (isset($kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaPegawai]) ? $kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaPegawai] : 0) . '">';
                    echo (isset($valPegawai->nip) ? $valPegawai->nip : "-");
                    echo '</td>';
                    echo '<td>' . (isset($valPegawai->nama) ? $valPegawai->nama : "-") . '</td>';
                    echo '<td>' . (isset($valPegawai->Pangkat->Golongan->nama) ? $valPegawai->Pangkat->Golongan->nama : "-" ) . '</td>';
                    echo '<td>' . (landa()->rp(isset($valPegawai->Gaji->gaji) ? $valPegawai->Gaji->gaji : 0)) . '</td>';
                    echo '<td>' . (landa()->rp(isset($kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaPegawai]) ? $kenaikanGaji[$valPegawai->Pangkat->golongan_id][$masakerjaPegawai] : 0)) . '</td>';
                    echo '</tr>';
                }
            }
        }
        ?>
    </tbody>
</table>
<div class="form-actions">
    <input type="submit" name="proses" value="Proses" class="btn btn-primary">
</div>