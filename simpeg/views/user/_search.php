<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'search-User-form',
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>


<div class="row">   
    <div class="span4">
        <?php echo $form->textFieldRow($model, 'code', array('class' => 'span4', 'maxlength' => 255)); ?>
        <?php echo $form->textFieldRow($model, 'name', array('class' => 'span4', 'maxlength' => 255)); ?>
        <?php // echo $form->textFieldRow($model,'city_id',array('class'=>'span4'));  ?>
        <!--  <div class="control-group ">
             <label>Province</label>
             <div class="controls">
      
        <?php
        $id_city = '';
        $id_city = (!empty($model->city_id)) ? $model->city_id : 0;
        $city = !empty($model->City->name) ? $model->City->Province->name . ' - ' . $model->City->name : 0;

        echo $form->select2Row($model, 'city_id', array(
            'asDropDownList' => false,
            'options' => array(
                'placeholder' => t('choose', 'global'),
                'allowClear' => true,
                'width' => '400px',
                'minimumInputLength' => '3',
                'ajax' => array(
                    'url' => Yii::app()->createUrl('city/getListKota'),
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
                            callback({id: ' . $id_city . ', text: "' . $city . '" });
                             
                                  
                            }',
            ),
                )
        );
        ?>
        
            
        <?php // echo $form->dropDownListRow($model, 'city_id', array(), array('class' => 'span3')); ?> -->
        <?php // $this->widget('common.extensions.landa.widgets.LandaProvinceCity', array('name' => 'city_id', 'provinceValue' => 1, 'cityValue' => 1, 'disabled' => false, 'width' => '100%')); ?>                  
    </div>

    <?php
    $array = User::model()->listUsers($type);
    $data = (!empty($array)) ? CHtml::listData($array, 'id', 'name') : array();
    ?>

    <div class="span4" style="padding-left: 90px;">
        <?php // echo $form->dropDownListRow($model, 'roles_id', $data, array('class' => 'span4', 'empty' => t('choose', 'global'),)); ?>
        <?php echo $form->textFieldRow($model, 'email', array('class' => 'span4', 'maxlength' => 100)); ?>
        <?php
        echo $form->textFieldRow(
                $model, 'phone', array('prepend' => '+62')
        );
        ?>
    </div>
</div>


<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'search white', 'label' => 'Pencarian')); ?>

    <?php
    $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'icon', 'label' => 'Export Excel',
        'htmlOptions' => array(
            'onclick' => 'excel()'
    )));
    ?>
</div>

<?php $this->endWidget(); ?>


<?php
$cs = Yii::app()->getClientScript();
$cs->registerCoreScript('jquery');
$cs->registerCoreScript('jquery.ui');
$cs->registerCssFile(Yii::app()->request->baseUrl . '/css/bootstrap/jquery-ui.css');
?>	
<script>
    

    function excel() {
        var code = $('#User_code').val();
        var name = $('#User_name').val();
        var city_id = $('#city_id').val();
        var email = $('#User_email').val();
        var phone = $('#User_phone').val();
        window.open("<?php echo url('user/GenerateExcel') ?>?code=" + code + "&city_id=" + city_id + "&name=" + name + "&email=" + email + "&phone=" + phone);
    }
</script>

