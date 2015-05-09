<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'keluarga-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>


        <?php
        echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12'));

        $model->pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : $model->pegawai_id;
        echo $form->hiddenField($model, 'id');
        echo $form->hiddenField($model, 'pegawai_id');

        echo $form->radioButtonListRow($model, 'hubungan', Pegawai::model()->ArrHubungan());
        ?>
        <div class="control-group ">
            <label class="control-label required" for="RiwayatKeluarga_nama">Nama <span class="required">*</span></label>
            <div class="controls">
                <input class="span3" maxlength="100" value="<?php echo $model->nama; ?>" name="RiwayatKeluarga[nama]" id="RiwayatKeluarga_nama" type="text">
                <a class="btn btn-info btn-cari">Cari Dari Daftar Pegawai</a>
            </div>
        </div>
        <div class="cari" style="display:none">
            <?php
            $id = 0;
            $pegawai_id = "hai";
            echo $form->select2Row($model, 'keluarga_pegawai_id', array(
                'asDropDownList' => false,
                    )
            );
            ?>
        </div>
        <?php
        echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin());
        $display = ($model->hubungan == 'anak' || empty($model->hubungan)) ? 'none' : '';
        $anak = ($model->hubungan == 'anak') ? '' : 'none';
        ?>
        <div class="suami_istri" style="display:<?php echo $display; ?>">
            <?php
            echo $form->textFieldRow($model, 'nomor_karsu', array('class' => 'span3', 'maxlength' => 100));
            echo $form->textFieldRow($model, 'nomor_karsi', array('class' => 'span3', 'maxlength' => 100));
            echo $form->datepickerRow(
                    $model, 'tanggal_pernikahan', array(
                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                'prepend' => '<i class="icon-calendar"></i>'
                    )
            );
            echo $form->radioButtonListRow($model, 'status', Pegawai::model()->ArrStatusHubungan());
            ?>
        </div>

        <?php
        echo $form->textFieldRow($model, 'jns_masalah', array('class' => 'span3', 'maxlength' => 100));
        echo $form->textFieldRow($model, 'no_sk', array('class' => 'span3', 'maxlength' => 100));
        echo $form->datepickerRow(
                $model, 'tanggal_sk', array(
            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'RiwayatKeluarga[tempat_lahir]', 'cityValue' => $model->tempat_lahir, 'disabled' => false, 'width' => '60%', 'label' => 'Tempat Lahir'));
        echo $form->datepickerRow(
                $model, 'tanggal_lahir', array(
            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        ?>

        <div class="anak" style="display:<?php echo $anak; ?>">
            <?php
            echo $form->textFieldRow($model, 'anak_ke', array('class' => 'span1 angka', 'maxlength' => 100));
            echo $form->radioButtonListRow($model, 'status_anak', Pegawai::model()->ArrStatusAnak());
            ?>
        </div>
        <?php
        echo $form->radioButtonListRow($model, 'pendidikan_terakhir', Pegawai::model()->arrJenjangPendidikan());
        echo $form->textFieldRow($model, 'pekerjaan', array('class' => 'span3', 'maxlength' => 100));
        ?>

        <div class="form-actions">
            <a class="btn btn-primary saveKeluarga"><i class="icon-ok icon-white"></i> Simpan</a>
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
        jQuery('#RiwayatKeluarga_tanggal_pernikahan').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
        jQuery('#RiwayatKeluarga_tanggal_lahir').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
        jQuery('#RiwayatKeluarga_tanggal_sk').datepicker({'language': 'id', 'format': 'yyyy-mm-dd', 'weekStart': 0});
        jQuery('#RiwayatKeluarga_tempat_lahir').select2({'width': '40%'});
        jQuery('#RiwayatKeluarga_keluarga_pegawai_id').select2({
            'allowClear': true,
            'minimumInputLength': '3',
            'width': '100%;margin:0px;text-align:left',
            'ajax': {
                'url': '<?php echo Yii::app()->createUrl('pegawai/getKeluargaPegawai'); ?>',
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
            }
        }).on('change', function () {
            $.ajax({
                url: "<?php echo url('pegawai/getDetail') ?>",
                type: "post",
                data: {id: $(this).val()},
                success: function (data) {
                    obj = JSON.parse(data);
                    $("#RiwayatKeluarga_nama").val(obj.nama);
                    $("#RiwayatKeluarga_tanggal_lahir").val(obj.tanggal_lahir);
                    $("#s2id_RiwayatKeluarga_tempat_lahir").select2("val", obj.tempat_lahir);
                }
            });
        });
    });
    $("#RiwayatKeluarga_hubungan_0,#RiwayatKeluarga_hubungan_1").click(function (event) {
        $(".suami_istri").show();
        $(".anak").hide();
        $("#RiwayatKeluarga_nomor_karsi").val("");
        $("#RiwayatKeluarga_nomor_karsu").val("");
    });
    $("#RiwayatKeluarga_hubungan_2").click(function (event) {
        $(".suami_istri").hide();
        $(".anak").show();
    });
    $('.btn-cari').click(function () {
        $('.cari').toggle();
    });
    $(".saveKeluarga").click(function () {
        var postData = $("#keluarga-form").serialize();
        $.ajax({
            url: "<?php echo url('pegawai/saveKeluarga'); ?>",
            data: postData,
            type: "post",
            success: function (data) {
                if (data != "") {
                    $("#tableKeluarga").replaceWith(data);
                    $("#modalForm").modal("hide");
                } else {
                    alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
                }
            },
            error: function (data) {
                alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            },
        });
    });</script>
