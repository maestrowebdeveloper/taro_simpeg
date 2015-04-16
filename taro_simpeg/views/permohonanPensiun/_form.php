<?php if (isset($_GET['v'])) { ?>
    <div class="alert alert-info">
        <label class="radio">
            <input id="viewTab" value="PNS" checked="checked" name="view" type="radio">
            <label for="viewTab">View Form</label></label>
        <label class="radio"><input id="viewFull" name="view" type="radio">
            <label for="viewFull">View Print Out</label></label>
    </div>

<?php } ?>
<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'permohonan-pensiun-form',
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

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
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
//        $data = array('0' => '- Pegawai -') + CHtml::listData(Pegawai::model()->listPegawai(), 'id', 'nipNama');
//        echo $form->select2Row($model, 'pegawai_id', array(
//            'asDropDownList' => true,
//            'data' => $data,
//            'events' => array('change' => 'js: function() {
//                        $.ajax({
//                           url : "' . url('pegawai/getDetail') . '",
//                           type : "POST",
//                           data :  { id:  $(this).val()},
//                           success : function(data){                                                                                                                                           
//                            obj = JSON.parse(data);                            
//                            $("#PermohonanPensiun_unit_kerja_id").val(obj.unit_kerja);                           
//                            $("#PermohonanPensiun_tipe_jabatan").val(obj.tipe_jabatan);                           
//                            $("#PermohonanPensiun_jabatan_struktural_id").val(obj.jabatan);                           
//                            $("#PermohonanPensiun_masa_kerja").val(obj.masa_kerja);                           
//                        }
//                    });
//                }'),
//            'options' => array(
//                "allowClear" => false,
//                'width' => '40%',
//            ))
//        );

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

        <?php echo $form->textFieldRow($model, 'unit_kerja_id', array('class' => 'span5', 'readOnly' => true)); ?>

        <?php echo $form->textFieldRow($model, 'tipe_jabatan', array('class' => 'span5', 'maxlength' => 19, 'readOnly' => true)); ?>

        <?php echo $form->textFieldRow($model, 'jabatan_struktural_id', array('class' => 'span5', 'readOnly' => true)); ?>

        <?php echo $form->textFieldRow($model, 'masa_kerja', array('class' => 'span5', 'maxlength' => 50, 'readOnly' => true)); ?>

        <?php
        echo $form->datepickerRow(
                $model, 'tmt', array(
            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        ?>

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




    <?php if (isset($_GET['v'])) { ?>
    <div class="surat" id="surat" style="display:none">
        <?php
        $siteConfig = SiteConfig::model()->listSiteConfig();
        $content = $siteConfig->format_pensiun;

        $content = str_replace('{nomor}', $model->nomor_register, $content);
        $content = str_replace('{tanggal}', $model->tanggal, $content);
        $content = str_replace('{nip}', $model->Pegawai->nip, $content);
        $content = str_replace('{pangkat}', $model->Pegawai->golongan, $content);
        $content = str_replace('{ttl}', $model->Pegawai->ttl, $content);
        $content = str_replace('{nama}', $model->pegawai, $content);
        $content = str_replace('{unit_kerja}', $model->Pegawai->unitKerja, $content);
        $content = str_replace('{jabatan}', $model->Pegawai->jabatan, $content);
        $content = str_replace('{masa_kerja}', $model->masa_kerja, $content);
        $content = str_replace('{tmt}', date('d F Y', strtotime($model->tmt)), $content);
        echo $content;
        ?>
    </div>
<?php } ?>



<style type="text/css">
    td{
        vertical-align: top !important;
    }
</style>
<script>
    $("#PermohonanPensiun_pegawai_id").on("change", function() {
        //var name = $("#Registration_guest_user_id").val();
        //  alert(name);

        $.ajax({
            url: "<?php echo url('pegawai/getDetail'); ?>",
            type: "POST",
            data: {id: $(this).val()},
            success: function(data) {

                obj = JSON.parse(data);
                $("#PermohonanPensiun_unit_kerja_id").val(obj.unit_kerja);
                $("#PermohonanPensiun_tipe_jabatan").val(obj.tipe_jabatan);
                $("#PermohonanPensiun_jabatan_struktural_id").val(obj.jabatan);
                $("#PermohonanPensiun_masa_kerja").val(obj.masa_kerja);
            }
        });
    })

    $("#viewTab").click(function() {
        $(".surat").hide();
        $(".form").show();
    });

    $("#viewFull").click(function() {
        $(".surat").show();
        $(".form").hide();
    });



    function printDiv(divName)
    {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        $("#myTab a").click(function(e) {
            e.preventDefault();
            $(this).tab("show");
        })
        $("#viewTab").click(function() {
            $(".surat").hide();
            $(".form").show();
        });

        $("#viewFull").click(function() {
            $(".surat").show();
            $(".form").hide();
        });


    }
</script>