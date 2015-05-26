<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-permohonan-ijin-belajar-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>

<?php echo $form->textFieldRow($model, 'nomor_register', array('class' => 'span5', 'maxlength' => 225)); ?>

<?php
echo $form->datepickerRow(
        $model, 'tanggal', array(
    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
    'prepend' => '<i class="icon-calendar"></i>'
        )
);

$idpegawai = isset($model->pegawai_id) ? $model->pegawai_id : 0;
        $pegawaiName = isset($model->Pegawai->nama) ? $model->Pegawai->nama : '';
        echo $form->select2Row($model, 'pegawai_id', array(
            'asDropDownList' => false,
//                    'data' => $data,
//                    'value' => $model->Pegawai->nama,
            'options' => array(
                'placeholder' => t('choose', 'global'),
                'allowClear' => true,
                'width' => '400px',
                'minimumInputLength' => '3',
                'ajax' => array(
                    'url' => Yii::app()->createUrl('pegawai/getListPegawai'),
                    'dataType' => 'json',
                    'data' => 'js:function(term, page) { 
                                                        return {
                                                            q: term 
                                                        }; 
                                                    }',
                    'results' => 'js:function(data) { 
                                                        return {
                                                            results: data
                                                            
                                                        };
                                                    }',
                ),
                'initSelection' => 'js:function(element, callback) 
                            { 
                               callback({id: '.$idpegawai.', text: "'.$pegawaiName.'" });
                            
                                  
                            }',
            ),
                )
        );
        

echo $form->radioButtonListRow($model, 'jenjang_pendidikan', Pegawai::model()->ArrJenjangPendidikan());
?>



<?php // echo $form->textFieldRow($model, 'jurusan', array('class' => 'span5', 'maxlength' => 225)); ?>

<?php // echo $form->textFieldRow($model, 'nama_sekolah', array('class' => 'span5', 'maxlength' => 225)); ?>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'icon', 'label' => 'Export Excel',
        'htmlOptions' => array(
            'onclick' => 'excel()'
    )));
    ?>
<?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'button', 'icon' => 'icon-remove-sign white', 'label' => 'Reset', 'htmlOptions' => array('class' => 'btnreset btn-small'))); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    jQuery(function ($) {
        $(".btnreset").click(function () {
            $(":input", "#search-permohonan-ijin-belajar-form").each(function () {
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
<script type="text/javascript">
    function excel(){
        
        if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_0').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_0').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_1').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_1').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_2').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_2').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_3').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_3').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_4').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_4').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_5').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_5').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_6').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_6').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_7').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_7').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_8').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_8').value;
        }else if (document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_9').checked) {
            var jenjang_pendidikan = document.getElementById('PermohonanIjinBelajar_jenjang_pendidikan_9').value;
        }else{
            var jenjang_pendidikan = '';
        }
        
        var nomor_register = $('#PermohonanIjinBelajar_nomor_register').val();
        var pegawai_id = $('#PermohonanIjinBelajar_pegawai_id').val();
        var tanggal = $('#PermohonanIjinBelajar_tanggal').val();
        var jurusan = $('#PermohonanIjinBelajar_jurusan').val();
        var nama_sekolah = $('#PermohonanIjinBelajar_nama_sekolah').val();
        
        window.open("<?php echo url('permohonanIjinBelajar/GenerateExcel') ?>?pegawai_id="+pegawai_id+"&jenjang_pendidikan="+jenjang_pendidikan+"&nomor_register=" + nomor_register + "&tanggal=" + tanggal + "&jurusan=" + jurusan + "&nama_sekolah=" + nama_sekolah);
    
    }
</script>
