<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'user-message-form',
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
            <label class="control-label">User</label>
            <div class="controls">
                <?php
                $this->widget('bootstrap.widgets.TbSelect2', array(
                    'asDropDownList' => TRUE,
                    'data' => CHtml::listData(User::model()->findAll(), 'id', 'name'),
                    'name' => 'UserMessage[receiver_user_id]',
                    'options' => array(
                        'placeholder' => yii::t('global', 'choose'),
                        'width' => '100%',
                        'tokenSeparators' => array(',', ' ')
                    ),
                ));
                ?>
            </div>
        </div>

        <?php echo $form->textFieldRow($model, 'last_date', array('class' => 'span5')); ?>

        <?php echo $form->textFieldRow($model, 'count_messages', array('class' => 'span5', 'maxlength' => 3)); ?>

        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok white',
                'label' => $model->isNewRecord ? 'Create' : 'Simpan',
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
