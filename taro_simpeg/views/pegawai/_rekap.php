<?php
$criteria = '';
if (!empty($model->unit_kerja_id))
    $criteria .= ' and unit_kerja_id='.$model->unit_kerja_id;

$unitKerja = (!empty($model->unit_kerja_id))?UnitKerja::model()->findByPk($model->unit_kerja_id)->nama:'Semua Unit Kerja';
app()->session['RekapUnitKerjaExcel_records'] = $unitKerja;

if($model->jabatan_fu_id=="agama"){	
	$data = Pegawai::model()->findAll(array('condition'=>'id>0'.$criteria,'group'=>'agama','select'=>'*,count(id) as id'));   	
	$agama = Pegawai::model()->arrAgama();
	foreach ($data as  $value) {
		$agama[$value->agama]=$value->id;
	}

	foreach ($agama as $key => $value) {		
		$agama[$key] = intval($value);
	}
		
	app()->session['RekapExcel_records'] = $agama;
	$this->renderPartial('_rekapDetail',array('data'=>$agama,'unitKerja'=>$unitKerja,'header'=>'AGAMA','berdasarkan'=>$model->jabatan_fu_id));

}elseif($model->jabatan_fu_id=="jenis_kelamin"){
	$data = Pegawai::model()->findAll(array('condition'=>'id>0'.$criteria,'group'=>'jenis_kelamin','select'=>'*,count(id) as id'));   	
	$jk = Pegawai::model()->arrJenisKelamin();
	foreach ($data as  $value) {
		$jk[$value->jenis_kelamin]=$value->id;
	}

	foreach ($jk as $key => $value) {		
		$jk[$key] = intval($value);
	}
			
	app()->session['RekapExcel_records'] = $jk;
	$this->renderPartial('_rekapDetail',array('data'=>$jk,'unitKerja'=>$unitKerja,'header'=>'JENIS KELAMIN','berdasarkan'=>$model->jabatan_fu_id));
}elseif($model->jabatan_fu_id=="usia"){
}elseif($model->jabatan_fu_id=="tingkat_pendidikan"){
	$data = Pegawai::model()->findAll(array('condition'=>'id>0'.$criteria,'group'=>'pendidikan_terakhir','select'=>'*,count(id) as id'));   	
	$pendidikan = Pegawai::model()->arrJenjangPendidikan();
	foreach ($data as  $value) {
		$pendidikan[$value->pendidikan_terakhir]=$value->id;
	}

	foreach ($pendidikan as $key => $value) {		
		$pendidikan[$key] = intval($value);
	}
			
	app()->session['RekapExcel_records'] = $pendidikan;
	$this->renderPartial('_rekapDetail',array('data'=>$pendidikan,'unitKerja'=>$unitKerja,'header'=>'TINGKAT PENDIDIKAN','berdasarkan'=>$model->jabatan_fu_id));
}elseif($model->jabatan_fu_id=="golongan"){
	$data = Pegawai::model()->findAll(array('condition'=>'id>0'.$criteria,'group'=>'golongan_id','select'=>'*,count(id) as id'));   	
	$golongan = CHtml::listData(Golongan::model()->findAll(), 'nama', 'nama');
	foreach ($data as  $value) {
		$golongan[$value->namaGolongan]=$value->id;		
	}

	foreach ($golongan as $key => $value) {		
		$golongan[$key] = intval($value);
	}
			
	app()->session['RekapExcel_records'] = $golongan;
	$this->renderPartial('_rekapDetail',array('data'=>$golongan,'unitKerja'=>$unitKerja,'header'=>'PANGKAT / GOLONGAN','berdasarkan'=>$model->jabatan_fu_id));
}	

?>


