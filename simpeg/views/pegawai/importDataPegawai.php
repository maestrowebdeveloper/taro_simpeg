<div class="form">
    <?php

    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    }

    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'User-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
<div class="well">
	<?php echo $form->fileFieldRow($model, 'modified', array('class' => 'span3')); ?>
</div>
<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'upload white',
        'label' => $model->isNewRecord ? 'Upload' : 'Simpan',
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'reset',
        'icon' => 'remove',
        'label' => 'Reset',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>

</div>
