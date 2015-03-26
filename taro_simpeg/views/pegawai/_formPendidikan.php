<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'pendidikan-form',
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
        ?>

        <?php
        $model->pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : $model->pegawai_id;
        echo $form->hiddenField($model, 'id');
        echo $form->hiddenField($model, 'pegawai_id');

        echo $form->radioButtonListRow($model, 'jenjang_pendidikan', Pegawai::model()->ArrJenjangPendidikan());
        echo $form->textFieldRow($model, 'jurusan', array('class' => 'span3', 'maxlength' => 50));
        echo' <div class="control-group ">
            <label class="control-label">Universitas</label>
            <div class="controls">';
        $data = array('0' => '- Universitas -') + CHtml::listData(Universitas::model()->findAll(array('order' => 'name')), 'id', 'name');
        $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => 'RiwayatPendidikan[id_universitas]',
            'data' => $data,
            'value' => $model->id_universitas,
            'options' => array(
                'width' => '40%;margin:0px;text-align:left',
        )));
        echo "</div></div>";
          echo' <div class="control-group ">
            <label class="control-label">Jurusan</label>
            <div class="controls">';
        $data = array('0' => '- jurusan -') + CHtml::listData(Jurusan::model()->findAll(array('order' => 'Name')), 'id', 'Name');
        $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => 'RiwayatPendidikan[id_jurusan]',
            'data' => $data,
            'value' => $model->id_universitas,
            'options' => array(
                'width' => '40%;margin:0px;text-align:left',
        )));
        echo "</div></div>";
        echo $form->textFieldRow($model, 'nama_sekolah', array('class' => 'span3', 'maxlength' => 100));
        echo $form->textAreaRow($model, 'alamat_sekolah', array('rows' => 4, 'cols' => 50, 'class' => 'span8'));
        echo $form->textFieldRow($model, 'tahun', array('class' => 'span1 angka', 'maxlength' => 100));
        ?>




        <div class="form-actions">
            <a class="btn btn-primary savePendidikan"><i class="icon-ok icon-white"></i> Simpan</a>
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
        jQuery('#Pendidikan_tanggal_sttb').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
        jQuery('#Pendidikan_tanggal_lulus').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
    });
    $(".savePendidikan").click(function () {
        var postData = $("#pendidikan-form").serialize();
        $.ajax({
            url: "<?php echo url('pegawai/savePendidikan'); ?>",
            data: postData,
            type: "post",
            success: function (data) {
                if (data != "") {
                    $("#tablePendidikan").replaceWith(data);
                    $("#modalForm").modal("hide");
                } else {
                    alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
                }
            },
            error: function (data) {
                alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            },
        });

    });
</script>