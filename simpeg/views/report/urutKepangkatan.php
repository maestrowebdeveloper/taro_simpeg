<?php
Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('daftar-pegawai-grid', {
                data: $(this).serialize()
            });
            return false;
        });
");
?>
<div class="search-form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'search-pegawai-form',
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
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
            $data = array('0' => '- Unit Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
            echo $form->select2Row($model, 'riwayat_jabatan_id', array(
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
                    $data = array('0' => '- Parent -') + CHtml::listData(Golongan::model()->findAll(array('order' => 'id')), 'tingkat', 'nama');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'Pegawai[jabatan_fu_id]',
                        'data' => $data,
                        'value' => $model->jabatan_fu_id,
                        'options' => array(
                            'width' => '25%;margin:0px;text-align:left',
                    )));

                    echo '  s/d ';

                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'Pegawai[jabatan_ft_id]',
                        'data' => $data,
                        'value' => $model->jabatan_ft_id,
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

        <div class="form-actions">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok white',
                'label' => 'View Report',
            ));
            ?>
            <a class="btn excelReport" onclick="exportExcel();"><i class="icomoon-icon-file-excel icon-white"></i> Export Excel</a>
        </div>

    </div>
    <?php $this->endWidget(); ?>
</div>
<h3 style="text-align:center">LAPORAN PEGAWAI BERDASARKAN URUTAN KEPANGKATAN PEGAWAI</h3><br>
    <h6  style="text-align:center">Tanggal : <?php echo date('d F Y'); ?></h6>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'daftar-pegawai-grid',
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
        array(
            'name' => 'nip',
            'type' => 'raw',
            'value' => '$data->nip',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        'nama',
        array(
            'name' => 'unitKerja',
            'type' => 'raw',
            'value' => '$data->unitKerja',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        array(
            'name' => 'golongan',
            'type' => 'raw',
            'value' => '$data->Pangkat->golongan',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        array(
            'name' => 'tipe',
            'value' => '$data->tipe',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
    ),
));
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
    function exportExcel(){
        var unit_id = $("#Pegawai_unit_kerja_id").val();
        var fu_id = $("#Pegawai_jabatan_fu_id").val();
        var ft_id = $("#Pegawai_jabatan_ft_id").val();
        if(unit_id != 0){
            window.open('<?php echo url('report/excelKepangkatan')?>?unit_id='+unit_id+'&fu_id='+fu_id+'&ft_id='+ft_id);
        }else{
            alert('Pilih Unit Kerja terlebih dahulu!');
        }
    }
</script>
<style>
    .form-horizontal .control-group{
        margin-bottom: 5px !important;
    }
</style>