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
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'permohonan-mutasi-form',
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

        <?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
        <?php echo $form->textFieldRow($model,'nomor_register',array('class'=>'span3','maxlength'=>100)); ?>
        <?php 
                echo $form->datepickerRow(
                   $model, 'tanggal', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
            );   
        ?>

        <?php
        $data= array('0' => '- Pegawai -') + CHtml::listData(Pegawai::model()->listPegawai(), 'id', 'nipNama'); 
        echo $form->select2Row($model, 'pegawai_id', array(
            'asDropDownList' => true,                    
            'data' => $data,    
             'events' => array('change' => 'js: function() {
                        $.ajax({
                           url : "' . url('pegawai/getDetail') . '",
                           type : "POST",
                           data :  { id:  $(this).val()},
                           success : function(data){                                                                                                                                           
                            obj = JSON.parse(data);
                            $("#PermohonanMutasi_unit_kerja_lama").val(obj.unit_kerja);                           
                            $("#PermohonanMutasi_tipe_jabatan_lama").val(obj.tipe_jabatan);                           
                            $("#PermohonanMutasi_jabatan_lama").val(obj.jabatan);                           
                        }
                    });
                }'),
            'options' => array(                        
                "allowClear" => false,
                'width' => '40%',
            ))
        );
        ?>
  
            
        <?php echo $form->textFieldRow($model,'unit_kerja_lama',array('class'=>'span6','readOnly'=>true)); ?>

        <?php echo $form->textFieldRow($model,'tipe_jabatan_lama',array('class'=>'span3','maxlength'=>19,'readOnly'=>true)); ?>

        <?php echo $form->textFieldRow($model,'jabatan_lama',array('class'=>'span5','readOnly'=>true)); ?>


            <?php
        $data = array('0'=>'- Unit Kerja -')+CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                echo $form->select2Row($model, 'new_unit_kerja_id', array(
                    'asDropDownList' => true,                    
                    'data' => $data,    
                    'options' => array(                        
                        "allowClear" => false,
                        'width' => '40%',
                    ))
                );
        ?>
        <?php echo $form->radioButtonListRow($model, 'new_tipe_jabatan', Pegawai::model()->arrTipeJabatan());   ?>
        


         <?php
                $struktural = ($model->tipe_jabatan=="struktural")?"":"none";
                $fu = ($model->tipe_jabatan=="fungsional_umum")?"":"none";
                $ft = ($model->tipe_jabatan=="fungsional_tertentu")?"":"none";
                ?>
      
                <div class="struktural" style="display:<?php echo $struktural;?>">                               
                    <?php 
                    $data = array('0'=>'- Jabatan Struktural -')+CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                    echo $form->select2Row($model, 'new_jabatan_struktural_id', array(
                        'asDropDownList' => true,                    
                        'data' => $data,    
                        'options' => array(                        
                            "allowClear" => false,
                            'width' => '50%',
                        ))
                    );
                   ?>
                </div>

                <div class="fungsional_umum" style="display:<?php echo $fu;?>">                                 
                    <?php 
                    $data = array('0'=>'- Jabatan Fungsional Umum -')+CHtml::listData(JabatanFu::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                    echo $form->select2Row($model, 'new_jabatan_fu_id', array(
                        'asDropDownList' => true,                    
                        'data' => $data,    
                        'options' => array(                        
                            "allowClear" => false,
                            'width' => '50%',
                        ))
                    );
                    ?>                            
                </div>

                <div class="fungsional_tertentu" style="display:<?php echo $ft;?>">                                
                    <?php 
                    $data = array('0'=>'- Jabatan Fungsional Tertentu -')+CHtml::listData(JabatanFt::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                    echo $form->select2Row($model, 'new_jabatan_ft_id', array(
                        'asDropDownList' => true,                    
                        'data' => $data,    
                        'options' => array(                        
                            "allowClear" => false,
                            'width' => '50%',
                        ))
                    );
                    ?>                         
                </div>
       

       
                <?php 
                        echo $form->datepickerRow(
                           $model, 'tmt', array(
                       'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                       'prepend' => '<i class="icon-calendar"></i>'
                           )
                    );   
                ?>
                


                                    

                                    

                    
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



<?php if (isset($_GET['v'])) { ?>
<div class="surat" id="surat" style="display:none">
<?php
    $siteConfig = SiteConfig::model()->listSiteConfig();
    $content = $siteConfig->format_mutasi;
    
    $content = str_replace('{nomor}', $model->nomor_register, $content);
    $content = str_replace('{tanggal}', $model->tanggal, $content);
    $content = str_replace('{nip}', $model->Pegawai->nip, $content);
    $content = str_replace('{golru}', $model->Pegawai->golongan, $content);
    $content = str_replace('{ttl}', $model->Pegawai->ttl, $content);
    $content = str_replace('{nama}', $model->pegawai, $content);
    $content = str_replace('{unit_kerja_lama}', $model->unit_kerja_lama, $content);
    $content = str_replace('{unit_kerja_baru}', $model->unitKerja, $content);
    $content = str_replace('{tipe_jabatan_lama}', $model->tipe_jabatan_lama, $content);
    $content = str_replace('{tipe_jabatan_baru}', $model->tipeJabatan, $content);
    $content = str_replace('{jabatan_lama}', $model->jabatan_lama, $content);
    $content = str_replace('{jabatan_baru}', $model->jabatan, $content);
    $content = str_replace('{tmt}', date('d F Y', strtotime($model->tmt)), $content);    
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
$("#viewTab").click(function(){
    $(".surat").hide();
    $(".form").show();
});

$("#viewFull").click(function(){
    $(".surat").show();
    $(".form").hide();
});



function printDiv(divName)
        {                  
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;               
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents ;   
          $("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })
          $("#viewTab").click(function(){
                $(".surat").hide();
                $(".form").show();
            });

            $("#viewFull").click(function(){
                $(".surat").show();
                $(".form").hide();
            });


        } 
</script>