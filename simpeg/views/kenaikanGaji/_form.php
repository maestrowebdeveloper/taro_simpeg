<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'kenaikan-gaji-form',
        'action' => Yii::app()->createUrl($this->route),
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
        <div class="well">
            <div class="row-fluid">
                <div class="control-group">
                    <label class="control-label">Satuan Kerja</label>
                    <div class="controls">
                        <?php
                        $data = array('0' => '- Satuan Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
                        $this->widget(
                                'bootstrap.widgets.TbSelect2', array(
                            'name' => 'unit_kerja',
                            'data' => $data,
                            'value' => isset($_POST['unit_kerja']) ? $_POST['unit_kerja'] : '',
                            'options' => array(
                                'width' => '38%;margin:0px;text-align:left',
                        )));
                        ?>                 
                    </div>
                </div>
                <div class="control-group ">
                    <label class="control-label" for="Pegawai_jabatan_id">Bulan / Tahun</label>
                    <div class="controls">
                        <select name='bulan' id="bulan">
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
                        <select Name='tahun' id="tahun">
                            <option value="0">Select Year</option>
                            <?php
                            $th = date('Y');
                            for ($x = ($th - 5); $x <= ($th + 5); $x++) {
                                $status = '';
                                if (isset($_POST['tahun']) and $_POST['tahun'] == $x) {
                                    $status = 'selected="selected"';
                                }
                                echo'<option value="' . $x . '" ' . $status . '>' . $x . '</option>';
                            }
                            ?> 
                        </select> &nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary" id="viewPegawai" type="button" name="yt0" onclick="return validat()"><i class="icon-ok icon-white"></i> View Pegawai</button>
                        <button class="btn btn-primary export" id="export" type="button" name="yt0" onclick="chgAction()"><i class="icon-ok icon-print"></i> Export</button>
                    </div>
                </div>
                <div id="listPegawai">
                    <?php
                    if (isset($_POST['dibayar'])) {
                        $unit = '';
                        if (!empty($_POST['unit_kerja']))
                            $unit = ' AND JabatanStruktural.unit_kerja_id = ' . $_POST['unit_kerja'];

                        if (!empty($_POST['bulan']) and !empty($_POST['tahun'])) {
                            $bulan = substr("0" . $_POST['bulan'], -2, 2);
                            $model = new KenaikanGaji;
                            $query = $model->search();
//                            $query = Pegawai::model()->with('Pangkat', 'JabatanStruktural')->findAll(array('condition' => 't.kedudukan_id = 1' . $unit, 'order' => 'Pangkat.golongan_id ASC'));
                            $this->renderPartial('/kenaikanGaji/_tableListPegawai', array('query' => $query, 'bulan' => $bulan, 'tahun' => $_POST['tahun']));
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="well">
            Keterangan :
            <ul>
                <li><span class="label label-success">Hijau</span> : Di Update</li>
                <li><span class="label">Abu-abu</span>: Belum di Update</li>
            </ul>
        </div>
    </fieldset>

    <?php $this->endWidget(); ?>

</div>
<script>
    $("#viewPegawai").click(function() {
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();
        var unit_kerja = $("#unit_kerja").val();
        $.ajax({
            url: "<?php echo url('kenaikanGaji/getListPegawai'); ?>",
            data: "bulan=" + bulan + "&tahun=" + tahun + "&unit_kerja=" + unit_kerja,
            type: "post",
            success: function(data) {
                $("#listPegawai").html(data);
            }
        });
    });
    function chgAction()
    {
        document.getElementById("kenaikan-gaji-form").action = "<?php echo Yii::app()->createUrl('kenaikanGaji/exportExcel'); ?>";
        document.getElementById("kenaikan-gaji-form").submit();

    }
    function save()
    {
        document.getElementById("kenaikan-gaji-form").action = "<?php echo Yii::app()->createUrl($this->route); ?>";
        document.getElementById("kenaikan-gaji-form").submit();

    }
</script>