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
        <div class="control-group ">
            <label class="control-label" for="PermohonanIjinBelajar_no_usul">Nomor Usul</label>
            <div class="controls">
                <input class="span5" maxlength="225" name="PermohonanIjinBelajar[no_usul]" id="PermohonanIjinBelajar_nomor_register" type="text" value="<?php echo isset($model->no_usul) ? $model->no_usul : '890/    /434.206 / 2015' ?>">
            </div>
        </div>
        <?php
        $tanggalUsul = isset($model->tanggal_usul) ? date('d-m-Y', strtotime($model->tanggal_usul)) : '';
        $tanggal = isset($model->tanggal) ? date('d-m-Y', strtotime($model->tanggal)) : '';

        echo $form->datepickerRow(
                $model, 'tanggal_usul', array(
            'value' => str_replace("0000-00-00", "", $tanggalUsul),
            'options' => array('language' => 'id', 'format' => 'dd-mm-yyyy'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        echo $form->datepickerRow(
                $model, 'tanggal', array(
            'value' => str_replace("0000-00-00", "", $tanggal),
            'options' => array('language' => 'id', 'format' => 'dd-mm-yyyy'),
            'prepend' => '<i class="icon-calendar"></i>'
                )
        );
        if (isset($_GET['v']) || $model->isNewRecord == false) {
            echo $form->radioButtonListRow($model, 'status', PermohonanIjinBelajar::model()->ArrStatuspros());
        }
        $idpegawai = isset($model->pegawai_id) ? $model->pegawai_id : 0;
        $pegawaiName = isset($model->Pegawai->nama) ? $model->Pegawai->nip.' - '.$model->Pegawai->nama : '';
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
        <?php
        $golru = (!empty($model->golru)) ? $model->golru : '';
        $unit_kerja = (!empty($model->unitKerja)) ? $model->unitKerja : '';
        $satuan_kerja = (!empty($model->satuanKerja)) ? $model->satuanKerja : '';
        $jenis_kelamin = (!empty($model->Pegawai->jenis_kelamin)) ? $model->Pegawai->jenis_kelamin : '-';
        $tempat_lahir = (!empty($model->Pegawai->tempatLahir)) ? $model->Pegawai->tempatLahir : '';
        $tanggal_lahir = (!empty($model->Pegawai->tanggal_lahir)) ? $model->Pegawai->tanggal_lahir : '';
        $pendidikan_terakhir = (!empty($model->Pegawai->pendidikanTerakhir)) ? $model->Pegawai->pendidikanTerakhir : '';
        $alamat = (!empty($model->Pegawai->alamat)) ? $model->Pegawai->alamat : '';
        ?>
        <div class="control-group "><label  class="control-label">Pangkat/Golru</label><div class="controls">
                <input disabled class="span4" maxlength="225" name="" value="<?php echo $golru; ?>" id="golru" type="text">
            </div></div>
        <div class="control-group "><label  class="control-label">Unit Kerja</label><div class="controls">
                <input disabled class="span4" maxlength="225" name="" value="<?php echo $unit_kerja; ?>" id="unit_kerja" type="text">
            </div></div>
        <div class="control-group "><label  class="control-label">Satuan Kerja</label><div class="controls">
                <input disabled class="span4" maxlength="225" name="" value="<?php echo $satuan_kerja; ?>" id="satuan_kerja" type="text">
            </div></div>
        <div class="control-group "><label  class="control-label">Jenis Kelamin</label><div class="controls">
                <input disabled class="span4" maxlength="225" name="" value="<?php echo $jenis_kelamin; ?>" id="jenis_kelamin" type="text">
            </div></div>
        <div class="control-group "><label  class="control-label">Tempat Lahir</label><div class="controls">
                <input disabled class="span4" maxlength="225" name="" value="<?php echo $tempat_lahir; ?>" id="tempat_lahir" type="text">
            </div></div>        
        <div class="control-group "><label class="control-label" for="">Tanggal Lahir</label><div class="controls">
                <div  class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input id="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" disabled type="text"></div>
            </div></div>    
        <div class="control-group "><label  class="control-label">Pendidikan Terakhir</label><div class="controls">
                <input disabled class="span4" maxlength="225" name="" id="pendidikan_terakhir" value="<?php echo $pendidikan_terakhir; ?>" type="text">
            </div></div>        
        <div class="control-group "><label  class="control-label">Alamat</label><div class="controls">
                <input disabled class="span6" maxlength="225" name="alamat" id="alamat" value="<?php echo $alamat; ?>" type="text">
            </div></div>

        <?php
//        echo $form->radioButtonListRow($model, 'jenjang_pendidikan_asal', Pegawai::model()->ArrJenjangPendidikan());


        echo $form->radioButtonListRow($model, 'jenjang_pendidikan', Pegawai::model()->ArrJenjangPendidikan());
        ?>

        <?php
        $idjurusan = isset($model->id_jurusan) ? $model->id_jurusan : 0;
        $jurusanName = isset($model->Jurusan->Name) ? $model->Jurusan->Name : '';
        echo $form->select2Row($model, 'id_jurusan', array(
            'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Pegawai->nama,
            'options' => array(
                'placeholder' => t('choose', 'global'),
                'allowClear' => true,
                'width' => '400px',
                'minimumInputLength' => '3',
                'ajax' => array(
                    'url' => Yii::app()->createUrl('pegawai/getJurusanTingkat'),
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
                               callback({id: ' . $idjurusan . ', text: "' . $jurusanName . '" });
                            
                                  
                            }',
            ),
                )
        );
        ?>

        <?php // echo $form->textFieldRow($model, 'nama_sekolah', array('class' => 'span5', 'maxlength' => 225)); ?>
        <?php
//    if(isset($model->jenjang_pendidikan != 'SMA/SMK') && ($model->jenjang_pendidikan != 'SD') && ($model->jenjang_pendidikan != 'SMP'){
        ?>
        <?php
//        echo $form->textFieldRow($model, 'jurusan', array(
//            'class' => 'span5',
//            'maxlength' => 225,
//        ));
        // }
        ?>

        <?php // echo $form->textFieldRow($model, 'nama_sekolah', array('class' => 'span5', 'maxlength' => 225));  ?>
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

//    }
        ?>

        <?php
//        $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'PermohonanIjinBelajar[kota]', 'cityValue' => $model->kota, 'disabled' => false, 'width' => '40%', 'label' => 'Kota'));
//        $idkota = isset($model->kota) ? $model->kota : 0;
//        $kotaName = isset($model->Kota->name) ? $model->Kota->Province->name.' - '.$model->Kota->name : '';
//        echo $form->select2Row($model, 'kota', array(
//            'asDropDownList' => false,
////                    'data' => $data,
////                    'value' => $model->Kota->name,
//            'options' => array(
//                'placeholder' => t('choose', 'global'),
//                'allowClear' => true,
//                'width' => '400px',
//                'minimumInputLength' => '3',
//                'ajax' => array(
//                    'url' => Yii::app()->createUrl('city/getListKota'),
//                    'dataType' => 'json',
//                    'data' => 'js:function(term, page) { 
//                                                        return {
//                                                            q: term 
//                                                        }; 
//                                                    }',
//                    'results' => 'js:function(data) { 
//                                                        return {
//                                                            results: data
//                                                            
//                                                        };
//                                                    }',
//                ),
//                'initSelection' => 'js:function(element, callback) 
//                            { 
//                            callback({id: '.$idkota.', text: "'.$kotaName.'" });
//                             
//                                  callback(data);
//                                  
//                            }',
//            ),
//                )
//        );
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
            </div>
        <?php } ?>    </fieldset>

        <?php $this->endWidget(); ?>

</div>

<?php if (isset($_GET['v'])) { ?>
    <div class="surat" id="surat" style="display:none">
    <?php
    $siteConfig = SiteConfig::model()->listSiteConfig();
    $content = $siteConfig->format_ijin_belajar;
    $universitas = (isset($model->Univ->name)) ? $model->Univ->name : '-';
    $content = str_replace('{no_usul}', $model->no_usul, $content);
    $content = str_replace('{nama}', $model->pegawai, $content);
    $content = str_replace('{nip}', $model->nip, $content);
    $content = str_replace('{pangkat}', $model->golongan, $content);
    $content = str_replace('{unit_kerja}', $model->unit_kerja, $content);
    $content = str_replace('{satuan_kerja}', $model->satuanKerja, $content);
    $content = str_replace('{jabatan}', $model->jabatan, $content);
    $content = str_replace('{jenjang_pendidikan}', $model->jenjang_pendidikan, $content);
//        $content = str_replace('{jurusan}', $model->jurusan, $content);
    $content = str_replace('{jurusan}', $model->Jurusan->Name, $content);
    $content = str_replace('{nama_sekolah}', (isset($model->Univ->name)) ? $model->Univ->name : '-', $content);

    $content = str_replace('{kota_sekolah}', $model->kotaSekolah, $content);
    $content = str_replace('{tanggal}', date('d F Y', strtotime($model->tanggal)), $content);
    echo $content;
    ?>
    </div>
    <?php } ?>

<style type="text/css">
    td{
        vertical-align: top !important;
    }
</style>
<script type="text/javascript">
    $("#PermohonanIjinBelajar_pegawai_id").on("change", function() {
        //var name = $("#Registration_guest_user_id").val();
        //  alert(name);

        $.ajax({
            url: "<?php echo url('pegawai/getDetail'); ?>",
            type: "POST",
            data: {id: $(this).val()},
            success: function(data) {

                obj = JSON.parse(data);
                $("#golru").val(obj.golru);
                $("#unit_kerja").val(obj.unit_kerja);
                $("#satuan_kerja").val(obj.satuan_kerja);
                $("#jenis_kelamin").val(obj.jenis_kelamin);
                $("#tempat_lahir").val(obj.tempat_lahir);
                $("#tanggal_lahir").val(obj.tanggal_lahir);
                $("#pendidikan_terakhir").val(obj.pendidikan_terakhir);
                $("#alamat").val(obj.alamat);
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

<?php
//    if ($model->jenjang_pendidikan == "SD") {
//    echo '$("#PermohonanIjinBelajar_id_universitas").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_id_jurusan").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_jurusan").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_nama_sekolah").parent().parent().attr("style", "display:");';
//} else
//    if ($model->jenjang_pendidikan == "SLTP"){
//       echo ' $("#PermohonanIjinBelajar_id_universitas").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_id_jurusan").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_jurusan").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_nama_sekolah").parent().parent().attr("style", "display:");';
//}else
//    if ($model->jenjang_pendidikan == "SLTA/SMK"){
//        echo'$("#PermohonanIjinBelajar_id_universitas").parent().parent().attr("style", "display:none")
//            $("#PermohonanIjinBelajar_id_jurusan").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_jurusan").parent().parent().attr("style", "display:");
//            $("#PermohonanIjinBelajar_nama_sekolah").parent().parent().attr("style", "display:");';
//    }else{
//        echo'$("#PermohonanIjinBelajar_jurusan").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_nama_sekolah").parent().parent().attr("style", "display:none");
//            $("#PermohonanIjinBelajar_id_universitas").parent().parent().attr("style", "display:");
//            $("#PermohonanIjinBelajar_id_jurusan").parent().parent().attr("style", "display:");';
//    }
?>
</script>
