<?php
$this->setPageTitle('Kenaikan Gajis');
$this->breadcrumbs=array(
	'Kenaikan Gajis',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('kenaikan-gaji-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
//		array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
	),
));
$this->endWidget();
?>



<!--<div class="search-form" style="display:none">-->
<?php
//$this->renderPartial('_search',array(
//	'model'=>$model,
//)); 
?>
<!--</div> search-form -->
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

<script>
    function hide() {
        $(".well").hide();
        $(".form-horizontal").hide();
    }

</script>
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
                    <button class="btn btn-primary" id="viewPegawai" type="button" name="yt0" ><i class="icon-ok icon-white"></i> View Pegawai</button>
                </div>
        </div>
        <div id="listPegawai"></div>
    </div>
    <div class="span1"><?php if (!empty($model->id)) { ?>
            <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>
        <?php } ?>
    </div>

</div>


<?php $this->endWidget(); ?>



<style>
    .form-horizontal .control-group{
        margin-bottom: 5px !important;
    }
</style>


<?php
//$this->widget('bootstrap.widgets.TbGridView',array(
//	'id'=>'kenaikan-gaji-grid',
//	'dataProvider'=>$model->search(),
//        'type'=>'striped bordered condensed',
//        'template'=>'{summary}{pager}{items}{pager}',
//	'columns'=>array(
//		'id',
//		'pegawai_id',
//		'nomor_register',
//		'sifat',
//		'perihal',
//		'gaji_pokok_lama',
//		/*
//		'gaji_pokok_baru',
//		'pejabat',
//		'tanggal',
//		'tmt',
//		'created',
//		'created_user_id',
//		*/
//       array(
//            'class'=>'bootstrap.widgets.TbButtonColumn',
//			'template' => '{view} {update} {delete}',
//			'buttons' => array(
//			      'view' => array(
//					'label'=> 'Lihat',
//					'options'=>array(
//						'class'=>'btn btn-small view'
//					)
//				),	
//                              'update' => array(
//					'label'=> 'Edit',
//					'options'=>array(
//						'class'=>'btn btn-small update'
//					)
//				),
//				'delete' => array(
//					'label'=> 'Hapus',
//					'options'=>array(
//						'class'=>'btn btn-small delete'
//					)
//				)
//			),
//            'htmlOptions'=>array('style'=>'width: 125px'),
//           )
//	),
//)); 
?>

<script>
    $("#viewPegawai").click(function() {
        var bulan = $("#bulan").val();
        var tahun = $("#tahun").val();
        $.ajax({
            url: "<?php echo url('kenaikanGaji/getPegawai'); ?>",
            data: "bulan=" + bulan + "&tahun=" + tahun,
            type: "post",
            success: function(data) {
                $("#listPegawai").html(data);
            }
        });
    });
</script>