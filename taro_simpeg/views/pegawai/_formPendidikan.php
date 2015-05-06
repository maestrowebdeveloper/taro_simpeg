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
        $idjurusan = (!empty($model->Jurusan->id)) ? $model->Jurusan->id : 0; 
        $jurusan = (!empty($model->Jurusan->Name)) ? $model->Jurusan->tingkat .' - '.$model->Jurusan->Name : 0; 
        $model->pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : $model->pegawai_id;
        echo $form->hiddenField($model, 'id');
        echo $form->hiddenField($model, 'pegawai_id');
        $id = 0;
            $pegawai_id = "hai";
            echo $form->select2Row($model, 'id_jurusan', array(
                'asDropDownList' => false,
                    )
            );
//        echo $form->radioButtonListRow($model, 'jenjang_pendidikan', Pegawai::model()->ArrJenjangPendidikan());
        echo $form->textFieldRow($model, 'nama_sekolah', array('class' => 'span3', 'maxlength' => 100));
        echo' <div class="control-group "><label class="control-label">Universitas</label><div class="controls">';
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
       
        echo $form->textFieldRow($model, 'no_ijazah', array('class' => 'span3', 'maxlength' => 100));
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
                    //$("#modalForm").modal("hide");
                    $(".modal-body").html(data);
                    $("#modalForm").modal("show");
                } else {
                    alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
                }
            },
            error: function (data) {
                alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            },
        });

    });
    $("body").on("click", ".radio", function () {
        var id = $(this).find("input").val();
        if (id == "SMA/SMK") {
            $("#RiwayatPendidikan_id_universitas").parent().parent().attr("style", "display:none");
            $("#RiwayatPendidikan_id_jurusan").parent().parent().attr("style", "display:none");
            $("#jurusan_sma").parent().parent().attr("style", "display:");
            $("#RiwayatPendidikan_nama_sekolah").parent().parent().attr("style", "display:");
        }
        else if (id == "SMP") {
            $("#RiwayatPendidikan_id_universitas").parent().parent().attr("style", "display:none");
            $("#RiwayatPendidikan_id_jurusan").parent().parent().attr("style", "display:none");
            $("#jurusan_sma").parent().parent().attr("style", "display:none");
            $("#RiwayatPendidikan_nama_sekolah").parent().parent().attr("style", "display:");
        }
        else if (id == "SD") {
            $("#RiwayatPendidikan_id_universitas").parent().parent().attr("style", "display:none");
            $("#RiwayatPendidikan_id_jurusan").parent().parent().attr("style", "display:none");
            $("#jurusan_sma").parent().parent().attr("style", "display:none");
            $("#RiwayatPendidikan_nama_sekolah").parent().parent().attr("style", "display:");
        }
        else {
            $("#jurusan_sma").parent().parent().attr("style", "display:none");
            $("#RiwayatPendidikan_nama_sekolah").parent().parent().attr("style", "display:none");
            $("#RiwayatPendidikan_id_universitas").parent().parent().attr("style", "display:");
            $("#RiwayatPendidikan_id_jurusan").parent().parent().attr("style", "display:");
        }
    });
       jQuery('#RiwayatPendidikan_id_jurusan').select2({
            'allowClear': true,
            'minimumInputLength': '3',
            'width': '60%;margin:0px;text-align:left',
            'ajax': {
                'url': '<?php echo Yii::app()->createUrl('pegawai/getJurusanTingkat'); ?>',
                'dataType': 'json',
                'data': function (term, page) {
                    return {
                        q: term
                    };
                },
                'results': function (data) {
                    return {
                        results: data
                    };
                },
            },
            'initSelection' : function(element, callback) 
                            { 
                                 callback({id: <?php echo $idjurusan ?>, text: "<?php echo $jurusan ?>" });
                            }
        })
</script>