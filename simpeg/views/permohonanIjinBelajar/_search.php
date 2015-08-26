<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-permohonan-ijin-belajar-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>

<?php echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span5', 'maxlength' => 225)); ?>
<?php // echo $form->textFieldRow($model, 'nama', array('class' => 'span5', 'maxlength' => 225)); ?>

<?php
echo $form->datepickerRow(
        $model, 'tanggal', array(
    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
    'prepend' => '<i class="icon-calendar"></i>'
        )
);
echo $form->radioButtonListRow($model, 'status', PermohonanIjinBelajar::model()->ArrStatuspros());
$idpegawai = isset($model->pegawai_id) ? $model->pegawai_id : 0;
$pegawaiName = isset($model->Pegawai->nama) ? $model->Pegawai->nama : '';
echo $form->select2Row($model, 'pegawai_id', array(
    'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Pegawai->nama,
    'options' => array(
        'placeholder' => t('choose', 'global'),
        'allowClear' => true,
        'width' => '400px',
        'minimumInputLength' => '3',
        'ajax' => array(
            'url' => Yii::app()->createUrl('pegawai/getListPegawai'),
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
                               callback({id: ' . $idpegawai . ', text: "' . $pegawaiName . '" });
                            
                                  
                            }',
    ),
        )
);


echo $form->radioButtonListRow($model, 'jenjang_pendidikan', Pegawai::model()->ArrJenjangPendidikan());
?>
<div class="control-group "><label class="control-label" for="Honorer_tmt_akhir_kontrak">Tanggal</label>
    <div class="controls">
        <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
            <?php
            $this->widget(
                    'bootstrap.widgets.TbDatePicker', array(
                'name' => 'PermohonanIjinBelajar[tanggal_usul]',
                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                'value' => $model->tanggal,
                    )
            );
            ?>
        </div>
        S/D
        <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
            <?php
            $this->widget(
                    'bootstrap.widgets.TbDatePicker', array(
                'name' => 'PermohonanIjinBelajar[created]',
                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                'value' => $model->created,
                    )
            );
            ?>
        </div>

    </div>
</div>



<?php // echo $form->textFieldRow($model, 'jurusan', array('class' => 'span5', 'maxlength' => 225));  ?>

<?php // echo $form->textFieldRow($model, 'nama_sekolah', array('class' => 'span5', 'maxlength' => 225));  ?>


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
        document.getElementById("search-permohonan-ijin-belajar-form").action = "<?php echo Yii::app()->createUrl('permohonanIjinBelajar/GenerateExcel'); ?>";
        document.getElementById("search-permohonan-ijin-belajar-form").submit();

    }
</script>
