<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-permohonan-ijin-belajar-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
    'type'=>'horizontal',
));  ?>

 <?php echo $form->textFieldRow($model,'nomor_register',array('class'=>'span5','maxlength'=>225)); ?>

        <?php 
        echo $form->datepickerRow(
               $model, 'tanggal', array(
           'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
           'prepend' => '<i class="icon-calendar"></i>'
               )
        );  

        $data= array('0' => '- Pegawai -') + CHtml::listData(Pegawai::model()->listPegawai(), 'id', 'nipNama');                            
        echo $form->select2Row($model, 'pegawai_id', array(
            'asDropDownList' => true,                    
            'data' => $data,    
            'options' => array(                        
                "allowClear" => false,
                'width' => '40%',
            ))
        );  

        echo $form->radioButtonListRow($model, 'jenjang_pendidikan', Pegawai::model()->ArrJenjangPendidikan());                    
        ?>

        

        <?php echo $form->textFieldRow($model,'jurusan',array('class'=>'span5','maxlength'=>225)); ?>

        <?php echo $form->textFieldRow($model,'nama_sekolah',array('class'=>'span5','maxlength'=>225)); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-permohonan-ijin-belajar-form").each(function() {
                var type = this.type;
                var tag = this.tagName.toLowerCase(); // normalize case
                if (type == "text" || type == "password" || tag == "textarea")
                    this.value = "";
                else if (type == "checkbox" || type == "radio")
                    this.checked = false;
                else if (tag == "select")
                    this.selectedIndex = "";
            });
        });
    })
</script>

