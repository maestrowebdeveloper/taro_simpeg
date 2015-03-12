<?php
$this->setPageTitle('Check Kelengkapan Data Pegawai');
$this->breadcrumbs=array(
	'Pegawai'=>array('index'),
	'Info Ulang Tahun Pegawai',
);
?>

<div class="well">
 <div class="shortcuts">
    <ul>
        <li><a style="width:130px" href="?lahir" title=""><span class="icon24 brocco-icon-calendar "></span><h6>Tanggal Lahir</h6></a></li>
        <li><a style="width:130px" href="?jk" title=""><span class="icon24 entypo-icon-users "></span><h6>Jenis Kelamin</h6></a></li>
        <li><a style="width:130px" href="?agama" title=""><span class="icon24 entypo-icon-book "></span><h6>Agama</h6></a></li>
        <li><a style="width:130px" href="?pangkat" title=""><span class="icon24 brocco-icon-bookmark-2 "></span><h6>Pangkat / Golongan</h6></a></li>
        <li><a style="width:130px" href="?jabatan" title=""><span class="icon24 entypo-icon-star "></span><h6>Jabatan</h6></a></li>        
        <li><a style="width:130px" href="?pendidikan" title=""><span class="icon24 wpzoom-user-2 "></span><h6>Pendidikan Terakhir</h6></a></li>
       
    </ul>
</div>
</div>
<hr>

<?php 
	if (isset($_GET['lahir'])||isset($_GET['jk'])||isset($_GET['agama'])||isset($_GET['pangkat'])||isset($_GET['jabatan'])||isset($_GET['pendidikan']))
		echo $this->renderPartial('_checkError', array('model'=>$model)); 	
 ?>
