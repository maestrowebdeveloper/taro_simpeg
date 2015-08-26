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

                            </div></div>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
</div>

<?php $this->endWidget(); ?>
