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
$this->setPageTitle('Laporan Daftar Urutan Kepangkatan Pegawai');
$this->breadcrumbs = array(
    'Laporan Daftar Urutan Kepangkatan Pegawai',
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
        <?php
        $data = array('0'=>'- Unit Kerja -')+CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
        echo $form->select2Row($model, 'unit_kerja_id', array(
            'asDropDownList' => true,                    
            'data' => $data,    
            'options' => array(                        
                "allowClear" => false,
                'width' => '50%',
            ))
        );
        ?>

        <div class="control-group ">
        <label class="control-label" for="Pegawai_jabatan_id">Pangkat / Golongan</label>
        <div class="controls">
            <?php

            $data= array('0' => '- Parent -') + CHtml::listData(Golongan::model()->findAll(array('order' => 'root, lft')), 'tingkat', 'nestedFullName');                            
            $this->widget(
                        'bootstrap.widgets.TbSelect2', array(      
                            'name' => 'Pegawai[jabatan_fu_id]',
                            'data' => $data,
                            'value'=>$model->jabatan_fu_id,
                            'options' => array(
                                'width' => '25%;margin:0px;text-align:left',
                                )));
                                     
            echo '  s/d ';

            $this->widget(
                        'bootstrap.widgets.TbSelect2', array(      
                            'name' => 'Pegawai[jabatan_ft_id]',
                            'data' => $data,
                            'value'=>$model->jabatan_ft_id,
                            'options' => array(
                                'width' => '25%;margin:0px;text-align:left',
                                )));
            
            ?>
        </div>
        </div>
        
           
        </div>
        <div><?php if (!empty($model->jabatan_ft_id) && !empty($model->jabatan_fu_id)) { ?>
                <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>
            <?php } ?>
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
if (!empty($model->unit_kerja_id)) {
    $this->renderPartial('_urutKepangkatan', array('model' => $model));
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