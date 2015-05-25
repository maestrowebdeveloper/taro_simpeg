<br>
<legend>Kenaikan Gaji Berkala Bulan <?php echo $bulan; ?> Tahun <?php echo $tahun; ?></legend>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIP</th>
            <th>Pangkat Golru</th>
            <th>Unit kerja</th>
            <th>Gaji Lama</th>
            <th>Gaji Baru</th>
            <th>Tmt Lama</th>
            <th>Tmt Baru</th>
            <th>No SK Akhir</th>
            <th>Tgl SK Akhir</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (empty($query)) {
            echo '<tr>';
            echo '<td colspan="7">Tida ada data pegawai</td>';
            echo '</tr>';
        } else {
            foreach ($query as $val) {
                echo '<tr>';
                echo '<td>' . (isset($val->Pegawai->nama) ? $val->Pegawai->nama : "-") . '</td>';
                echo '<td>' . (isset($val->Pegawai->nip) ? $val->Pegawai->nip : "-") . '</td>';
                echo '<td>' . (isset($val->Pegawai->Pangkat->Golongan->keterangan) ? $val->Pegawai->Pangkat->Golongan->keterangan : "-" ) . ' (' . (isset($val->Pegawai->Pangkat->Golongan->nama) ? $val->Pegawai->Pangkat->Golongan->nama : "-" ) . ')</td>';
                echo '<td>' . (isset($val->Pegawai->unitKerja) ? $val->Pegawai->unitKerja : "-") . '</td>';
                echo '<td>' . landa()->rp($val->gaji_pokok_lama) . '</td>';
                echo '<td>' . landa()->rp($val->gaji_pokok_baru) . '</td>';
                echo '<td>' . (($val->tmt_lama != '0000-00-00') ? date("d-m-Y", strtotime($val->tmt_lama)) : "-") . '</td>';
                echo '<td>' . date("d-m-Y", strtotime($val->tmt_baru)) . '</td>';
                echo '<td>'.$val['no_sk_akhir'].'</td>';
                echo '<td>'.$val['tanggal_sk_akhir'].'</td>';
                echo '</tr>';
            }
        }
        ?>
    </tbody>
</table>
<div class="form-actions">
    <input type="submit" name="proses" value="Simpan" class="btn btn-primary">
</div>