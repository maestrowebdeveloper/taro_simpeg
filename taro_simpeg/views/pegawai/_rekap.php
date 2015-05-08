<?php

$criteria = '';
if (!empty($_POST['riwayat_jabatan_id'])) {
//    $criteria .= ' and unit_kerja_id=' . $model->unit_kerja_id;
//    $unitkerja = $model->unit_kerja_id;


    $unitKerja = (!empty($_POST['riwayat_jabatan_id'])) ? UnitKerja::model()->findByPk($_POST['riwayat_jabatan_id'])->nama : 'Semua Unit Kerja';
    app()->session['RekapUnitKerjaExcel_records'] = $unitKerja;

    if ($model->jabatan_fu_id == "agama") {
//        $data = Pegawai::model()->findAll(array('condition' => 'id>0' . $criteria, 'group' => 'agama', 'select' => '*,count(id) as id'));
        $agama = Pegawai::model()->arrAgama();


        foreach ($agama as $key => $value) {
            $agama[$key] = intval($value);
            $agama[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND pegawai.agama ="' . $value . '"')->query());
        }

        app()->session['RekapExcel_records'] = $agama;
        $this->renderPartial('_rekapDetail', array('data' => $agama, 'unitKerja' => $unitKerja, 'header' => 'AGAMA', 'berdasarkan' => $model->jabatan_fu_id));
    } elseif ($model->jabatan_fu_id == "jenis_kelamin") {
        $jk = Pegawai::model()->arrJenisKelamin();
        foreach ($jk as $key => $value) {
//        $jk[$key] = intval($value);
            $jeniskel[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND pegawai.jenis_kelamin ="' . $value . '"')->query());
        }

        app()->session['RekapExcel_records'] = $jk;
        $this->renderPartial('_rekapDetail', array('data' => $jeniskel, 'unitKerja' => $unitKerja, 'header' => 'JENIS KELAMIN', 'berdasarkan' => $model->jabatan_fu_id));
    } elseif ($model->jabatan_fu_id == "jabatan") {
        $criteria = '';
        if (!empty($_POST['riwayat_jabatan_id']))
            $criteria .= ' and t.riwayat_jabatan_id=' . $_POST['riwayat_jabatan_id'];

        $struktural = Pegawai::model()->with('JabatanStruktural.Eselon')->findAll(array('condition' => 't.id>0' . ' and JabatanStruktural.eselon_id = Eselon.id and t.tipe_jabatan="struktural" ' . $criteria, 'group' => 'Eselon.nama', 'select' => '*,count(t.id) as id'));
        $eselon = CHtml::listData(Eselon::model()->findAll(array('order' => 'id ASC')), 'nama', 'nama');
        foreach ($struktural as $value) {
            if (isset($value->JabatanStruktural->Eselon->nama)) {
                $eselon[$value->JabatanStruktural->Eselon->nama] = $value->id;
            }
        }

        foreach ($eselon as $key => $value) {
//            $eselon[$key] = intval($value);
            $eselon[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN eselon ON jabatan_struktural.eselon_id = eselon.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND eselon.nama="' . $key . '"')->query());
        }

        $jbtTertentu = Pegawai::model()->with('JabatanFt')->findAll(array('condition' => 't.id>0' . $criteria . ' and t.tipe_jabatan="fungsional_tertentu" ', 'group' => 'JabatanFt.type', 'select' => '*,count(t.id) as id'));
        $tertentu = array('guru' => 'Guru', 'kesehatan' => 'Kesehatan', 'umum' => 'Teknis');
        foreach ($jbtTertentu as $value) {
            if (isset($value->JabatanFt->type)) {
                $tertentu[$value->JabatanFt->type] = $value->id;
            }
        }

        foreach ($tertentu as $key => $value) {
//            $tertentu[$key] = intval($value);
            $tertentu[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN jabatan_ft ON riwayat_jabatan.jabatan_ft_id = jabatan_ft.id
WHERE jabatan_struktural.unit_kerja_id = '.$_POST['riwayat_jabatan_id'].' AND pegawai.kedudukan_id = 1 AND jabatan_ft.type="'.$key.'"')->query());
        
        }

    $umum['umum'] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = '.$_POST['riwayat_jabatan_id'].' AND pegawai.kedudukan_id = 1 AND pegawai.tipe_jabatan="fungsional_umum"')->query());
        

        app()->session['RekapExcel_records'] = '';
        $this->renderPartial('_rekapDetailJabatan', array('eselon' => $eselon, 'tertentu' => $tertentu, 'umum' => $umum, 'unitKerja' => $unitKerja, 'header' => 'PANGKAT / GOLONGAN', 'berdasarkan' => $model->jabatan_fu_id));
    } elseif ($model->jabatan_fu_id == "tingkat_pendidikan") {

        $pendidikan = Pegawai::model()->arrJenjangPendidikan();
        foreach ($pendidikan as $key => $value) {
//            $pendidikan[$key] = intval($value);
            $pendidikan[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_pendidikan ON pegawai.pendidikan_id = riwayat_pendidikan.id
INNER JOIN jurusan ON riwayat_pendidikan.id_jurusan = jurusan.id
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND jurusan.tingkat="' . $value . '" ')->query());
        }

        app()->session['RekapExcel_records'] = $pendidikan;
        $this->renderPartial('_rekapDetail', array('data' => $pendidikan, 'unitKerja' => $unitKerja, 'header' => 'TINGKAT PENDIDIKAN', 'berdasarkan' => $model->jabatan_fu_id));
    } elseif ($model->jabatan_fu_id == "golongan") {

        $golongan = CHtml::listData(Golongan::model()->findAll(), 'nama', 'nama');

        foreach ($golongan as $key => $value) {
//            $golongan[$key] = intval($value);
            $golongan[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN riwayat_pangkat ON riwayat_pangkat.id = pegawai.riwayat_pangkat_id
INNER JOIN golongan ON riwayat_pangkat.golongan_id = golongan.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND golongan.nama="' . $key . '"')->query());
        }

        app()->session['RekapExcel_records'] = $golongan;
        $this->renderPartial('_rekapDetail', array('data' => $golongan, 'unitKerja' => $unitKerja, 'header' => 'PANGKAT / GOLONGAN', 'berdasarkan' => $model->jabatan_fu_id));
    }
} else {
//    =====================JIKA TIDAK MEMILIH SKPD===========================
    if ($model->jabatan_fu_id == "agama") {
        $idunit = array();
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));

        $arrAgama = Pegawai::model()->arrAgama();
//        $jabstruk = JabatanStruktural::model()->with('UnitKerja')->findAll(array('condition' => 'unit_kerja_id IN (' . implode(',', $idunit) . ')'));

        foreach ($unitKerja as $unit => $data) {
        foreach ($arrAgama as $key ) {
            $agama[$data->id][$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id='.$data->id.' AND pegawai.kedudukan_id = 1 AND pegawai.agama ="' . $key . '"')->query());
        }
        }


        app()->session['RekapExcel_records'] = $agama;
        $this->renderPartial('_rekapDetail', array('data' => $agama,'arr'=>$arrAgama, 'unitKerja' => $unitKerja, 'header' => 'AGAMA', 'berdasarkan' => 'all'));
    } elseif ($model->jabatan_fu_id == "jenis_kelamin") {
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));
        $jk = Pegawai::model()->arrJenisKelamin();
        foreach ($jk as $key => $value) {
//        $jk[$key] = intval($value);
            $jeniskel[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id =1 AND pegawai.kedudukan_id = 1 AND pegawai.jenis_kelamin ="' . $value . '"')->query());
        }

        app()->session['RekapExcel_records'] = $jk;
        $this->renderPartial('_rekapDetail', array('data' => $jeniskel, 'unitKerja' => $unitKerja, 'header' => 'JENIS KELAMIN', 'berdasarkan' => 'all'));
    } elseif ($model->jabatan_fu_id == "tingkat_pendidikan") {
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));
        $pendidikan = Pegawai::model()->arrJenjangPendidikan();
        foreach ($pendidikan as $key => $value) {
//            $pendidikan[$key] = intval($value);
            $pendidikan[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_pendidikan ON pegawai.pendidikan_id = riwayat_pendidikan.id
INNER JOIN jurusan ON riwayat_pendidikan.id_jurusan = jurusan.id
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = 1 AND pegawai.kedudukan_id = 1 AND jurusan.tingkat="' . $value . '" ')->query());
        }

        app()->session['RekapExcel_records'] = $pendidikan;
        $this->renderPartial('_rekapDetail', array('data' => $pendidikan, 'unitKerja' => $unitKerja, 'header' => 'TINGKAT PENDIDIKAN', 'berdasarkan' => 'all'));
    } elseif ($model->jabatan_fu_id == "golongan") {
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));
        $golongan = CHtml::listData(Golongan::model()->findAll(), 'nama', 'nama');

        foreach ($golongan as $key => $value) {
//            $golongan[$key] = intval($value);
            $golongan[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN riwayat_pangkat ON riwayat_pangkat.id = pegawai.riwayat_pangkat_id
INNER JOIN golongan ON riwayat_pangkat.golongan_id = golongan.id
WHERE jabatan_struktural.unit_kerja_id = 1 AND pegawai.kedudukan_id = 1 AND golongan.nama="' . $key . '"')->query());
        }

        app()->session['RekapExcel_records'] = $golongan;
        $this->renderPartial('_rekapDetail', array('data' => $golongan, 'unitKerja' => $unitKerja, 'header' => 'PANGKAT / GOLONGAN', 'berdasarkan' => $model->jabatan_fu_id));
    }else{
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));
        $struktural = Pegawai::model()->with('JabatanStruktural.Eselon')->findAll(array('condition' => 't.id>0' . ' and JabatanStruktural.eselon_id = Eselon.id and t.tipe_jabatan="struktural" ' . $criteria, 'group' => 'Eselon.nama', 'select' => '*,count(t.id) as id'));
        $eselon = CHtml::listData(Eselon::model()->findAll(array('order' => 'id ASC')), 'nama', 'nama');
        foreach ($struktural as $value) {
            if (isset($value->JabatanStruktural->Eselon->nama)) {
                $eselon[$value->JabatanStruktural->Eselon->nama] = $value->id;
            }
        }

        foreach ($eselon as $key => $value) {
//            $eselon[$key] = intval($value);
            $eselon[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN eselon ON jabatan_struktural.eselon_id = eselon.id
WHERE jabatan_struktural.unit_kerja_id = ' . $model->unit_kerja_id . ' AND pegawai.kedudukan_id = 1 AND eselon.nama="' . $key . '"')->query());
        }

        $jbtTertentu = Pegawai::model()->with('JabatanFt')->findAll(array('condition' => 't.id>0' . $criteria . ' and t.tipe_jabatan="fungsional_tertentu" ', 'group' => 'JabatanFt.type', 'select' => '*,count(t.id) as id'));
        $tertentu = array('guru' => 'Guru', 'kesehatan' => 'Kesehatan', 'umum' => 'Teknis');
        foreach ($jbtTertentu as $value) {
            if (isset($value->JabatanFt->type)) {
                $tertentu[$value->JabatanFt->type] = $value->id;
            }
        }

        foreach ($tertentu as $key => $value) {
//            $tertentu[$key] = intval($value);
            $tertentu[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN jabatan_ft ON riwayat_jabatan.jabatan_ft_id = jabatan_ft.id
WHERE jabatan_struktural.unit_kerja_id = '.$model->unit_kerja_id.' AND pegawai.kedudukan_id = 1 AND jabatan_ft.type="'.$key.'"')->query());
        
        }

    $umum['umum'] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = '.$model->unit_kerja_id.' AND pegawai.kedudukan_id = 1 AND pegawai.tipe_jabatan="fungsional_umum"')->query());
        


        app()->session['RekapExcel_records'] = '';
        $this->renderPartial('_rekapDetailJabatan', array('eselon' => $eselon, 'tertentu' => $tertentu, 'umum' => $umum, 'unitKerja' => $unitKerja, 'header' => 'PANGKAT / GOLONGAN', 'berdasarkan' => 'all'));
    
    }
}
?>


