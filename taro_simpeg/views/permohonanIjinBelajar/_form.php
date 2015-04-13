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
        'id' => 'permohonan-ijin-belajar-form',
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


        <?php echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span5', 'maxlength' => 225)); ?>

        <?php
        echo $form->datepickerRow(
                $model, 'tanggal_usul', array(
            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );

        echo $form->datepickerRow(
                $model, 'tanggal', array(
            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );

        $data = array('0' => '- Pegawai -') + CHtml::listData(Pegawai::model()->listPegawai(), 'id', 'nipNama');
        echo $form->select2Row($model, 'pegawai_id', array(
            'asDropDownList' => true,
            'data' => $data,
            'options' => array(
                "allowClear" => false,
                'width' => '40%',
            ))
        );
        
        echo $form->radioButtonListRow($model, 'jenjang_pendidikan_asal', Pegawai::model()->ArrJenjangPendidikan());
       

        echo $form->radioButtonListRow($model, 'jenjang_pendidikan', Pegawai::model()->ArrJenjangPendidikan());
        ?>

      <?php
          echo $form->textFieldRow($model, 'jurusan', array(
              'class' => 'span5',
              'maxlength' => 225,
             
              ));
     // }
    ?>
        
        <?php echo $form->textFieldRow($model, 'nama_sekolah', array('class' => 'span5', 'maxlength' => 225)); ?>
      <?php
//    if(isset($model->jenjang_pendidikan != 'SMA/SMK') && ($model->jenjang_pendidikan != 'SD') && ($model->jenjang_pendidikan != 'SMP'){
    
      ?>
        <?php
         echo' <div class="control-group "><label class="control-label">Universitas</label><div class="controls">';
        $data = array('0' => '- Universitas -') + CHtml::listData(Universitas::model()->findAll(array('order' => 'name')), 'id', 'name');
        $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => 'PermohonanIjinBelajar[id_universitas]',
            'data' => $data,
            'value' => $model->id_universitas,
            'options' => array(
                'width' => '40%;margin:0px;text-align:left',
        )));
        echo "</div></div>";
        echo' <div class="control-group "><label class="control-label">Jurusan</label><div class="controls">';
        $data = array('0' => '- jurusan -') + CHtml::listData(Jurusan::model()->findAll(array('order' => 'Name')), 'id', 'Name');
        $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => 'PermohonanIjinBelajar[id_jurusan]',
            'id' => 'jurusan_kuliah',
            'data' => $data,
            'value' => $model->id_jurusan,
            'options' => array(
                'width' => '40%;margin:0px;text-align:left',
        )));
        echo "</div></div>";
//    }
        ?>
        
        <?php
        $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'PermohonanIjinBelajar[kota]', 'cityValue' => $model->kota, 'disabled' => false, 'width' => '40%', 'label' => 'Kota'));
        ?>

<?php echo $form->textAreaRow($model, 'alamat', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>


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
        $content = $siteConfig->format_ijin_belajar;

        $content = str_replace('{nomor}', $model->nomor_register, $content);
        $content = str_replace('{nama}', $model->nama, $content);
        $content = str_replace('{nip}', $model->nip, $content);
        $content = str_replace('{pangkat}', $model->golongan, $content);
        $content = str_replace('{unit_kerja}', $model->unit_kerja, $content);
        $content = str_replace('{jabatan}', $model->jabatan, $content);
        $content = str_replace('{jenjang_pendidikan}', $model->jenjang_pendidikan, $content);
        $content = str_replace('{jurusan}', $model->jurusan, $content);
        $content = str_replace('{id_jurusan}', $model->jurusan, $content);
        $content = str_replace('{id_universitas}', $model->jurusan, $content);
        $content = str_replace('{nama_sekolah}', $model->nama_sekolah, $content);
        $content = str_replace('{kota_sekolah}', $model->kotaSekolah, $content);
        $content = str_replace('{tanggal}', date('d F Y', strtotime($model->created)), $content);
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
    $("#viewTab").click(function () {
        $(".surat").hide();
        $(".form").show();
    });

    $("#viewFull").click(function () {
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
        $("#myTab a").click(function (e) {
            e.preventDefault();
            $(this).tab("show");
        })
        $("#viewTab").click(function () {
            $(".surat").hide();
            $(".form").show();
        });

        $("#viewFull").click(function () {
            $(".surat").show();
            $(".form").hide();
        });


    }
        $("body").on("click", ".radio", function () {
        var id = $(this).find("input").val();
        if (id == "SMA/SMK") {
            $("#PermohonanIjinBelajar_id_universitas").parent().parent().attr("style", "display:none")
            $("#PermohonanIjinBelajar_id_jurusan").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_jurusan").parent().parent().attr("style", "display:");
            $("#PermohonanIjinBelajar_nama_sekolah").parent().parent().attr("style", "display:");
        }
        else if (id == "SMP") {
            $("#PermohonanIjinBelajar_id_universitas").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_id_jurusan").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_jurusan").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_nama_sekolah").parent().parent().attr("style", "display:");
        }
        else if (id == "SD") {
            $("#PermohonanIjinBelajar_id_universitas").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_id_jurusan").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_jurusan").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_nama_sekolah").parent().parent().attr("style", "display:");
        }
        else {
            $("#PermohonanIjinBelajar_jurusan").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_nama_sekolah").parent().parent().attr("style", "display:none");
            $("#PermohonanIjinBelajar_id_universitas").parent().parent().attr("style", "display:");
            $("#PermohonanIjinBelajar_id_jurusan").parent().parent().attr("style", "display:");
        }
    });
</script>