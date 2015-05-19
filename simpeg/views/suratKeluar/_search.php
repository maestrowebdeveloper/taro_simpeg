<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-surat-keluar-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>


<?php
echo $form->textFieldRow($model, 'penerima', array('class' => 'span4', 'maxlength' => 225));
echo $form->datepickerRow(
        $model, 'tanggal_kirim', array(
    'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
    'prepend' => '<i class="icon-calendar"></i>'
        )
);

echo $form->radioButtonListRow($model, 'sifat', SuratMasuk::model()->ArrSifat());

echo $form->textFieldRow($model, 'nomor_surat', array('class' => 'span4', 'maxlength' => 225));

echo $form->textFieldRow($model, 'perihal', array('class' => 'span4', 'maxlength' => 225));
?>

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
            $(":input", "#search-surat-keluar-form").each(function () {
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
    
    function excel(){
        if (document.getElementById('SuratKeluar_sifat_0').checked) {
            var sifat = document.getElementById('SuratKeluar_sifat_0').value;
        }
        if (document.getElementById('SuratKeluar_sifat_1').checked) {
            var sifat = document.getElementById('SuratKeluar_sifat_1').value;
        }
        if (document.getElementById('SuratKeluar_sifat_2').checked) {
            var sifat = document.getElementById('SuratKeluar_sifat_2').value;
        }else{
            var sifat = '';
        }
        var SuratKeluar_penerima = $('#SuratKeluar_penerima').val();
        var SuratKeluar_tanggal_kirim = $('#SuratKeluar_tanggal_kirim').val();
        var SuratKeluar_nomor_surat = $('#SuratKeluar_nomor_surat').val();
        var SuratKeluar_perihal = $('#SuratKeluar_perihal').val();
        
        
        window.open("<?php echo url('suratKeluar/GenerateExcel') ?>?SuratKeluar_penerima="+SuratKeluar_penerima+"&SuratKeluar_tanggal_kirim="+SuratKeluar_tanggal_kirim+"&SuratKeluar_nomor_surat="+SuratKeluar_nomor_surat+"&SuratKeluar_perihal="+SuratKeluar_perihal+"&sifat="+sifat)
    }
</script>

