<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-jabatan-struktural-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>

<div class="control-group ">
    <label class="control-label">Satuan Kerja <span class="required">*</span></label>
    <div class="controls">
        <?php
        $data = array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
        $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => 'JabatanStruktural[unit_kerja_id]',
            'data' => $data,
            'value' => $model->unit_kerja_id,
            'options' => array(
                'width' => '40%;margin:0px;text-align:left',
        )));
        ?>                
    </div>
</div>
<div class="control-group">
    <label class="control-label">Eselon<span class="required">*</span></label>
    <div class="controls">
        <?php
        $data = array('0' => '- Eselon -') + CHtml::listData(Eselon::model()->findAll(array('order' => 'nama')), 'id', 'nama');
        $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => 'JabatanStruktural[eselon_id]',
            'data' => $data,
            'value' => $model->eselon_id,
            'options' => array(
                'width' => '40%;margin:0px;text-align:left',
        )));
        ?>                 
    </div>
</div>

    <?php echo $form->textFieldRow($model, 'nama', array('class' => 'span5', 'maxlength' => 150)); ?>
<div class="form-actions">
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>
</div>

<?php $this->endWidget(); ?>



