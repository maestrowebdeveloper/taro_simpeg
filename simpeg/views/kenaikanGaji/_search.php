<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-kenaikan-gaji-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
));  ?>

<div class="row-fluid">
            <div class="span5">

                <?php echo $form->textFieldRow($model, 'nomor_register', array('class' => '6','maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'sifat', array('class' => 'span6', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'perihal', array('class' => 'span6', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'pejabat', array('class' => 'span6', 'maxlength' => 100)); ?>

            </div>
            <div class="span5">

                <?php echo $form->textFieldRow($model, 'gaji_pokok_lama', array('class' => 'angka span12', 'prepend' =>'Rp')); ?>

                <?php echo $form->textFieldRow($model, 'gaji_pokok_baru', array('class' => 'angka span12', 'prepend' =>'Rp')); ?>

                <?php
                echo $form->datepickerRow(
                        $model, 'tanggal', array(
                    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                    'prepend' => '<i class="icon-calendar"></i>'
                        )
                );
                ?>

                <?php
                echo $form->datepickerRow(
                        $model, 'tmt', array(
                    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                    'prepend' => '<i class="icon-calendar"></i>'
                        )
                );
                ?>
            </div></div>

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

