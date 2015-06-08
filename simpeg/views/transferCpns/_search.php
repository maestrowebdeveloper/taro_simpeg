<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-transfer-cpns-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>


<div class="row-fluid">
    <div class="span5">

        <?php
        $idpegawai = isset($model->pegawai_id) ? $model->pegawai_id : 0;
        $pegawaiName = isset($model->Pegawai->nama) ? $model->Pegawai->nama : '';
        echo $form->select2Row($model, 'pegawai_id', array(
            'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Pegawai->nama,
            'options' => array(
                'placeholder' => t('choose', 'global'),
                'allowClear' => true,
                'width' => '300px',
                'minimumInputLength' => '3',
                'ajax' => array(
                    'url' => Yii::app()->createUrl('pegawai/getListPegawaicpns'),
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

        <?php echo $form->textFieldRow($model, 'nomor_kesehatan', array('class' => 'span7')); ?>
        <?php
        echo $form->datepickerRow(
                $model, 'tanggal_kesehatan', array(
            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        ?>

    </div><div class="span5">


        <?php echo $form->textFieldRow($model, 'nomor_diklat', array('class' => 'span7')); ?>
        <?php echo $form->textFieldRow($model, 'tanggal_diklat', array('class' => 'angka span3')); ?>

    </div></div>
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
            $(":input", "#search-transfer-cpns-form").each(function () {
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
        document.getElementById("search-transfer-cpns-form").action = "<?php echo Yii::app()->createUrl('tansferCpns/GenerateExcel'); ?>";
        document.getElementById("search-transfer-cpns-form").submit();

    }
</script>

