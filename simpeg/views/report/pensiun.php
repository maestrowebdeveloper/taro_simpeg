<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'get',
    'action' => url('report/pensiun?tampil=1'),
    'type' => 'horizontal',
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Pensiun');
$this->breadcrumbs = array(
    'Laporan pensiun',
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

        <div class="control-group ">
            <label class="control-label" for="Pegawai_jabatan_id">Tahun / Bulan</label>
            <div class="controls">
                <select Name='tahun'>
                    <option value="0">Select Year</option>
                    <?php
                    $th = date('Y');
                    for ($x = ($th - 5); $x <= ($th + 5); $x++) {
                        $status = '';
                        if (isset($_GET['tahun']) and $_GET['tahun'] == $x) {
                            $status = 'selected="selected"';
                        }
                        echo'<option value="' . $x . '" ' . $status . '>' . $x . '</option>';
                    }
                    ?> 
                </select> - 
                <select name='bulan'>
                    <option value=0> Select Month</option>
                    <?php
                    $month = landa()->monthly();
                    foreach ($month as $key => $val) {
                        $status = '';
                        if (isset($_GET['bulan']) and $_GET['bulan'] == $key) {
                            $status = 'selected="selected"';
                        }
                        echo '<option value="' . $key . '" ' . $status . '>' . $val . '</option>';
                    }
                    ?>
                </select>    
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label" for="bup">BUP</label>
            <div class="controls">
                <select name='bup'>
                    <option value=1> ---Select---</option>
                    <option value="58" <?php
                    if (isset($_GET['bup']) and $_GET['bup'] == "58") {
                        echo 'selected="selected"';
                    }
                    ?>> 58</option>
                    <option value="60" <?php
                    if (isset($_GET['bup']) and $_GET['bup'] == "60") {
                        echo 'selected="selected"';
                    }
                    ?>> 60</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Satuan Kerja<span class="required">*</span></label>
            <div class="controls">
                <?php
                $data = array('0' => '- Select All -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
                $this->widget(
                        'bootstrap.widgets.TbSelect2', array(
                    'name' => 'satuan_kerja_id',
                    'data' => $data,
                    'value' => isset($_GET['satuan_kerja_id']) ? $_GET['satuan_kerja_id'] : '',
                    'options' => array(
                        'width' => '40%;margin:0px;text-align:left',
                )));
                ?>                 
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Eselon<span class="required">*</span></label>
            <div class="controls">
                <?php
                $data = array('0' => '- Eselon -') + CHtml::listData(Eselon::model()->findAll(array('order' => 'id')), 'id', 'nama');
                $this->widget(
                        'bootstrap.widgets.TbSelect2', array(
                    'name' => 'eselon_id',
                    'data' => $data,
                    'value' => isset($_GET['eselon_id']) ? $_GET['eselon_id'] : '',
                    'options' => array(
                        'width' => '40%;margin:0px;text-align:left',
                )));
                ?>                 
            </div>
        </div>
        <?php
        echo $form->radioButtonListRow($model, 'jabatan_ft_id', Pegawai::model()->ArrJabFt());
        ?>
    </div>
    <div class="span1"><?php if (!empty($model->id)) { ?>
            <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>
        <?php } ?>
    </div>

</div>
<div class="form-actions">
    <button class="btn btn-primary" id="yw2" type="submit" name="yt0" onclick="return validat()"><i class="icon-ok icon-white"></i> View Report</button>
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
$tampil = isset($_GET['tampil']) ? "1" : "0";
if ($tampil == "1") {
    ?>
    <?php
    $criteria = new CDbCriteria();
    $criteria->with = array('RiwayatJabatan','JabatanStruktural');
    $criteria->together = true;
    $criteria->addCondition('kedudukan_id="1"');

    if (!empty($_GET['tahun']) && !empty($_GET['bup'])) {
        $tgl_lahir = $_GET['tahun'];
        $criteria->addCondition('date_format(tmt_pensiun,"%y") = "' . date("y", strtotime($tgl_lahir)) . '"');
    }

    if (!empty($_GET['bulan']))
        $criteria->addCondition('month(tmt_pensiun) = "' . substr("0" . $_GET['bulan'], -2, 2) . '"');

    if (!empty($_GET['satuan_kerja_id']))
        $criteria->addCondition('JabatanStruktural.unit_kerja_id = ' . $_GET['satuan_kerja_id']);

    if (!empty($_GET['eselon_id'])) {
        $jbt_id = array();

        $jbt = JabatanStruktural::model()->findAll(array('condition' => 'eselon_id=' . $_GET['eselon_id']));
        if (!empty($jbt)) {
            foreach ($jbt as $a) {
                $jbt_id[] = $a->id;
            }
            $criteria->addCondition('t.jabatan_struktural_id IN ("' . implode(',', $jbt_id) . '")');
        }
    }
    //jabatan_ft
    if (isset($_GET['Pegawai']['jabatan_ft_id']) and ! empty($_GET['Pegawai']['jabatan_ft_id'])) {
        $jabFt = JabatanFt::model()->findAll(array('condition' => 'type ="' . $_GET['Pegawai']['jabatan_ft_id'] . '"'));
        $id = array();
        if (empty($jabFt)) {
            
        } else {
            foreach ($jabFt as $val) {
                $id[] = $val->id;
            }
        }
        $criteria->addCondition('RiwayatJabatan.jabatan_ft_id IN (' . implode(",", $id) . ')');
    }

    $data = new CActiveDataProvider('Pegawai', array(
        'criteria' => $criteria,
        'sort' => false,
    ));
//$data = Pegawai::model()->with('RiwayatJabatan')->findAll(array('condition' => 't.id > 0 ' . $criteria));
    ?>

    <!--    <div style="text-align: right">

            <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
            <a class="btn btn-info pull-right" href="<?php echo url("/suratMasuk/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
        </div>-->
    <div class="report" id="report" style="width: 100%">
        <h3 style="text-align:center">LAPORAN PENSIUN</h3><br>
        <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'daftar-pegawai-grid',
            'dataProvider' => $data,
            'type' => 'striped bordered condensed',
            'template' => '{pager}{summary}{items}',
            'columns' => array(
                'bup',
                array(
                    'name' => 'tmt_pensiun',
                    'header' => 'Proyeksi Pensiun',
                    'type' => 'raw',
                    'value' => 'date("d/m/Y",strtotime($data->tmt_pensiun))',
                ),
                array(
                    'name' => 'status',
                    'header' => 'Status',
                    'type' => 'raw',
                    'value' => '(date("Y-m-d") < $data->tmt_pensiun) ? "Aktif" : "Pensiun"'
                ),
                array(
                    'name' => 'nip',
                    'type' => 'raw',
                    'value' => '$data->nip',
                    'htmlOptions' => array('style' => 'text-align:left'),
                ),
                'nama',
                'kedudukan',
                array(
                    'name' => 'golongan',
                    'type' => 'raw',
                    'value' => '$data->golongan',
                    'htmlOptions' => array('style' => 'text-align:left'),
                ),
                'jabatan',
                array(
                    'name' => 'eselon',
                    'type' => 'raw',
                    'value' => '$data->eselon',
                    'htmlOptions' => array('style' => 'text-align:left'),
                ),
                array(
                    'name' => 'unitKerja',
                    'type' => 'raw',
                    'value' => '$data->unitKerja',
                    'htmlOptions' => array('style' => 'text-align:left'),
                ),
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


    function validateForm() {
        var x = $(this).value;
        if (x == 0) {
            alert("Name must be filled out");
            return false;
        }
    }
</script>
<style>
    .form-horizontal .control-group{
        margin-bottom: 5px !important;
    }
</style>
