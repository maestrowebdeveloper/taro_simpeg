<?php
$this->setPageTitle('Info Ulang Tahun Pegawai');
$this->breadcrumbs=array(
	'Pegawai'=>array('index'),
	'Info Ulang Tahun Pegawai',
);
?>


<div class="well">
 <div class="shortcuts">
    <ul>
        <li><a style="width:100px" href="?today" title="History Login"><span class="icon24 brocco-icon-calendar "></span><h6>Hari Ini</h6></a></li>
        <li><a style="width:100px" href="?week" title="History Login"><span class="icon24 icomoon-icon-calendar "></span><h6>Minggu Ini</h6></a></li>
        <li><a style="width:100px" href="?nextweek" title="History Login"><span class="icon24   iconic-icon-calendar-alt-stroke  "></span><h6>Minggu Depan</h6></a></li>
        <li><a style="width:100px" href="?month" title="History Login"><span class="icon24 silk-icon-calendar "></span><h6>Bulan Ini</h6></a></li>
        <li><a style="width:100px" href="?nextmonth" title="History Login"><span class="icon24 minia-icon-calendar  "></span><h6>Bulan Depan</h6></a></li>
       
    </ul>
</div>
</div>
<hr>

<?php 
	if (isset($_GET['today'])||isset($_GET['week'])||isset($_GET['month'])||isset($_GET['nextmonth'])||isset($_GET['nextweek']))
		echo $this->renderPartial('_ulangTahun', array('model'=>$model,'honorer'=>$honorer)); 	
 ?>
