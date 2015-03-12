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
        <div class="control-group "><label class="control-label" for="Honorer_tmt_akhir_kontrak">TMT Akhir Kontrak</label>
        <div class="controls">
            <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
            <?php
            $this->widget(
                'bootstrap.widgets.TbDatePicker',
                array(
                'name' => 'Honorer[tmt_kontrak]',
                'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                'value'=>$model->tmt_kontrak,
                )
                );
            ?>
            </div>
            S/D
            <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
            <?php
            $this->widget(
                'bootstrap.widgets.TbDatePicker',
                array(
                'name' => 'Honorer[tmt_akhir_kontrak]',
                'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                'value'=>$model->tmt_akhir_kontrak,
                )
                );
            ?>
            </div>

        </div>
        </div>

        
           
        </div>
        <div><?php if (!empty($post)) { ?>
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
if (!empty($post)) {
    $this->renderPartial('_honorer', array('model' => $model));
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