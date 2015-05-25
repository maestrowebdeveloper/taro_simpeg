<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-danger">' . $message . "</div>\n";
}
?>
<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'gaji-form',
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

         <br>
        <table class="table table-bordered" id="table-1">
            <thead>
                <tr>
                    <?php
                    $golongan = Golongan::model()->findAll();
                    $jmlGolongan = count($golongan) + 1;
                    echo '<th colspan="' . $jmlGolongan . '">DAFTAR GAJI POKOK PEGAWAI NEGERI SIPIL</th>'
                    ?>
                </tr>
                <tr>
                    <th style="width: 20px;">MKG</th>
                    <?php
                    foreach ($golongan as $val) {
                        echo '<th>' . $val->nama . '</th>';
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < 35; $i++) {
                    echo '<tr>';
                    echo '<td style="text-align:center">' . $i . '</td>';
                    foreach ($golongan as $val) {
                        $gaji = 0;
                        if ($model->isNewRecord == FALSE) {
                            $gajiPegawai = json_decode($model->gaji, true);
                            $gaji = isset($gajiPegawai[$val->id][$i]) ? $gajiPegawai[$val->id][$i] : 0;
                        }
                        echo '<th><input type="text" class="span1 angka" value="' . $gaji . '" name="gaji[' . $val->id . '][' . $i . ']"></th>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php if (!isset($_GET['v'])) { ?>        
            <div class="form-actions">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'submit',
                    'type' => 'primary',
                    'icon' => 'ok white',
                    'label' => $model->isNewRecord ? 'Tambah' : 'Simpan',
                ));
                ?>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType' => 'reset',
                    'icon' => 'remove',
                    'label' => 'Reset',
                ));
                ?>
            </div>
        <?php } ?>    </fieldset>

    <?php $this->endWidget(); ?>

</div>
