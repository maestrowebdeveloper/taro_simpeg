<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'jabatan-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

        <?php
        $model->pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : $model->pegawai_id;
        echo $form->hiddenField($model, 'id');
        echo $form->hiddenField($model, 'pegawai_id');
        echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span4', 'maxlength' => 100));
        ?>
         <?php
        $idjabatanstruktural = (!empty($model->JabatanStruktural->id)) ? $model->JabatanStruktural->id : 0;
        $jabstruktural = (!empty($model->JabatanStruktural->nama)) ? $model->JabatanStruktural->nama  : 0;

        $id = 0;
        $pegawai_id = "hai";
        echo $form->select2Row($model, 'jabatan_struktural_id', array(
            'asDropDownList' => false,
                )
        );
        ?>
        <?php echo $form->radioButtonListRow($model, 'tipe_jabatan', Pegawai::model()->arrTipeJabatan()); ?>

        <?php
        $struktural = ($model->tipe_jabatan == "struktural") ? "" : "none";
        $fu = ($model->tipe_jabatan == "fungsional_umum") ? "" : "none";
        $ft = ($model->tipe_jabatan == "fungsional_tertentu") ? "" : "none";
        ?>
       
        <div class="struktural" style="display:<?php echo $struktural; ?>"> 

            <div class="control-group "><label class="control-label" for="RiwayatJabatan_jabatan_struktural_id">Jabatan / Tanggal </label>
                <div class="controls">
                    <input type="text" id="Riwayatjabatanasli" readonly="true" class="span4" value="<?php echo isset($model->JabatanStruktural->jabatan) ? $model->JabatanStruktural->jabatan : '-'; ?>">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'tmt_mulai_struktural',
                            'value' => $model->tmt_mulai,
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="control-group "><label class="control-label" for="eselon">Eselon</label>
                <div class="controls">
                    <input type="text" id="Riwayateselon" readonly="true" class="span4" value="<?php echo isset($model->JabatanStruktural->Eselon->nama) ? $model->JabatanStruktural->Eselon->nama : '-'; ?>">
                    <?php
                    echo '&nbsp;&nbsp;';
                    ?>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'RiwayatJabatan[tmt_eselon]',
                            'value' => str_replace("0000-00-00", "", $model->tmt_eselon),
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>
            <div class="control-group "><label class="control-label" for="eselon">No/Tanggal SK</label>
                <div class="controls">

                    <?php
                    echo CHtml::textField('RiwayatJabatan[no_sk_struktural]', isset($model->no_sk_struktural) ? $model->no_sk_struktural : '', array('class' => 'span4', 'placeholder' => 'No Sk Struktural'));
                    ?>
                    <div class="input-prepend" style="margin-right: 40px;">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'tanggal_sk_struktural',
                            'value' => str_replace("0000-00-00", "", $model->tanggal_sk_struktural),
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="fungsional_umum" style="display:<?php echo $fu; ?>">   

            <div class="control-group ">
                <label class="control-label" for="RiwayatJabatan_jabatan_fu_id">Jabatan</label>
                <div class="controls">
                    <?php
                    $data = array('0' => '- Jabatan Fungsional Umum -') + CHtml::listData(JabatanFu::model()->findAll(array('order' => 'nama')), 'id', 'nama');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'RiwayatJabatan[jabatan_fu_id]',
                        'value' => $model->jabatan_fu_id,
                        'data' => $data,
                        'options' => array(
                            'width' => '40%;margin:0px;text-align:left',
                    )));
                    echo '&nbsp;&nbsp;';
                    ?>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'tmt_mulai_fu',
                            'value' => str_replace("0000-00-00", "", $model->tmt_mulai),
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                )
                        );
                        ?>
                    </div>    
                </div>
            </div>

        </div>

        <div class="fungsional_tertentu" style="display:<?php echo $ft; ?>">
            
            <div class="control-group "><label class="control-label" for="RiwayatJabatan_jabatan_fu_id">Jabatan</label>
                <div class="controls">
                    <?php
                    $data = array('0' => '- Jabatan Fungsional Tertentu -') + CHtml::listData(JabatanFt::model()->findAll(array('order' => 'nama')), 'id', 'nama');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'RiwayatJabatan[jabatan_ft_id]',
                        'value' => $model->jabatan_ft_id,
                        'data' => $data,
                        'options' => array(
                            'width' => '40%;margin:0px;text-align:left',
                        )
                            )
                    );
                    echo '&nbsp;&nbsp;';
                    ?>
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'tmt_mulai_ft',
                            'value' => str_replace("0000-00-00", "", $model->tmt_mulai),
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>

            <div class="control-group ">
                <label class="control-label" for="jabatan_fungsional_tertentu">Jabatan Fungsional</label>
                <div class="controls">
                    <?php
                    $model->jabatan_ft_id = ($model->isNewRecord == false) ? $model->jabatan_ft_id : 0;
                    $jabatanFung = JabatanFungsional::model()->find(array('condition' => 'jabatan_ft_id=' . $model->jabatan_ft_id));
                    echo CHtml::textField('jabatan_fungsional_tertentu', isset($jabatanFung->nama) ? $jabatanFung->nama : '-', array('id' => 'jabatan_fungsional_tertentu', 'class' => 'span4', 'readonly' => true));
                    ?>   
                    <?php
                    $data = array('0' => '- Berdasarkan -') + RiwayatJabatan::model()->arrType();
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'RiwayatJabatan[type]',
                        'data' => $data,
                        'value' => $model->type,
                        'options' => array(
                            'width' => '25%;margin:0px;text-align:left',
                    )));
                    ?>
                </div>
            </div>
            <div class="control-group ">
                <label class="control-label" for="eselon">No/Tanggal SK</label>
                <div class="controls">
                    <?php
                    echo CHtml::textField('RiwayatJabatan[no_sk_ft]', isset($model->no_sk_ft) ? $model->no_sk_ft : '', array('class' => 'span4', 'placeholder' => 'No Sk Jab. Fung. Tertentu    '));
                    ?>
                    <div class="input-prepend" style="margin-right: 40px;">
                        <span class="add-on"><i class="icon-calendar"></i></span>

                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'tanggal_sk_ft',
                            'value' => str_replace("0000-00-00", "", $model->tanggal_sk_ft),
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                )
                        );
                        ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="form-actions">
            <a class="btn btn-primary saveJabatan"><i class="icon-ok icon-white"></i> Simpan</a>
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
        jQuery('#RiwayatJabatan_tmt_mulai, #RiwayatJabatan_tmt_eselon, #tmt_mulai_ft, #tmt_mulai_fu, #tmt_mulai_struktural,#tanggal_sk_struktural,#tanggal_sk_ft').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
