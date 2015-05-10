<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-pegawai-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>
<div class="row">
    <div class="span5">
        <?php
        echo $form->textFieldRow($model, 'nip', array('class' => 'span2 angka', 'style' => 'max-width:500px;width:200px', 'maxlength' => 18));
        echo $form->textFieldRow($model, 'nama', array('class' => 'span3', 'maxlength' => 100));
        echo $form->radioButtonListRow($model, 'jenis_kelamin', Pegawai::model()->ArrJenisKelamin());
        ?>
        <div class="control-group ">
            <label class="control-label" for="Pegawai_gelar_depan">Gelar</label>
            <div class="controls">
                <input class="span1" maxlength="25" value="<?php echo $model->gelar_depan; ?>" name="Pegawai[gelar_depan]" id="Pegawai_gelar_depan" placeHolder="Depan" type="text">
                <input class="span1" maxlength="25" value="<?php echo $model->gelar_belakang; ?>" name="Pegawai[gelar_belakang]" id="Pegawai_gelar_belakang" placeHolder="Belakang" type="text">
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label" for="Pegawai_jurusan">Jurusan</label>
            <div class="controls">
                <input class="span3" name="jurusan" id="Pegawai_jurusan" type="text">
            </div>
        </div>
        <?php
        echo $form->textFieldRow($model, 'hp', array('class' => 'span4 angka', 'style' => 'max-width:500px;width:200px', 'maxlength' => 25, 'prepend' => '+62'));
        ?>
    </div>
    <div class="span5">
        <?php
        echo $form->dropDownListRow($model, 'agama', Pegawai::model()->ArrAgama(), array('empty' => '- Agama -'));
        echo $form->radioButtonListRow($model, 'status_pernikahan', Pegawai::model()->arrStatusPernikahan());
        echo $form->dropDownListRow($model, 'tipe_jabatan', Pegawai::model()->arrTipeJabatan(), array('empty' => '- Tipe Jabatan -'));
        ?>
        <div class="control-group ">
            <label class="control-label" for="satuan_kerja">Satuan Kerja</label>
            <div class="controls">
                <?php
                $data = array('0' => '- pilih -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
                $this->widget(
                        'bootstrap.widgets.TbSelect2', array(
                    'name' => 'satuan_kerja',
                    'data' => $data,
                    'options' => array(
                        'width' => '100%',
                    )
                        )
                );
                ?>
            </div>
        </div>
        <div class="control-group ">
            <label class="control-label" for="unit_kerja">Unit Kerja</label>
            <div class="controls">
                <?php
                $data = array('0' => '- pilih -') + CHtml::listData(JabatanStruktural::model()->findAll(array('order' => 'root, lft')), 'id', 'nestedname');
                $this->widget(
                        'bootstrap.widgets.TbSelect2', array(
                    'name' => 'unit_kerja',
                    'data' => $data,
                    'options' => array(
                        'width' => '100%',
                    )
                        )
                );
                ?>
            </div>
        </div>
    </div>
</div>
<script>

function kil() {
       
        var nip = $("#Pegawai_nip").val();
        var nama = $("#Pegawai_nama").val();
        var gelar_dpn = $("#Pegawai_gelar_depan").val();
        var gelar_blk = $("#Pegawai_gelar_belakang").val();
        var hp = $("#Pegawai_hp").val();
        var agama = $("#Pegawai_agama").val();
        var type_jabatan = $("#Pegawai_tipe_jabatan").val();
        var unit_kerja = $("#unit_kerja").val();
        var Pegawai_tipe_jabatan = $("#Pegawai_tipe_jabatan").val();
        var jns_kelamin = $('input:radio[name="Pegawai[jenis_kelamin]"]').val();
        var sts_pernikahan = $('input:radio[name="Pegawai[status_pernikahan]"]').val();
        
//        if (data != "") {
           window.open("<?php echo url('pegawai/generateExcel') ?>?nip="+nip+"&nama="+nama+"&gelar_dpn="+gelar_dpn+"&gelar_blk="+gelar_blk+"&hp="+hp+"&agama="+agama+"&type_jabatan="+type_jabatan+"&unit_kerja="+unit_kerja+"&Pegawai_tipe_jabatan="+Pegawai_tipe_jabatan+"&jns_kelamin="+jns_kelamin+"&sts_pernikahan="+sts_pernikahan);
//        } 
    }
    </script>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>

   <?php
    $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'icon', 'label' => 'Export Excel', 
        'htmlOptions' => array(
            'onclick' => 'kil()'
    )));
    ?>
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

