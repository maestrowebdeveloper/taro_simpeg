<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-jurusan-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php // echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

        <?php // echo $form->textFieldRow($model,'id_universitas',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'Name',array('class'=>'span5','maxlength'=>255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
</div>

<?php $this->endWidget(); ?>

