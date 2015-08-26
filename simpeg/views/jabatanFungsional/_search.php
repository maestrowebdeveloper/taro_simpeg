<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-jabatan-fungsional-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        

        <?php echo $form->textFieldRow($model,'nama',array('class'=>'span5','maxlength'=>30)); ?>

        

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
</div>

<?php $this->endWidget(); ?>


