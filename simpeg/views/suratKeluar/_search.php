<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-surat-keluar-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
        ));
?>


<?php
echo $form->textFieldRow($model, 'no_agenda', array('class' => 'span3', 'maxlength' => 225));
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
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'button',
        'type' => 'primary',
        'icon' => 'ok white',
        'label' => 'Export ke Excel',
        'htmlOptions' => array(
            'name' => 'export',
            'onClick' => 'chgAction()',
        )
    ));
    ?>  
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    
     function chgAction()
    {
        document.getElementById("search-surat-keluar-form").action = "<?php echo Yii::app()->createUrl('suratKeluar/GenerateExcel'); ?>";
        document.getElementById("search-surat-keluar-form").submit();

    }
</script>


