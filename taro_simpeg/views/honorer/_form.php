<?php if (isset($_GET['v'])) { ?>
    <div class="alert alert-info">
        <label class="radio">
            <input id="viewTab" value="PNS" checked="checked" name="view" type="radio">
            <label for="viewTab">View as Tab</label></label>
        <label class="radio"><input id="viewFull" name="view" type="radio">
            <label for="viewFull">View as Report </label></label>
    </div>

<?php } ?>

<?php
if ($model->isNewRecord == true) {
    $edit = '';
    $nilai = array();
} else {
    if (isset($_GET['v'])) {
        $edit = '';
    } else {
        $edit = 1;
    }
    $nilai = NilaiHonorer::model()->findAll(array('condition' => 'pegawai_id=' . $model->id));
}
?>


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
                    $img = Yii::app()->landa->urlImg('honorer/', $model->foto, $_GET['id']);
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
                <th style="background:beige" colspan="2">UNIT KERJA & JABATAN</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                    echo $model->tagPangkatJabatan;
                    ?>
                </td>
            </tr> 
            <tr>
                <th style="background:beige" colspan="2">NILAI SKP</th>
            </tr>
            <tr>
                <td colspan="2">
                    <?php
                    echo $this->renderPartial('_tableNilai', array('nilai' => $nilai, 'edit' => $edit));
                    //echo $this->renderPartial('_tablePangkat', array('pangkat' => $pangkat)); 
                    ?>

                </td>
            </tr>            
        </table>
    </div>
<?php } ?>


<style>
    #content .form-row.row-fluid {
        margin-top: 0px !important;
    }
    .form-row {
        margin-top: 0px;
    }
    .form-row {
        margin-top: 0px;
        width: 100%;
        position: relative;
    }
</style>
<div class="form" id="tabView">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'honorer-form',
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
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#profil">Profil Pegawai</a></li>
            <li ><a href="#jabatan">Unit Kerja & Jabatan</a></li>
            <?php
            if ($model->isNewRecord != TRUE) {
                echo '<li ><a href="#nilaiSkp">Nilai SKP</a></li>';
            }
            ?>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="profil">                
                <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
                <div class="form-row row-fluid">
                    <div class="span9" style="margin-left: 0px;">                                                
                        <?php
                        echo $form->textFieldRow($model, 'nama', array('class' => 'span5', 'maxlength' => 100));
                        ?>                    
                        <div class="control-group "><label class="control-label" for="Honorer_pendidikan_terakhir">Pendidikan</label>
                            <div class="controls">
                                <?php echo CHtml::dropDownList('Honorer[pendidikan_terakhir]', $model->pendidikan_terakhir, Pegawai::model()->arrJenjangPendidikan(), array('class' => 'span2')); ?>
                                <input class="span2 angka" maxlength="4" value="<?php echo $model->tahun_pendidikan; ?>" name="Honorer[tahun_pendidikan]" id="Honorer_tahun_pendidikan" placeHolder="Tahun" type="text">
                            </div>
                        </div>
                        <div class="control-group ">
                            <label class="control-label" for="Honorer_st_peg">Status SK</label>
                            <div class="controls">
                                <?php
                                $data = array('0' => '- Pilih Status -') + Honorer::model()->arrStatusSk();
                                $this->widget(
                                        'bootstrap.widgets.TbSelect2', array(
                                    'name' => 'Honorer[status_sk]',
                                    'data' => $data,
                                    'value' => $model->status_sk,
                                    'options' => array(
                                        'width' => '40%;margin:0px;text-align:left',
                                )));
                                ?>
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
                                $model, 'tanggal_lahir', array(
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                            'prepend' => '<i class="icon-calendar"></i>'
                                )
                        );
