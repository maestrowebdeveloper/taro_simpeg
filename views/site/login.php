<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>


<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
        'type'=>'horizontal',
    ),
        ));
?>


<div class="container-fluid">
    <div class="newLogin">        
        <form class="form-horizontal" action="dashboard.html" />
        <h1 style="margin:0px">SELAMAT DATANG DI SIMPEG</h1>
        <span class="green">Sistem Informasi Pegawai | Kabupaten Sampang</span>
        <hr style="margin:10px 0px 20px 0px">
       
       <div class="form-row row-fluid">   
            <div class="span8"> 
               <div class="form-row row-fluid">
                    <div class="span12">            
                        <div class="row-fluid">
                            <div class="span4">Username</div>
                            <div class="span8">
                                <?php echo $form->textField($model, 'username', array('class'=>'span12')); ?>
                                <span class="red"><?php echo $form->error($model, 'username'); ?></span>
                            </div>                   
                        </div>
                    </div>
                </div>


                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="span4">Password</div>
                            <div class="span8">
                                <?php echo $form->passwordField($model, 'password' , array('class'=>'span12')); ?>
                                <span class="red"><?php echo $form->error($model, 'password'); ?></span>    
                            </div>             
                        </div>                
                    </div>
                </div>
            </div>  
            <div class="span4">
                <img style="margin:-15px 40px 0px 40px;height:140px" src="<?php echo bt() ?>/images/logo.png" />
            </div>
        </div>
 
    
        <div class="form-row row-fluid">                       
            <div class="span12">
                <div class="row-fluid">
                    <div class="form-actions" style="margin:0px -20px">
                        <div class="span12 controls" style="padding:0px 20px">
                            <?php echo $form->checkBox($model, 'rememberMe', array('class'=>'left', 'style'=>'width:20px')); ?> Keep me login in
                            <button type="submit" style="background:forestgreen" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Login</button>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 

        </form>
    </div>

</div><!-- End .container-fluid -->

<?php $this->endWidget(); ?>
<style>
.newLogin{
    left:50%;
    top:50%;
    width:600px;
    height:auto;
    position:absolute;
    margin-top:-200px;
    margin-left:-320px;
    padding:0px 20px;
    border:1px solid forestgreen;
    box-shadow:0px 0px 1px 1px rgba(0, 0, 0, 0.1);
    border-radius:2px;
    background:white
}
</style>