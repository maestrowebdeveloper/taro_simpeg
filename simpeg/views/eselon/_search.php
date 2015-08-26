<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-eselon-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

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

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
</div>

<?php $this->endWidget(); ?>


