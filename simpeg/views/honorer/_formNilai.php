<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'nilai-honorer-form',
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
        <div class="form-row row-fluid">
            <?php
            echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12'));
            echo '<div class="span6">';
            $model->pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : $model->pegawai_id;
            echo $form->hiddenField($model, 'id');
            echo $form->hiddenField($model, 'pegawai_id');
            echo $form->textFieldRow($model, 'no_register', array('class' => 'span3', 'maxlength' => 100));
            echo $form->datepickerRow(
                    $model, 'tanggal', array(
                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                'prepend' => '<i class="icon-calendar"></i>'
                    )
            );
            echo $form->dropDownListRow($model, 'tahun', landa()->yearly(), array('class' => 'span3'));
            echo $form->textFieldRow($model, 'nilai_hasil_kerja', array('class' => 'span3 angka', 'maxlength' => 100));
            echo $form->textFieldRow($model, 'nilai_orientasi_pelayanan', array('class' => 'span3 angka', 'maxlength' => 100));
            echo '</div>';
            echo '<div class="span6">';
            echo $form->textFieldRow($model, 'nilai_integritas', array('class' => 'span3 angka', 'maxlength' => 100));
            echo $form->textFieldRow($model, 'nilai_disiplin', array('class' => 'span3 angka', 'maxlength' => 100));
            echo $form->textFieldRow($model, 'nilai_kerja_sama', array('class' => 'span3 angka', 'maxlength' => 100));
            echo $form->textFieldRow($model, 'nilai_kreativitas', array('class' => 'span3 angka', 'maxlength' => 100));
            echo '</div>';
            ?>
        </div>
        <div class="form-actions">
            <a class="btn btn-primary saveNilai"><i class="icon-ok icon-white"></i> Simpan</a>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>

<script>
    jQuery(function ($) {
        jQuery('#NilaiHonorer_tanggal').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});

    });
    $(".saveNilai").click(function () {
        var postData = $("#nilai-honorer-form").serialize();
        $.ajax({
            url: "<?php echo url('honorer/saveNilai'); ?>",
            data: postData,
            type: "post",
            success: function (data) {
                if (data != "") {
                    $("#tableNilai").replaceWith(data);
                    $("#modalForm").modal("hide");
                } else {
                    alert("Nilai pada tahun " + $("#NilaiHonorer_tahun").val()+" sudah diinput.");
                }
            },
            error: function (data) {
                alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            },
        });

    });

</script>