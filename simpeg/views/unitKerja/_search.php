<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-unit-kerja-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>

      

                    

   

        <?php echo $form->textFieldRow($model,'nama',array('class'=>'span4','maxlength'=>255)); ?>

        <?php echo $form->textAreaRow($model,'keterangan',array('rows'=>2, 'cols'=>50, 'class'=>'span6')); ?>

      

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
</div>

<?php $this->endWidget(); ?>

