<?php
$this->setPageTitle('Pencarian Pegawai Berdasarkan Riwayat Jabatan');
$this->breadcrumbs=array(
	'Pencarian Pegawai Berdasarkan Riwayat Jabatan',
);

	$button = "";     
	if (landa()->checkAccess("pegawai", 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess("pegawai", 'u')) 
        $button .= '{update} ';    


$this->widget('bootstrap.widgets.TbMenu', array(
    'type'=>'pills',
    'items'=>array(       
        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('cariRiwayatJabatanExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
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
            'name' => 'tipe_jabatan',
            'value' => '$data->tipe',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),  
        array(
            'name' => 'jabatan',
            'header' => 'Jabatan',
            'value' => '$data->jabatan',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),  	
        		
//        array(
//            'name' => 'jabatan_fu_id',
//            'value' => '$data->jabatanFu',
//            'htmlOptions' => array('style' => 'text-align: left;')
//        ),      
//        
//        array(
//            'name' => 'jabatan_ft_id',
//            'value' => '$data->jabatanFt',
//            'htmlOptions' => array('style' => 'text-align: left;')
//        ),      
//        
//        array(
//            'name' => 'tmt_mulai',
//            'value' => '$data->tmt_mulai',
//            'htmlOptions' => array('style' => 'text-align: left;')
//        ),    
	
		
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