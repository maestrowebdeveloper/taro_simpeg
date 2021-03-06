<style>
    .box{
        min-height: initial !important;
    }
</style>
<div class="form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'User-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));

    $cmp = (!empty($model->others)) ? json_decode($model->others, true) : array();
    $company = (!empty($cmp['company'])) ? $cmp['company'] : '';
    ?>
    <fieldset>
        <legend>
            <p class="note">Fields dengan <span class="required">*</span> harus di isi.</p>
        </legend>

        <?php echo $form->errorSummary($model, 'Opps!!!', null, array('class' => 'alert alert-error span12')); ?>
        <div class="clearfix"></div>

        <div class="box" >
            <div class="title">
                <h4>
                    <?php
                    echo 'Hak Akses Sebagai<span class="required">*</span> :    ';
                    if ($model->id == User()->id) { //if same id, cannot change role it self
                        $listRoles = Roles::model()->listRoles();
                        if (User()->roles_id == -1) {
                            echo 'Super User';
                        } elseif (isset($listRoles[User()->roles_id])) {
                            echo $listRoles[User()->roles_id]['name'];
                        }
                    } else {
                        $array = Roles::model()->listRole($type);
                        if (!empty($array)) {
                            echo CHtml::dropDownList('User[roles_id]', $model->roles_id, CHtml::listData($array, 'id', 'name'), array(
                                /* 'empty' => t('choose', 'global'), */
                                'ajax' => array('url' => url('user/AllowLogin'),
                                    'type' => 'POST',
                                    'success' => 'function(data){
                                            if (data=="0")
                                                $(".notAllow").fadeOut();
                                            else
                                                $(".notAllow").fadeIn();                                                                                        
                                        }'),
                            ));
                        } else {
                            echo'Data is empty please insert data group ' . $type . '.';
                        }
                    }
                    ?> 
                </h4>
            </div>
        </div>

        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#personal">Personal</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="personal">

                <table>
                    <tr>
                        <td style="vertical-align: top;">                                
                            <h3 style="text-align:center; border-bottom: solid 1px #ccc">Informasi Login</h3>
                                     <?php echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 20)); ?>



                                <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'span3', 'maxlength' => 255, 'hint' => 'Fill the password, to change',)); ?>
                                                       
                            <?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 100)); ?>
                            <?php echo $form->textFieldRow($model, 'code', array('class' => 'span5', 'maxlength' => 25)); ?>
                            <h3 style="text-align:center; border-bottom: solid 1px #ccc">Informasi User</h3>
                            <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 255)); ?>                           

                            <?php echo $form->toggleButtonRow($model, 'enabled'); ?>
                            <?php
                            echo $form->textFieldRow(
                                    $model, 'phone', array('prepend' => '+62')
                            );
                            ?>
                            <?php
                            echo $form->dropDownListRow(
                                    $model, 'sex', array('m' => 'Male', 'f' => 'Female')
                            );
                            ?>
                            <?php
                            echo $form->datepickerRow(
                                    $model, 'birth', array(
                                'options' => array('language' => 'en', 'format' => 'yyyy-mm-dd'),
                                'prepend' => '<i class="icon-calendar"></i>'
                                    )
                            );
                            ?>
                            <?php
                            echo $form->textAreaRow(
                                    $model, 'description', array('class' => 'span4', 'rows' => 5)
                            );
                            ?>
                            <?php // echo $form->textFieldRow($model, 'nationality', array('class' => 'span5', 'maxlength' => 30)); ?>

                            <!-- <div class="control-group ">
                            <?php
                            echo CHtml::activeLabel($model, 'province_id', array('class' => 'control-label'));
                            ?>
                                <div class="controls">
                            <?php
                            $prov_id = (isset($model->City->province_id)) ? $model->City->province_id : 0;
                            echo CHtml::dropDownList('province_id', $prov_id, CHtml::listData(Province::model()->findAll(), 'id', 'name'), array(
                                'empty' => t('choose', 'global'),
                                'ajax' => array(
                                    'type' => 'POST',
                                    'url' => CController::createUrl('landa/city/dynacities'),
                                    'update' => '#User_city_id',
                                ),
                            ));
                            ?>  
                                </div>
                            </div> -->




                            <?php $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'city_id', 'cityValue' => $model->city_id, 'disabled' => false, 'width' => '80%', 'label' => 'Kota')); ?>
                            <?php echo $form->textAreaRow($model, 'address', array('class' => 'span5', 'maxlength' => 255)); ?>
                            <hr/>
                             <?php
//                          $imgs = '';
                            $cc = '';
                            if ($model->isNewRecord) {
                                $img = Yii::app()->landa->urlImg('', '', '');
                            } else {
                                $img = Yii::app()->landa->urlImg('avatar/', $model->avatar_img, $_GET['id']);
                                $del = '<div class="btn-group photo-det-btn">';
                                $imgs = param('urlImg') . '150x150-noimage.jpg';
                                $cc = CHtml::ajaxLink(
                                                '<i class="icon-trash"></i>', url('user/removephoto', array('id' => $model->id)), array(
                                            'type' => 'POST',
                                            'success' => 'function( data )
                                                    {
                                                           $("#my_image").attr("src","' . $imgs . '");
                                                           $("#yt0").fadeOut();
                                                    }'), array('class' => 'btn btn-large btn-block btn-primary', 'style' => 'width: 360px;font-size: 15px;')
                                        )
                                        . '</div>';
                            }
                            echo '<img src="' . $model->imgUrl . '" alt="" class="image img-polaroid" id="my_image"  /><br><br> ';
                            echo $cc;
                            ?>
                            <div style="margin-left: -90px;"> <?php echo $form->fileFieldRow($model, 'avatar_img', array('class' => '')); ?></div>


                        </td>

                    </tr>
                </table>

            </div> 


        </div>
</div>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'ok white',
        'label' => $model->isNewRecord ? 'Create' : 'Simpan',
    ));
    ?>
</div>
</fieldset>

<?php $this->endWidget(); ?>

</div>
