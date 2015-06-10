<?php
$this->setPageTitle('Kenaikan Gaji Berkala');
$this->breadcrumbs=array(
	'Kenaikan Gaji Berkala'=>array('index'),
);

?>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>