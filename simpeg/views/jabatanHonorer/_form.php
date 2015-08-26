<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'jabatan-honorer-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
	'type'=>'horizontal',
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	)
)); ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>

<div class="control-group ">
            <label class="control-label">Parent</label>
            <div class="controls">
                    <?php 
                        $data= array('0' => '- Parent -') + CHtml::listData(JabatanHonorer::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');                            
                        $this->widget(
                                    'bootstrap.widgets.TbSelect2', array(      
                                        'name' => 'JabatanHonorer[parent_id]',
                                        'data' => $data,
                                        'value'=>$model->parent_id,
                                        'options' => array(
                                            'width' => '40%;margin:0px;text-align:left',
                                            )));
                    ?>                
            </div>
        </div>

        <?php echo $form->textFieldRow($model,'nama',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textAreaRow($model,'keterangan',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
                    
        <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white',  
			'label'=>$model->isNewRecord ? 'Tambah' : 'Simpan',
		)); ?>
        </div>
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>
