<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'surat-masuk-form',
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

        echo $form->textFieldRow($model,'pengirim',array('class'=>'span4','maxlength'=>225)); 
        echo $form->datepickerRow(
               $model, 'tanggal_terima', array(
           'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
           'prepend' => '<i class="icon-calendar"></i>'
               )
        );

        echo $form->radioButtonListRow($model, 'sifat', SuratMasuk::model()->ArrSifat());

        echo $form->textFieldRow($model,'nomor_surat',array('class'=>'span4','maxlength'=>225)); 

        echo $form->textFieldRow($model,'perihal',array('class'=>'span4','maxlength'=>225));
        
        ?>
        <div class="control-group "><label class="control-label required" for="SuratMasuk_isi">Isi Surat</label>
        <div class="controls">
        <?php
            $this->widget(
            'bootstrap.widgets.TbRedactorJs',
            [
            'name' => 'SuratMasuk[isi]',
            'value' => $model->isi,            
            ]
            );
        ?>
        </div>
        </div>
        
        <?php 
        if (!isset($_GET['v'])) {?>
            <div class="control-group "><label class="control-label" for="SuratMasuk_file">File / Document</label>
            <div class="controls">
            <input id="ytSuratMasuk_file" value="" name="SuratMasuk[file]" type="hidden">
            <input class="span5" name="SuratMasuk[file]" id="SuratMasuk_file" type="file">
            <?php if ($model->file!="") 
            echo '<br><br><span class="alert alert-info"><a target="_blank" href="'.param('urlImg').'/surat_masuk/'.$model->file.'">'.$model->file.'</a></span>';?>
            </div>
            </div>
            <?php            
        }else{?>
            <div class="control-group "><label class="control-label" for="SuratMasuk_file">File / Document</label>
            <div class="controls">            
            <?php if ($model->file!="")echo '<span class="alert alert-info"><a target="_blank" href="'.param('urlImg').'/surat_masuk/'.$model->file.'">'.$model->file.'</a></span>';?>
            </div>
            </div>
            <?php
        }

        echo $form->textFieldRow($model,'tembusan',array('class'=>'span4','maxlength'=>225));
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
