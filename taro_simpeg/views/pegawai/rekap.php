<?php
$this->setPageTitle('Rekapitulasi Data Pegawai');
$this->breadcrumbs=array(
	'Pegawai'=>array('index'),
	'Rekapitulasi Data Pegawai',
);
?>

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
<div class="well">

    <div class="row-fluid">
        <div class="control-group">
                <label class="control-label">Satuan Kerja<span class="required">*</span></label>
                <div class="controls">
                    <?php
                    $data = array('0' => '- Satuan Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'riwayat_jabatan_id',
                        'data' => $data,
                        'value' => isset($_POST['riwayat_jabatan_id']) ? $_POST['riwayat_jabatan_id'] : '',
                        'options' => array(
                            'width' => '40%;margin:0px;text-align:left',
                    )));
                    ?>                 
                </div>
            </div>

        <div class="control-group ">
        <label class="control-label" for="Pegawai_jabatan_id">Berdasarkan</label>
        <div class="controls">
            <?php
            $data= array('0' => '- Berdasarkan -') + Pegawai::model()->arrRekapitulasi();                            
            $this->widget(
                        'bootstrap.widgets.TbSelect2', array(      
                            'name' => 'Pegawai[jabatan_fu_id]',
                            'data' => $data,
                            'value'=>$model->jabatan_fu_id,
                            'options' => array(
                                'width' => '25%;margin:0px;text-align:left',
                                )));
                                     
           ?>
        </div>
        </div>
        
           
        </div>
        <div><?php if (!empty($_POST)) { ?>
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
            'label' => 'View Rekapitulasi',
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>


<?php
if ( !empty($_POST)) {
    $this->renderPartial('_rekap', array('model' => $model));
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
function hide() {
        $(".well").hide();
        $(".form-horizontal").hide();
    }        
</script>
<style>
.form-horizontal .control-group{
    margin-bottom: 5px !important;
}
</style>
