<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-kedudukan-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'nama',array('class'=>'span5','maxlength'=>100)); ?>

        <?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'creted_user_id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'modified',array('class'=>'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>    
</div>

<?php $this->endWidget(); ?>
