<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-transfer-cpns-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'pegawai_id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'nomor_kesehatan',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'tanggal_kesehatan',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'pelatihan_id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'nomor_diklat',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'tanggal_diklat',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-transfer-cpns-form").each(function() {
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

