<?php
$this->setPageTitle('Lihat User Messages | ID : ' . $model->id);
$this->breadcrumbs = array(
    'User Messages' => array('index'),
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
        array('label' => 'Create', 'icon' => 'icon-plus', 'url' => url('userMessageDetail/create'), 'linkOptions' => array()),
        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'linkOptions' => array()),
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
                        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                            'id' => 'user-message-form',
                            'enableAjaxValidation' => false,
                            'method' => 'post',
                            'type' => 'horizontal',
                            'htmlOptions' => array(
                                'enctype' => 'multipart/form-data'
                            )
                        ));
                        ?>
                        <?php echo $form->markdownEditorRow($userMessageDetail, 'message', array("placeholder" => "Your text ...", 'height' => '80px', 'label' => false,)); ?>

                        <?php echo CHtml::hiddenField('user_id_opp', $model->user_id_opp); ?>
                        <div class="row-fluid marginT10">
                            <?php
                            echo CHtml::ajaxButton(
                                    'Send Message', url('userMessageDetail/createDetail'), array(
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
                        $criteria->addCondition('user_message_id=' . $model->id);
                        $criteria->order = 'created DESC';
                        $total = UserMessageDetail::model()->count();

                        $pages = new CPagination($total);
                        $pages->pageSize = 10;
                        $pages->applyLimit($criteria);

                        $userMessageDetails = UserMessageDetail::model()->findAll($criteria);

                        echo $this->renderPartial('_viewDetail', array('model' => $model, 'userMessageDetails' => $userMessageDetails, 'pages' => $pages));
                        ?>
                </ul>
            </div>
        </div>
    </div>
</div>