//                        $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'kota', 'cityValue' => $model->kota, 'disabled' => false, 'width' => '40%', 'label' => 'Kota'));
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
                        ?>

                    </div>
                    <div class="span3" style="margin-left: -15px;">
                        <?php
                        $cc = '';
                        if ($model->isNewRecord) {
                            $img = Yii::app()->landa->urlImg('', '', '');
                        } else {
                            $img = Yii::app()->landa->urlImg('honorer/', $model->foto, $_GET['id']);
                            $imgs = param('urlImg') . '350x350-noimage.jpg';
                            $cc = CHtml::ajaxLink(
                                            '<i class="icon-trash"></i>', url('honorer/removephoto', array('id' => $model->id)), array(
                                        'type' => 'POST',
                                        'success' => 'function( data )
                                                    {
                                                           $("#my_image").attr("src","' . $imgs . '");
                                                           $("#yt0").fadeOut();
                                                    }'), array('class' => 'btn btn-large btn-block btn-primary', 'style' => 'width: 252px;font-size: 15px;')
                                    )
                            ;
                        }
                        echo '<img src="' . $img['medium'] . '" alt="" class="image img-polaroid" id="my_image"  /> ';
                        if (!isset($_GET['v'])) {
                            echo $cc;
                            ?>
                            <br><br><div style="margin-left: -90px;"> <?php echo $form->fileFieldRow($model, 'foto', array('class' => 'span3')); ?></div>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-row row-fluid">
                    <div class="span12">
                        <?php
                        echo $form->textAreaRow($model, 'alamat', array('rows' => 2, 'style' => 'width:50%', 'class' => 'span9'));
                        echo $form->textFieldRow($model, 'kode_pos', array('class' => 'span2', 'style' => 'max-width:500px;width:100px', 'maxlength' => 10));
                        echo $form->textFieldRow($model, 'hp', array('class' => 'span5 angka', 'style' => 'max-width:500px;width:200px', 'maxlength' => 25, 'prepend' => '+62'));
                        echo $form->radioButtonListRow($model, 'agama', Pegawai::model()->ArrAgama());
                        echo $form->textFieldRow($model, 'ket_agama', array('class' => 'span5', 'maxlength' => 50));
                        echo $form->radioButtonListRow($model, 'golongan_darah', Pegawai::model()->ArrGolonganDarah());
                        echo $form->radioButtonListRow($model, 'status_pernikahan', Pegawai::model()->arrStatusPernikahan());
                        echo $form->textFieldRow($model, 'npwp', array('class' => 'span5', 'maxlength' => 50));
                        echo $form->textFieldRow($model, 'bpjs', array('class' => 'span5', 'maxlength' => 50));
                        ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="jabatan">
                <?php
                echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span4', 'style' => 'max-width:500px;width:300px', 'maxlength' => 18));
                echo $form->datepickerRow(
                        $model, 'tanggal_register', array(
                    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                    'prepend' => '<i class="icon-calendar"></i>'
                        )
                );
                $data = array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                echo $form->select2Row($model, 'unit_kerja_id', array(
                    'asDropDownList' => true,
                    'data' => $data,
                    'options' => array(
                        "allowClear" => false,
                        'width' => '50%',
                    ))
                );

                $data = array('0' => '- Jabatan  -') + CHtml::listData(JabatanHonorer::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                echo $form->select2Row($model, 'jabatan_honorer_id', array(
                    'asDropDownList' => true,
                    'data' => $data,
                    'options' => array(
                        "allowClear" => false,
                        'width' => '50%',
                    ))
                );
                ?>
                <div class="control-group ">
                    <label class="control-label" for="Honorer_st_peg">Status</label>
                    <div class="controls">
                        <?php
                        $data = array('0' => '- Pilih Status -') + Honorer::model()->arrStatus();
                        $this->widget(
                                'bootstrap.widgets.TbSelect2', array(
                            'name' => 'Honorer[st_peg]',
                            'data' => $data,
                            'value' => $model->st_peg,
                            'options' => array(
                                'width' => '40%;margin:0px;text-align:left',
                        )));
                        ?>
                    </div>
                </div>
                <?php
                echo $form->datepickerRow(
                        $model, 'tmt_jabatan', array(
                    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                    'prepend' => '<i class="icon-calendar"></i>'
                        )
                );
                ?>


                <?php echo $form->textFieldRow($model, 'gaji', array('class' => 'span5 angka', 'prepend' => 'Rp')); ?>
                <?php
                echo $form->datepickerRow(
                        $model, 'tmt_kontrak', array(
                    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                    'prepend' => '<i class="icon-calendar"></i>'
                        )
                );
                echo $form->datepickerRow(
                        $model, 'tmt_akhir_kontrak', array(
                    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                    'prepend' => '<i class="icon-calendar"></i>'
                        )
                );
                ?>

                <?php if (isset($_GET['v'])) { ?>
                    <div class="control-group "><label class="control-label" for="">Masa Kerja</label>
                        <div class="controls"><input disabled=""  name="masaKerja" id="" value="<?php echo $model->masaKerja; ?>" type="text">
                        </div>
                    </div>
                <?php } ?>

            </div>
            <div class="tab-pane" id="nilaiSkp">
                <?php
                echo $this->renderPartial('_tableNilai', array('nilai' => $nilai, 'edit' => $edit));
                ?>
            </div>
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
<?php
$this->beginWidget(
        'bootstrap.widgets.TbModal', array('id' => 'modalForm')
);
?>
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3 style="text-align:center">FORM NILAI SKP</h3>
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
    .form-row  .control-label{
        margin-right: 30px;
    }
    .form-row .controls input{
        margin-bottom: 0px;
    }
</style>

<script>
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

</script>
<script>
    $("body").on("click", ".radio", function () {

        var id = $(this).find("input").val();
        if (id == "Lainnya") {
            $("#Honorer_ket_agama").parent().parent().attr("style", "display:");

        } else if (id == "Islam") {
            $("#Honorer_ket_agama").parent().parent().attr("style", "display:none");
            $('#Honorer_ket_agama').attr("value", "");
        } else if (id == "Hindu") {
            $("#Honorer_ket_agama").parent().parent().attr("style", "display:none");
            $('#Honorer_ket_agama').attr("value", "");
        } else if (id == "Katolik") {
            $("#Honorer_ket_agama").parent().parent().attr("style", "display:none");
            $('#Honorer_ket_agama').attr("value", "");
        } else if (id == "Protestan") {
            $("#Honorer_ket_agama").parent().parent().attr("style", "display:none");
            $('#Honorer_ket_agama').attr("value", "");
        } else if (id == "Konghucu") {
            $("#Honorer_ket_agama").parent().parent().attr("style", "display:none");
            $('#Honorer_ket_agama').attr("value", "");
        }
    });
</script>