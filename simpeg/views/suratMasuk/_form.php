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
        'id' => 'surat-masuk-form',
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


        <?php
        $tanggal = isset($model->tanggal_terima) ? date('d-m-Y', strtotime($model->tanggal_terima)) :'';
        echo $form->textFieldRow($model, 'pengirim', array('class' => 'span4', 'maxlength' => 225));
        echo $form->datepickerRow(
                $model, 'tanggal_terima', array(
            'value' => str_replace("0000-00-00", "",$tanggal),
            'options' => array('language' => 'id', 'format' => 'dd-mm-yyyy'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );

        echo $form->radioButtonListRow($model, 'sifat', SuratMasuk::model()->ArrSifat());

        echo $form->textFieldRow($model, 'nomor_surat', array('class' => 'span4', 'maxlength' => 225));


        echo $form->textFieldRow($model, 'perihal', array('class' => 'span4', 'maxlength' => 225));
        ?>
        <div class="control-group ">
            <label class="control-label" for="Pegawai_jabatan_id">Di Teruskan</label>
            <div class="controls">
                <?php
                $data = array('0' => '- Diteruskan ke -') + SuratMasuk::model()->arrTerusan();
                $this->widget(
                        'bootstrap.widgets.TbSelect2', array(
                    'name' => 'SuratMasuk[terusan]',
                    'data' => $data,
                    'value' => $model->terusan,
                    'options' => array(
                        'width' => '40%;margin:0px;text-align:left',
                )));
                ?>
            </div>
        </div>
        <div class="control-group "><label class="control-label required" for="SuratMasuk_isi">Isi Surat</label>
            <div class="controls">
                <?php
                $this->widget(
                        'bootstrap.widgets.TbRedactorJs', [
                    'name' => 'SuratMasuk[isi]',
                    'value' => $model->isi,
                        ]
                );
                ?>
            </div>
        </div>

<?php if (!isset($_GET['v'])) { ?>
            <div class="control-group "><label class="control-label" for="SuratMasuk_file">File / Document</label>
                <div class="controls">
                    <input id="ytSuratMasuk_file" value="" name="SuratMasuk[file]" type="hidden">
                    <input class="span5" name="SuratMasuk[file]" id="SuratMasuk_file" type="file">
    <?php if ($model->file != "")
        echo '<br><br><span class="alert alert-info"><a target="_blank" href="' . param('urlImg') . '/surat_masuk/' . $model->file . '">' . $model->file . '</a></span>';
    ?>
                </div>
            </div>
    <?php }else {
    ?>
            <div class="control-group "><label class="control-label" for="SuratMasuk_file">File / Document</label>
                <div class="controls">            
    <?php if ($model->file != "") echo '<span class="alert alert-info"><a target="_blank" href="' . param('urlImg') . '/surat_masuk/' . $model->file . '">' . $model->file . '</a></span>'; ?>
                </div>
            </div>
    <?php
}

//        echo $form->textFieldRow($model,'tembusan',array('class'=>'span4','maxlength'=>225));
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
        $content = $siteConfig->format_surat_masuk;

        $content = str_replace('{pengirim}', $model->pengirim, $content);
        $content = str_replace('{ttl_terima}', date('d F Y', strtotime($model->tanggal_terima)), $content);
        $content = str_replace('{tanggal}', date('d F Y', strtotime($model->created)), $content);
        $content = str_replace('{no_agenda}', $model->no_agenda, $content);
        $content = str_replace('{no_surat}', $model->nomor_surat, $content);
        $content = str_replace('{perihal}', $model->perihal, $content);
        $content = str_replace('{terusan}', ucwords($model->terusan), $content);
        echo $content;
        ?>
    </div>
<?php } ?>
<script>
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
