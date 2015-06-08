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

    
</script>

<script type="text/javascript">
     function chgAction()
    {
        document.getElementById("search-permohonan-mutasi-form").action = "<?php echo Yii::app()->createUrl('permohonanMutasi/GenerateExcel'); ?>";
        document.getElementById("search-permohonan-mutasi-form").submit();

    }
    </script>