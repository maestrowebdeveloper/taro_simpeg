<?php
$result='';
$criteria = '';
if (!empty($_POST['riwayat_jabatan_id'])) {
//    $criteria .= ' and unit_kerja_id=' . $model->unit_kerja_id;
//    $unitkerja = $model->unit_kerja_id;


    $unitKerja = (!empty($_POST['riwayat_jabatan_id'])) ? UnitKerja::model()->findByPk($_POST['riwayat_jabatan_id'])->nama : 'Semua Unit Kerja';
    

    if ($model->jabatan_fu_id == "agama") {
//        $data = Pegawai::model()->findAll(array('condition' => 'id>0' . $criteria, 'group' => 'agama', 'select' => '*,count(id) as id'));
        $sAgama = Pegawai::model()->arrAgama();


        foreach ($sAgama as $key => $value) {
//            $agama[$key] = intval($value);
            $agama[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND pegawai.agama ="' . $value . '"')->query());
        }

        
        $this->renderPartial('_rekapDetail', array('data' => $agama,'arr'=>$sAgama, 'unitKerja' => $unitKerja, 'header' => 'AGAMA', 'berdasarkan' => $model->jabatan_fu_id));
    } elseif ($model->jabatan_fu_id == "jenis_kelamin") {
        $sjk = Pegawai::model()->arrJenisKelamin();
        foreach ($sjk as $key => $value) {
//        $jk[$key] = intval($value);
            $jeniskel[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND pegawai.jenis_kelamin ="' . $value . '"')->query());
        }

        
        $this->renderPartial('_rekapDetail', array('data' => $jeniskel,'arr'=>$sjk, 'unitKerja' => $unitKerja, 'header' => 'JENIS KELAMIN', 'berdasarkan' => $model->jabatan_fu_id));
    } elseif ($model->jabatan_fu_id == "jabatan") {
        $criteria = '';
        if (!empty($_POST['riwayat_jabatan_id']))
            $criteria .= ' and t.riwayat_jabatan_id=' . $_POST['riwayat_jabatan_id'];

        $struktural = Pegawai::model()->with('JabatanStruktural.Eselon')->findAll(array('condition' => 't.id>0' . ' and JabatanStruktural.eselon_id = Eselon.id and t.tipe_jabatan="struktural" ' . $criteria, 'group' => 'Eselon.nama', 'select' => '*,count(t.id) as id'));
        $sEselon = CHtml::listData(Eselon::model()->findAll(array('order' => 'id ASC')), 'nama', 'nama');
        foreach ($struktural as $value) {
            if (isset($value->JabatanStruktural->Eselon->nama)) {
                $eselon[$value->JabatanStruktural->Eselon->nama] = $value->id;
            }
        }

        foreach ($sEselon as $key => $value) {
//            $eselon[$key] = intval($value);
            $eselon[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN eselon ON jabatan_struktural.eselon_id = eselon.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND eselon.nama="' . $key . '"')->query());
        }

        
        $sTertentu = array('guru' => 'Guru', 'kesehatan' => 'Kesehatan', 'umum' => 'Teknis');
      

        foreach ($sTertentu as $key => $value) {
//            $tertentu[$key] = intval($value);
            $tertentu[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN jabatan_ft ON riwayat_jabatan.jabatan_ft_id = jabatan_ft.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND jabatan_ft.type="' . $key . '"')->query());
        }

        $umum['umum'] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND pegawai.tipe_jabatan="fungsional_umum"')->query());


        
        $this->renderPartial('_rekapDetailJabatan', array('eselon' => $eselon, 'tertentu' => $tertentu, 'umum' => $umum,'arrEselon'=>$sEselon,'arrTertentu'=>$sTertentu, 'unitKerja' => $unitKerja, 'header' => 'PANGKAT / GOLONGAN', 'berdasarkan' => $model->jabatan_fu_id));
    } elseif ($model->jabatan_fu_id == "tingkat_pendidikan") {

        $sPendidikan = Pegawai::model()->arrJenjangPendidikan();
        foreach ($sPendidikan as $key => $value) {
//            $pendidikan[$key] = intval($value);
            $pendidikan[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_pendidikan ON pegawai.pendidikan_id = riwayat_pendidikan.id
INNER JOIN jurusan ON riwayat_pendidikan.id_jurusan = jurusan.id
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND jurusan.tingkat="' . $value . '" ')->query());
        }
        $this->renderPartial('_rekapDetail', array('data' => $pendidikan,'arr'=>$sPendidikan, 'unitKerja' => $unitKerja, 'header' => 'TINGKAT PENDIDIKAN', 'berdasarkan' => $model->jabatan_fu_id));
        
    } elseif ($model->jabatan_fu_id == "golongan") {

        $sGolongan = CHtml::listData(Golongan::model()->findAll(), 'nama', 'nama');

        foreach ($sGolongan as $key => $value) {
//            $golongan[$key] = intval($value);
            $golongan[$key] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN riwayat_pangkat ON riwayat_pangkat.id = pegawai.riwayat_pangkat_id
INNER JOIN golongan ON riwayat_pangkat.golongan_id = golongan.id
WHERE jabatan_struktural.unit_kerja_id = ' . $_POST['riwayat_jabatan_id'] . ' AND pegawai.kedudukan_id = 1 AND golongan.nama="' . $key . '"')->query());
        }

        
        $this->renderPartial('_rekapDetail', array('data' => $golongan,'arr'=>$sGolongan, 'unitKerja' => $unitKerja, 'header' => 'PANGKAT / GOLONGAN', 'berdasarkan' => $model->jabatan_fu_id));
    }
} else {
//    =====================JIKA TIDAK MEMILIH SKPD===========================
    
    if ($model->jabatan_fu_id == "agama") {
        $idunit = array();
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));

        $arrAgama = Pegawai::model()->arrAgama();
//        $jabstruk = JabatanStruktural::model()->with('UnitKerja')->findAll(array('condition' => 'unit_kerja_id IN (' . implode(',', $idunit) . ')'));

        foreach ($unitKerja as $unit => $data) {
            foreach ($arrAgama as $key) {
                $result = cmd('select count(nip) as result from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id=' . $data->id . ' AND pegawai.kedudukan_id = 1 AND pegawai.agama ="' . $key . '"')->query();
            foreach ($result as $a)
                    $result = $a['result'];
                
                $agama[$data->id][$key] = $result;
                
            }
        }


        
        $this->renderPartial('_rekapDetail', array('data' => $agama, 'arr' => $arrAgama, 'unitKerja' => $unitKerja, 'header' => 'AGAMA', 'berdasarkan' => 'all'));
    } elseif ($model->jabatan_fu_id == "jenis_kelamin") {
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));
        $jk = Pegawai::model()->arrJenisKelamin();
        foreach ($unitKerja as $unit => $data) {
            foreach ($jk as $key => $value) {
//        $jk[$key] = intval($value);
                $result = cmd('select count(nip) as result from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id =' . $data->id . ' AND pegawai.kedudukan_id = 1 AND pegawai.jenis_kelamin ="' . $value . '"')->query();
            foreach ($result as $a)
                    $result = $a['result'];
                
                $jeniskel[$data->id][$key] = $result;
                
            }
        }

        
        $this->renderPartial('_rekapDetail', array('data' => $jeniskel, 'arr' => $jk, 'unitKerja' => $unitKerja, 'header' => 'JENIS KELAMIN', 'berdasarkan' => 'all'));
    } elseif ($model->jabatan_fu_id == "tingkat_pendidikan") {
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));
        $sPendidikan = Pegawai::model()->arrJenjangPendidikan();
        foreach ($unitKerja as $unit => $data) {
            foreach ($sPendidikan as $key => $value) {
//            $pendidikan[$key] = intval($value);
                $result = cmd('select count(nip) as result from pegawai 
INNER JOIN riwayat_pendidikan ON pegawai.pendidikan_id = riwayat_pendidikan.id
INNER JOIN jurusan ON riwayat_pendidikan.id_jurusan = jurusan.id
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $data->id . ' AND pegawai.kedudukan_id = 1 AND jurusan.tingkat="' . $value . '" ')->query();
            foreach ($result as $a)
                    $result = $a['result'];
                
                $pendidikan[$data->id][$key] = $result;
                
            }
        }

        
        $this->renderPartial('_rekapDetail', array('data' => $pendidikan, 'arr' => $sPendidikan, 'unitKerja' => $unitKerja, 'header' => 'TINGKAT PENDIDIKAN', 'berdasarkan' => 'all'));
    } elseif ($model->jabatan_fu_id == "golongan") {
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));
        $sGolongan = CHtml::listData(Golongan::model()->findAll(), 'nama', 'nama');
        foreach ($unitKerja as $unit => $data) {
            foreach ($sGolongan as $key => $value) {
//            $golongan[$key] = intval($value);
                $result = cmd('SELECT count(nip) as result from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN riwayat_pangkat ON riwayat_pangkat.id = pegawai.riwayat_pangkat_id
INNER JOIN golongan ON riwayat_pangkat.golongan_id = golongan.id
WHERE jabatan_struktural.unit_kerja_id = ' . $data->id . ' AND pegawai.kedudukan_id = 1 AND golongan.nama="' . $value . '"')->query();
                foreach ($result as $a)
                    $result = $a['result'];
                
                $golongan[$data->id][$key] = $result;
            }
        }

        
        $this->renderPartial('_rekapDetail', array('data' => $golongan, 'arr' => $sGolongan, 'unitKerja' => $unitKerja, 'header' => 'PANGKAT / GOLONGAN', 'berdasarkan' => 'all'));
    } else {
        $unitKerja = UnitKerja::model()->findAll(array('order' => 'id'));
        $sEselon = CHtml::listData(Eselon::model()->findAll(array('order' => 'id ASC')), 'nama', 'nama');
        foreach ($unitKerja as $unit => $data) {
            foreach ($sEselon as $key => $value) {
                $result = cmd('select count(nip) as result from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN eselon ON jabatan_struktural.eselon_id = eselon.id
WHERE jabatan_struktural.unit_kerja_id = ' . $data->id . ' AND pegawai.kedudukan_id = 1 AND eselon.nama="' . $key . '"')->query();
           foreach ($result as $a)
                    $result = $a['result'];
                
                $eselon[$data->id][$key] = $result;
                }
        }
//============= Jabatan FUngsional Tertentu======

        $sTertentu = array('guru' => 'Guru', 'kesehatan' => 'Kesehatan', 'teknis' => 'Teknis');
       
        foreach ($unitKerja as $unit => $data) {
            foreach ($sTertentu as $key => $value) {
//            $tertentu[$key] = intval($value);
                $result2 = cmd('select count(nip) as result from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
INNER JOIN jabatan_ft ON riwayat_jabatan.jabatan_ft_id = jabatan_ft.id
WHERE jabatan_struktural.unit_kerja_id = ' . $data->id . ' AND pegawai.kedudukan_id = 1 AND jabatan_ft.type="' . $key . '"')->query();
            foreach ($result2 as $a)
                    $result2 = $a['result'];
                
                $tertentu[$data->id][$key] = $result2;
                }
        }
//============= fungsional umum================== 
        foreach($unitKerja as $unit=>$data){
        $umum[$data->id]['umum'] = count(cmd('select * from pegawai 
INNER JOIN riwayat_jabatan ON pegawai.riwayat_jabatan_id = riwayat_jabatan.id
INNER JOIN jabatan_struktural ON riwayat_jabatan.jabatan_struktural_id = jabatan_struktural.id
WHERE jabatan_struktural.unit_kerja_id = ' . $data->id . ' AND pegawai.kedudukan_id = 1 AND pegawai.tipe_jabatan="fungsional_umum"')->query());
        }


        
        $this->renderPartial('_rekapDetailJabatan', array('eselon' => $eselon, 'tertentu' => $tertentu, 'umum' => $umum,'arrEselon'=>$sEselon,'arrTertentu'=>$sTertentu, 'unitKerja' => $unitKerja, 'header' => 'PANGKAT / GOLONGAN', 'berdasarkan' => 'all'));
    }
}
?>


