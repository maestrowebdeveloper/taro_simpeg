<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'jabatan-struktural-form',
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
                        $data= array('0' => '- Parent -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');                            
                        $this->widget(
                                    'bootstrap.widgets.TbSelect2', array(      
                                        'name' => 'JabatanStruktural[parent_id]',
                                        'data' => $data,
                                        'value'=>$model->parent_id,
                                        'options' => array(
                                            'width' => '40%;margin:0px;text-align:left',
                                            )));
                    ?>                
            </div>
        </div>
        
        <div class="control-group ">
            <label class="control-label">Unit Kerja <span class="required">*</span></label>
            <div class="controls">
                <?php 
                    $data= array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');                            
                    $this->widget(
                                'bootstrap.widgets.TbSelect2', array(      
                                    'name' => 'JabatanStruktural[unit_kerja_id]',
                                    'data' => $data,
                                    'value'=>$model->unit_kerja_id,
                                    'options' => array(
                                        'width' => '40%;margin:0px;text-align:left',
                                        )));
                ?>                
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Eselon<span class="required">*</span></label>
            <div class="controls">
                <?php 
                    $data= array('0' => '- Eselon -') + CHtml::listData(Eselon::model()->findAll(array('order' => 'nama')), 'id', 'nama');                            
                    $this->widget(
                                'bootstrap.widgets.TbSelect2', array(      
                                    'name' => 'JabatanStruktural[eselon_id]',
                                    'data' => $data,
                                    'value'=>$model->eselon_id,
                                    'options' => array(
                                        'width' => '40%;margin:0px;text-align:left',
                                        )));
                ?>                 
            </div>
        </div>

                        <?php echo $form->textFieldRow($model,'nama',array('class'=>'span5','maxlength'=>150)); ?>

                            <?php echo $form->textAreaRow($model,'keterangan',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

                                      



                    
        <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white',  
			'label'=>$model->isNewRecord ? 'Tambah' : 'Simpan',
		)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
                        'icon'=>'remove',  
			'label'=>'Reset',
		)); ?>
        </div>
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>
