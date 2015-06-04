<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'penghargaan-detail-form',
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
            $data= array('0' => '- Penghargaan -') + CHtml::listData(Penghargaan::model()->findAll(), 'id', 'nama');                            
            echo $form->select2Row($model, 'penghargaan_id', array(
                'asDropDownList' => true,                    
                'data' => $data,    
                'options' => array(                        
                    "allowClear" => false,
                    'width' => '40%',
                ))
            );
            ?>
            <?php
                echo $form->textFieldRow($model,'nomor_register',array('class'=>'span3','maxlength'=>100));
                echo $form->datepickerRow(
                   $model, 'tanggal_pemberian', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
                ); 
                 echo $form->textFieldRow($model,'pejabat',array('class'=>'span3','maxlength'=>100));
                echo $form->textAreaRow($model,'keterangan',array('rows'=>3, 'cols'=>50, 'class'=>'span6'));
            ?>
           
        <div class="form-actions">
            <a class="btn btn-primary savePenghargaan"><i class="icon-ok icon-white"></i> Simpan</a>
           <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>


<script>
jQuery(function($) {
    jQuery('#RiwayatPenghargaan_tanggal_pemberian').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});
    jQuery('#RiwayatPenghargaan_penghargaan_id').select2({'width':'50%'});  
});
$(".savePenghargaan").click(function(){
    var postData = $("#penghargaan-detail-form").serialize();
    $.ajax({
        url:"<?php echo url('pegawai/savePenghargaan');?>",
        data:postData,
        type:"post",
        success:function(data){            
            if(data!=""){
               $("#tablePenghargaan").replaceWith(data);
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