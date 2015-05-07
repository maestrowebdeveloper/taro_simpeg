<?php
$this->setPageTitle('Rekapitulasi Data Jabatan Fungsional');
$this->breadcrumbs=array(
	'Pegawai'=>array('index'),
	'Rekapitulasi Data Jabatan Fungsional',
);
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'action' => url("pegawai/rekapJabfung?cari=1"),
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
            'value' => isset($_POST['unit_kerja_id']) ? $_POST['unit_kerja_id'] : '',
            'options' => array(                        
                "allowClear" => false,
                'width' => '50%',
            ))
        );
        ?>

        <div class="control-group ">
        <label class="control-label" for="Pegawai_jabatan_id">Berdasarkan</label>
        <div class="controls">
            <?php
            $data= array('0' => '- Berdasarkan -') + Pegawai::model()->arrRekapitulasiJabfung();                            
            $this->widget(
                        'bootstrap.widgets.TbSelect2', array(      
                            'name' => 'type',
                            'data' => $data,
                            'value' => isset($_POST['type']) ? $_POST['type'] : '',
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
//if ( !empty($_POST)) {
//    $this->renderPartial('_rekapJabfung', array('model' => $model));
//}
?>
<?php
if ( isset($_GET['cari'])) {
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'daftar-pegawai-grid',
    'dataProvider' => $model->search3(),
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
