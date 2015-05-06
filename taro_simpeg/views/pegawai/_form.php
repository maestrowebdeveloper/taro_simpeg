<?php if (isset($_GET['v'])) { ?>
    <div class="alert alert-info">
        <label class="radio">
            <input id="viewTab" value="PNS" checked="checked" name="view" type="radio">
            <label for="viewTab">View as Tab</label></label>
        <label class="radio"><input id="viewFull" name="view" type="radio">
            <label for="viewFull">View as Report </label></label>
    </div>

<?php } ?>

<div id="tabView">
    <div class="form">

        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'pegawai-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data'
            )
        ));
        ?>
        <fieldset>
            <?php if (!isset($_GET['v'])) { ?>
                <legend>
                    <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
                </legend>
            <?php } ?>

            <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#pegawai">Data Pegawai</a></li>
                <!-- <li ><a href="#pangkatJabatan">Pangkat & Jabatan</a></li> -->
                <?php
                if ($model->isNewRecord == false) {
                    if (!isset($_GET['v'])) {
                        echo '                                           
                            <li><a href="#keluarga"> R. Keluarga</a></li>                                                                       
                            <li><a href="#pelatihan"> R. Diklat</a></li>       
                            <li><a href="#penghargaan"> R. Penghargaan</a></li>       
                            <li><a href="#hukuman"> R. Hukuman</a></li> 
                            <li><a href="#cuti"> R. Cuti</a></li> 
                            <li><a href="#file"> File</a></li> 
                            ';
                    } else {
                        echo '  
                            <li><a href="#pangkat"> R. Pangkat</a></li>              
                            <li><a href="#jabatan"> R. Jabatan</a></li>       
                            <li><a href="#gaji"> R. Gaji</a></li>       
                            <li><a href="#keluarga"> R. Keluarga</a></li>                                           
                            <li><a href="#pendidikan"> R. Pendidikan</a></li>                                           
                            <li><a href="#pelatihan"> R. Diklat</a></li>       
                            <li><a href="#penghargaan"> R. Penghargaan</a></li>       
                            <li><a href="#hukuman"> R. Hukuman</a></li> 
                            <li><a href="#cuti"> R. Cuti</a></li> 
                            <li><a href="#file"> File</a></li> 
                            ';
                    }
                }
                ?>               
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="pegawai">
                    <div class="form-row row-fluid">
                        <fieldset>
                            <legend>Biodata Pegawai <div class="pull-right" style="font-size: 12px;font-style: italic;">Last Update : <?php echo $model->lastEdit ?></div></legend>
                        </fieldset>
                        <div class="span9" style="margin-left: 0px;"> 
                            <div class="control-group "><label class="control-label required" for="Pegawai_nip">Nip <span class="required">*</span></label>
                                <div class="controls">
                                    <input class="span4 angka nip" style="max-width:500px;width:200px" maxlength="18"value="<?php echo $model->nip; ?>" name="Pegawai[nip]" id="Pegawai_nip" type="text">
                                    <span class="red nipError" style="display:none">NIP Baru kurang dari 18 digit.</span> 
                                    <input class="span4" style="max-width:500px;width:200px" maxlength="18" placeholder="NIP Lama" value="<?php echo $model->nip_lama; ?>" name="Pegawai[nip_lama]" id="Pegawai_nip_lama" type="text">
                                </div>
                            </div>                        
                            <?php
                            //echo $form->textFieldRow($model,'nip',array('class'=>'span4 angka','style'=>'max-width:500px;width:300px','maxlength'=>18));                                     
                            echo $form->textFieldRow($model, 'nama', array('class' => 'span5', 'maxlength' => 100));
                            echo $form->hiddenField($model, 'pendidikan_id', array('class' => 'span5', 'maxlength' => 100));
                            ?>                    
                            <div class="control-group "><label class="control-label" for="Pegawai_pendidikan_terakhir">Pendidikan</label>
                                <div class="controls">                                    
                                    <input class="span3" disabled value="<?php echo $model->pendidikanTerakhir; ?>"  id="pendidikanTerakhir" placeHolder="Pendidikan Terakhir" type="text">
                                    <input class="span1 angka"  disabled maxlength="4" value="<?php echo $model->pendidikanTahun; ?>" id="pendidikanTahun" placeHolder="Tahun" type="text">
                                    <?php if (!isset($_GET['v']) && $model->isNewRecord == false) { ?>
                                        <a class="btn blue pilihPendidikan" pegawai="<?php echo $model->id; ?>;" id="pilihPendidikan"><i class="wpzoom-search blue"></i> Riwayat Pendidikan</a>
                                    <?php } ?>

                                </div>
                            </div>

                            <div class="control-group "><label class="control-label" for="Pegawai_pendidikan_terakhir">Jurusan</label>
                                <div class="controls">                                                                       
                                    <input class="span6" disabled maxlength="4" value="<?php echo $model->pendidikanJurusan; ?>" id="pendidikanJurusan" placeHolder="Jurusan" type="text">
                                </div>
                            </div>

                            <div class="control-group "><label class="control-label" for="Pegawai_gelar_depan">Gelar</label>
                                <div class="controls">
                                    <input class="span2" maxlength="25" value="<?php echo $model->gelar_depan; ?>" name="Pegawai[gelar_depan]" id="Pegawai_gelar_depan" placeHolder="Depan" type="text">
                                    <input class="span2" maxlength="25" value="<?php echo $model->gelar_belakang; ?>" name="Pegawai[gelar_belakang]" id="Pegawai_gelar_belakang" placeHolder="Belakang" type="text">
                                </div>
                            </div>

                            <?php
                            echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin());

                            $kotaName = isset($model->tempat_lahir) ? $model->tempat_lahir : '';
                            echo $form->select2Row($model, 'tempat_lahir', array(
                                'asDropDownList' => false,
                                'options' => array(
                                    'placeholder' => t('choose', 'global'),
                                    'allowClear' => true,
                                    'width' => '400px',
                                    'minimumInputLength' => '3',
                                    'ajax' => array(
                                        'url' => Yii::app()->createUrl('city/getListKota2'),
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
                            callback({id: 1, text: "' . $kotaName . '" });
                             
                                  
                            }',
                                ),
                                    )
                            );

                            echo $form->datepickerRow(
                                    $model, 'tanggal_lahir', array('value' => str_replace("0000-00-00", "", $model->tanggal_lahir),
                                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                'events' => array('changeDate' => 'js:function(){
                                                                pensiun($(this).val(), $("#Pegawai_riwayat_jabatan_id").val());
                                                         }'),
                                'prepend' => '<i class="icon-calendar"></i>',
                                    )
                            );
                            $id_city = '';
                            $id_city = (!empty($model->city_id)) ? $model->city_id : 0;
                            $city = !empty($model->City->name) ? $model->City->Province->name . ' - ' . $model->City->name : 0;

                            echo $form->select2Row($model, 'city_id', array(
                                'asDropDownList' => false,
                                'options' => array(
                                    'placeholder' => t('choose', 'global'),
                                    'allowClear' => true,
                                    'width' => '400px',
                                    'minimumInputLength' => '3',
                                    'ajax' => array(
                                        'url' => Yii::app()->createUrl('city/getListKota'),
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
                            callback({id: ' . $id_city . ', text: "' . $city . '" });
                             
                                  
                            }',
                                ),
                                    )
                            );
                            echo $form->textAreaRow($model, 'alamat', array('rows' => 2, 'style' => 'width:50%', 'class' => 'span9'));
                            echo $form->textFieldRow($model, 'kode_pos', array('class' => 'span2', 'style' => 'max-width:500px;width:100px', 'maxlength' => 10));
                            ?>
                        </div>
                        <div class="span3" style="margin-left: -15px;">
                            <?php
                            $cc = '';
                            if ($model->isNewRecord) {
                                $img = Yii::app()->landa->urlImg('', '', '');
                            } else {
                                $img = Yii::app()->landa->urlImg('pegawai/', $model->foto, $_GET['id']);
                                $imgs = param('urlImg') . '350x350-noimage.jpg';
                                $cc = CHtml::ajaxLink(
                                                '<i class="icon-trash"></i>', url('pegawai/removephoto', array('id' => $model->id)), array(
                                            'type' => 'POST',
                                            'success' => 'function( data )
                                                    {
                                                           $("#my_image").attr("src","' . $imgs . '");
                                                           $("#yt0").fadeOut();
                                                    }'), array('class' => 'btn btn-large btn-block btn-primary', 'style' => 'width: 250px;font-size: 15px;')
                                        )
                                ;
                            }
                            echo '<img src="' . $img['medium'] . '" alt="" class="image img-polaroid" id="my_image"  /> ';
                            if (!isset($_GET['v'])) {
                                echo $cc;
                                ?>
                                <br><div style="margin-left: -100px;"> <?php echo $form->fileFieldRow($model, 'foto', array('class' => 'span3')); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-row row-fluid">
                        <div class="span12">
                            <?php
                            if (!isset($_GET['v'])) {

//                                echo $form->textAreaRow($model, 'alamat', array('rows' => 2, 'style' => 'width:50%', 'class' => 'span9'));
//                                echo $form->textFieldRow($model, 'kode_pos', array('class' => 'span2', 'style' => 'max-width:500px;width:100px', 'maxlength' => 10));
//                                echo $form->textFieldRow($model, 'hp', array('class' => 'span5 angka', 'style' => 'max-width:500px;width:200px', 'maxlength' => 25, 'prepend' => '+62'));
//                                echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 50));
//                                echo $form->radioButtonListRow($model, 'golongan_darah', Pegawai::model()->ArrGolonganDarah());
                            }
                            echo $form->radioButtonListRow($model, 'agama', Pegawai::model()->ArrAgama());
                            echo $form->textFieldRow($model, 'ket_agama', array('class' => 'span5', 'maxlength' => 50));
                            echo $form->radioButtonListRow($model, 'status_pernikahan', Pegawai::model()->arrStatusPernikahan());
                            ?>
                            <fieldset>
                                <legend>Status Kepegawaian</legend>
                            </fieldset>
                            <div class="row-fluid">
                                <div class="span5">
                                    <?php
                                    echo $form->textFieldRow($model, 'npwp', array('class' => 'span6', 'maxlength' => 50));
                                    echo $form->textFieldRow($model, 'karpeg', array('class' => 'span6', 'maxlength' => 50));
                                    echo $form->textFieldRow($model, 'kpe', array('class' => 'span6', 'maxlength' => 50));
                                    ?>
                                </div>
                                <div class="span5">
                                    <?php
                                    echo $form->textFieldRow($model, 'no_taspen', array('class' => 'span6', 'maxlength' => 50));
                                    echo $form->textFieldRow($model, 'bpjs', array('class' => 'span6', 'maxlength' => 50));
                                    ?>        
                                </div>
                            </div>

                            <fieldset>
                                <legend>Pangkat & Jabatan</legend>
                            </fieldset>
                            <?php
                            $data = array('0' => '- Kedudukan -') + CHtml::listData(Kedudukan::model()->findAll(), 'id', 'nama');
                            echo $form->select2Row($model, 'kedudukan_id', array(
                                'asDropDownList' => true,
                                'data' => $data,
                                'options' => array(
                                    "allowClear" => false,
                                    'width' => '40%',
                                ))
                            );

                            echo $form->textFieldRow($model, 'keterangan', array('class' => 'span5', 'maxlength' => 50));
                            ?>
                            <div class="control-group ">
                                <label class="control-label" for="Pegawai_tmt_cpns">Tmt Keterangan</label>
                                <div class="controls">

                                    <div class="input-prepend" style="margin-right: 40px;">
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                        <?php
                                        $this->widget(
                                                'bootstrap.widgets.TbDatePicker', array(
                                            'name' => 'Pegawai[tmt_keterangan_kedudukan]',
                                            'value' => str_replace("0000-00-00", "", $model->tmt_keterangan_kedudukan),
                                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
//                                            'events' => array('changeDate' => 'js:function(){
//                                                                getMasaKerja();
//                                                         }'),
                                                )
                                        );
                                        ?>
                                    </div>


                                </div>
                            </div>
                            <?php
//                            $data = array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
//                            echo $form->select2Row($model, 'unit_kerja_id', array(
//                                'asDropDownList' => true,
//                                'data' => $data,
//                                'options' => array(
//                                    "allowClear" => false,
//                                    'width' => '50%',
//                                ))
//                            );
                            ?>
                            <div class="control-group ">
                                <label class="control-label" for="Pegawai_tmt_cpns">Tmt CPNS</label>
                                <div class="controls">
                                    <div class="input-prepend" style="margin-right: 40px;">
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                        <?php
                                        $this->widget(
                                                'bootstrap.widgets.TbDatePicker', array(
                                            'name' => 'Pegawai[tmt_cpns]',
                                            'value' => str_replace("0000-00-00", "", $model->tmt_cpns),
                                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                            'events' => array('changeDate' => 'js:function(){
                                                                getMasaKerja();
                                                         }'),
                                                )
                                        );
                                        ?>
                                    </div>
                                    <?php
                                    echo '&nbsp;&nbsp;';
                                    echo CHtml::textField('Pegawai[ket_tmt_cpns]', isset($model->ket_tmt_cpns) ? $model->ket_tmt_cpns : '', array('class' => 'span4', 'placeholder' => 'Keterangan Tmt CPNS'));
                                    ?>
                                </div>
                            </div>
                            <div class="control-group ">
                                <label class="control-label" for="Pegawai_tmt_cpns">Tgl/No SK CPNS</label>
                                <div class="controls">

                                    <div class="input-prepend" style="margin-right: 40px;">
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                        <?php
                                        $this->widget(
                                                'bootstrap.widgets.TbDatePicker', array(
                                            'name' => 'Pegawai[tanggal_sk_cpns]',
                                            'value' => str_replace("0000-00-00", "", $model->tanggal_sk_cpns),
                                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
//                                            'events' => array('changeDate' => 'js:function(){
//                                                                getMasaKerja();
//                                                         }'),
                                                )
                                        );
                                        ?>
                                    </div>
                                    <?php
                                    echo '&nbsp;&nbsp;';
                                    echo CHtml::textField('Pegawai[no_sk_cpns]', isset($model->no_sk_cpns) ? $model->no_sk_cpns : '', array('class' => 'span4', 'placeholder' => 'No Sk CPNS'));
                                    ?>

                                </div>
                            </div>
                            <?php
                            echo $form->datepickerRow(
                                    $model, 'tmt_pns', array('value' => str_replace("0000-00-00", "", $model->tmt_pns),
                                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                'prepend' => '<i class="icon-calendar"></i>',
                                    )
                            );
                            ?>
                            <div class="control-group ">
                                <label class="control-label" for="Pegawai_tmt_cpns">Tgl/No SK PNS</label>
                                <div class="controls">

                                    <div class="input-prepend" style="margin-right: 40px;">
                                        <span class="add-on"><i class="icon-calendar"></i></span>
                                        <?php
                                        $this->widget(
                                                'bootstrap.widgets.TbDatePicker', array(
                                            'name' => 'Pegawai[tanggal_sk_pns]',
                                            'value' => str_replace("0000-00-00", "", $model->tanggal_sk_pns),
                                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
//                                            'events' => array('changeDate' => 'js:function(){
//                                                                getMasaKerja();
//                                                         }'),
                                                )
                                        );
                                        ?>
                                    </div>
                                    <?php
                                    echo '&nbsp;&nbsp;';
                                    echo CHtml::textField('Pegawai[no_sk_pns]', isset($model->no_sk_pns) ? $model->no_sk_pns : '', array('class' => 'span4', 'placeholder' => 'No Sk PNS'));
                                    ?>

                                </div>
                            </div>
                            <?php
                            echo $form->textfieldRow(
                                    $model, 'tmt_pensiun', array('value' => str_replace("0000-00-00", "", $model->tmt_pensiun), 'readonly' => true,
                                'prepend' => '<i class="icon-calendar"></i>',
                                    )
                            );
                            ?>
                            <div class="control-group "><label class="control-label" for="Pegawai_golongan_id">Pangkat/Golru</label>
                                <div class="controls">
                                    <?php
                                    echo $form->hiddenField($model, 'riwayat_pangkat_id', array('class' => 'span5', 'maxlength' => 100));
                                    ?>
                                    <input class="span4" disabled value="<?php echo $model->Pangkat->golongan; ?>"  id="nama_pangkat" placeHolder="" type="text">
                                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                                        <input class="span10"  disabled maxlength="4" id="tmtPangkat" value="<?php echo $model->tmtPangkat; ?>"  type="text">
                                    </div>                                    

                                    <?php if (!isset($_GET['v']) && $model->isNewRecord == false) { ?>
                                        <a class="btn blue pilihPangkat" pegawai="<?php echo $model->id; ?>;" id="pilihPangkat"><i class="wpzoom-search blue"></i> Riwayat Pangkat</a>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="control-group "><label class="control-label" for="Pegawai_golongan_id">Tipe Jabatan</label>
                                <div class="controls">
                                    <?php
                                    echo $form->hiddenField($model, 'riwayat_jabatan_id', array('class' => 'span5', 'maxlength' => 100));
                                    ?>
                                    <input class="span4" disabled value="<?php echo $model->riwayatTipeJabatan; ?>"  id="riwayatTipeJabatan" placeHolder="" type="text">                                    
                                    <?php if (!isset($_GET['v']) && $model->isNewRecord == false) { ?>
                                        <a class="btn blue pilihJabatan" pegawai="<?php echo $model->id; ?>;" id="pilihJabatan"><i class="wpzoom-search blue"></i> Riwayat Jabatan</a>
                                    <?php } ?>
                                </div>
                            </div>
                            

                            <div class="control-group "><label class="control-label" for="Pegawai_golongan_id">Jabatan</label>
                                <div class="controls">                                    
                                    <input class="span4" disabled value="<?php echo $model->riwayatNamaJabatan; ?>"  id="riwayatNamaJabatan" placeHolder="" type="text">
                                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                                        <input class="span10"  disabled maxlength="4" id="riwayatTmtJabatan" value="<?php echo $model->riwayatTmtJabatan; ?>"  type="text">
                                    </div>                                                                                                            
                                </div>
                            </div>

                            <div class="control-group "><label class="control-label" for="Pegawai_bidang_id">Unit Kerja</label>
                                <div class="controls">                                    
                                    <input class="span4" disabled value="<?php echo $model->riwayatBidangJabatan; ?>"  id="riwayatBidangJabatan" placeHolder="" type="text">
                                </div>
                            </div>

                            <?php
                            if (isset($model->perubahan_masa_kerja) and !empty($model->perubahan_masa_kerja)) {
                                $perubahan = json_decode($model->perubahan_masa_kerja, false);
                            }
                            ?>
                            <div class="control-group ">
                                <label class="control-label" for="masaKerja">Masa Kerja</label>
                                <div class="controls">
                                    <div class="input-append span1" style="margin-right: 5px;">
                                        <?php echo CHtml::textField('masaKerja', $model->masaKerjaTahun, array('id' => 'masaKerjaTahun', 'class' => 'span8', 'disabled' => true)); ?>    
                                        <span class="add-on">
                                            Tahun
                                        </span>
                                    </div>
                                    <div class="input-append span1" style="margin-right: 5px;">
                                        <?php echo CHtml::textField('masaKerja', $model->masaKerjaBulan, array('id' => 'masaKerjaBulan', 'class' => 'span8', 'disabled' => true)); ?>    
                                        <span class="add-on">
                                            Bulan
                                        </span>
                                    </div>    
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="perubahanMasaKerja">Penambahan / Pengurangan Masa Kerja</label>
                                <div class="controls">
                                    <div class="input-append span1" style="margin-right: 5px;">
                                        <?php echo CHtml::textField('kalkulasiTahun', isset($perubahan->tahun) ? $perubahan->tahun : 0, array('id' => 'kalkulasiTahun', 'class' => 'span8', 'onkeyup' => 'getMasaKerja();')); ?>
                                        <span class="add-on">
                                            Tahun
                                        </span>
                                    </div>
                                    <div class="input-append span1">
                                        <?php echo CHtml::textField('kalkulasiBulan', isset($perubahan->bulan) ? $perubahan->bulan : 0, array('id' => 'kalkulasiBulan', 'class' => 'span8', 'onkeyup' => 'getMasaKerja();')); ?>    
                                        <span class="add-on">
                                            Bulan
                                        </span>
                                    </div>
                                    <input type="hidden" name="Pegawai[id]" value="<?php echo isset($model->id) ? $model->id : ''; ?>">
                                    <br><br>
                                    Gunakan tanda (<b>-</b>) untuk mengurangi tahun maupun bulan
                                </div>
                            </div>
                            <div class="control-group "><label class="control-label" for="Pegawai_golongan_id">Gaji Sekarang</label>
                                <div class="controls">
                                    <?php
                                    echo $form->hiddenField($model, 'riwayat_gaji_id', array('class' => 'span5', 'maxlength' => 100));
                                    ?>
                                    <input class="span4" disabled value="<?php echo $model->gajiPegawai; ?>"  id="riwayatGaji" placeHolder="" type="text">                                    
                                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                                        <input class="span10"  disabled maxlength="4" id="tmtMulai" value="<?php echo $model->tmtGaji; ?>"  type="text">
                                    </div> 
                                    <?php if (!isset($_GET['v']) && $model->isNewRecord == false) { ?>
                                        <a class="btn blue pilihGaji" pegawai="<?php echo $model->id; ?>;" id="pilihGaji"><i class="wpzoom-search blue"></i> Riwayat Gaji</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 



                <?php
                if ($model->isNewRecord == false) {
                    $pangkat = RiwayatPangkat::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tmt_pangkat DESC'));
                    $jabatan = RiwayatJabatan::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tmt_mulai DESC'));
                    $gaji = RiwayatGaji::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tmt_mulai DESC'));
                    $keluarga = RiwayatKeluarga::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'hubungan DESC'));
                    $pendidikan = RiwayatPendidikan::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tahun DESC'));
                    $hukuman = RiwayatHukuman::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tanggal_pemberian DESC'));
                    $cuti = RiwayatCuti::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tanggal_sk DESC'));
                    $pelatihan = RiwayatPelatihan::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tanggal DESC'));
                    $penghargaan = RiwayatPenghargaan::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tanggal_pemberian DESC'));
                    $file = File::model()->findAll(array('condition' => 'pegawai_id=' . $model->id));

                    if (!isset($_GET['v']))
                        $edit = true;
                    else
                        $edit = false;

                    if (isset($_GET['v'])) {
                        ?>
                        <div class="tab-pane " id="pangkat">
                            <?php echo $this->renderPartial('_tablePangkat', array('pangkat' => $pangkat, 'edit' => $edit)); ?>
                        </div>
                        <div class="tab-pane " id="jabatan">
                            <?php echo $this->renderPartial('_tableJabatan', array('jabatan' => $jabatan, 'edit' => $edit)); ?>                
                        </div>
                        <div class="tab-pane " id="gaji">
                            <?php echo $this->renderPartial('_tableGaji', array('gaji' => $gaji, 'edit' => $edit)); ?>                
                        </div>
                        <?php
                    }
                    ?>

                    <div class="tab-pane " id="keluarga">
                        <?php echo $this->renderPartial('_tableKeluarga', array('keluarga' => $keluarga, 'edit' => $edit)); ?>                
                    </div>
                    <div class="tab-pane " id="pendidikan">
                        <?php echo $this->renderPartial('_tablePendidikan', array('pendidikan' => $pendidikan, 'edit' => $edit)); ?>                
                    </div>
                    <div class="tab-pane " id="penghargaan">
                        <?php echo $this->renderPartial('_tablePenghargaan', array('penghargaan' => $penghargaan, 'edit' => $edit)); ?>                
                    </div>
                    <div class="tab-pane " id="pelatihan">
                        <?php echo $this->renderPartial('_tablePelatihan', array('pelatihan' => $pelatihan, 'edit' => $edit)); ?>                
                    </div>
                    <div class="tab-pane " id="hukuman">
                        <?php echo $this->renderPartial('_tableHukuman', array('hukuman' => $hukuman, 'edit' => $edit)); ?>                
                    </div>
                    <div class="tab-pane " id="cuti">
                        <?php echo $this->renderPartial('_tableCuti', array('cuti' => $cuti, 'edit' => $edit)); ?>                
                    </div>
                    <div class="tab-pane" id="file">

                        <?php
                        if (!isset($_GET['v']))
                            echo $this->renderPartial('_formUploadFile', array('model' => $model, 'file' => $file, 'edit' => $edit));
                        echo $this->renderPartial('_tableFile', array('model' => $model, 'file' => $file, 'edit' => $edit))
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php if (!isset($_GET['v'])) { ?>        
                <div class="form-actions">
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
</div>

<?php if (isset($_GET['v'])) {
    ?>
    <div class='report' id="report" style="display:none">
        <style >
            @media print
            {
                table.table td{border: none !important;}

            }
        </style>
        <table class="table">
            <tr>
                <th style="background:beige;text-align:center !important" colspan="2">
            <h3 style="margin:0px">PROFIL <?php echo strtoupper($model->nama); ?></h3>
            </th>
            </tr>
            <tr>


                <td style="line-height:10px;vertical-align:top;" class="span2">            
                    <?php
                    $img = Yii::app()->landa->urlImg('pegawai/', $model->foto, $_GET['id']);
                    echo '<img style="max-width:250px;max-height:350px;" src="' . $img['medium'] . '" alt="" class="image img-polaroid" id="my_image"  /> ';
                    ?>

                </td>

                <td>
                    <div style="padding:8px">
                        <table class="table2" width="100%" >

                            <tr><td>NIP</td><td>:</td><td><?php echo $model->nip; ?></td></tr>
                            <tr><td>Nama</td><td>:</td><td><?php echo $model->namaGelar; ?></td></tr>
                            <tr><td>Pendidikan</td><td>:</td><td><?php echo ucwords(strtolower($model->pendidikanTerakhir)) . ', Tahun : ' . $model->pendidikanTahun; ?></td></tr>
                            <tr><td>Jurusan</td><td>:</td><td><?php echo ucwords(strtolower($model->pendidikanJurusan)); ?></td></tr>
                            <tr><td>Jenis Kelamin</td><td>:</td><td><?php echo $model->jenis_kelamin; ?></td></tr>
                            <tr><td>TTL</td><td>:</td><td><?php echo $model->ttl; ?></td></tr>
                            <tr><td>Kode Pos</td><td>:</td><td><?php echo $model->kode_pos; ?></td></tr>
                            <tr><td>HP</td><td>:</td><td><?php echo landa()->hp($model->hp); ?></td></tr>
                            <tr><td>Agama</td><td>:</td><td><?php echo $model->agama; ?></td></tr>
                            <tr><td>Golongan Darah</td><td>:</td><td><?php echo $model->golongan_darah; ?></td></tr>
                            <tr><td>Status Pernikahan</td><td>:</td><td><?php echo $model->status_pernikahan; ?></td></tr>
                            <tr><td>NPWP</td><td>:</td><td><?php echo $model->npwp; ?></td></tr>
                            <tr><td>Karpeg</td><td>:</td><td><?php echo $model->karpeg; ?></td></tr>
                            <tr><td>KPE</td><td>:</td><td><?php echo $model->kpe; ?></td></tr>
                            <tr><td>Taspen</td><td>:</td><td><?php echo $model->no_taspen; ?></td></tr>
                            <tr><td>BPJS/ASKES/KIS</td><td>:</td><td><?php echo $model->bpjs; ?></td></tr>

                        </table>
                    </div>
                </td>

            </tr>  
            <tr>
                <th style="background:beige" colspan="2">PANGKAT & JABATAN</th>
            </tr>
            <tr><td style="text-align:left" class="span3" colspan="3">
                    <div style="padding:8px">
                        <table class="table2" width="400" >
                            <tr>
                            <tr><td>Kedudukan</td><td>:</td><td><?php echo $model->kedudukan; ?></td></tr>
                            <tr><td>Unit Kerja</td><td>:</td><td><?php echo $model->unitKerja; ?></td></tr>
                            <tr><td>TMT CPNS</td><td>:</td><td><?php echo date('d M Y', strtotime($model->tmt_cpns)); ?></td></tr>
                            <tr><td>TMT PNS</td><td>:</td><td><?php echo date('d M Y', strtotime($model->tmt_pns)); ?></td></tr>
                            <tr><td>Pangkat / Golru</td><td>:</td><td><?php echo isset($model->Pangkat->golongan) ? $model->Pangkat->golongan : "-" . ' TMT : ' . date('d M Y', strtotime(isset($model->Pangkat->tmt_golongan) ? $model->Pangkat->tmt_golongan : "-")); ?></td></tr>
                            <tr><td>Tipe Jabatan</td><td>:</td><td><?php echo ucwords(str_replace("_", " ", $model->tipe_jabatan)); ?></td></tr>
                            <tr><td>Jabatan</td><td>:</td><td><?php echo $model->jabatan . ', TMT :  ' . $model->tmtJabatan; ?></td></tr>
                            <tr><td>Masa Kerja</td><td>:</td><td><?php echo $model->masaKerja; ?></td></tr>
                            <tr><td>Gaji</td><td>:</td><td><?php echo landa()->rp(isset($model->Gaji->gaji) ? $model->Gaji->gaji : 0); ?></td></tr>
                            <tr><td>TMT Pensiun</td><td>:</td><td><?php echo date('d M Y', strtotime($model->tmt_pensiun)); ?></td></tr>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr> 
            <tr>
                <th style="background:beige" colspan="2">RIWAYAT PANGKAT / GOLONGAN</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tablePangkat', array('pangkat' => $pangkat)); ?>
                </td>
            </tr>
            <tr>
                <th style="background:beige"  colspan="2">RIWAYAT JABATAN</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tableJabatan', array('jabatan' => $jabatan)); ?> 
                </td>
            </tr>
            <tr>
                <th style="background:beige"  colspan="2">RIWAYAT GAJI</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tableGaji', array('gaji' => $gaji)); ?>
                </td>
            </tr>
            <tr>
                <th style="background:beige"  colspan="2">RIWAYAT KELUARGA</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tableKeluarga', array('keluarga' => $keluarga)); ?>
                </td>
            </tr>
            <tr>
                <th style="background:beige"  colspan="2">RIWAYAT PENDIDIKAN</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tablePendidikan', array('pendidikan' => $pendidikan)); ?>
                </td>
            </tr>
            <tr>
                <th style="background:beige"  colspan="2">RIWAYAT PENGHARGAAN</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tablePenghargaan', array('penghargaan' => $penghargaan)); ?> 
                </td>
            </tr>
            <tr>
                <th style="background:beige"  colspan="2">RIWAYAT PELATIHAN</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tablePelatihan', array('pelatihan' => $pelatihan)); ?>
                </td>
            </tr>    
            <tr>
                <th style="background:beige"  colspan="2">RIWAYAT HUKUMAN</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tableHukuman', array('hukuman' => $hukuman)); ?>
                </td>
            </tr>
            <tr>
                <th style="background:beige"  colspan="2">RIWAYAT CUTI</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php echo $this->renderPartial('_tableCuti', array('cuti' => $cuti)); ?>
                </td>
            </tr>
        </table>
    </div>
<?php } ?>



<?php
$this->beginWidget(
        'bootstrap.widgets.TbModal', array('id' => 'modalForm')
);
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3 style="text-align:center">RIWAYAT PEGAWAI</h3>
</div>
<div class="modal-body form-horizontal">

</div>

<?php $this->endWidget(); ?>


<style>

    .form-horizontal{
        margin-bottom: 0px;
    }
    .form-actions{
        margin-bottom: 0px;
    }
    .form-row  .control-label{
        margin-right: 30px;
    }
    .form-row .controls input{
        margin-bottom: 0px;
    }
    .modal {
        height: auto; 
        width: 90%; 
        margin : -2% 0 0 -45%; 
    }
    .modal-body{
        max-height: 500px;
    }
</style>
<script>
    function getMasaKerja() {
        $.ajax({
            url: "<?php echo url('pegawai/getMasaKerja') ?> ",
            type: "POST",
            data: {tmt_cpns: $("#Pegawai_tmt_cpns").val(), tahun: $("#kalkulasiTahun").val(), bulan: $("#kalkulasiBulan").val()},
            success: function(data) {
                obj = JSON.parse(data);
                $("#masaKerjaTahun").val(obj.tahun);
                $("#masaKerjaBulan").val(obj.bulan);
            }
        });
    }

    $("#viewTab").click(function() {
        $("#report").hide();
        $("#tabView").show();
    });

    $("#viewFull").click(function() {
        $("#report").show();
        $("#tabView").hide();
    });

    $("#Pegawai_nip").focusout(function() {
        var value = $(this).val();
        if (value.length < 18) {
            $(".nipError").show();
        } else {
            $(".nipError").hide();
        }

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
        });
        $("#viewTab").click(function() {
            $("#report").hide();
            $("#tabView").show();
        });

        $("#viewFull").click(function() {
            $("#report").show();
            $("#tabView").hide();
        });

    }

    function pensiun(tanggal, jabatan) {
        $.ajax({
            url: "<?php echo url('pegawai/getPensiun') ?> ",
            type: "POST",
            data: {tanggal_lahir: tanggal, riwayatJabatan: jabatan},
            success: function(data) {
                $("#Pegawai_tmt_pensiun").val(data);
//                alert(tanggal + " id " + jabatan);
//                alert(data);
            }
        });
    }
    $(".pilihPendidikan").click(function() {
        $.ajax({
            url: "<?php echo url('pegawai/getTablePendidikan'); ?>",
            data: "id=<?php echo $model->id; ?>" + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function(data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });

    $(".pilihPangkat").click(function() {
        $.ajax({
            url: "<?php echo url('pegawai/getTablePangkat'); ?>",
            data: "id=<?php echo $model->id; ?>" + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function(data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });

    $(".pilihJabatan").click(function() {
        $.ajax({
            url: "<?php echo url('pegawai/getTableJabatan'); ?>",
            data: "id=<?php echo $model->id; ?>" + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function(data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
    $(".pilihGaji").click(function() {
        $.ajax({
            url: "<?php echo url('pegawai/getTableGaji'); ?>",
            data: "id=<?php echo $model->id; ?>" + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function(data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
    $(function() {

        $('#Pegawai_kedudukan_id').change(function() {
            if ($('#Pegawai_kedudukan_id').val() == '1') {
                $("#Pegawai_keterangan").parent().parent().attr("style", "display:none");
                $('#Pegawai_keterangan').attr("value", "");
                $("#Pegawai_tmt_keterangan_kedudukan").parent().parent().parent().attr("style", "display:none");
                $('#Pegawai_tmt_keterangan_kedudukan').attr("value", "");
            } else {
                $("#Pegawai_keterangan").parent().parent().attr("style", "display:");
                $("#Pegawai_tmt_keterangan_kedudukan").parent().parent().parent().attr("style", "display:");
            }
        });
    });
    $("body").on("click", ".radio", function() {

        var id = $(this).find("input").val();
        if (id == "Lainnya") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:");

        } else if (id == "Islam") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:none");
            $('#Pegawai_ket_agama').attr("value", "");
        } else if (id == "Hindu") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:none");
            $('#Pegawai_ket_agama').attr("value", "");
        } else if (id == "Khatolik") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:none");
            $('#Pegawai_ket_agama').attr("value", "");
        } else if (id == "Protestan") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:none");
            $('#Pegawai_ket_agama').attr("value", "");
        } else if (id == "Konghucu") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:none");
            $('#Pegawai_ket_agama').attr("value", "");
        }
    });
<?php
if ($model->agama == "Lainnya") {
    echo '$("#Pegawai_ket_agama").parent().parent().attr("style", "display:");';
} else {
    echo '$("#Pegawai_ket_agama").parent().parent().attr("style", "display:none");';
}

//
if ($model->kedudukan_id == "1") {
    echo ' $("#Pegawai_keterangan").parent().parent().attr("style", "display:none");';
} else {
    echo ' $("#Pegawai_keterangan").parent().parent().attr("style", "display:");';
}
?>
</script>
