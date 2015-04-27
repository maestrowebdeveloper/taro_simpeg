<?php
$this->setPageTitle('Pencarian Pegawai Berdasarkan Riwayat Pendidikan');
$this->breadcrumbs=array(
	'Pencarian Pegawai Berdasarkan Riwayat Pendidikan',
);

	$button = "";     
	if (landa()->checkAccess("pegawai", 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess("pegawai", 'u')) 
        $button .= '{update} ';    
   
    $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills',
    'items'=>array(       
        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('cariRiwayatPendidikanExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
    ),
));
    ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pangkat-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{items}{pager}{summary}',
        'filter'=>$model,
	'columns'=>array(
         array(
            'name' => 'id',
            'value' => '$data->Pegawai->nip',
            'htmlOptions' => array('style' => 'text-align: left;')
        ), 
		array(
            'name' => 'pegawai_id',
            'value' => '$data->pegawai',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),   
        array(
            'name' => 'jenjang_pendidikan',
            'value' => '$data->jenjang_pendidikan',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),  
        array(
            'name' => 'id_jurusan',
            'value' => '$data->jurusanPegawai',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),  	
        		
        array(
            'name' => 'nama_sekolah',
            'value' => '$data->nama_sekolah',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),      
        
        array(
            'name' => 'alamat_sekolah',
            'value' => '$data->alamat_sekolah',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),      
        
        array(
            'name' => 'tahun',
            'value' => '$data->tahun',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),    
	
		
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => $button,
			'buttons' => array(
			      'view' => array(
					'label'=> 'Lihat',	
					'url'=>'Yii::app()->createUrl("pegawai/view", array("id"=>$data->pegawai_id))',				
					'options'=>array(
						'class'=>'btn btn-small view'
					)
				),	
                              'update' => array(
					'label'=> 'Edit',
					'url'=>'Yii::app()->createUrl("pegawai/update", array("id"=>$data->pegawai_id))',
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
            'htmlOptions'=>array('style'=>'width: 80px;text-align:center'),
           )
	),
));
 ?>

<style type="text/css">	
	#Jabatan_id{
		display: none;
	}
</style>