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
        'id' => 'permohonan-perpanjangan-honorer-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>

    <legend>
        <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
    </legend>

    <fieldset>
        <legend>
            Form Permohonan
        </legend>
    </fieldset>

    <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
    <div class="row-fluid">
        <div class="span5">
            <?php echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span10', 'maxlength' => 225)); ?>

            <?php
            echo $form->datepickerRow(
                    $model, 'tanggal', array(
                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                'prepend' => '<i class="icon-calendar"></i>'
                    )
            );

//        $data = array('0' => '- Pegawai Honorer -') + CHtml::listData(Honorer::model()->listHonorer(), 'id', 'nama');
//        echo $form->select2Row($model, 'honorer_id', array(
//            'asDropDownList' => true,
//            'data' => $data,
//            'events' => array('change' => 'js: function() {
//                        $.ajax({
//                           url : "' . url('permohonanPerpanjanganHonorer/getNilai') . '",
//                           type : "POST",
//                           data :  { id:  $(this).val()},
//                           success : function(data){                             
//                            obj = JSON.parse(data);                                                    
//                            $(".riwayatNilai").html(obj.table);
//                            $("#unit_kerja").val(obj.unit_kerja);                            
//                            $("#jenis_kelamin").val(obj.jenis_kelamin);
//                            $("#tempat_lahir").val(obj.tempat_lahir);
//                            $("#tanggal_lahir").val(obj.tanggal_lahir);
//                            $("#pendidikan_terakhir").val(obj.pendidikan_terakhir);
//                            $("#alamat").val(obj.alamat);
//                            $(".riwayatNilai").show();
//                        }
//                    });
//                }'),
//            'options' => array(
//                "allowClear" => false,
//                'width' => '80%',
//            ))
//        );

            
            ?>
            <?php
