<?php
$this->setPageTitle('Pencarian Pegawai Berdasarkan Riwayat Keluarga');
$this->breadcrumbs=array(
	'Pencarian Pegawai Berdasarkan Riwayat Keluarga',
);

	$button = "";     
	if (landa()->checkAccess("pegawai", 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess("pegawai", 'u')) 
        $button .= '{update} ';    
      $this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills',
    'items'=>array(       
        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('cariRiwayatKeluargaExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
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
            'name' => 'hubungan',
            'value' => '$data->hubungan',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),  
        array(
            'name' => 'nama',
            'value' => '$data->nama',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),  	          
        
        array(
            'name' => 'pendidikan_terakhir',
            'value' => '$data->pendidikan_terakhir',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),   

        array(
            'name' => 'pekerjaan',
            'value' => '$data->pekerjaan',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),  

        array(
            'name' => 'nomor_karsu',
            'value' => '$data->nomorKarsu',
            'htmlOptions' => array('style' => 'text-align: left;')
        ), 

        array(
            'name' => 'tanggal_pernikahan',
            'value' => '$data->tanggalPernikahan',
            'htmlOptions' => array('style' => 'text-align: left;')
        ), 

        array(
            'name' => 'status',
            'value' => '$data->statusPernikahan',
            'htmlOptions' => array('style' => 'text-align: left;')
        ), 

        array(
            'name' => 'jenis_kelamin',
            'value' => '$data->jenis_kelamin',
            'htmlOptions' => array('style' => 'text-align: left;')
        ), 

         array(
            'name' => 'anak_ke',
            'value' => '$data->anakKe',
            'htmlOptions' => array('style' => 'text-align: left;')
        ), 

          array(
            'name' => 'status_anak',
            'value' => '$data->statusAnak',
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