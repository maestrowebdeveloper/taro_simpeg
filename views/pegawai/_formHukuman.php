<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'hukuman-detail-form',
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
          $model->pegawai_id = (!empty($pegawai_id))?$pegawai_id:$model->pegawai_id;                 
          echo $form->hiddenField($model, 'id');                   
          echo $form->hiddenField($model, 'pegawai_id');   
        ?>
        <?php
        $data= array('0' => '- Hukuman -') + CHtml::listData(Hukuman::model()->findAll(), 'id', 'nama');                            
        echo $form->select2Row($model, 'hukuman_id', array(
            'asDropDownList' => true,                    
            'data' => $data,    
            'options' => array(                        
                "allowClear" => false,
                'width' => '40%',
            ))
        );
        ?>
        <?php 
        echo $form->textFieldRow($model,'nomor_register',array('class'=>'span3','maxlength'=>255));
        echo $form->datepickerRow(
               $model, 'tanggal_pemberian', array(
           'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
           'prepend' => '<i class="icon-calendar"></i>'
               )
            );                
        echo $form->textAreaRow($model,'alasan',array('rows'=>4, 'cols'=>50, 'class'=>'span6'));

         ?>
                 
        <div class="form-actions">
           <a class="btn btn-primary saveHukuman"><i class="icon-ok icon-white"></i> Simpan</a>
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
    jQuery('#RiwayatHukuman_tanggal_pemberian').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});
    jQuery('#RiwayatHukuman_hukuman_id').select2({'width':'50%'});      
});
$(".saveHukuman").click(function(){
    var postData = $("#hukuman-detail-form").serialize();
    $.ajax({
        url:"<?php echo url('pegawai/saveHukuman');?>",
        data:postData,
        type:"post",
        success:function(data){            
            if(data!=""){
               $("#tableHukuman").replaceWith(data);
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