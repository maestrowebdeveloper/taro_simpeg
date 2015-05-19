<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'kenaikan-gaji-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

        <div class="row-fluid">
            <div class="span5">

                <?php echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span12', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'sifat', array('class' => 'span12', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'perihal', array('class' => 'span12', 'maxlength' => 255)); ?>

                <?php echo $form->textFieldRow($model, 'pejabat', array('class' => 'span12', 'maxlength' => 100)); ?>

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


        <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'icon' => 'ok white',
                    'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
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
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>
