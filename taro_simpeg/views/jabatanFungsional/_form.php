<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'jabatan-fungsional-form',
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
            <p class="neote">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
        <div class="control-group ">
            <label class="control-label" for="JabatanFungsional_jabatan_ft_id">Jabatan</label>
            <div class="controls">
                <?php
                $data = array('0' => '- Choose -') + CHtml::listData(JabatanFt::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                $this->widget(
                        'bootstrap.widgets.TbSelect2', array(
                    'name' => 'JabatanFungsional[jabatan_ft_id]',
                    'data' => $data,
                    'value' => $model->jabatan_ft_id,
                    'options' => array(
                        'width' => '50%;margin:0px;text-align:left',
                )));
                ?>    
            </div>
        </div>
        <?php
        //echo $form->checkBoxListRow($model, 'golongan_id', CHtml::listData(Golongan::model()->findAll(array('order' => 'root, lft')), 'id', 'nama'));
                
        ?>
        <div class="control-group "><label class="control-label" for="JabatanFungsional_golongan_id">Golongan</label>
            <div class="controls">
                
                <?php echo CHtml::checkBoxList('golongan_id', '', CHtml::listData(Golongan::model()->findAll(array('order' => 'root, lft')), 'id', 'nama'), array('class' => 'radio','separator' => '','style'=>'margin-bottom:5px;')); ?>
            </div>
        </div>

        <?php echo $form->textFieldRow($model, 'nama', array('class' => 'span5', 'maxlength' => 30)); ?>

        <?php echo $form->textAreaRow($model, 'keterangan', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

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
<style>
            input[type=checkbox]{
                display: none;
            }
            input[type=checkbox]:checked + label {
                display: inline-block;
                background-image: none;
                outline: 0;
                -webkit-box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
                -moz-box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
                box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05);
                background-color: #e0e0e0;
            }
            input[type=checkbox] + label {
                display: inline-block;
                margin-right: 10px;
                padding: 4px 12px;
                margin-bottom: 20;
                font-size: 14px;
                line-height: 20px;
                color: #333;
                text-align: center;
                text-shadow: 0 1px 1px rgba(255,255,255,0.75);
                vertical-align: middle;
                cursor: pointer;
                background-color: #f5f5f5;
                background-image: -moz-linear-gradient(top,#fff,#e6e6e6);
                background-image: -webkit-gradient(linear,0 0,0 100%,from(#fff),to(#e6e6e6));
                background-image: -webkit-linear-gradient(top,#fff,#e6e6e6);
                background-image: -o-linear-gradient(top,#fff,#e6e6e6);
                background-image: linear-gradient(to bottom,#fff,#e6e6e6);
                background-repeat: repeat-x;
                border: 1px solid #ccc;
                border-color: #e6e6e6 #e6e6e6 #bfbfbf;
                border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
                border-bottom-color: #b3b3b3;
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffffff',endColorstr='#ffe6e6e6',GradientType=0);
                filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
                -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
                -moz-box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
                box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
            }
        </style>