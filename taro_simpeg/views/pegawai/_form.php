<?php if (isset($_GET['v'])) { ?>
    <div class="alert alert-info">
        <label class="radio">
            <input id="viewTab" value="PNS" checked="checked" name="view" type="radio">
            <label for="viewTab">View as Tab</label></label>
        <label class="radio"><input id="viewFull" name="view" type="radio">
            <label for="viewFull">Vimasew as Report </label></label>
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
                            <li><a href="#gaji"> R. Gaji</a></li>       
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
                            <legend>Biodata Pegawai</legend>
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
//                    'data' => $data,
//                    'value' => $model->Kota->name,
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
                                'prepend' => '<i class="icon-calendar"></i>',
                                    )
                            );
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
                                $kota = isset($model->kota) ? $model->kota : '';
                                echo $form->select2Row($model, 'kota', array(
                                    'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Kota->name,
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
                            callback({id: 1, text: "' . $kota . '" });
                             
                                  
                            }',
                                    ),
                                        )
                                );
                                echo $form->textAreaRow($model, 'alamat', array('rows' => 2, 'style' => 'width:50%', 'class' => 'span9'));
                                echo $form->textFieldRow($model, 'kode_pos', array('class' => 'span2', 'style' => 'max-width:500px;width:100px', 'maxlength' => 10));
                                echo $form->textFieldRow($model, 'hp', array('class' => 'span5 angka', 'style' => 'max-width:500px;width:200px', 'maxlength' => 25, 'prepend' => '+62'));
                                echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 50));
                                echo $form->radioButtonListRow($model, 'golongan_darah', Pegawai::model()->ArrGolonganDarah());
                            }
                            echo $form->radioButtonListRow($model, 'agama', Pegawai::model()->ArrAgama());
                            echo $form->textFieldRow($model, 'ket_agama', array('class' => 'span5', 'maxlength' => 50));
                            echo $form->radioButtonListRow($model, 'status_pernikahan', Pegawai::model()->arrStatusPernikahan());
                            ?>
                            <fieldset>
                                <legend>Status Kepegawaian</legend>
                            </fieldset>
                            <?php
                            echo $form->textFieldRow($model, 'npwp', array('class' => 'span5', 'maxlength' => 50));
                            echo $form->textFieldRow($model, 'karpeg', array('class' => 'span5', 'maxlength' => 50));
                            echo $form->textFieldRow($model, 'kpe', array('class' => 'span5', 'maxlength' => 50));
                            echo $form->textFieldRow($model, 'no_taspen', array('class' => 'span5', 'maxlength' => 50));
                            echo $form->textFieldRow($model, 'bpjs', array('class' => 'span5', 'maxlength' => 50));
                            ?>
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

                            $data = array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                            echo $form->select2Row($model, 'unit_kerja_id', array(
                                'asDropDownList' => true,
                                'data' => $data,
                                'options' => array(
                                    "allowClear" => false,
                                    'width' => '50%',
                                ))
                            );
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
                                    echo CHtml::textField('Pegawai[ket_tmt_cpns]', '', array('class' => 'span4', 'placeholder' => 'Keterangan Tmt CPNS'));
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
                            <div class="control-group "><label class="control-label" for="Pegawai_golongan_id">Pangkat/Golru</label>
                                <div class="controls">
                                    <?php
                                    echo $form->hiddenField($model, 'riwayat_pangkat_id', array('class' => 'span5', 'maxlength' => 100));
                                    ?>
                                    <input class="span4" disabled value="<?php echo $model->pangkat; ?>"  id="nama_pangkat" placeHolder="" type="text">
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

                            <?php
                            /* echo $form->radioButtonListRow($model, 'tipe_jabatan', Pegawai::model()->arrTipeJabatan(), array(
                              'onclick' => 'pensiun()'
                              )); */
                            ?>

                            <?php
                            $struktural = ($model->tipe_jabatan == "struktural") ? "" : "none";
                            $fu = ($model->tipe_jabatan == "fungsional_umum") ? "" : "none";
                            $ft = ($model->tipe_jabatan == "fungsional_tertentu") ? "" : "none";
                            ?>

                            <!-- <div class="struktural" style="display:<?php echo $struktural; ?>">              
                                <div class="control-group "><label class="control-label" for="Pegawai_jabatan_struktural_id">Jabatan</label>
                                    <div class="controls">
                            <?php
                            $data = array('0' => '- Jabatan Struktural -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                            $this->widget(
                                    'bootstrap.widgets.TbSelect2', array(
                                'name' => 'Pegawai[jabatan_struktural_id]',
                                'value' => $model->jabatan_struktural_id,
                                'data' => $data,
                                'events' => array('change' => 'js: function() {
                                                    $.ajax({
                                                       url : "' . url('pegawai/statusJabatan') . '",
                                                       type : "POST",
                                                       data : $("#pegawai-form").serialize(),
                                                       success : function(data){   
                                                       obj = JSON.parse(data);
                                                        $("#eselon").val(obj.eselon);
                                                        pensiun();
                                                        if(obj.status==1){
                                                            if($("#Pegawai_jabatan_struktural_id").val()!="' . $model->jabatan_struktural_id . '"){
                                                                alert("Jabatan Telah Diemban Orang Lain");
                                                                $("#s2id_Pegawai_jabatan_struktural_id").select2("val", "' . $model->jabatan_struktural_id . '") ;  
                                                            }        
                                                        }
                                                        
                                                    }
                                                });
                                            }'),
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
                                'name' => 'Pegawai[tmt_jabatan_struktural]',
                                'value' => $model->tmt_jabatan_struktural,
                                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                    )
                            );
                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group "><label class="control-label" for="eselon">Eselon</label>
                                    <div class="controls">
                                        <input type="hidden" name="masa_kerja" id="masa_kerja" value="<?php echo isset($model->JabatanStruktural->Eselon->masa_kerja) and ! empty($model->JabatanStruktural->Eselon->masa_kerja) ? $model->JabatanStruktural->Eselon->id : 0; ?>">
                            <?php
                            echo CHtml::textField('eselon', isset($model->JabatanStruktural->Eselon->nama) ? $model->JabatanStruktural->Eselon->nama : '-', array('id' => 'eselon', 'class' => 'span5', 'readonly' => true));
                            echo '&nbsp;&nbsp;';
                            ?>
                                        <div class="input-prepend">
                                            <span class="add-on"><i class="icon-calendar"></i></span>
                            <?php
                            $this->widget(
                                    'bootstrap.widgets.TbDatePicker', array(
                                'name' => 'Pegawai[tmt_eselon]',
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
                                <div class="control-group "><label class="control-label" for="Pegawai_jabatan_fu_id">Jabatan</label>
                                    <div class="controls">
                            <?php
                            $data = array('0' => '- Jabatan Fungsional Umum -') + CHtml::listData(JabatanFu::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                            $this->widget(
                                    'bootstrap.widgets.TbSelect2', array(
                                'name' => 'Pegawai[jabatan_fu_id]',
                                'value' => $model->jabatan_fu_id,
                                'data' => $data,
                                'events' => array('change' => 'js: function() {
                                                    $.ajax({
                                                       url : "' . url('pegawai/statusJabatan') . '",
                                                       type : "POST",
                                                       data : $("#pegawai-form").serialize(),
                                                       success : function(data){                                                             
                                                        if(data==1){
                                                            if($("#Pegawai_jabatan_fu_id").val()!="' . $model->jabatan_fu_id . '"){
                                                                alert("Jabatan Telah Diemban Orang Lain");
                                                                $("#s2id_Pegawai_jabatan_fu_id").select2("val", "' . $model->jabatan_fu_id . '") ;  
                                                            }                                                                                                                       
                                                        }
                                                        
                                                    }
                                                });
                                            }'),
                                'options' => array(
                                    'width' => '40%;margin:0px;text-align:left',
                            )));
                            echo '&nbsp;&nbsp;';
                            ?>
                                        <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                            <?php
                            $this->widget(
                                    'bootstrap.widgets.TbDatePicker', array(
                                'name' => 'Pegawai[tmt_jabatan_fu]',
                                'value' => str_replace("0000-00-00", "", $model->tmt_jabatan_fu),
                                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                    )
                            );
                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fungsional_tertentu" style="display:<?php echo $ft; ?>">              
                                <div class="control-group "><label class="control-label" for="Pegawai_jabatan_ft_id">Jabatan</label>
                                    <div class="controls">
                            <?php
                            $data = array('0' => '- Jabatan Fungsional Tertentu -') + CHtml::listData(JabatanFt::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                            $this->widget(
                                    'bootstrap.widgets.TbSelect2', array(
                                'name' => 'Pegawai[jabatan_ft_id]',
                                'data' => $data,
                                'value' => $model->jabatan_ft_id,
                                'events' => array('change' => 'js: function() {
                                                    $.ajax({
                                                       url : "' . url('pegawai/fungsionalTertentu') . '",
                                                       type : "POST",
                                                       data : $("#pegawai-form").serialize(),
                                                       success : function(data){                                                                                                               
                                                            $("#jabatan_fungsional_tertentu").val(data);
                                                    }
                                                });
                                            }'),
                                'options' => array(
                                    'width' => '40%;margin:0px;text-align:left',
                            )));
                            echo '&nbsp;&nbsp;';
                            ?>
                                        <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                            <?php
                            $this->widget(
                                    'bootstrap.widgets.TbDatePicker', array(
                                'name' => 'Pegawai[tmt_jabatan_ft]',
                                'value' => str_replace("0000-00-00", "", $model->tmt_jabatan_ft),
                                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                    )
                            );
                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group "><label class="control-label" for="jabatan_fungsional_tertentu">Jabatan Fungsional</label>
                                    <div class="controls">
                            <?php
//                            $model->jabatan_ft_id = ($model->isNewRecord == false) ? $model->jabatan_ft_id : 0;
//                            $jabatanFung = JabatanFungsional::model()->find(array('condition' => 'jabatan_ft_id=' . $model->jabatan_ft_id));
//                            echo CHtml::textField('jabatan_fungsional_tertentu', isset($jabatanFung->nama) ? $jabatanFung->nama : '-', array('id' => 'jabatan_fungsional_tertentu', 'class' => 'span5', 'readonly' => true));
                            ?>   
                                    </div>
                                </div>
                            </div> -->


                            <?php // echo $form->textFieldRow($model, 'gaji', array('class' => 'span5 angka', 'prepend' => 'Rp'));                    ?>

                            <?php
                            if (isset($model->perubahan_masa_kerja) and ! empty($model->perubahan_masa_kerja)) {
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
                                        <?php echo CHtml::textField('kalkulasiBulan', isset($perubahan->bulan) ? $perubahan->bulan : 0, array('id' => 'kalkulasiBulan', 'class' => 'span8', 'onkeyup' => 'if($(this).val() <= 12 && $(this).val() >= -12){ getMasaKerja(); }else{ alert("Masukkan angka -12 sampai 12"); }')); ?>    
                                        <span class="add-on">
                                            Bulan
                                        </span>
                                    </div>
                                    <input type="hidden" name="Pegawai[id]" value="<?php echo isset($model->id) ? $model->id : ''; ?>">
                                    <br><br>
                                    Gunakan tanda (<b>-</b>) untuk mengurangi tahun maupun bulan
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
</div>

<?php if ($model->isNewRecord == false) {
    ?>
    <div class='report' id="report" style="display:none">
        <table class="table">
            <tr>
                <th style="background:beige;text-align:center !important" colspan="2"><h3 style="margin:0px">PROFIL <?php echo strtoupper($model->nama); ?></h3></th>
            </tr>
            <tr>
                <td style="text-align:left" class="span3">            
                    <?php
                    $img = Yii::app()->landa->urlImg('pegawai/', $model->foto, $_GET['id']);
                    echo '<img style="max-width:300px;max-height:400px" src="' . $img['medium'] . '" alt="" class="image img-polaroid" id="my_image"  /> ';
                    ?>

                </td>
                <td>
                    <?php
                    echo $model->tagProfil;
                    ?>
                </td>
            </tr>  
            <tr>
                <th style="background:beige" colspan="2">PANGKAT & JABATAN</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                    echo $model->tagPangkatJabatan;
                    ?>
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
            success: function (data) {
                obj = JSON.parse(data);
                $("#masaKerjaTahun").val(obj.tahun);
                $("#masaKerjaBulan").val(obj.bulan);
            }
        });
    }

    $("#viewTab").click(function () {
        $("#report").hide();
        $("#tabView").show();
    });

    $("#viewFull").click(function () {
        $("#report").show();
        $("#tabView").hide();
    });

    $("#Pegawai_nip").focusout(function () {
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
        $("#myTab a").click(function (e) {
            e.preventDefault();
            $(this).tab("show");
        });
        $("#viewTab").click(function () {
            $("#report").hide();
            $("#tabView").show();
        });

        $("#viewFull").click(function () {
            $("#report").show();
            $("#tabView").hide();
        });

    }

    function pensiun() {
        var lahir = new Date($("#Pegawai_tanggal_lahir").val());
        var tipe = $('input[name="Pegawai[tipe_jabatan]"]:checked').val();
        var masa_kerja = 0;
        if (tipe == 'struktural') {
            if ($("#masa_kerja").val() == '')
                masa_kerja = 0
            else
                masa_kerja = parseInt($("#masa_kerja").val());
        } else if (tipe == 'fungsional_umum') {
            masa_kerja = 58;
        } else if (tipe == 'fungsional_tertentu') {
            masa_kerja = 60;
        }
        var kalkulasi = new Date(new Date(lahir).setYear(lahir.getFullYear() + masa_kerja));
        var pensiun = kalkulasi.getFullYear() + '-' + kalkulasi.getMonth() + '-' + kalkulasi.getDate();
        $("#Pegawai_tmt_pensiun").val(pensiun)
    }
</script>



<script>
    $(".pilihPendidikan").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/getTablePendidikan'); ?>",
            data: "id=<?php echo $model->id; ?>" + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });

    $(".pilihPangkat").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/getTablePangkat'); ?>",
            data: "id=<?php echo $model->id; ?>" + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });

    $(".pilihJabatan").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/getTableJabatan'); ?>",
            data: "id=<?php echo $model->id; ?>" + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
</script>
<script>
    $(function () {

        $('#Pegawai_kedudukan_id').change(function () {
            if ($('#Pegawai_kedudukan_id').val() == '1') {
                $("#Pegawai_keterangan").parent().parent().attr("style", "display:none");
                $('#Pegawai_keterangan').attr("value", "");
            } else {
                $("#Pegawai_keterangan").parent().parent().attr("style", "display:");
            }
        });
    });

</script>
<script>
    $("body").on("click", ".radio", function () {

        var id = $(this).find("input").val();
        if (id == "Lainnya") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:");

        } else if (id == "Islam") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:none");
            $('#Pegawai_ket_agama').attr("value", "");
        } else if (id == "Hindu") {
            $("#Pegawai_ket_agama").parent().parent().attr("style", "display:none");
            $('#Pegawai_ket_agama').attr("value", "");
        } else if (id == "Katolik") {
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
</script>
