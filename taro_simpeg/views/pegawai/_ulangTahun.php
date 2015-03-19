<?php
if (isset($_GET['today']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI HARI INI';
if (isset($_GET['week']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI MINGGU INI';
if (isset($_GET['month']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI BULAN INI';
if (isset($_GET['nextmonth']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI BULAN DEPAN';
if (isset($_GET['nextweek']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI MINGGU DEPAN';
?>


<a class="btn btn-info pull-right" href="ulangTahunExcel" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
    


<h3 style="text-align:center"><?php echo $judul;?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pegawai-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{items}{pager}{summary}', 
        'enableSorting'=>false,       
	'columns'=>array(
    array(
           'name' => 'STATUS',           
            'type' => 'raw',
            'value' => '"PNS"',             
            ),
		'namaGelar',        
      
        array(
           'name' => 'tanggal_lahir',
           'header' => 'Tempat / Tgl. Lahir',
            'type' => 'raw',
            'value' => '"$data->ttl"',             
            ),
        'golongan',
        'jabatan',
        'unitKerja',
 
        'usia',
	
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' =>'{view}',
			'buttons' => array(
			      'view' => array(
					'label'=> 'Lihat',
					'options'=>array(
						'class'=>'btn btn-small view'
					)
				),	
                              'update' => array(
					'label'=> 'Edit',
					'options'=>array(
						'class'=>'btn btn-small update'
					)
				),
				'delete' => array(
					'label'=> 'Hapus',
					'options'=>array(
						'class'=>'btn btn-small delete'
					)
				)
			),
            'htmlOptions'=>array('style'=>'width: 20px;text-align:center'),
           )
	),
));

$this->widget('bootstrap.widgets.TbGridView',array(
  'id'=>'pegawai-grid',
  'dataProvider'=>$honorer->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{items}{pager}{summary}', 
        'enableSorting'=>false,       
  'columns'=>array(
    array(
           'name' => 'STATUS',           
            'type' => 'raw',
            'value' => '"HONORER"',             
            ),
    'nama',        
      
        array(
           'name' => 'tanggal_lahir',
           'header' => 'Tempat / Tgl. Lahir',
            'type' => 'raw',
            'value' => '"$data->ttl"',             
            ),        
        'jabatan',
        'unitKerja',
 
        'usia',
  
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
      'template' =>'{view}',
      'buttons' => array(
            'view' => array(
          'label'=> 'Lihat',
          'options'=>array(
            'class'=>'btn btn-small view'
          )
        ),  
                              'update' => array(
          'label'=> 'Edit',
          'options'=>array(
            'class'=>'btn btn-small update'
          )
        ),
        'delete' => array(
          'label'=> 'Hapus',
          'options'=>array(
            'class'=>'btn btn-small delete'
          )
        )
      ),
            'htmlOptions'=>array('style'=>'width: 20px;text-align:center'),
           )
  ),
));
 ?>
