<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'user-message-detail-form',
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

        <div class="control-group">

            <label class="control-label">To</label>
            <div class="controls">
                <?php
                $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => TRUE,
                    'data' => CHtml::listData(User::model()->findAll(array('order' => 'name', 'condition' => 'id <>' . app()->user->id)), 'id', 'name'),
                    'name' => 'receiver_user_ids',
                    'options' => array(
                        'placeholder' => yii::t('global', 'choose'),
                        'width' => '80%',
                        'tokenSeparators' => array(',', ' ')
                    ),
                    'htmlOptions' => array(
//                        'multiple' => 'multiple',
                    )
                ));
                ?>
            </div>
        </div>

        <?php echo $form->ckEditorRow($model, 'message', array('options' => array('fullpage' => 'js:true'))); ?>

        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok white',
                'label' => $model->isNewRecord ? 'Kirim' : 'Simpan',
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
    </fieldset>

    <?php $this->endWidget(); ?>

</div>
