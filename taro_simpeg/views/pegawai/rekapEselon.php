<?php
$this->setPageTitle('Rekapitulasi Data Eselon');
$this->breadcrumbs=array(
	'Pegawai'=>array('index'),
	'Rekapitulasi Data Eselon',
);
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'action' => url("pegawai/rekapEselon?cari=1"),
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<div class="well">

    <div class="row-fluid">
        <?php
        $data = array('0'=>'- Unit Kerja -')+CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
        echo $form->select2Row($model, 'unit_kerja_id', array(
            'asDropDownList' => true,                    
            'data' => $data,
            'value' => isset($_POST['Pegawai']['unit_kerja_id']) ? $_POST['Pegawai']['unit_kerja_id'] : '',
            'options' => array(                        
                "allowClear" => false,
                'width' => '50%',
            ))
        );
        ?>

        <div class="control-group">
                <label class="control-label">Eselon<span class="required">*</span></label>
                <div class="controls">
                    <?php
                    $data = array('0' => '- Eselon -') + CHtml::listData(Eselon::model()->findAll(array('order' => 'root, lft')), 'id', 'nama');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'eselon_id',
                        'data' => $data,
                        'value' => isset($_POST['eselon_id']) ? $_POST['eselon_id'] : '',
                        'options' => array(
                            'width' => '40%;margin:0px;text-align:left',
                    )));
                    ?>                 
                </div>
            </div>
        
           
        </div>
        <div><?php if (!empty($_POST['Pegawai'])) { ?>
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
if ( isset($_GET['cari'])) {
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'daftar-pegawai-grid',
    'dataProvider' => $model->searchEselon(),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
        'nama',
        array(
            'name' => 'nip',
            'type' => 'raw',
            'value' => '$data->nip',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        
        array(
            'name' => 'golongan_id',
            'type' => 'raw',
            'header'=>'Golongan',
            'value' => '$data->golongan',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        array(
            'name' => 'jabatan_fu_id',
            'type' => 'raw',
            'header'=>'Jabatan Fungsional',
            'value' => '$data->jabatanFu',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        array(
            'name' => 'riwayat_pangkat_id',
            'type' => 'raw',
            'value' => '$data->pangkat',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        array(
            'name' => 'unit_kerja_id',
            'type' => 'raw',
            'header'=>'Satuan Kerja',
            'value' => '$data->unitKerja',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        
    ),
));
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
