<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-permohonan-mutasi-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>

<?php echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span3', 'maxlength' => 100)); ?>


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
?>




<?php
$data = array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
echo $form->select2Row($model, 'new_unit_kerja_id', array(
    'asDropDownList' => true,
    'data' => $data,
    'options' => array(
        "allowClear" => false,
        'width' => '40%',
    ))
);
?>
<?php echo $form->radioButtonListRow($model, 'new_tipe_jabatan', Pegawai::model()->arrTipeJabatan()); ?>



<?php
$struktural = ($model->tipe_jabatan == "struktural") ? "" : "none";
$fu = ($model->tipe_jabatan == "fungsional_umum") ? "" : "none";
$ft = ($model->tipe_jabatan == "fungsional_tertentu") ? "" : "none";
?>

<div class="struktural" style="display:<?php echo $struktural; ?>">                               
    <?php
    $data = array('0' => '- Jabatan Struktural -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
    echo $form->select2Row($model, 'new_jabatan_struktural_id', array(
        'asDropDownList' => true,
        'data' => $data,
        'options' => array(
            "allowClear" => false,
            'width' => '50%',
        ))
    );
    ?>
</div>

<div class="fungsional_umum" style="display:<?php echo $fu; ?>">                                 
    <?php
    $data = array('0' => '- Jabatan Fungsional Umum -') + CHtml::listData(JabatanFu::model()->findAll(array('order' => 'id')), 'id', 'nama');
    echo $form->select2Row($model, 'new_jabatan_fu_id', array(
        'asDropDownList' => true,
        'data' => $data,
        'options' => array(
            "allowClear" => false,
            'width' => '50%',
        ))
    );
    ?>                            
</div>

<div class="fungsional_tertentu" style="display:<?php echo $ft; ?>">                                
    <?php
    $data = array('0' => '- Jabatan Fungsional Tertentu -') + CHtml::listData(JabatanFt::model()->findAll(array('order' => 'id')), 'id', 'nama');
    echo $form->select2Row($model, 'new_jabatan_ft_id', array(
        'asDropDownList' => true,
        'data' => $data,
        'options' => array(
            "allowClear" => false,
            'width' => '50%',
        ))
    );
    ?>                         
</div>







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
            $(":input", "#search-permohonan-mutasi-form").each(function () {
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
        if (document.getElementById('PermohonanMutasi_new_tipe_jabatan_0').checked) {
            var tipe_jabatan = document.getElementById('PermohonanMutasi_new_tipe_jabatan_0').value;
        } else if (document.getElementById('PermohonanMutasi_new_tipe_jabatan_1').checked) {
            var tipe_jabatan = document.getElementById('PermohonanMutasi_new_tipe_jabatan_1').value;
        } else if (document.getElementById('PermohonanMutasi_new_tipe_jabatan_2').checked) {
            var tipe_jabatan = document.getElementById('PermohonanMutasi_new_tipe_jabatan_2').value;
        } else {
            var tipe_jabatan = '';

        }

        var nomor_register = $('#PermohonanMutasi_nomor_register').val();
        var pegawai_id = $('#PermohonanMutasi_pegawai_id').val();
        var unit_kerja_id = $('#PermohonanMutasi_new_unit_kerja_id').val();
       // alert(tipe_jabatan);
        window.open("<?php echo url('permohonanMutasi/GenerateExcel')?>?nomor_register="+nomor_register+"&pegawai_id="+pegawai_id+"&tipe_jabatan="+tipe_jabatan+"&unit_kerja_id="+unit_kerja_id);
    }
</script>

