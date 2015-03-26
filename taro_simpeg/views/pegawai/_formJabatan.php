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
        <!-- <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend> -->
        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>

        <?php
        $model->pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : $model->pegawai_id;
        echo $form->hiddenField($model, 'id');
        echo $form->hiddenField($model, 'pegawai_id');
        ?>

        <?php echo $form->radioButtonListRow($model, 'tipe_jabatan', Pegawai::model()->arrTipeJabatan()); ?>

        <?php
        $struktural = ($model->tipe_jabatan == "struktural") ? "" : "none";
        $fu = ($model->tipe_jabatan == "fungsional_umum") ? "" : "none";
        $ft = ($model->tipe_jabatan == "fungsional_tertentu") ? "" : "none";
        ?>

        <div class="struktural" style="display:<?php echo $struktural; ?>">              
            <div class="control-group "><label class="control-label" for="RiwayatJabatan_jabatan_struktural_id">Jabatan</label>
                <div class="controls">
                    <?php
                    $data = array('0' => '- Jabatan Struktural -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'RiwayatJabatan[jabatan_struktural_id]',
                        'value' => $model->jabatan_struktural_id,
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
                            'name' => 'RiwayatJabatan[tmt_mulai]',
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
                    <input type="text" id="Riwayateselon" readonly="true" class="span5" value="<?php echo isset($model->JabatanStruktural->Eselon->nama) ? $model->JabatanStruktural->Eselon->nama : '-'; ?>">
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
        </div>

        <div class="fungsional_umum" style="display:<?php echo $fu; ?>">   
            <div class="control-group "><label class="control-label" for="RiwayatJabatan_jabatan_fu_id">Jabatan</label>
                <div class="controls">
                    <?php
                    $data = array('0' => '- Jabatan Fungsional Umum -') + CHtml::listData(JabatanFu::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
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
                            'name' => 'RiwayatJabatan[tmt_mulai]',
                            'value' => str_replace("0000-00-00", "",  $model->tmt_mulai),
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
                    $data = array('0' => '- Jabatan Fungsional Tertentu -') + CHtml::listData(JabatanFt::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'RiwayatJabatan[jabatan_ft_id]',
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
                            'name' => 'RiwayatJabatan[tmt_mulai]',
                            'value' => str_replace("0000-00-00", "", $model->tmt_mulai),
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
    jQuery(function ($) {
        jQuery('#RiwayatJabatan_tmt_mulai, #RiwayatJabatan_tmt_eselon').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
        jQuery('#RiwayatJabatan_jabatan_struktural_id').select2({'width': '40%'});
        jQuery('#RiwayatJabatan_jabatan_fu_id').select2({'width': '40%'});
        jQuery('#RiwayatJabatan_jabatan_ft_id').select2({'width': '40%'});
    });
    $("#RiwayatJabatan_tipe_jabatan_0").click(function (event) {
        $(".struktural").show();
        $(".fungsional_umum").hide();
        $(".fungsional_tertentu").hide();
    });

    $("#RiwayatJabatan_tipe_jabatan_1").click(function (event) {
        $(".struktural").hide();
        $(".fungsional_umum").show();
        $(".fungsional_tertentu").hide();
    });

    $("#RiwayatJabatan_tipe_jabatan_2").click(function (event) {
        $(".struktural").hide();
        $(".fungsional_umum").hide();
        $(".fungsional_tertentu").show();
    });

    $(".saveJabatan").click(function () {
        var postData = $("#jabatan-form").serialize();
        $.ajax({
            url: "<?php echo url('pegawai/saveJabatan'); ?>",
            data: postData,
            type: "post",
            success: function (data) {
                if (data != "") {
                    $("#tableJabatan").replaceWith(data);
                    $("#modalForm").modal("hide");
                } else {
                    alert("Terjadi  Input Data. Silahkan Dicek Kembali!");
                }
            },
            error: function (data) {
                alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            },
        });

    });

    $("#RiwayatJabatan_jabatan_struktural_id").click(function () {
        var postData = $("#jabatan-form").serialize();
        $.ajax({
            url: "<?php echo url('pegawai/riwayatStatusJabatan'); ?>",
            data: postData,
            type: "post",
            success: function (data) {
//                alert(data);
                obj = JSON.parse(data);
                $("#Riwayateselon").val(obj.eselon);
            }
        });
    });

</script>