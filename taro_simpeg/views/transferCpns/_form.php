<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'transfer-cpns-form',
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
        <fieldset>
            <legend>Informasi Pegawai</legend>
        </fieldset>
        <div class="row-fluid">
            <div class="span5">
                <input class="span12" name="TransferCpns[pelatihan_id]" id="TransferCpns_nomor_kesehatan" type="hidden" value="<?php echo (isset($model->pelatihan_id)) ? $odel->pelatihan_id : 2 ?>">
                <?php
                $idpegawai = isset($model->pegawai_id) ? $model->pegawai_id : 0;
                $pegawaiName = isset($model->Pegawai->nama) ? $model->Pegawai->nama : '';
                echo $form->select2Row($model, 'pegawai_id', array(
                    'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Pegawai->nama,
                    'options' => array(
                        'placeholder' => t('choose', 'global'),
                        'allowClear' => true,
                        'width' => '300px',
                        'minimumInputLength' => '3',
                        'ajax' => array(
                            'url' => Yii::app()->createUrl('pegawai/getListPegawaicpns'),
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

                $unit_kerja = (!empty($model->Pegawai->unitKerja)) ? $model->Pegawai->unitKerja : '';
                $nip = (!empty($model->Pegawai->nip)) ? $model->Pegawai->nip : '';
                $tempat_lahir = (!empty($model->Pegawai->tempatLahir)) ? $model->Pegawai->tempatLahir : '';
                $tanggal_lahir = (!empty($model->Pegawai->tanggal_lahir)) ? $model->Pegawai->tanggal_lahir : '';
                $pendidikan_terakhir = (!empty($model->Pegawai->pendidikan_terakhir)) ? $model->Pegawai->pendidikan_terakhir : '';
                $tahun_pendidikan = (!empty($model->Pegawai->tahun_pendidikan)) ? $model->Pegawai->tahun_pendidikan : '';
                $jabatan = (!empty($model->Pegawai->jabatan)) ? $model->Pegawai->jabatan : '';
                $golongan = (!empty($model->Pegawai->golongan)) ? $model->Pegawai->golongan : '';
                $tmt = (!empty($model->Pegawai->tmt_cpns)) ? $model->Pegawai->tmt_cpns : '';
                $mkTahun = (!empty($model->Pegawai->masaKerjaTahun)) ? $model->Pegawai->masaKerjaTahun : '';
                $mkBulan = (!empty($model->Pegawai->masaKerjaBulan)) ? $model->Pegawai->masaKerjaBulan : '';
                ?>

                <div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">Nip</label>
                    <div class="controls">
                        <input class="span12" disabled name="" id="nip" type="text" value="<?php echo $nip ?>">
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">Tempat Lahir</label>
                    <div class="controls">
                        <input class="span12" disabled name="" id="tempat_lahir" type="text" value="<?php echo $tempat_lahir ?>">

                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">Tanggal Lahir</label>
                    <div class="controls">

                        <div class="input-prepend"><span class="add-on">
                                <i class="icon-calendar"></i></span>
                            <input type="text" disabled class="span12" autocomplete="off" id="tanggal_lahit" value="<?php echo $tanggal_lahir ?>"></div>
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">R. Pendidikan</label>
                    <div class="controls">
                        <input class="span12" disabled name="" id="pendidikan_terakhir" value="<?php echo $pendidikan_terakhir ?>" type="text"><br><br>
                        <input class="span12" disabled name="" id="tahun_pendidikan" type="text" value="<?php echo $tahun_pendidikan ?>">

                    </div>
                </div>
                
            </div>
            <div class="span5">
<div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">Jabatan</label>
                    <div class="controls">
                        <input class="span12" name="" disabled id="jabatan" type="text" value="<?php echo $jabatan ?>">

                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">Satuan Kerja</label>
                    <div class="controls">
                        <input class="span12" name="" disabled id="unit_kerja" type="text" value="<?php echo $unit_kerja ?>">

                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">Pangkat / Golru</label>
                    <div class="controls">
                        <input class="span12" name="" disabled id="golru" type="text" value="<?php echo $golongan ?>">

                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">TMT</label>
                    <div class="controls">
                        <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                            <input type="text" disabled class="span12" autocomplete="off" id="tmt" value="<?php echo $tmt ?>"></div>

                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="TransferCpns_nomor_kesehatan">Masa Kerja</label>
                    <div class="controls">
                        <input class="span6" name="" disabled id="masa_kerja_tahun" value="<?php echo $mkTahun ?>" type="text"><br><br>
                        <input class="span6" name="" disabled id="masa_kerja_bulan" value="<?php echo $mkBulan ?>" type="text">

                    </div>
                </div>
                
             

            </div>
        </div>
        <fieldset>
            <legend>Form Transfer CPNS</legend>
        </fieldset>
        <?php echo $form->textFieldRow($model, 'nomor_kesehatan', array('class' => 'span5')); ?>

                <?php
                echo $form->datepickerRow(
                        $model, 'tanggal_kesehatan', array(
                    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                    'prepend' => '<i class="icon-calendar"></i>'
                        )
                );
                ?>



                <?php echo $form->textFieldRow($model, 'nomor_diklat', array('class' => 'span5')); ?>

                <?php
                echo $form->datepickerRow(
                        $model, 'tanggal_diklat', array(
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
                <?php } ?>

    </fieldset>

    <?php $this->endWidget(); ?>

</div>
<script>
    $("#TransferCpns_pegawai_id").on("change", function() {
        //var name = $("#Registration_guest_user_id").val();
        //  alert(name);

        $.ajax({
            url: "<?php echo url('transferCpns/getNilai'); ?>",
            type: "POST",
            data: {id: $(this).val()},
            success: function(data) {

                obj = JSON.parse(data);
                $("#nip").val(obj.nip);
                $("#unit_kerja").val(obj.unit_kerja);
                $("#jenis_kelamin").val(obj.jenis_kelamin);
                $("#tempat_lahir").val(obj.tempat_lahir);
                $("#tanggal_lahir").val(obj.tanggal_lahir);
                $("#pendidikan_terakhir").val(obj.pendidikan_terakhir);
                $("#tahun_pendidikan").val(obj.tahun_pendidikan);
                $("#golru").val(obj.golru);
                $("#mas_kerja").val(obj.masa_kerja);
                $("#tmt").val(obj.tmt);
            }
        });
    })
</script>