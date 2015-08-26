<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-honorer-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>
<div class="row-fluid">
    <div class="span6">
        <?php
        echo $form->textFieldRow($model, 'no_reg', array('class' => 'span5', 'maxlength' => 100));
        echo $form->textFieldRow($model, 'nama', array('class' => 'span5', 'maxlength' => 100));

        $idpendidikan = isset($model->Jurusan->id) ? $model->Jurusan->id : 0;
        $pendidikan = isset($model->Jurusan->Name) ? $model->Jurusan->Name : '';
        echo $form->select2Row($model, 'id_jurusan', array(
            'asDropDownList' => false,
            'options' => array(
                'placeholder' => t('choose', 'global'),
                'allowClear' => true,
                'width' => '400px',
                'minimumInputLength' => '3',
                'ajax' => array(
                    'url' => Yii::app()->createUrl('pegawai/getJurusanTingkat'),
                    'dataType' => 'json',
                    'data' => 'js:function(term, page) { 
                                                        return {
                                                            q: term 
                                                        }; 
                                                    }',
                    'results' => 'js:function(data) { 
                                                        return {
                                                            results: data
                                                            
                                                        };
                                                    }',
                ),
                'initSelection' => 'js:function(element, callback) 
                            { 
                            callback({id: ' . $idpendidikan . ', text: "' . $pendidikan . '" });
                             
                                  
                                  
                            }',
            ),
                )
        );
        $data = array('0' => '- Kedudukan -') + array('20' => '20 : Tidak Aktif', '40' => '40 : Aktif');
        echo $form->select2Row($model, 'kode', array(
            'asDropDownList' => true,
            'data' => $data,
            'options' => array(
                "allowClear" => false,
                'width' => '40%',
            ))
        );
        ?>              
        <div class="control-group "><label class="control-label" for="Honorer_pendidikan_terakhir">Pendidikan</label>
            <div class="controls">
                <input class="span2 angka" maxlength="4" value="<?php echo $model->tahun_pendidikan; ?>" name="Honorer[tahun_pendidikan]" id="Honorer_tahun_pendidikan" placeHolder="Tahun" type="text">
            </div>
        </div>

        <?php
        echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin());
        echo $form->dropDownListRow($model, 'agama', Pegawai::model()->ArrAgama(), array('empty' => '- Agama -'));
        ?>
        <div class="control-group ">
            <label class="control-label required" for="Honorer_nama">Tahun Lahir </label>
            <div class="controls"><input class="span4 angka" maxlength="100" name="Honorer[gaji]" id="Honorer_nama" type="text">
            </div>
        </div>
    </div>
    <div class="span6">
        <?php
        echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span4 angka', 'style' => 'max-width:500px;width:300px', 'maxlength' => 18));

        $data = array('0' => '- Unit Kerja -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
        echo $form->select2Row($model, 'jabatan_struktural_id', array(
            'asDropDownList' => true,
            'data' => $data,
            'options' => array(
                "allowClear" => false,
                'width' => '100%',
            ))
        );
        $data = array('0' => '- Jabatan -') + CHtml::listData(JabatanFu::model()->findAll(array('order' => 'id')), 'id', 'nama');
        echo $form->select2Row($model, 'jabatan_fu_id', array(
            'asDropDownList' => true,
            'data' => $data,
            'options' => array(
                "allowClear" => false,
                'width' => '100%',
            ))
        );
        ?>
    </div>
</div>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'button',
        'type' => 'primary',
        'icon' => 'ok white',
        'label' => 'Export ke Excel',
        'htmlOptions' => array(
            'name' => 'export',
            'onClick' => 'chgAction()',
        )
    ));
    ?>


</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">

    function chgAction()
    {
        document.getElementById("search-honorer-form").action = "<?php echo Yii::app()->createUrl('honorer/GenerateExcel'); ?>";
        document.getElementById("search-honorer-form").submit();

    }
</script>
