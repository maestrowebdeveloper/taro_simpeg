<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'jabatan-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
	'type'=>'horizontal',
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	)
)); ?>
    <fieldset>
        <!-- <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend> -->
        <?php echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); ?>
      
        <?php 
        $model->pegawai_id = (!empty($pegawai_id))?$pegawai_id:$model->pegawai_id;            
        echo $form->hiddenField($model, 'id');                   
        echo $form->hiddenField($model, 'pegawai_id');                                                      
        ?>
             
        <?php echo $form->radioButtonListRow($model, 'tipe_jabatan', Pegawai::model()->arrTipeJabatan());   ?>

        <?php
        $struktural = ($model->tipe_jabatan=="struktural")?"":"none";
        $fu = ($model->tipe_jabatan=="fungsional_umum")?"":"none";
        $ft = ($model->tipe_jabatan=="fungsional_tertentu")?"":"none";        
        ?>

        <div class="struktural" style="display:<?php echo $struktural;?>">              
            <?php
            $data = array('0'=>'- Jabatan Struktural -')+CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
            echo $form->select2Row($model, 'jabatan_struktural_id', array(
                'asDropDownList' => true,                    
                'data' => $data,    
                'options' => array(                        
                    "allowClear" => false,
                    'width' => '40%',
                ))
            );
            ?>
        </div>

        <div class="fungsional_umum" style="display:<?php echo $fu;?>">   
            <?php
            $data = array('0'=>'- Jabatan Fungsional Umum -')+CHtml::listData(JabatanFu::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
            echo $form->select2Row($model, 'jabatan_fu_id', array(
                'asDropDownList' => true,                    
                'data' => $data,    
                'options' => array(                        
                    "allowClear" => false,
                    'width' => '40%',
                ))
            );
            ?>                       
        </div>

        <div class="fungsional_tertentu" style="display:<?php echo $ft;?>">              
            <?php
            $data = array('0'=>'- Jabatan Fungsional Tertentu -')+CHtml::listData(JabatanFt::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
            echo $form->select2Row($model, 'jabatan_ft_id', array(
                'asDropDownList' => true,                    
                'data' => $data,    
                'options' => array(                        
                    "allowClear" => false,
                    'width' => '40%',
                ))
            );
            ?> 
        </div>

        <?php
        echo $form->datepickerRow(
                   $model, 'tmt_mulai', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
        );
        ?>           

        <div class="form-actions">
            <a class="btn btn-primary saveJabatan"><i class="icon-ok icon-white"></i> Simpan</a>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'reset',
                        'icon'=>'remove',  
			'label'=>'Reset',
		)); ?>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>

<script>
jQuery(function($) {
    jQuery('#RiwayatJabatan_tmt_mulai').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});    
    jQuery('#RiwayatJabatan_jabatan_struktural_id').select2({'width':'40%'});      
    jQuery('#RiwayatJabatan_jabatan_fu_id').select2({'width':'40%'});      
    jQuery('#RiwayatJabatan_jabatan_ft_id').select2({'width':'40%'});         
});
$("#RiwayatJabatan_tipe_jabatan_0").click(function(event) {   
  $(".struktural").show();
  $(".fungsional_umum").hide();            
  $(".fungsional_tertentu").hide();            
});

$("#RiwayatJabatan_tipe_jabatan_1").click(function(event) { 
  $(".struktural").hide();
  $(".fungsional_umum").show();            
  $(".fungsional_tertentu").hide();            
});

$("#RiwayatJabatan_tipe_jabatan_2").click(function(event) { 
  $(".struktural").hide();
  $(".fungsional_umum").hide();            
  $(".fungsional_tertentu").show();            
});

$(".saveJabatan").click(function(){
    var postData = $("#jabatan-form").serialize();
    $.ajax({
        url:"<?php echo url('pegawai/saveJabatan');?>",
        data:postData,
        type:"post",
        success:function(data){            
            if(data!=""){
              $("#tableJabatan").replaceWith(data);
              $("#modalForm").modal("hide");
            }else{
              alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            }
        },
        error:function(data){
            alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
        },
    });
    
});

</script>