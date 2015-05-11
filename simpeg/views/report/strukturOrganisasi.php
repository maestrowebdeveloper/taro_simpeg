<?php
$this->setPageTitle('Daftar Struktur Organisasi');

$arrJabatanStruktural = JabatanStruktural::model()->with('Pegawai')->findAll(array('order' => 'root,lft'));
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Unit Kerja</th>
            <th>NIP</th>
            <th>Pegawai</th>
            <th>Golongan</th>
            <th>TMT Pensiun</th>
            <th>Eselon</th>
            <th>Pendidikan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($arrJabatanStruktural as $arr) {
            $sNip = (isset($arr->Pegawai->nip)) ? $arr->Pegawai->nip : "";
            $sPegawai = (isset($arr->Pegawai->nama)) ? $arr->Pegawai->nama : "";
//            $sGolongan = (isset($arr->Pegawai->Pangkat->Golongan->nama)) ? $arr->Pegawai->Pangkat->Golongan->nama : "";
//            $sPensiun = (isset($arr->Pegawai->pensiun)) ? $arr->Pegawai->pensiun: "";
//            $sEselon = (isset($arr->Eselon->nama)) ? $arr->Eselon->nama: "";
//            $sPendidikan = (isset($arr->Pegawai->pendidikanJurusan)) ? $arr->Pegawai->pendidikanJurusan: "";
            ?>
            <tr>
                <td><?php echo $arr->nestedName ?></td>
                <td><?php echo $sNip ?></td>
                <td><?php echo $sPegawai ?></td>
                <td><?php // echo $sGolongan ?></td>
                <td><?php // echo $sPensiun ?></td>
                <td><?php // echo $sEselon ?></td>
                <td><?php // echo $sPendidikan ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
