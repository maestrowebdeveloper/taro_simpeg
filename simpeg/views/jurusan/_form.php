<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'jurusan-form',
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
        <?php
        echo $form->radioButtonListRow($model, 'tingkat', Pegawai::model()->ArrJenjangPendidikan());
        ?>


        <?php // echo $form->textFieldRow($model,'id_universitas',array('class'=>'span5')); ?>

        <?php echo $form->textFieldRow($model, 'Name', array('class' => 'span5', 'maxlength' => 255)); ?>


            <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'icon' => 'ok white',
                    'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
                ));
                ?>
            </div>
<?php } ?>    </fieldset>

<?php $this->endWidget(); ?>

</div>
