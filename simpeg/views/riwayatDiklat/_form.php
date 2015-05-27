<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'riwayat-diklat-form',
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

                                        <?php echo $form->textFieldRow($model,'nama',array('class'=>'span5','maxlength'=>255)); ?>

                                        <?php echo $form->textFieldRow($model,'nama_pelatihan',array('class'=>'span5','maxlength'=>255)); ?>

                                        <?php echo $form->textFieldRow($model,'penyelenggara',array('class'=>'span5','maxlength'=>255)); ?>

                                        <?php echo $form->textFieldRow($model,'tahun',array('class'=>'span5','maxlength'=>255)); ?>

                    
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
