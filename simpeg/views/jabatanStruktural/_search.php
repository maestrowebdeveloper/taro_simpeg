<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-jabatan-struktural-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>

<div class="control-group ">
    <label class="control-label">Parent</label>
    <div class="controls">
        <?php
        $data = array('0' => '- Parent -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
        $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => 'JabatanStruktural[parent_id]',
            'data' => $data,
            'value' => $model->parent_id,
            'options' => array(
                'width' => '40%;margin:0px;text-align:left',
        )));
        ?>                
    </div>
</div>
<div class="control-group ">
    <label class="control-label">Unit Kerja <span class="required">*</span></label>
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
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'button', 'icon' => 'icon-remove-sign white', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function ($) {
        $(".btnreset").click(function () {
            $(":input", "#search-jabatan-struktural-form").each(function () {
                var type = this.type;
                var tag = this.tagName.toLowerCase(); // normalize case
                if (type == "text" || type == "password" || tag == "textarea")
                    this.value = "";
                else if (type == "checkbox" || type == "radio")
                    this.checked = false;
                else if (tag == "select")
                    this.selectedIndex = "";
            });
        });
    })
</script>

