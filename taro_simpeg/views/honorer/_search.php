<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-honorer-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
    'type'=>'horizontal',
));  ?>

    <table>
        <tr>
            <td style="width:50%;vertical-align:top">
                <?php                                                  
        echo $form->textFieldRow($model,'nama',array('class'=>'span3','maxlength'=>100));                    
        ?>                    
        <div class="control-group "><label class="control-label" for="Honorer_pendidikan_terakhir">Pendidikan</label>
        <div class="controls">
            <?php // echo CHtml::dropDownList('Honorer[pendidikan_terakhir]', $model->pendidikan_terakhir, Pegawai::model()->arrJenjangPendidikan(), array('class' => 'span2','empty'=>'- Pendidikan -')); ?>
            <input class="span2 angka" maxlength="4" value="<?php echo $model->tahun_pendidikan;?>" name="Honorer[tahun_pendidikan]" id="Honorer_tahun_pendidikan" placeHolder="Tahun" type="text">
        </div>
        </div>

        <?php                                  
        echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin());                                         
        $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'tempat_lahir',  'cityValue' => $model->tempat_lahir, 'disabled' => false,'width'=>'80%','label'=>'Tempat Lahir'));                    
        echo $form->datepickerRow(
               $model, 'tanggal_lahir', array(
           'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
           'prepend' => '<i class="icon-calendar"></i>'
               )
        );   
        $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'city_id', 'cityValue' => $model->city_id, 'disabled' => false,'width'=>'80%','label'=>'Kota'));
        echo $form->textAreaRow($model,'alamat',array('rows'=>2, 'cols'=>50, 'class'=>'span3'));  
        echo $form->textFieldRow($model,'kode_pos',array('class'=>'span2','style'=>'max-width:500px;width:100px','maxlength'=>10)); 
        echo $form->textFieldRow($model,'hp',array('class'=>'span5 angka','style'=>'max-width:500px;width:150px','maxlength'=>25,'prepend'=>'+62')); 
        echo $form->dropDownListRow($model, 'agama', Pegawai::model()->ArrAgama(),array('empty'=>'- Agama -'));                                  
        echo $form->radioButtonListRow($model, 'golongan_darah', Pegawai::model()->ArrGolonganDarah());   
                            
                                                                                                                              
        ?>

            </td>
            <td style="width:50%;vertical-align:top">
                <?php
                
                echo $form->radioButtonListRow($model, 'status_pernikahan', Pegawai::model()->arrStatusPernikahan());   
                echo $form->textFieldRow($model,'npwp',array('class'=>'span3','maxlength'=>50));
        echo $form->textFieldRow($model,'bpjs',array('class'=>'span3','maxlength'=>50));  
                    echo $form->textFieldRow($model,'nomor_register',array('class'=>'span4 angka','style'=>'max-width:500px;width:300px','maxlength'=>18));                                     
                    echo $form->datepickerRow(
                           $model, 'tanggal_register', array(
                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                       'prepend' => '<i class="icon-calendar"></i>'
                           )
                    ); 
                    $data = array('0'=>'- Unit Kerja -')+CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                    echo $form->select2Row($model, 'unit_kerja_id', array(
                        'asDropDownList' => true,                    
                        'data' => $data,    
                        'options' => array(                        
                            "allowClear" => false,
                            'width' => '80%',
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

                    echo $form->datepickerRow(
                           $model, 'tmt_jabatan', array(
                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                       'prepend' => '<i class="icon-calendar"></i>'
                           )
                    );            
           

            
                echo $form->textFieldRow($model,'gaji',array('class'=>'span5 angka','prepend'=>'Rp')); 
            
                echo $form->datepickerRow(
                           $model, 'tmt_kontrak', array(
                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                       'prepend' => '<i class="icon-calendar"></i>'
                           )
                    ); 
                echo $form->datepickerRow(
                           $model, 'tmt_akhir_kontrak', array(
                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                       'prepend' => '<i class="icon-calendar"></i>'
                           )
                    ); 
            ?>

            </td>            
        </tr>
    </table>
        

        

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-honorer-form").each(function() {
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

