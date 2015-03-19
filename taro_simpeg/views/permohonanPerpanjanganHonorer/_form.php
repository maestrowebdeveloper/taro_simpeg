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
	'id'=>'permohonan-perpanjangan-honorer-form',
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

        <?php echo $form->textFieldRow($model,'nomor_register',array('class'=>'span5','maxlength'=>225)); ?>

        <?php 
        echo $form->datepickerRow(
               $model, 'tanggal', array(
           'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
           'prepend' => '<i class="icon-calendar"></i>'
               )
        );  

        $data= array('0' => '- Pegawai Honorer -') + CHtml::listData(Honorer::model()->listHonorer(), 'id', 'nama');                            
        echo $form->select2Row($model, 'honorer_id', array(
            'asDropDownList' => true,                    
            'data' => $data,    
            'options' => array(                        
                "allowClear" => false,
                'width' => '40%',
            ))
        );  

        echo $form->textFieldRow($model,'honor_saat_ini',array('class'=>'span5 angka','prepend'=>'Rp')); 

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
    $content = $siteConfig->format_perpanjangan_honorer;
    
    $content = str_replace('{nomor}', $model->nomor_register, $content);
    $content = str_replace('{nomor_pengangkatan}', $model->nomorPengangkatan, $content);
    $content = str_replace('{tanggal_pengangkatan}', $model->tanggalPengangkatan, $content);
    $content = str_replace('{tmt_pengangkatan}', $model->tmtPengangkatan, $content);
    $content = str_replace('{jenis_kelamin}', $model->jenisKelamin, $content);
    $content = str_replace('{pendidikan}', $model->pendidikan, $content);
    $content = str_replace('{masa_kerja}', $model->masa_kerja, $content);
    $content = str_replace('{gaji}', landa()->rp($model->honor_saat_ini), $content);
    $content = str_replace('{ttl}', $model->ttl, $content);
    $content = str_replace('{tmt_mulai}', $model->tmt_mulai, $content);
    $content = str_replace('{tmt_selesai}', $model->tmt_selesai, $content);
    $content = str_replace('{nama}', $model->honorer, $content);
    $content = str_replace('{unit_kerja}', $model->unitKerja, $content);   
    $content = str_replace('{tanggal}', date('d F Y', strtotime($model->created)), $content);    
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