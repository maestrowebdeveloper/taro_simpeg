<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'kenaikan-gaji-form',
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
                    </div>
                </div>
                <div id="listPegawai"></div>
            </div>
        </div>


        <?php if (!isset($_GET['v']) and isset($_POST['bulan'])) { ?>        <div class="form-actions">
                <?php
//                $this->widget('bootstrap.widgets.TbButton', array(
//                    'buttonType' => 'submit',
//                    'type' => 'primary',
//                    'icon' => 'ok white',
//                    'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
//                ));
                ?>
                <?php
//                $this->widget('bootstrap.widgets.TbButton', array(
//                    'buttonType' => 'reset',
//                    'icon' => 'remove',
//                    'label' => 'Reset',
//                ));
                ?>
            </div>
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>
<script>
    $("#viewPegawai").click(function() {
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();
        $.ajax({
            url: "<?php echo url('kenaikanGaji/getListPegawai'); ?>",
            data: "bulan=" + bulan + "&tahun=" + tahun,
            type: "post",
            success: function(data) {
                $("#listPegawai").html(data);
            }
        });
    });
</script>