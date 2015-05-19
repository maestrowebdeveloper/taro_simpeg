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
?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'icon', 'label' => 'Export Excel',
        'htmlOptions' => array(
            'onclick' => 'excel()'
    )));
    ?> 
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'button', 'icon' => 'icon-remove-sign white', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function ($) {
        $(".btnreset").click(function () {
            $(":input", "#search-permohonan-perpanjangan-honorer-form").each(function () {
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

    function excel() {
        var noregister = $('#PermohonanPerpanjanganHonorer_nomor_register').val();
        var tanggal = $('#PermohonanPerpanjanganHonorer_tanggal').val();
        var honorer_id = $('#PermohonanPerpanjanganHonorer_honorer_id').val();
        var tmt_mulai = $('#PermohonanPerpanjanganHonorer_tmt_mulai').val();
        var tmt_selesai = $('#PermohonanPerpanjanganHonorer_tmt_selesai').val();
        
        window.open("<?php  echo url('permohonanPerpanjanganHonorer/GenerateExcel')?>?noregister="+noregister+"&tanggal="+tanggal+"&honorer_id="+honorer_id+"&tmt_mulai="+tmt_mulai+"&tmt_selesai="+tmt_selesai);
    }
</script>

