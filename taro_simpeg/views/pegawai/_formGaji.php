<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'gaji-pokok-form',
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
        <?php
        echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12'));
        ?>
     
              <?php
                  $model->pegawai_id = (!empty($pegawai_id))?$pegawai_id:$model->pegawai_id;                 
                  echo $form->hiddenField($model, 'id');                   
                  echo $form->hiddenField($model, 'pegawai_id');   
                  
                  echo $form->textFieldRow($model,'nomor_register',array('class'=>'span3','maxlength'=>100));
                       
                  echo $form->textFieldRow($model,'gaji',array('class'=>'span3 angka' ,'prepend'=>'Rp'));
                  echo $form->textFieldRow($model,'dasar_perubahan',array('class'=>'span4','maxlength'=>100));
                   echo $form->datepickerRow(
                             $model, 'tmt_mulai', array(
                         'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                         'prepend' => '<i class="icon-calendar"></i>'
                             )
                      );   

                    echo $form->datepickerRow(
                             $model, 'tmt_selesai', array(
                         'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                         'prepend' => '<i class="icon-calendar"></i>'
                             )
                      );   
              ?>
           
        <br>
        <br>
        <div class="form-actions">
         <a class="btn btn-primary saveGajiPokok"><i class="icon-ok icon-white"></i> Simpan</a>
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
    jQuery('#RiwayatGaji_tmt_mulai').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});  
    jQuery('#RiwayatGaji_tmt_selesai').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});  
      
});
$(".saveGajiPokok").click(function(){
    var postData = $("#gaji-pokok-form").serialize();
    $.ajax({
        url:"<?php echo url('pegawai/saveGajiPokok');?>",
        data:postData,
        type:"post",
        success:function(data){
            if(data!=""){
              $("#tableGajiPokok").replaceWith(data);
             $("#modalForm").modal("show");
               $(".modal-body").html(data);
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