<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'kenaikan-gaji-form',
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


                                    <?php echo $form->textFieldRow($model,'pegawai_id',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'nomor_register',array('class'=>'span5','maxlength'=>255)); ?>

                                        <?php echo $form->textFieldRow($model,'sifat',array('class'=>'span5','maxlength'=>255)); ?>

                                        <?php echo $form->textFieldRow($model,'perihal',array('class'=>'span5','maxlength'=>255)); ?>

                                        <?php echo $form->textFieldRow($model,'gaji_pokok_lama',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'gaji_pokok_baru',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'pejabat',array('class'=>'span5','maxlength'=>100)); ?>

                                        <?php echo $form->textFieldRow($model,'tanggal',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'tmt',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

                                        <?php echo $form->textFieldRow($model,'created_user_id',array('class'=>'span5')); ?>

                    
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
