<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-permohonan-perpanjangan-honorer-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>


<?php echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span5', 'maxlength' => 225)); ?>

<?php
echo $form->datepickerRow(
        $model, 'tanggal', array(
    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
    'prepend' => '<i class="icon-calendar"></i>'
        )
);

$idpegawai = isset($model->honorer_id) ? $model->honorer_id : 0;
$pegawaiName = isset($model->Honorer->nama) ? $model->Honorer->nama : 0;
echo $form->select2Row($model, 'honorer_id', array(
    'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Pegawai->nama,
    'options' => array(
        'placeholder' => t('choose', 'global'),
        'allowClear' => true,
        'width' => '300px',
        'minimumInputLength' => '3',
        'ajax' => array(
            'url' => Yii::app()->createUrl('honorer/getListHonorer'),
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


echo $form->datepickerRow(
        $model, 'tmt_mulai', array(
    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
    'prepend' => '<i class="icon-calendar"></i>'
        )
);

echo $form->datepickerRow(
        $model, 'tmt_selesai', array(
    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
    'prepend' => '<i class="icon-calendar"></i>'
        )
);

echo $form->radioButtonListRow($model, 'status', PermohonanPerpanjanganHonorer::model()->ArrStatus());
?>
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
        document.getElementById("search-permohonan-perpanjangan-honorer-form").action = "<?php echo Yii::app()->createUrl('permohonanPerpanjanganHonorer/GenerateExcel'); ?>";
        document.getElementById("search-permohonan-perpanjangan-honorer-form").submit();

    }
</script>

