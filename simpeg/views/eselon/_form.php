<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'eselon-form',
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


                                    <?php echo $form->textFieldRow($model,'nama',array('class'=>'span5','maxlength'=>150)); ?>

                                        <?php echo $form->textAreaRow($model,'keterangan',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

                                        <?php echo $form->textFieldRow($model,'level',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'lft',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'rgt',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'root',array('class'=>'span5','maxlength'=>50)); ?>

                                        <?php echo $form->textFieldRow($model,'parent_id',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'created_user_id',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'modified',array('class'=>'span5')); ?>

                    
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
