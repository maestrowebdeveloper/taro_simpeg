<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-notification-form',
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
        		
   <div class="control-group">		
			<div class="span4">

	<div class="control-group">

		<label class="control-label">User</label>
			<div class="controls">
				<?php
				$this->widget('bootstrap.widgets.TbSelect2', array(
		            'asDropDownList' => TRUE,
		            'data' => CHtml::listData(User::model()->findAll(), 'id', 'name'),
		            'name' => 'UserNotification[receiver_user_id]',
		            'options' => array(
                                'placeholder' => yii::t('global', 'choose'),
                                'width' => '100%',
                                'tokenSeparators' => array(',', ' ')
                            ),
                            'htmlOptions' => array(
                                'multiple' => 'multiple',
                            )
                        ));
                        ?>
			</div>
	</div>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->ckEditorRow($model,'message',array('options' => array('fullpage' => 'js:true', 'width' => '640', 'resize_maxWidth' => '640', 'resize_minWidth' => '320'))); ?>

	
	

            </div>   
  </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white',  
			'label'=>$model->isNewRecord ? 'Create' : 'Simpan',
		)); ?>
              <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
                        'icon'=>'remove',  
			'label'=>'Reset',
		)); ?>
	</div>
</fieldset>

<?php $this->endWidget(); ?>

</div>