//            echo $form->textFieldRow($model, 'honor_saat_ini', array('class' => 'span10 angka', 'prepend' => 'Rp'));

            echo $form->datepickerRow(
                    $model, 'tmt_mulai', array(
                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                'prepend' => '<i class="icon-calendar"></i>'
                    )
            );

            echo $form->datepickerRow(
                    $model, 'tmt_selesai', array(
                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                'prepend' => '<i class="icon-calendar"></i>'
                    )
            );
            ?>
        </div>
        <div class="span5">
            <?php
            $idpegawai = isset($model->honorer_id) ? $model->honorer_id : 0;
            $pegawaiName = isset($model->Honorer->nama) ? $model->Honorer->nama : 0;
            echo $form->select2Row($model, 'honorer_id', array(
                'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Pegawai->nama,
                'options' => array(
                    'placeholder' => t('choose', 'global'),
                    'allowClear' => true,
                    'width' => '300px',
                    'minimumInputLength' => '3',
                    'ajax' => array(
                        'url' => Yii::app()->createUrl('honorer/getListHonorer'),
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
            
            $unit_kerja = (!empty($model->Honorer->unitKerja)) ? $model->Honorer->unitKerja : '';
            $jenis_kelamin = (!empty($model->Honorer->jenis_kelamin)) ? $model->Honorer->jenis_kelamin : '';
            $tempat_lahir = (!empty($model->Honorer->tempat_lahir)) ? $model->Honorer->tempat_lahir : '';
            $tanggal_lahir = (!empty($model->Honorer->tanggal_lahir)) ? $model->Honorer->tanggal_lahir : '';
            $pendidikan_terakhir = (!empty($model->Honorer->pendidikan)) ? $model->Honorer->pendidikan : '';
            $alamat = (!empty($model->Honorer->alamat)) ? $model->Honorer->alamat : '';
            ?>
            <div class="control-group "><label  class="control-label">Unit Kerja</label><div class="controls">
                    <input disabled class="span12" maxlength="225" name="" value="<?php echo $unit_kerja; ?>" id="unit_kerja" type="text">
                </div></div>
            <div class="control-group "><label  class="control-label">Jenis Kelamin</label><div class="controls">
                    <input disabled class="span12" maxlength="225" name="" value="<?php echo $jenis_kelamin; ?>" id="jenis_kelamin" type="text">
                </div></div>
            <div class="control-group "><label  class="control-label">Tempat Lahir</label><div class="controls">
                    <input disabled class="span12" maxlength="225" name="" value="<?php echo $tempat_lahir; ?>" id="tempat_lahir" type="text">
                </div></div>        
            <div class="control-group "><label class="control-label" for="">Tanggal Lahir</label><div class="controls">
                    <div  class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span><input id="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" disabled type="text"></div>
                </div></div>    
            <div class="control-group "><label  class="control-label">Pendidikan Terakhir</label><div class="controls">
                    <input disabled class="span12" maxlength="225" name="" id="pendidikan_terakhir" value="<?php echo $pendidikan_terakhir; ?>" type="text">
                </div></div>        
            <div class="control-group "><label  class="control-label">Alamat</label><div class="controls">
                    <input disabled class="span12" maxlength="225" name="alamat" id="alamat" value="<?php echo $alamat; ?>" type="text">
                </div></div>
        </div>
    </div>

    <?php
    if ($model->isNewRecord == true)
        $display = 'none';
    else
        $display = 'block';
    ?>

    <div style="display: <?php echo $display; ?>" class="riwayatNilai">
        <fieldset>
            <legend>Riwayat Nilai SKP</legend>
        </fieldset>
        <table class="table table-bordered">
            <thead>   
                <tr>
                    <th rowspan="2">Tahun</th>
                    <th rowspan="2">Nomor Register</th>        
                    <th colspan="6">Nilai</th>  
                </tr>         
                <tr>
                    <th>Hasil Kerja</th>
                    <th>Orientasi Pelayanan</th>
                    <th>Integritas</th>
                    <th>Disiplin</th>
                    <th>Kerja Sama</th>
                    <th>Kreativitas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($model->isNewRecord == False)
                    $nilai = NilaiHonorer::model()->findAll(array('condition' => 'pegawai_id=' . $model->honorer_id, 'order' => 'tahun DESC', 'limit' => 5));
                else
                    $nilai = array();

                if (!empty($nilai)) {
                    foreach ($nilai as $val) {
                        echo '<tr>';
                        echo '<td>' . $val->tahun . '</td>';
                        echo '<td>' . $val->no_register . '</td>';
                        echo '<td>' . $val->nilai_hasil_kerja . '</td>';
                        echo '<td>' . $val->nilai_orientasi_pelayanan . '</td>';
                        echo '<td>' . $val->nilai_integritas . '</td>';
                        echo '<td>' . $val->nilai_disiplin . '</td>';
                        echo '<td>' . $val->nilai_kerja_sama . '</td>';
                        echo '<td>' . $val->nilai_kreativitas . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="8">No Data Available</td></tr>';
                }
                ?>
            </tbody>
        </table>
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
    <?php } ?>    

    <?php $this->endWidget(); ?>

</div>



<?php if (isset($_GET['v'])) { ?>
    <div class="surat" id="surat" style="display:none">
        <?php
        $siteConfig = SiteConfig::model()->listSiteConfig();
        $content = $siteConfig->format_perpanjangan_honorer;

        $content = str_replace('{nomor}', $model->nomor_register, $content);
        $content = str_replace('{nomor_pengangkatan}', $model->nomorPengangkatan, $content);
        $content = str_replace('{status}', $model->Honorer->st_peg, $content);
        $content = str_replace('{disahkan}', $model->Honorer->pengesahan, $content);
        $content = str_replace('{tanggal_pengangkatan}', landa()->date2Ind($model->tanggalPengangkatan), $content);
        $content = str_replace('{tmt_pengangkatan}', landa()->date2Ind($model->tmtPengangkatan), $content);
        $content = str_replace('{jenis_kelamin}', $model->jenisKelamin, $content);
        $content = str_replace('{pendidikan}', $model->pendidikan, $content);
        $content = str_replace('{tahun}', $model->pendidikanTahun, $content);
        $content = str_replace('{masa_kerja}', $model->Honorer->masaKerjaTahun.' Tahun '.$model->Honorer->masaKerjaBulan.' Bulan' , $content);
        $content = str_replace('{gaji}', landa()->rp($model->honor_saat_ini), $content);
        $content = str_replace('{ttl}', $model->ttl, $content);
        $content = str_replace('{tmt_mulai}', landa()->date2Ind($model->tmt_mulai), $content);
        $content = str_replace('{tmt_selesai}', landa()->date2Ind($model->tmt_selesai), $content);
        $content = str_replace('{nama}', $model->honorer, $content);
        $content = str_replace('{unit_kerja}', $model->unitKerja, $content);
        $content = str_replace('{satuan_kerja}', $model->satuanKerja, $content);
        $content = str_replace('{tanggal}', landa()->date2Ind($model->created), $content);
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
    $("#PermohonanPerpanjanganHonorer_honorer_id").on("change", function() {
        //var name = $("#Registration_guest_user_id").val();
        //  alert(name);

        $.ajax({
            url: "<?php echo url('permohonanPerpanjanganHonorer/getNilai'); ?>",
            type: "POST",
            data: {id: $(this).val()},
            success: function(data) {

                obj = JSON.parse(data);
                $(".riwayatNilai").html(obj.table);
                            $("#unit_kerja").val(obj.unit_kerja);                            
                            $("#jenis_kelamin").val(obj.jenis_kelamin);
                            $("#tempat_lahir").val(obj.tempat_lahir);
                            $("#tanggal_lahir").val(obj.tanggal_lahir);
                            $("#pendidikan_terakhir").val(obj.pendidikan_terakhir);
                            $("#alamat").val(obj.alamat);
                            $(".riwayatNilai").show();
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
</script>
