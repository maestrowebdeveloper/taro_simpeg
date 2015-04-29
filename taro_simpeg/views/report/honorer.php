<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url("report/honorer?cari=1"),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Pegawai Honorer');
$this->breadcrumbs = array(
    'Laporan Pegawai Honorer',
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
        $data = array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
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
                            'bootstrap.widgets.TbDatePicker', array(
                        'name' => 'Honorer[tmt_kontrak]',
                        'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                        'value' => $model->tmt_kontrak,
                            )
                    );
                    ?>
                </div>
                S/D
                <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                    <?php
                    $this->widget(
                            'bootstrap.widgets.TbDatePicker', array(
                        'name' => 'Honorer[tmt_akhir_kontrak]',
                        'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                        'value' => $model->tmt_akhir_kontrak,
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
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'icon16 icomoon-icon-file-excel  white',
        'label' => 'Export Excel',
        'id' => 'export',
        'htmlOptions' => array(
            'name' => 'export'
        )
    ));
    ?>
</div>

<?php $this->endWidget(); ?>


<?php if (isset($_GET['cari']) && !empty($_GET['cari'])) { ?>
    <div class="report" id="report" style="width: 100%">
        <h3 style="text-align:center">LAPORAN DATA PEGAWAI HONORER</h3><br>
        <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'honorer-grid',
            'dataProvider' => $model->search2(),
            'type' => 'striped bordered condensed',
            'template' => '{summary}{pager}{items}{pager}',
            'columns' => array(
                array(
                    'name' => 'id',
                    'type' => 'raw',
                    'value' => '$data->id',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'nama',
                array(
                    'name' => 'unitKerja',
                    'type' => 'raw',
                    'value' => '$data->unitKerja',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'jabatan',
                array(
                    'name' => 'tmt_kontrak',
                    'type' => 'raw',
                    'value' => 'date("d M Y",strtotime($data->tmt_kontrak))',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'tmt_akhir_kontrak',
                    'type' => 'raw',
                    'value' => 'date("d M Y",strtotime($data->tmt_akhir_kontrak))',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'masaKerja',
            ),
        ));
        ?>
    </div>
    <?php
}
?>
<script>
    function printDiv(divName)
    {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<style>
    .form-horizontal .control-group{
        margin-bottom: 5px !important;
    }
</style>