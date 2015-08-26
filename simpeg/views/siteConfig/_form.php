<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'site-config-form',
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


        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#site">Global</a></li>
            <li><a href="#ijin_belajar">Format Surat Ijin Belajar</a></li>
            <li><a href="#perpanjangan_honorer">Format Surat Perpanangan Honorer</a></li>
            <li><a href="#permohonan_mutasi">Format Surat Mutasi</a></li>
            <li><a href="#permohonan_pensiun">Format Surat Pensiun</a></li>           
            <li><a href="#surat_masuk">Format Surat Masuk</a></li>           
            <li><a href="#transfer_cpns">Format Transfer Cpns</a></li>           

        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="site">

                <table>
                    <tr>
                        <td width="300">
                            <?php
                            $siteConfig = SiteConfig::model()->listSiteConfig();
                            $img = Yii::app()->landa->urlImg('site/', $siteConfig->client_logo, param('id'));
                            echo '<img src="' . $img['medium'] . '" class="img-polaroid"/>';
                            ?>
                            <div style="margin-left: -100px;"> <?php echo $form->fileFieldRow($model, 'client_logo', array('class' => 'span3')); ?></div>

                        </td>
                        <td style="vertical-align: top;">                                

                            <?php echo $form->textFieldRow($model, 'client_name', array('class' => 'span4', 'maxlength' => 255)); ?>

                            <?php $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'city_id', 'provinceValue' => $model->City->province_id, 'cityValue' => $model->city_id, 'disabled' => false, 'width' => '50%')); ?>                  
                            <?php echo $form->textAreaRow($model, 'address', array('class' => 'span4', 'rows' => 4, 'maxlength' => 255)); ?>
                            <?php
                            echo $form->textFieldRow(
                                    $model, 'phone', array('prepend' => '+62')
                            );
                            ?>

                            <?php echo $form->textFieldRow($model, 'email', array('class' => 'span4', 'maxlength' => 45)); ?>

                        </td>

                    </tr>
                </table>


            </div>


            <div class="tab-pane" id="setting">               

               

            </div>
            <div class="tab-pane" id="ijin_belajar">
                <center><h4>FORMAT SURAT IJIN BELAJAR</h4></center>
                <hr>
                <?php
                echo $form->ckEditorRow(
                        $model, 'format_ijin_belajar', array(
                    'options' => array(
                        'fullpage' => 'js:true',
                        'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank"),
                        'resize_maxWidth' => '1007',
                        'resize_minWidth' => '320'
                    ), 'label' => false,
                        )
                );
                //echo $form->textAreaRow($model, 'report_sell', array('class' => 'span8', 'rows' => 8)); 
                ?> 
                <div class="well">
                    Gunakan format berikut untuk men-generate sebuah field.
                    <hr>
                    <ul>                      
                        <li><b>{nomor}</b>  : Mengembalikan Nomor Surat</li>                        
                        <li><b>{nama}</b>  : Mengembalikan Nama Pegawai</li>                        
                        <li><b>{nip}</b> : Mengembalikan NIP Pegawai</li>                             
                        <li><b>{pangkat}</b> : Mengembalikan Pangkat Pegawai</li>                                                                   
                        <li><b>{jabatan}</b> : Mengembalikan Jabatan Pegawai</li>
                        <li><b>{unit_kerja}</b> : Mengembalikan Unit Kerja Pegawai</li>
                        <li><b>{jenjang_pendidikan}</b> : Mengembalikan Jenjang Pendidikan</li>
                        <li><b>{jurusan}</b> : Mengembalikan Jurusan</li>
                        <li><b>{nama_sekolah}</b> : Mengembalikan Nama Sekolah</li>
                        <li><b>{kota_sekolah}</b> : Mengembalikan Kota Sekolah</li>
                        <li><b>{alamat_sekolah}</b> : Mengembalikan Alamat Sekolah</li>
                        <li><b>{tanggal}</b> : Mengembalikan Tanggal Surat</li>

                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="permohonan_mutasi">
                <center><h4>FORMAT SURAT PERMOHONAN MUTASI</h4></center>
                <hr>
                <?php
                echo $form->ckEditorRow(
                        $model, 'format_mutasi', array(
                    'options' => array(
                        'fullpage' => 'js:true',
                        'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank"),
                        'resize_maxWidth' => '1007',
                        'resize_minWidth' => '320'
                    ), 'label' => false,
                        )
                );
                //echo $form->textAreaRow($model, 'report_sell', array('class' => 'span8', 'rows' => 8)); 
                ?> 
                <div class="well">
                    Gunakan format berikut untuk men-generate sebuah field.
                    <hr>
                    <ul>                      
                        <li><b>{nomor}</b>  : Mengembalikan Nomor Surat</li>                        
                        <li><b>{tanggal}</b>  : Mengembalikan Tanggal Surat</li>                        
                        <li><b>{nip}</b> : Mengembalikan NIP Pegawai</li>                             
                        <li><b>{nama}</b> : Mengembalikan Nama Pegawai</li>                                                                   
                        <li><b>{unit_kerja_lama}</b> : Mengembalikan Unit Kerja Lama</li>
                        <li><b>{unit_kerja_baru}</b> : Mengembalikan Unit Kerja Baru</li>
                        <li><b>{tipe_jabatan_lama}</b> : Mengembalikan Tipe Jabatan Lama Sebelum Mutasi</li>
                        <li><b>{tipe_jabatan_baru}</b> : Mengembalikan Tipe Jabatan Baru Setelah Mutasi</li>
                        <li><b>{jabatan_lama}</b> : Mengembalikan Jabatan Lama Sebelum Mutasi</li>
                        <li><b>{jabatan_baru}</b> : Mengembalikan Jabatan Baru Setelah Mutasi</li>
                        <li><b>{tmt}</b> : Mengembalikan TMT mutasi</li>                        

                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="permohonan_pensiun">
                <center><h4>FORMAT SURAT PERMOHONAN PENSIUN</h4></center>
                <hr>
                <?php
                echo $form->ckEditorRow(
                        $model, 'format_pensiun', array(
                    'options' => array(
                        'fullpage' => 'js:true',
                        'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank"),
                        'resize_maxWidth' => '1007',
                        'resize_minWidth' => '320'
                    ), 'label' => false,
                        )
                );
                //echo $form->textAreaRow($model, 'report_sell', array('class' => 'span8', 'rows' => 8)); 
                ?> 
                <div class="well">
                    Gunakan format berikut untuk men-generate sebuah field.
                    <hr>
                    <ul>                      
                        <li><b>{nomor}</b>  : Mengembalikan Nomor Surat</li>                        
                        <li><b>{nama}</b>  : Mengembalikan Nama Pegawai</li>                        
                        <li><b>{nip}</b> : Mengembalikan NIP Pegawai</li>                             
                        <li><b>{pangkat}</b> : Mengembalikan Pangkat Pegawai</li>                                                                   
                        <li><b>{jabatan}</b> : Mengembalikan Jabatan Pegawai</li>
                        <li><b>{unit_kerja}</b> : Mengembalikan Unit Kerja Pegawai</li>
                        <li><b>{jenjang_pendidikan}</b> : Mengembalikan Jenjang Pendidikan</li>
                        <li><b>{jurusan}</b> : Mengembalikan Jurusan</li>
                        <li><b>{nama_sekolah}</b> : Mengembalikan Nama Sekolah</li>
                        <li><b>{kota_sekolah}</b> : Mengembalikan Kota Sekolah</li>
                        <li><b>{alamat_sekolah}</b> : Mengembalikan Alamat Sekolah</li>
                        <li><b>{tanggal}</b> : Mengembalikan Tanggal Surat</li>

                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="perpanjangan_honorer">
                <center><h4>FORMAT SURAT PERPANJANGAN PEGAWAI HONORER</h4></center>
                <hr>
                <?php
                echo $form->ckEditorRow(
                        $model, 'format_perpanjangan_honorer', array(
                    'options' => array(
                        'fullpage' => 'js:true',
                        'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank"),
                        'resize_maxWidth' => '1007',
                        'resize_minWidth' => '320'
                    ), 'label' => false,
                        )
                );
                //echo $form->textAreaRow($model, 'report_sell', array('class' => 'span8', 'rows' => 8)); 
                ?> 
                <div class="well">
                    Gunakan format berikut untuk men-generate sebuah field.
                    <hr>
                    <ul>                      
                        <li><b>{nama}</b>  : Mengembalikan Nama Pegawai</li>                        
                        <li><b>{ttl}</b> : Mengembalikan Tempat Tanggal Lahir Pegawai</li>                             
                        <li><b>{jenis_kelamin}</b> : Mengembalikan Pangkat Pegawai</li>                                                                   
                        <li><b>{pendidikan}</b> : Mengembalikan Pendidikan Pegawai</li>
                        <li><b>{masa_kerja}</b> : Mengembalikan Masa Kerja Pegawai</li>
                        <li><b>{gaji}</b> : Mengembalikan Gaji Pegawai</li>
                        <li><b>{unit_kerja}</b> : Mengembalikan Unit Kerja Pegawai</li>
                        <li><b>{tmt_mulai}</b> : Mengembalikan TMT Perpanjangan Kontrak</li>
                        <li><b>{tmt_selesai}</b> : Mengembalikan Tanggal TMT Akhir Perpanjangan Kontrak</li>                        
                        <li><b>{tanggal}</b> : Mengembalikan Tanggal Surat</li>

                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="surat_masuk">
                <center><h4>FORMAT SURAT MASUK</h4></center>
                <hr>
                <?php
                echo $form->ckEditorRow(
                        $model, 'format_surat_masuk', array(
                    'options' => array(
                        'fullpage' => 'js:true',
                        'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank"),
                        'resize_maxWidth' => '1007',
                        'resize_minWidth' => '320'
                    ), 'label' => false,
                        )
                );
                //echo $form->textAreaRow($model, 'report_sell', array('class' => 'span8', 'rows' => 8)); 
                ?> 
                <div class="well">
                    Gunakan format berikut untuk men-generate sebuah field.
                    <hr>
                    <ul>                      
                        <li><b>{pengirim}</b>  : Mengembalikan Nama Pengirim</li>                          
                        <li><b>{tanggal}</b> : Mengembalikan tanggal di kirim</li>                                                                   
                        <li><b>{no_surat}</b> : Mengembalikan Nomor Surat</li>
                        <li><b>{perihal}</b> : Mengembalikan Perihal Surat</li>
                        <li><b>{ttl_terima}</b> : Mengembalikan Tanggal terima Surat</li>
                        <li><b>{no_agenda}</b> : Mengembalikan Nomor Agenda</li>
                        <li><b>{terusan}</b> : Mengembalikan di Teruskan Kepada</li>


                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="transfer_cpns">
                <center><h4>FORMAT TRANSFER CPNS</h4></center>
                <hr>
                <?php
                echo $form->ckEditorRow(
                        $model, 'format_transfer_cpns', array(
                    'options' => array(
                        'fullpage' => 'js:true',
                        'filebrowserBrowseUrl' => $this->createUrl("fileManager/indexBlank"),
                        'resize_maxWidth' => '1007',
                        'resize_minWidth' => '320'
                    ), 'label' => false,
                        )
                );
                //echo $form->textAreaRow($model, 'report_sell', array('class' => 'span8', 'rows' => 8)); 
                ?> 
                <div class="well">
                    Gunakan format berikut untuk men-generate sebuah field.
                    <hr>
                    <ul>                      
                        <li><b>{pengirim}</b>  : Mengembalikan Nama Pengirim</li>                          
                        <li><b>{tanggal}</b> : Mengembalikan tanggal di kirim</li>                                                                   
                        <li><b>{no_surat}</b> : Mengembalikan Nomor Surat</li>
                        <li><b>{perihal}</b> : Mengembalikan Perihal Surat</li>
                        <li><b>{ttl_terima}</b> : Mengembalikan Tanggal terima Surat</li>
                        <li><b>{no_agenda}</b> : Mengembalikan Nomor Agenda</li>
                        <li><b>{terusan}</b> : Mengembalikan di Teruskan Kepada</li>


                    </ul>
                </div>
            </div>
        </div>

</div>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'ok white',
        'label' => $model->isNewRecord ? 'Create' : 'Simpan',
    ));
    ?>
</div>

</fieldset>







<?php $this->endWidget(); ?>

</div>
<script>
    $(".delRow").on("click", function() {
        $(this).parent().parent().remove();
    });
</script>
