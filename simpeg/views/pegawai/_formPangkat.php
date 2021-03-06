<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'pangkat-form',
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

           
            <?php             
            $model->pegawai_id = (!empty($pegawai_id))?$pegawai_id:$model->pegawai_id;                 
            echo $form->hiddenField($model, 'id');                   
            echo $form->hiddenField($model, 'pegawai_id');                   
                                        
            $data = array('0'=>'- Golongan -')+CHtml::listData(Golongan::model()->findAll(array('order' => 'nama')), 'id', 'golongan');                                    
            echo $form->select2Row($model, 'golongan_id', array(
                'asDropDownList' => true,                    
                'data' => $data,    
                'options' => array(                        
                    "allowClear" => false,
                    'width' => '40%',
                ))
            );

            echo $form->textFieldRow($model,'nomor_register',array('class'=>'span5','maxlength'=>50));
            
            echo $form->datepickerRow(
                   $model, 'tanggal_cg', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
            ); 
            echo $form->datepickerRow(
                   $model, 'tmt_pangkat', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
            ); 
            echo $form->textFieldRow($model,'no_sk',array('class'=>'span5','maxlength'=>50));
            echo $form->datepickerRow(
                   $model, 'tgl_sk', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
            ); 
            ?>

        <div class="form-actions">            
        <a class="btn btn-primary savePangkat"><i class="icon-ok icon-white"></i> Simpan</a>
        <button class="btn back "id="yw10" type="reset" ><i class="entypo-icon-back"></i> Back</button>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>
<script>
jQuery(function($) {
    jQuery('#RiwayatPangkat_tmt_pangkat').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});
    jQuery('#RiwayatPangkat_tgl_sk').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});
    jQuery('#RiwayatPangkat_tanggal_cg').datepicker({'language':'id','format':'yyyy-mm-dd','weekStart':0});
    jQuery('#RiwayatPangkat_golongan_id').select2({'width':'30%'});          
});
$(".savePangkat").click(function(){
    var postData = $("#pangkat-form").serialize();
    $.ajax({
        url:"<?php echo url('pegawai/savePangkat');?>",
        data:postData,
        type:"post",
        success:function(data){            
            if(data!=""){
               $("#tablePangkat").replaceWith(data);
              //$("#modalForm").modal("hide");
                $(".modal-body").html(data);
                $("#modalForm").modal("show");
            }else{
              alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
            }
        },
        error:function(data){
            alert("Terjadi Kesalahan Input Data. Silahkan Dicek Kembali!");
        },
    });
    
});
 $(".back").click(function() {
    var judul = $(this).attr('judulPangkat');
        $.ajax({
            url: "<?php echo url('pegawai/getTablePangkat'); ?>",
            data: "id=<?php echo $model->pegawai_id; ?>" + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function(data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
        $("#judul").html(judul);
    });
</script>