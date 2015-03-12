<?php
$this->setPageTitle('Site Config');
$this->breadcrumbs=array(
	'Site Config',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('site-config-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
		//
		//
	),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'site-config-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{items}{pager}{summary}',
	'columns'=>array(
		'id',
		'client_name',
		'client_logo',
		'city_id',
		'address',
		'phone',
		/*
		'email',
		*/
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => $button,
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
            'htmlOptions'=>array('style'=>'width: 125px;text-align:center'),
           )
	),
)); ?>

