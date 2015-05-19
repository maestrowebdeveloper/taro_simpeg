<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-honorer-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>

<table>
    <tr>
        <td style="width:50%;vertical-align:top">
            
                        
            <?php
            echo $form->textFieldRow($model, 'nama', array('class' => 'span4', 'maxlength' => 100));
            
            $idpendidikan = isset($model->Jurusan->id) ? $model->Jurusan->id : 0;
            $pendidikan = isset($model->Jurusan->Name) ? $model->Jurusan->Name : '';
            echo $form->select2Row($model, 'id_jurusan', array(
                'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Kota->name,
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
                            callback({id: ' . $idpendidikan . ', text: "' . $pendidikan . '" });
                             
                                  
                                  
                            }',
                ),
                    )
            );
            ?>              
            <div class="control-group "><label class="control-label" for="Honorer_pendidikan_terakhir">Pendidikan</label>
                <div class="controls">
                    <?php // echo CHtml::dropDownList('Honorer[pendidikan_terakhir]', $model->pendidikan_terakhir, Pegawai::model()->arrJenjangPendidikan(), array('class' => 'span2','empty'=>'- Pendidikan -'));  ?>
                    <input class="span2 angka" maxlength="4" value="<?php echo $model->tahun_pendidikan; ?>" name="Honorer[tahun_pendidikan]" id="Honorer_tahun_pendidikan" placeHolder="Tahun" type="text">
                </div>
            </div>

            <?php
            echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin());

//            echo $form->textAreaRow($model, 'alamat', array('rows' => 2, 'cols' => 50, 'class' => 'span3'));
//            echo $form->textFieldRow($model, 'kode_pos', array('class' => 'span2', 'style' => 'max-width:500px;width:100px', 'maxlength' => 10));
//            echo $form->textFieldRow($model, 'hp', array('class' => 'span5 angka', 'style' => 'max-width:500px;width:150px', 'maxlength' => 25, 'prepend' => '+62'));
            echo $form->dropDownListRow($model, 'agama', Pegawai::model()->ArrAgama(), array('empty' => '- Agama -'));
//            echo $form->radioButtonListRow($model, 'golongan_darah', Pegawai::model()->ArrGolonganDarah());
            ?>

        </td>
        <td style="width:50%;vertical-align:top">
            <?php
            echo $form->radioButtonListRow($model, 'status_pernikahan', Pegawai::model()->arrStatusPernikahan());
//            echo $form->textFieldRow($model, 'npwp', array('class' => 'span3', 'maxlength' => 50));
//            echo $form->textFieldRow($model, 'bpjs', array('class' => 'span3', 'maxlength' => 50));
            echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span4 angka', 'style' => 'max-width:500px;width:300px', 'maxlength' => 18));
          
            $data = array('0' => '- Unit Kerja -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
            echo $form->select2Row($model, 'jabatan_struktural_id', array(
                'asDropDownList' => true,
                'data' => $data,
                'options' => array(
                    "allowClear" => false,
                    'width' => '100%',
                ))
            );
            $data = array('0' => '- Jabatan -') + CHtml::listData(JabatanFu::model()->findAll(array('order' => 'id')), 'id', 'nama');
            echo $form->select2Row($model, 'jabatan_fu_id', array(
                'asDropDownList' => true,
                'data' => $data,
                'options' => array(
                    "allowClear" => false,
                    'width' => '100%',
                ))
            );

//                    $data = array('0'=>'- Jabatan  -')+CHtml::listData(JabatanHonorer::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
//                    echo $form->select2Row($model, 'jabatan_honorer_id', array(
//                        'asDropDownList' => true,                    
//                        'data' => $data,    
//                        'options' => array(                        
//                            "allowClear" => false,
//                            'width' => '80%',
//                        ))
//                    );     
//                    echo $form->datepickerRow(
//                           $model, 'tmt_jabatan', array(
//                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
//                       'prepend' => '<i class="icon-calendar"></i>'
//                           )
//                    );            
//           
//                echo $form->textFieldRow($model,'gaji',array('class'=>'span5 angka','prepend'=>'Rp')); 
//                echo $form->datepickerRow(
//                           $model, 'tmt_kontrak', array(
//                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
//                       'prepend' => '<i class="icon-calendar"></i>'
//                           )
//                    ); 
//                echo $form->datepickerRow(
//                           $model, 'tmt_akhir_kontrak', array(
//                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
//                       'prepend' => '<i class="icon-calendar"></i>'
//                           )
//                    ); 
            ?>

        </td>            
    </tr>
</table>




<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'icon', 'label' => 'Export Excel',
        'htmlOptions' => array(
            'onclick' => 'excel()'
    )));
    ?>  

    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'button', 'icon' => 'icon-remove-sign white', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function ($) {
        $(".btnreset").click(function () {
            $(":input", "#search-honorer-form").each(function () {
                var type = this.type;
                var tag = this.tagName.toLowerCase(); // normalize case
                if (type == "text" || type == "password" || tag == "textarea")
                    this.value = "";
                else if (type == "checkbox" || type == "radio")
                    this.checked = false;
                else if (tag == "select")
                    this.selectedIndex = "";
            });
        });
    })
</script>

<script type="text/javascript">
    function excel() {
        
        
        if (document.getElementById('Honorer_jenis_kelamin_0').checked) {
            var jns_kelamin = document.getElementById('Honorer_jenis_kelamin_0').value;
        } else
        if (document.getElementById('Honorer_jenis_kelamin_1').checked) {
            var jns_kelamin = document.getElementById('Honorer_jenis_kelamin_1').value;
        } else {
            var jns_kelamin = '';
        }
        
        if (document.getElementById('Honorer_status_pernikahan_0').checked) {
            var sts_pernikahan = document.getElementById('Honorer_status_pernikahan_0').value;
        } else
        if (document.getElementById('Honorer_status_pernikahan_1').checked) {
            var sts_pernikahan = document.getElementById('Honorer_status_pernikahan_1').value;
        } else
        if (document.getElementById('Honorer_status_pernikahan_2').checked) {
            var sts_pernikahan = document.getElementById('Honorer_status_pernikahan_2').value;
        } else {
            var sts_pernikahan = '';
        }
        
        var id_jurusan = $('#Honorer_id_jurusan').val();
        var nama = $('#Honorer_nama').val();
        var tahun_pendidikan = $('#Honorer_tahun_pendidikan').val(); 
        var agama = $('#Honorer_agama').val();
        var nomor_register = $('#Honorer_nomor_register').val();
        var jabatan_struktural_id = $('#Honorer_jabatan_struktural_id').val();
        var jabatan_fu_id = $('#Honorer_jabatan_fu_id').val();
//        alert('nama');
        window.open("<?php echo url('honorer/GenerateExcel') ?>?jns_kelamin="+jns_kelamin+"&nama="+nama+"&sts_pernikahan="+sts_pernikahan+"&id_jurusan="+id_jurusan+"&tahun_pendidikan="+tahun_pendidikan+"&agama="+agama+"&nomor_register="+nomor_register+"&jabatan_struktural_id="+jabatan_struktural_id+"&jabatan_fu_id="+jabatan_fu_id);

    }
</script>

