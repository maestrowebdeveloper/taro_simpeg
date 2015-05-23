<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-permohonan-pensiun-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>

<?php echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span3', 'maxlength' => 100)); ?>
<?php
echo $form->datepickerRow(
        $model, 'tanggal', array(
    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
    'prepend' => '<i class="icon-calendar"></i>'
        )
);
?>

<?php
$idpegawai = isset($model->pegawai_id) ? $model->pegawai_id : 0;
$pegawaiName = isset($model->Pegawai->nama) ? $model->Pegawai->nama : 0;
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

echo $form->datepickerRow(
        $model, 'tmt', array(
    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
    'prepend' => '<i class="icon-calendar"></i>'
        )
);

echo $form->radioButtonListRow($model, 'status', PermohonanPensiun::model()->ArrStatus());


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
            $(":input", "#search-permohonan-pensiun-form").each(function () {
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
        if (document.getElementById('PermohonanPensiun_status_0').checked) {
            var status = document.getElementById('PermohonanPensiun_status_0').value;
        }else
        if (document.getElementById('PermohonanPensiun_status_1').checked) {
            var status = document.getElementById('PermohonanPensiun_status_1').value;
        }else{
        
        }
        var noregister = $('#PermohonanPensiun_nomor_register').val();
        var tanggal = $('#PermohonanPensiun_tanggal').val();
        var pegawai_id = $('#PermohonanPensiun_pegawai_id').val();
        var tmt = $('#PermohonanPensiun_tmt').val();
        
        window.open("<?php  echo url('permohonanPensiun/GenerateExcel')?>?noregister="+noregister+"&status="+status+"&tanggal="+tanggal+"&pegawai_id="+pegawai_id+"&tmt="+tmt);
    }
</script>

