<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-permohonan-pensiun-form',
'action'=>Yii::app()->createUrl($this->route),
'method'=>'get',
'type'=>'horizontal',
));  ?>

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
                            $("#PermohonanPensiun_unit_kerja_id").val(obj.unit_kerja);                           
                            $("#PermohonanPensiun_tipe_jabatan").val(obj.tipe_jabatan);                           
                            $("#PermohonanPensiun_jabatan_struktural_id").val(obj.jabatan);                           
                            $("#PermohonanPensiun_masa_kerja").val(obj.masa_kerja);                           
                        }
                    });
                }'),
            'options' => array(                        
                "allowClear" => false,
                'width' => '40%',
            ))
        );
        ?>
                                     

        <?php 
                echo $form->datepickerRow(
                   $model, 'tmt', array(
               'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
               'prepend' => '<i class="icon-calendar"></i>'
                   )
            );   
        ?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'search white', 'label'=>'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'button', 'icon'=>'icon-remove-sign white', 'label'=>'Reset', 'htmlOptions'=>array('class'=>'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function($) {
        $(".btnreset").click(function() {
            $(":input", "#search-permohonan-pensiun-form").each(function() {
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

