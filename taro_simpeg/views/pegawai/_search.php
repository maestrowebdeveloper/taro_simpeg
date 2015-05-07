<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-pegawai-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>

<table>
    <tr>
        <td style="vertical-align:top">
            <?php
            echo $form->textFieldRow($model, 'nip', array('class' => 'span2 angka', 'style' => 'max-width:500px;width:200px', 'maxlength' => 18));
            echo $form->textFieldRow($model, 'nama', array('class' => 'span3', 'maxlength' => 100));
            ?>                    
            <div class="control-group "><label class="control-label" for="Pegawai_gelar_depan">Gelar</label>
                <div class="controls">
                    <input class="span1" maxlength="25" value="<?php echo $model->gelar_depan; ?>" name="Pegawai[gelar_depan]" id="Pegawai_gelar_depan" placeHolder="Depan" type="text">
                    <input class="span1" maxlength="25" value="<?php echo $model->gelar_belakang; ?>" name="Pegawai[gelar_belakang]" id="Pegawai_gelar_belakang" placeHolder="Belakang" type="text">
                </div>
            </div>
            <?php
            echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin());
//            $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'tempat_lahir', 'cityValue' => $model->tempat_lahir, 'disabled' => false, 'width' => '40%', 'label' => 'Tempat Lahir'));
//            echo $form->datepickerRow(
//                    $model, 'tanggal_lahir', array(
//                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
//                'prepend' => '<i class="icon-calendar"></i>'
//                    )
//            );
//            echo $form->textAreaRow($model, 'alamat', array('rows' => 2, 'cols' => 50, 'class' => 'span3'));
            ?>
        </td>
        <td style="vertical-align:top">
            <?php
//            echo $form->textFieldRow($model, 'kode_pos', array('class' => 'span2', 'style' => 'max-width:500px;width:100px', 'maxlength' => 10));
//            $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'city_id', 'cityValue' => $model->city_id, 'disabled' => false, 'width' => '40%', 'label' => 'Kota'));
            echo $form->textFieldRow($model, 'hp', array('class' => 'span4 angka', 'style' => 'max-width:500px;width:200px', 'maxlength' => 25, 'prepend' => '+62'));

            echo $form->dropDownListRow($model, 'agama', Pegawai::model()->ArrAgama(), array('empty' => '- Agama -'));
//            echo $form->radioButtonListRow($model, 'golongan_darah', Pegawai::model()->ArrGolonganDarah());
            echo $form->radioButtonListRow($model, 'status_pernikahan', Pegawai::model()->arrStatusPernikahan());
