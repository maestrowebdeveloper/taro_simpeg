<?php

$this->setPageTitle('Daftar Struktur Organisasi');
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'struktur-organisasi',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
//$arrPegawai = Pegawai::model()->with('RiwayatJabatan', 'JabatanStruktural')->findAll(
//        array('order' => 'JabatanStruktural.root,JabatanStruktural.lft',
//            'condition' => 'kedudukan_id=1'
//        )
//);
//$arrJabatanStruktural = JabatanStruktural::model()->with('Pegawai')->findAll(array('order' => 'root,lft'));
//$arrPegawai = cmd('SELECT pegawai.*,jabatan_struktural.nama as unitKerja'
$arrPegawai = cmd('SELECT pegawai.*,jabatan_struktural.nama as unitKerja, jabatan_struktural.level as level '
//        . ',golongan.nama as nama_golongan, golongan.keterangan as gol_keterangan, eselon.nama as nama_eselon, jurusan.Name as pendidikan FROM pegawai '
        . ' FROM pegawai '
        . 'INNER JOIN riwayat_jabatan ON pegawai.id = riwayat_jabatan.pegawai_id AND pegawai.kedudukan_id=1 AND pegawai.tipe_jabatan="struktural" '
        . 'RIGHT JOIN jabatan_struktural ON jabatan_struktural.id = riwayat_jabatan.jabatan_struktural_id '
        . 'INNER JOIN eselon ON eselon.id = jabatan_struktural.eselon_id '
        . 'INNER JOIN riwayat_pangkat ON pegawai.id = riwayat_pangkat.pegawai_id '
//        . 'INNER JOIN golongan ON golongan.id = riwayat_pangkat.golongan_id '
//        . 'INNER JOIN riwayat_pendidikan ON pegawai.id = riwayat_pendidikan.pegawai_id '
//        . 'INNER JOIN jurusan ON jurusan.id = riwayat_pendidikan.id_jurusan '
        . 'ORDER BY jabatan_struktural.root,jabatan_struktural.lft')->query();
?>
<br>
<center><h2>Daftar Struktur Organisasi</h2></center>
<div style="text-align: right">
    <input type="submit" name="exportExcel" value="Export Excel" class="btn btn-primary">
</div>
<hr>
<table border='1' class="table table-bordered">
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
        foreach ($arrPegawai as $arr) {
            $maju = ($arr['level'] == 1) ? "" : str_repeat("|— ", $arr['level'] - 1);
            $css = ($arr['level'] == 1) ? "style='font-weight:bold'" : "";
            ?>
            <tr <?php echo $css?>>
                <td><?php echo $maju.$arr['unitKerja'] ?></td>
                <td><?php echo $arr['nip']?></td>
                <td><?php echo $arr['nama'] ?></td>
                <td><?php // echo $arr['nama_golongan'].' - '.$arr['gol_keterangan'] ?></td>
                <td><?php // echo date('d M Y',strtotime($arr['tmt_pensiun']))   ?></td>
                <td align="center"><?php // echo $arr['nama_eselon']   ?></td>
                <td><?php // echo $arr['pendidikan']   ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php $this->endWidget();?>