<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'keluarga-form',
	'enableAjaxValidation'=>false,
        'method'=>'post',
	'type'=>'horizontal',
	'htmlOptions'=>array(
		'enctype'=>'multipart/form-data'
	)
)); ?>
    <fieldset>
       

        <?php 
        echo $form->errorSummary($model,'Opps!!!', null,array('class'=>'alert alert-error span12')); 

        $model->pegawai_id = (!empty($pegawai_id))?$pegawai_id:$model->pegawai_id;                 
        echo $form->hiddenField($model, 'id');                   
        echo $form->hiddenField($model, 'pegawai_id');  

        echo $form->radioButtonListRow($model, 'hubungan', Pegawai::model()->ArrHubungan());          
        echo $form->textFieldRow($model,'nama',array('class'=>'span3','maxlength'=>100)); 
        echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin()); 
        $display = ($model->hubungan=='anak' || empty($model->hubungan))?'none':'';
        $anak = ($model->hubungan=='anak')?'':'none';
        ?>
        <div class="suami_istri" style="display:<?php echo $display;?>">
        <?php
        echo $form->textFieldRow($model,'nomor_karsu',array('class'=>'span3','maxlength'=>100));
        echo $form->datepickerRow(
                   $model, 'tanggal_pernikahan', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
            ); 
        echo $form->radioButtonListRow($model, 'status', Pegawai::model()->ArrStatusHubungan());   
        ?>
        </div>

        <?php
        $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'RiwayatKeluarga[tempat_lahir]',  'cityValue' => $model->tempat_lahir, 'disabled' => false,'width'=>'60%','label'=>'Tempat Lahir'));        
        echo $form->datepickerRow(
                   $model, 'tanggal_lahir', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
            ); 
            ?>

        <div class="anak" style="display:<?php echo $anak;?>">
        <?php        
        echo $form->textFieldRow($model,'anak_ke',array('class'=>'span1 angka','maxlength'=>100));       
        echo $form->radioButtonListRow($model, 'status_anak', Pegawai::model()->ArrStatusAnak());   
        ?>
        </div>
        <?php
        echo $form->radioButtonListRow($model, 'pendidikan_terakhir', Pegawai::model()->arrJenjangPendidikan());  
        echo $form->textFieldRow($model,'pekerjaan',array('class'=>'span3','maxlength'=>100));

        ?>


                    


        <div class="form-actions">
            <a class="btn btn-primary saveKeluarga"><i class="icon-ok icon-white"></i> Simpan</a>
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
    jQuery('#RiwayatKeluarga_tanggal_pernikahan').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});    
    jQuery('#RiwayatKeluarga_tanggal_lahir').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});    
    jQuery('#RiwayatKeluarga_tempat_lahir').select2({'width':'40%'});         
});

$("#RiwayatKeluarga_hubungan_0,#RiwayatKeluarga_hubungan_1").click(function(event) {   
  $(".suami_istri").show();  
  $(".anak").hide();  
});

$("#RiwayatKeluarga_hubungan_2").click(function(event) { 
  $(".suami_istri").hide();  
  $(".anak").show();  

});


$(".saveKeluarga").click(function(){
    var postData = $("#keluarga-form").serialize();
    $.ajax({
        url:"<?php echo url('pegawai/saveKeluarga');?>",
        data:postData,
        type:"post",
        success:function(data){            
            if(data!=""){
               $("#tableKeluarga").replaceWith(data);
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