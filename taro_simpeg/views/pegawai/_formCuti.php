<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'cuti-detail-form',
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

        <?php
        echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12'));
        $model->pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : $model->pegawai_id;
        echo $form->hiddenField($model, 'id');
        echo $form->hiddenField($model, 'pegawai_id');
        ?>
        <?php
//        $data= array('0' => '- Hukuman -') + CHtml::listData(Hukuman::model()->findAll(), 'id', 'nama');                            
//        echo $form->select2Row($model, 'hukuman_id', array(
//            'asDropDownList' => true,                    
//            'data' => $data,    
//            'options' => array(                        
//                "allowClear" => false,
//                'width' => '40%',
//            ))
//        );
        ?>
        <?php
        echo $form->textFieldRow($model, 'jenis_cuti', array('class' => 'span3', 'maxlength' => 255));
        echo $form->textFieldRow($model, 'no_sk', array('class' => 'span3', 'maxlength' => 255));
        echo $form->datepickerRow(
                $model, 'tanggal_sk', array(
            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        echo $form->textFieldRow($model, 'pejabat', array('class' => 'span3', 'maxlength' => 255));
        ?>
        <div class="control-group ">
            <label class="control-label" for="RiwayatCuti_tanggal_sk">Lama Cuti</label>
            <div class="controls">
                <?php
                $mulai ='';
                $selesai ='';
                if(isset($model->mulai_cuti)){
                    $mulai = date('Y-m-d', strtotime($model->mulai_cuti));
                }
                
                if(isset($model->mulai_cuti)){
                    $selesai = date('Y-m-d', strtotime($model->selesai_cuti));
                }
                ?>
                <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input type="text" autocomplete="off" name="RiwayatCuti[mulai_cuti]" value="<?php echo $mulai ?>" id="RiwayatCuti_mulai_cuti">
                </div> S/D
                <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input type="text" autocomplete="off" name="RiwayatCuti[selesai_cuti]" value="<?php echo $selesai ?>" id="RiwayatCuti_selesai_cuti">
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a class="btn btn-primary saveCuti"><i class="icon-ok icon-white"></i> Simpan</a>
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


<script>
    jQuery(function($) {
        jQuery('#RiwayatCuti_tanggal_sk').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
        jQuery('#RiwayatCuti_mulai_cuti').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
        jQuery('#RiwayatCuti_selesai_cuti').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
//    jQuery('#RiwayatHukuman_hukuman_id').select2({'width':'50%'});      
    });
    $(".saveCuti").click(function() {
        var postData = $("#cuti-detail-form").serialize();
        $.ajax({
            url: "<?php echo url('pegawai/saveCuti'); ?>",
            data: postData,
            type: "post",
            success: function(data) {
                if (data != "") {
                    $("#tableCuti").replaceWith(data);
                    $("#modalForm").modal("hide");
                } else {
                    alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
                }
            },
            error: function(data) {
                alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            },
        });

    });
</script>