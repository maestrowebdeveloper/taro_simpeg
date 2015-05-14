<?php  $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
'id'=>'search-permohonan-mutasi-form',
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
                            $("#PermohonanMutasi_unit_kerja_lama").val(obj.unit_kerja);                           
                            $("#PermohonanMutasi_tipe_jabatan_lama").val(obj.tipe_jabatan);                           
                            $("#PermohonanMutasi_jabatan_lama").val(obj.jabatan);                           
                        }
                    });
                }'),
            'options' => array(                        
                "allowClear" => false,
                'width' => '40%',
            ))
        );
        ?>
  
            
        <?php echo $form->textFieldRow($model,'unit_kerja_lama',array('class'=>'span6')); ?>

        <?php echo $form->textFieldRow($model,'tipe_jabatan_lama',array('class'=>'span3','maxlength'=>19)); ?>

        <?php echo $form->textFieldRow($model,'jabatan_lama',array('class'=>'span5')); ?>


            <?php
        $data = array('0'=>'- Unit Kerja -')+CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
                echo $form->select2Row($model, 'new_unit_kerja_id', array(
                    'asDropDownList' => true,                    
                    'data' => $data,    
                    'options' => array(                        
                        "allowClear" => false,
                        'width' => '40%',
                    ))
                );
        ?>
        <?php echo $form->radioButtonListRow($model, 'new_tipe_jabatan', Pegawai::model()->arrTipeJabatan());   ?>
        


         <?php
                $struktural = ($model->tipe_jabatan=="struktural")?"":"none";
                $fu = ($model->tipe_jabatan=="fungsional_umum")?"":"none";
                $ft = ($model->tipe_jabatan=="fungsional_tertentu")?"":"none";
                ?>
      
                <div class="struktural" style="display:<?php echo $struktural;?>">                               
                    <?php 
                    $data = array('0'=>'- Jabatan Struktural -')+CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                    echo $form->select2Row($model, 'new_jabatan_struktural_id', array(
                        'asDropDownList' => true,                    
                        'data' => $data,    
                        'options' => array(                        
                            "allowClear" => false,
                            'width' => '50%',
                        ))
                    );
                   ?>
                </div>

                <div class="fungsional_umum" style="display:<?php echo $fu;?>">                                 
                    <?php 
                    $data = array('0'=>'- Jabatan Fungsional Umum -')+CHtml::listData(JabatanFu::model()->findAll(array('order' => 'id')), 'id', 'nama');
                    echo $form->select2Row($model, 'new_jabatan_fu_id', array(
                        'asDropDownList' => true,                    
                        'data' => $data,    
                        'options' => array(                        
                            "allowClear" => false,
                            'width' => '50%',
                        ))
                    );
                    ?>                            
                </div>

                <div class="fungsional_tertentu" style="display:<?php echo $ft;?>">                                
                    <?php 
                    $data = array('0'=>'- Jabatan Fungsional Tertentu -')+CHtml::listData(JabatanFt::model()->findAll(array('order' => 'id')), 'id', 'nama');
                    echo $form->select2Row($model, 'new_jabatan_ft_id', array(
                        'asDropDownList' => true,                    
                        'data' => $data,    
                        'options' => array(                        
                            "allowClear" => false,
                            'width' => '50%',
                        ))
                    );
                    ?>                         
                </div>


       

       
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
            $(":input", "#search-permohonan-mutasi-form").each(function() {
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