<script>
    $("body").on("click", ".radio", function () {
        var id = $(this).find("input").val();
        if (id == "istri") {
            $("#RiwayatKeluarga_nomor_karsu").parent().parent().attr("style", "display:");
            $("#RiwayatKeluarga_tanggal_pernikahan").parent().parent().attr("style", "display:");
            $("#RiwayatKeluarga_nomor_karsi").parent().parent().attr("style", "display:none");
        } else if (id == "suami") {
            $("#RiwayatKeluarga_nomor_karsu").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_nomor_karsi").parent().parent().attr("style", "display:");
            $("#RiwayatKeluarga_tanggal_pernikahan").parent().parent().attr("style", "display:");
        } else if (id == "anak") {
            $("#RiwayatKeluarga_jns_masalah").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_no_sk").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_tanggal_sk").parent().parent().parent().attr("style", "display:none");
        }

        if (id == "cerai") {
            $("#RiwayatKeluarga_jns_masalah").parent().parent().attr("style", "display:");
            $("#RiwayatKeluarga_no_sk").parent().parent().attr("style", "display:");
            $("#RiwayatKeluarga_tanggal_sk").parent().parent().parent().attr("style", "display:");
        } else if (id == "aktif") {
            $("#RiwayatKeluarga_jns_masalah").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_no_sk").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_tanggal_sk").parent().parent().parent().attr("style", "display:none");
        } else if (id == "meninggal") {
            $("#RiwayatKeluarga_jns_masalah").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_no_sk").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_tanggal_sk").parent().parent().parent().attr("style", "display:none");
        }

    });
<?php
if ($model->status == 'cerai') {
    echo '$("#RiwayatKeluarga_jns_masalah").parent().parent().attr("style", "display:");
            $("#RiwayatKeluarga_no_sk").parent().parent().attr("style", "display:");
            $("#RiwayatKeluarga_tanggal_sk").parent().parent().parent().attr("style", "display:");';
} else {
    echo '$("#RiwayatKeluarga_jns_masalah").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_no_sk").parent().parent().attr("style", "display:none");
            $("#RiwayatKeluarga_tanggal_sk").parent().parent().parent().attr("style", "display:none");';
}
?>
</script>
