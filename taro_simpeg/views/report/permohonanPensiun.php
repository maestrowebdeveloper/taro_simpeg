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
$this->setPageTitle('Laporan Permohonan Pensiun');
$this->breadcrumbs = array(
    'Laporan Permohonan Pensiun',
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
       
        
        
         <div class="control-group "><label class="control-label" for="">Tanggal</label>
            <div class="controls">
                <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                <?php
                $this->widget(
                    'bootstrap.widgets.TbDatePicker',
                    array(
                    'name' => 'PermohonanPensiun[tanggal]',
                    'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                    'value'=>$model->tanggal,
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
                    'name' => 'PermohonanPensiun[created]',
                    'options' => array('language' => 'id','format'=>'yyyy-mm-dd'),
                    'value'=>$model->created,
                    )
                    );
                ?>
                </div>

            </div>
        </div>
        </div>

           
        
        <div class="span1"><?php if (!empty($model->id)) { ?>
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
if (!empty($model->id)) { 
    $this->renderPartial('_permohonanPensiun', array('model' => $model));
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