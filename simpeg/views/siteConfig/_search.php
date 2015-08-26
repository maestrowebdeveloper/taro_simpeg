<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-site-config-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'client_name',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'client_logo',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>45)); ?>

        <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>45)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
</div>

<?php $this->endWidget(); ?>


<?php $cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap/jquery-ui.css');
?>	