//        jQuery('#RiwayatJabatan_jabatan_struktural_id').select2({'width': '40%'});
        jQuery('#RiwayatJabatan_jabatan_fu_id').select2({'width': '40%'});
        jQuery('#RiwayatJabatan_jabatan_ft_id').select2({'width': '40%'});
//        jQuery('#RiwayatJabatan_bidang_id').select2({'width': '40%'});
        jQuery('#RiwayatJabatan_type').select2({'width': '40%'});
//        jQuery('#RiwayatJabatan_jabatan_struktural_fu_id').select2({'width': '40%'});
//        jQuery('#RiwayatJabatan_jabatan_struktural_ft_id').select2({'width': '40%'});
    });
    $("#RiwayatJabatan_tipe_jabatan_0").click(function(event) {
        $(".struktural").show();
        $(".fungsional_umum").hide();
        $(".fungsional_tertentu").hide();
    });

    $("#RiwayatJabatan_tipe_jabatan_1").click(function(event) {
        $(".struktural").hide();
        $(".fungsional_umum").show();
        $(".fungsional_tertentu").hide();
    });

    $("#RiwayatJabatan_tipe_jabatan_2").click(function(event) {
        $(".struktural").hide();
        $(".fungsional_umum").hide();
        $(".fungsional_tertentu").show();
    });

    $(".saveJabatan").click(function() {
        var postData = $("#jabatan-form").serialize();
        $.ajax({
            url: "<?php echo url('pegawai/saveJabatan'); ?>",
            data: postData,
            type: "post",
            success: function(data) {
                if (data != "") {
                    $("#tableJabatan").replaceWith(data);
                    $(".modal-body").html(data);
                    $("#modalForm").modal("show");
                } else {
                    alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
                }
            },
            error: function(data) {
                alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            },
        });

    });

    $("#RiwayatJabatan_jabatan_struktural_id").change(function() {
        var postData = $("#jabatan-form").serialize();
        $.ajax({
            url: "<?php echo url('pegawai/riwayatStatusJabatan'); ?>",
            data: postData,
            type: "post",
            success: function(data) {
                obj = JSON.parse(data);
                $("#Riwayateselon").val(obj.eselon);
                $("#Riwayatjabatanasli").val(obj.jabatan);
            }
        });
    });

    $("#RiwayatJabatan_jabatan_ft_id").change(function() {
        $.ajax({
            url: "<?php echo url('pegawai/fungsionalTertentu'); ?>",
            data: {golongan_id: $("#RiwayatPangkat_golongan_id").val(), jabatan_ft_id: $(this).val()},
            type: "POST",
            success: function(data) {
                $("#jabatan_fungsional_tertentu").val(data);
            }
        });
    });
    jQuery('#RiwayatJabatan_jabatan_struktural_id').select2({
        'allowClear': true,
        'minimumInputLength': '3',
        'width': '50%;margin:0px;text-align:left',
        'ajax': {
            'url': '<?php echo Yii::app()->createUrl('jabatanStruktural/getUnitKerja'); ?>',
            'dataType': 'json',
            'data': function(term, page) {
                return {
                    q: term
                };
            },
            'results': function(data) {
                return {
                    results: data
                };
            },
        },
        'initSelection': function(element, callback)
        {
            callback({id: <?php echo $idjabatanstruktural ?>, text: "<?php echo $jabstruktural ?>"});
        }
    });
</script>
