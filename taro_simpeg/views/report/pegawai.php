<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'action' => url("report/pegawai?cari=1"),
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Pegawai Negeri Sipil');
$this->breadcrumbs = array(
    'Laporan Pegawai Negeri Sipil',
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
        $data = array('0' => '- Kedudukan -') + CHtml::listData(Kedudukan::model()->findAll(), 'id', 'nama');
        echo $form->select2Row($model, 'kedudukan_id', array(
            'asDropDownList' => true,
            'data' => $data,
            'options' => array(
                "allowClear" => false,
                'width' => '40%',
            ))
        );


        $data = array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
        echo $form->select2Row($model, 'unit_kerja_id', array(
            'asDropDownList' => true,
            'data' => $data,
            'options' => array(
                "allowClear" => false,
                'width' => '50%',
            ))
        );
//        $data = array('0' => '- Parent -') + CHtml::listData(Golongan::model()->findAll(array('order' => 'root, lft')), 'tingkat', 'nestedFullName');
//        echo $form->select2Row($model, 'golongan_id', array(
//            'asDropDownList' => true,
//            'data' => $data,
//            'options' => array(
//                "allowClear" => false,
//                'width' => '50%',
//            ))
//        );
        ?>
        <div class="control-group "><label class="control-label" for="jurusan">Jurusan</label>
            <div class="controls">
                <input type="text" name="id_jurusan" id="id_jurusan" value="<?php echo isset($_POST['id_jurusan']) ? $_POST['id_jurusan'] : "-"; ?>">
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'jurusan',
                    'sourceUrl' => array('report/getPendidikan'),
                    'value' => isset($_POST['jurusan']) ? $_POST['jurusan'] : "",
                    'options' => array(
                        'showAnim' => 'fold',
                        'minLength' => '3',
                        'select' => 'js:function(event, ui){
                                        jQuery("#id_jurusan").val(ui.item["item_id"]);
                                    }'
                    ),
                ))
                ?>
            </div>
        </div>

        <?php
        echo $form->radioButtonListRow($model, 'tipe_jabatan', Pegawai::model()->arrTipeJabatan());
        ?>

        <div class="control-group "><label class="control-label" for="Pegawai_tmt_pensiun">TMT Pensiun</label>
            <div class="controls">
                <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                    <?php
                    $this->widget(
                            'bootstrap.widgets.TbDatePicker', array(
                        'name' => 'Pegawai[tmt_pns]',
                        'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                        'value' => $model->tmt_pns,
                            )
                    );
                    ?>
                </div>
                S/D
                <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                    <?php
                    $this->widget(
                            'bootstrap.widgets.TbDatePicker', array(
                        'name' => 'Pegawai[tmt_pensiun]',
                        'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                        'value' => $model->tmt_pensiun,
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

<?php
$cari = isset($_GET['cari']) ? "1" : "0";
if ($cari == "1") {
    ?>
    <div class="report" id="report" style="width: 100%">
        <h3 style="text-align:center">LAPORAN DATA PEGAWAI NEGERI SIPIL</h3><br>
        <h6  style="text-align:center">Tanggal : <?php echo date('d F Y'); ?></h6>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'daftar-pegawai-grid',
            'dataProvider' => $model->search2(),
            'type' => 'striped bordered condensed',
            'template' => '{summary}{pager}{items}{pager}',
            'columns' => array(
                array(
                    'name' => 'nip',
                    'type' => 'raw',
                    'value' => '$data->nip',
                    'htmlOptions' => array('style' => 'text-align:left'),
                ),
                'nama',
                'kedudukan',
                array(
                    'name' => 'unitKerja',
                    'type' => 'raw',
                    'value' => '$data->unitKerja',
                    'htmlOptions' => array('style' => 'text-align:left'),
                ),
                array(
                    'name' => 'golongan',
                    'type' => 'raw',
                    'value' => '$data->golongan',
                    'htmlOptions' => array('style' => 'text-align:left'),
                ),
                array(
                    'name' => 'tipe',
                    'type' => 'raw',
                    'value' => '$data->tipe',
                    'htmlOptions' => array('style' => 'text-align:left'),
                ),
                'jabatan',
                'masaKerja',
                'tmt_pensiun'
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
