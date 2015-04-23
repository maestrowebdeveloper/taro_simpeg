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
                <select name='bulan'>
                    <option value=0> Select Month</option>
                    <?php
                    $month = landa()->monthly();
                    foreach ($month as $key => $val) {
                        $status = '';
                        if (isset($_POST['bulan']) and $_POST['bulan'] == $key) {
                            $status = 'selected="selected"';
                        }
                        echo '<option value="' . $key . '" ' . $status . '>' . $val . '</option>';
                    }
                    ?>
                </select> - 
                <select Name='tahun'>
                    <option value="0">Select Year</option>
                    <?php
                    $th = date('Y');
                    for ($x = ($th - 5); $x <= ($th + 5); $x++) {
                        $status = '';
                        if (isset($_POST['tahun']) and $_POST['tahun'] == $x) {
                            $status = 'selected="selected"';
                        }
                        echo'<option value="' . $x . '" '.$status.'>' . $x . '</option>';
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
                    <option value="58" <?php if(isset($_POST['bup']) and $_POST['bup'] == "58") { echo 'selected="selected"';}?>> 58</option>
                    <option value="60" <?php if(isset($_POST['bup']) and $_POST['bup'] == "60") { echo 'selected="selected"';}?>> 60</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Unit Kerja<span class="required">*</span></label>
            <div class="controls">
                <?php
                $data = array('0' => '- Select All -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                $this->widget(
                        'bootstrap.widgets.TbSelect2', array(
                    'name' => 'satuan_kerja_id',
                    'data' => $data,
                    'value' => isset($_POST['satuan_kerja_id']) ? $_POST['satuan_kerja_id'] : '',
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
                $data = array('0' => '- Eselon -') + CHtml::listData(Eselon::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
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
    <div class="span1"><?php if (!empty($model->id)) { ?>
            <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>
        <?php } ?>
    </div>

</div>
<div class="form-actions">
    <button class="btn btn-primary" id="yw2" type="submit" name="yt0" onclick="return validat()"><i class="icon-ok icon-white"></i> View Report</button>
</div>

<?php $this->endWidget(); ?>


<?php
if (isset($_POST['yt0'])) {
    $this->renderPartial('_pensiun', array('model' => $model));
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