//            echo $form->textFieldRow($model, 'npwp', array('class' => 'span3', 'maxlength' => 50));
//            echo $form->textFieldRow($model, 'bpjs', array('class' => 'span3', 'maxlength' => 50));
            ?>                    
        </td>
    </tr>
    <tr>
        <td style="vertical-align:top">
            <?php
            $data = array('0' => '- Kedudukan -') + CHtml::listData(Kedudukan::model()->findAll(), 'id', 'nama');
            echo $form->select2Row($model, 'kedudukan_id', array(
                'asDropDownList' => true,
                'data' => $data,
                'options' => array(
                    "allowClear" => false,
                    'width' => '50%',
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

//            echo $form->datepickerRow(
//                    $model, 'tmt_cpns', array(
//                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
//                'prepend' => '<i class="icon-calendar"></i>'
//                    )
//            );
//
//            echo $form->datepickerRow(
//                    $model, 'tmt_pns', array(
//                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
//                'prepend' => '<i class="icon-calendar"></i>',
//                    )
//            );
            ?>
        </td>
        <td style="vertical-align:top">

            

            <?php echo $form->radioButtonListRow($model, 'tipe_jabatan', Pegawai::model()->arrTipeJabatan()); ?>

            <?php
            $struktural = ($model->tipe_jabatan == "struktural") ? "" : "none";
            $fu = ($model->tipe_jabatan == "fungsional_umum") ? "" : "none";
            $ft = ($model->tipe_jabatan == "fungsional_tertentu") ? "" : "none";
            ?>

            <div class="struktural" style="display:<?php echo $struktural; ?>">              
                <div class="control-group "><label class="control-label" for="Pegawai_jabatan_struktural_id">Jabatan Struktural</label>
                    <div class="controls">
                        <?php
                        $data = array('0' => '- Jabatan Struktural -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'nama')), 'id', 'nama');
                        $this->widget(
                                'bootstrap.widgets.TbSelect2', array(
                            'name' => 'Pegawai[jabatan_struktural_id]',
                            'value' => $model->jabatan_struktural_id,
                            'data' => $data,
                            'options' => array(
                                'width' => '20%;margin:0px;text-align:left',
                        )));
                        echo '&nbsp;&nbsp;';
                        ?>
                        <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                            <?php
                            $this->widget(
                                    'bootstrap.widgets.TbDatePicker', array(
                                'name' => 'Pegawai[tmt_jabatan_struktural]',
                                'value' => isset($_POST['Pegawai']['tmt_jabatan_struktural']) ? $_POST['Pegawai']['tmt_jabatan_struktural'] : "-",
                                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                    )
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fungsional_umum" style="display:<?php echo $fu; ?>">              
                <div class="control-group "><label class="control-label" for="Pegawai_jabatan_fu_id">Fungsional Umum</label>
                    <div class="controls">
                        <?php
                        $data = array('0' => '- Jabatan Fungsional Umum -') + CHtml::listData(JabatanFu::model()->findAll(array('order' => 'nama')), 'id', 'nama');
                        $this->widget(
                                'bootstrap.widgets.TbSelect2', array(
                            'name' => 'Pegawai[jabatan_fu_id]',
                            'value' => $model->jabatan_fu_id,
                            'data' => $data,
                            'options' => array(
                                'width' => '20%;margin:0px;text-align:left',
                        )));
                        echo '&nbsp;&nbsp;';
                        ?>
                        <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                            <?php
                            $this->widget(
                                    'bootstrap.widgets.TbDatePicker', array(
                                'name' => 'Pegawai[tmt_jabatan_fu]',
                                'value' => isset($_POST['Pegawai']['tmt_jabatan_fu']) ? $_POST['Pegawai']['tmt_jabatan_fu'] : "-",
                                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                    )
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fungsional_tertentu" style="display:<?php echo $ft; ?>">              
                <div class="control-group "><label class="control-label" for="Pegawai_jabatan_ft_id">Fungsional Tertentu</label>
                    <div class="controls">
                        <?php
                        $data = array('0' => '- Jabatan Fungsional Tertentu -') + CHtml::listData(JabatanFt::model()->findAll(array('order' => 'nama')), 'id', 'nama');
                        $this->widget(
                                'bootstrap.widgets.TbSelect2', array(
                            'name' => 'Pegawai[jabatan_ft_id]',
                            'data' => $data,
                            'value' => $model->jabatan_ft_id,
                            'options' => array(
                                'width' => '20%;margin:0px;text-align:left',
                        )));
                        echo '&nbsp;&nbsp;';
                        ?>
                        <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                            <?php
                            $this->widget(
                                    'bootstrap.widgets.TbDatePicker', array(
                                'name' => 'Pegawai[tmt_jabatan_ft]',
                                'value' => isset($_POST['Pegawai']['tmt_jabatan_ft']) ? $_POST['Pegawai']['tmt_jabatan_ft'] : "-",
                                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                                    )
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <?php // echo $form->textFieldRow($model, 'gaji', array('class' => 'span5 angka', 'prepend' => 'Rp')); ?>
            <?php
//            echo $form->datepickerRow(
//                    $model, 'tmt_pensiun', array(
//                'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
//                'prepend' => '<i class="icon-calendar"></i>'
//                    )
//            );
            ?>
        </td>
    </tr> 
</table>




<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'button', 'icon' => 'icon-remove-sign white', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function ($) {
        $(".btnreset").click(function () {
            $(":input", "#search-pegawai-form").each(function () {
                var type = this.type;
                var tag = this.tagName.toLowerCase(); // normalize case
                if (type == "text" || type == "password" || tag == "textarea")
                    this.value = "";
                else if (type == "checkbox" || type == "radio")
                    this.checked = false;
                else if (tag == "select")
                    this.selectedIndex = "";
            });
        });
    })
</script>

