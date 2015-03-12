<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'honorer-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
	'type'=>'horizontal',
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	)
)); ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>
         <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#profil">Profil Pegawai</a></li>
            <li ><a href="#jabatan">Unit Kerja & Jabatan</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="profil">                
                <?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
                <div class="form-row row-fluid">
                <div class="span3">
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
                            <?php }?>
                </div>
                <div class="span9">                                                      
                    <?php                                                  
                    echo $form->textFieldRow($model,'nama',array('class'=>'span9','maxlength'=>100));                    
                    ?>                    
                    <div class="control-group "><label class="control-label" for="Honorer_pendidikan_terakhir">Pendidikan</label>
                    <div class="controls">
                        <?php echo CHtml::dropDownList('Honorer[pendidikan_terakhir]', $model->pendidikan_terakhir, Pegawai::model()->arrJenjangPendidikan(), array('class' => 'span2')); ?>
                        <input class="span2 angka" maxlength="4" value="<?php echo $model->tahun_pendidikan;?>" name="Honorer[tahun_pendidikan]" id="Honorer_tahun_pendidikan" placeHolder="Tahun" type="text">
                    </div>
                    </div>
       
                    <?php                                  
                    echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin());                                         
                    $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'tempat_lahir',  'cityValue' => $model->tempat_lahir, 'disabled' => false,'width'=>'40%','label'=>'Tempat Lahir'));                    
                    echo $form->datepickerRow(
                           $model, 'tanggal_lahir', array(
                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                       'prepend' => '<i class="icon-calendar"></i>'
                           )
                    );   
                    $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'kota', 'cityValue' => $model->kota, 'disabled' => false,'width'=>'40%','label'=>'Kota'));
                    echo $form->textAreaRow($model,'alamat',array('rows'=>2, 'cols'=>50, 'class'=>'span9'));  
                    echo $form->textFieldRow($model,'kode_pos',array('class'=>'span2','style'=>'max-width:500px;width:100px','maxlength'=>10)); 
                    echo $form->textFieldRow($model,'hp',array('class'=>'span5 angka','style'=>'max-width:500px;width:200px','maxlength'=>25,'prepend'=>'+62')); 
                    echo $form->radioButtonListRow($model, 'agama', Pegawai::model()->ArrAgama());                    
                    echo $form->radioButtonListRow($model, 'golongan_darah', Pegawai::model()->ArrGolonganDarah());   
                    echo $form->radioButtonListRow($model, 'status_pernikahan', Pegawai::model()->arrStatusPernikahan());                       
                    echo $form->textFieldRow($model,'npwp',array('class'=>'span5','maxlength'=>50));
                    echo $form->textFieldRow($model,'bpjs',array('class'=>'span5','maxlength'=>50));                                                                                                                        
                    ?>
                    </div>
                    </div>
            </div>
            <div class="tab-pane" id="jabatan">
              <?php
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
                            'width' => '50%',
                        ))
                    );    

                    $data = array('0'=>'- Jabatan  -')+CHtml::listData(JabatanHonorer::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                    echo $form->select2Row($model, 'jabatan_honorer_id', array(
                        'asDropDownList' => true,                    
                        'data' => $data,    
                        'options' => array(                        
                            "allowClear" => false,
                            'width' => '50%',
                        ))
                    );     

                    echo $form->datepickerRow(
                           $model, 'tmt_jabatan', array(
                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                       'prepend' => '<i class="icon-calendar"></i>'
                           )
                    );            
              ?>

            
            <?php echo $form->textFieldRow($model,'gaji',array('class'=>'span5 angka','prepend'=>'Rp')); ?>
            <?php
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

             <?php if (isset($_GET['v'])){?>
                <div class="control-group "><label class="control-label" for="">Masa Kerja</label>
                <div class="controls"><input disabled=""  name="masaKerja" id="" value="<?php echo $model->masaKerja;?>" type="text">
                </div>
                </div>
                 <?php } ?>
                                                                             
            </div>
        </div>
            

                                      


                    
        <?php if (!isset($_GET['v'])) { ?>        <div class="form-actions">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
                        'icon'=>'ok white',  
			'label'=>$model->isNewRecord ? 'Tambah' : 'Simpan',
		)); ?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
                        'icon'=>'remove',  
			'label'=>'Reset',
		)); ?>
        </div>
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>

<style>

.form-row  .control-label{
    margin-right: 30px;
}
.form-row .controls input{
    margin-bottom: 0px;
}
</style>