<?php
$this->setPageTitle('Lihat Tickets | ID : ' . $model->id);
$this->breadcrumbs = array(
    'Tickets' => array('index'),
    $model->id,
);
?>

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array()),
        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
        array('label' => 'Edit', 'icon' => 'icon-edit', 'url' => Yii::app()->controller->createUrl('update', array('id' => $model->id)), 'linkOptions' => array()),
        //array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
        array('label' => 'Print', 'icon' => 'icon-print', 'url' => 'javascript:void(0);return false', 'linkOptions' => array('onclick' => 'printDiv();return false;')),
)));
$this->endWidget();
?>

<div id="history">
    <div id="historyContent">
        <div class="box">
            <div class="title">
                <h4>
                    <span class="icon-envelope"></span>
                    <span>Detail Pesan</span>
                    <span class="box-form right">
                        <a class="btn btn-mini dropdown-toggle" data-toggle="dropdown" href="#">
                            <span class="icon16 iconic-icon-cog"></span>
                            <span class="caret"></span>
                        </a>
                        <!--                        <div class="btn-group">
                                                    <a class="btn btn-mini" id="btnBack" href="#"><i class="icon-circle-arrow-left"></i></a>
                                                    <a class="btn btn-mini" id="btnTrash" href="#"><i class="icon-trash"></i></a>
                                                </div>-->
                    </span>
                </h4>
            </div>
            <div class="content noPad">
                <ul class="messages">
                    <li class="sendMsg">
                        <?php
                        $modelTicketDetail->ticket_id = $model->id;
   

                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'ticket-detail-form',
                            'enableAjaxValidation' => false,
                            'method' => 'post',
                            'type' => 'horizontal',
                            'htmlOptions' => array(
                                'enctype' => 'multipart/form-data'
                            )
                        ));
                        ?>
                        <?php echo $form->markdownEditorRow($modelTicketDetail, 'message', array("placeholder" => "Your text ...", 'height' => '80px', 'label' => false,)); ?>
                        <?php echo $form->hiddenField($modelTicketDetail, 'ticket_id'); ?>
                        <div class="row-fluid marginT10">
                            <?php
                            echo CHtml::ajaxButton(
                                'Send Message', url('landa/ticketDetail/createDetail'), array(
                                'type' => 'POST',
                                'success' => 'function( data )
                                        {
                                          $(".nextMessage").replaceWith(data);
                                        }',
                                    ), array('class' => 'btn btn-primary')
                            ); 
                            ?>
                            <span class="help-inline" id="infoMess"></span>
                        </div>
                        <?php $this->endWidget() ?>
                    </li>
                    <?php
                    $criteria = new CDbCriteria;
                    $criteria->addCondition('ticket_id=' . $model->id);
                    $total = TicketDetail::model()->count();

                    $pages = new CPagination($total);
                    $pages->pageSize = 10;
                    $pages->applyLimit($criteria);

                    $ticketDetail= TicketDetail::model()->findAll($criteria);

                    echo $this->renderPartial('_viewDetail', array('model' => $model, 'ticketDetails' => $ticketDetail, 'pages' => $pages));
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>

