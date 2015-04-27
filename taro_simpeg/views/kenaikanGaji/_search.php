<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-kenaikan-gaji-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>


        <?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'pegawai_id',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'nomor_register',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'sifat',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'perihal',array('class'=>'span5','maxlength'=>255)); ?>

        <?php echo $form->textFieldRow($model,'gaji_pokok_lama',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'gaji_pokok_baru',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'pejabat',array('class'=>'span5','maxlength'=>100)); ?>

        <?php echo $form->textFieldRow($model,'tanggal',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'tmt',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'created',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model,'created_user_id',array('class'=>'span5')); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-kenaikan-gaji-form").each(function() {
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

