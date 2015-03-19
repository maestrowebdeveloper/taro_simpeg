<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Pegawai Per Status Jabatan');
$this->breadcrumbs = array(
    'Laporan Pegawai Per Status Jabatan',
);
?>
<script>
    function hide() {
        $(".well").hide();
        $(".form-horizontal").hide();
    }

</script>
<div class="well">

    <div class="row-fluid">
        <div class="span11">
        

        <div class="control-group ">
        <label class="control-label" for="Pegawai_jabatan_id">Status Jabatan</label>
        <div class="controls">
            <div id="satuanKerja">
                <?php echo $form->dropDownListRow($model, 'pendidikan_id',CHtml::listData(StatusJabatan::model()->findAll(), 'id', 'nama'),array('label'=>false,'class'=>'span4','maxlength'=>100,'empty'=>'- Status Jabatan -'));               ?>
            </div>            
        </div>
        </div>

        <div class="control-group ">
        <label class="control-label" for="Pegawai_jabatan_id">Unit Kerja</label>
        <div class="controls">
            <?php            
            $data = array('0'=>'- Unit Kerja -')+CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');               
            ?>            
                    <?php
                    echo $form->select2Row($model, 'pangkat_id', array(
                        'asDropDownList' => true,
                        'label'=>false,
                        'data' => $data,    

                        'options' => array(
                            "placeholder" => t('choose', 'global'),
                            "allowClear" => true,
                            'width' => '100%',
                        ),
                        'events' => array('change' => 'js: function() {
                                                     $.ajax({
                                                        url : "' . url('pegawai/getSatuanKerja') . '",
                                                        type : "POST",
                                                        data :  { id:  $(this).val()},
                                                        success : function(data){                                                                                                                          
                                                           $("#satuanKerja").html(data);
                                                        }
                                                     });
                                            }'),
                            )
                    );
                    ?>
                
            
        </div>
        </div>

        <div class="control-group ">
        <label class="control-label" for="Pegawai_jabatan_id">Satuan Kerja</label>
        <div class="controls">
            <div id="satuanKerja">
                <?php
                if ($model->pangkat_id>0) {
                    $data = CHtml::listData(SatuanKerja::model()->findAll(array('condition'=>'unit_kerja_id='.$model->pangkat_id,'order' => 'root, lft')), 'id', 'nestedname');      
                    echo $form->dropDownListRow($model, 'jabatan_id',$data,array('class'=>'span10','maxlength'=>100,'label'=>false,'empty'=>'- Satuan Kerja -'));               
                }else{
                    echo $form->dropDownListRow($model, 'jabatan_id',array(),array('class'=>'span10','maxlength'=>100,'label'=>false,'empty'=>'- Satuan Kerja -'));               
                }
            ?>
            </div>
            
        </div>
        </div>
        </div>

           
        
        <div class="span1"><?php if (!empty($model->pendidikan_id)) { ?>
                <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>
            <?php } ?>
        </div>

    
    </div>
    </div>
    
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => 'View Report',
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>


<?php
if (!empty($model->pendidikan_id)) { 
    $this->renderPartial('_statusJabatan', array('model' => $model));
}
?>
<script>
function printDiv(divName)
        {                  
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;               
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents ;            
        }   
</script>
<style>
.form-horizontal .control-group{
    margin-bottom: 5px !important;
}
</style>