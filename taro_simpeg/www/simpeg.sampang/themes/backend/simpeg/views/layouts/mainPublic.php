<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="author" content="Landa - Profesional Website Development" />
        <meta name="application-name" content="Application Default" />
        <link rel="shortcut icon" href="<?php echo bt() ?>/images/favicon.ico" />

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?php
        $cs = Yii::app()->getClientScript();
        $cs->registerCoreScript('jquery');
        $cs->registerCssFile(bt() . '/css/main.css');
        $cs->registerCssFile(bt() . '/css/icons.css');
        ?>     

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-57-precomposed.png" />

        <script type="text/javascript">
            //adding load class to body and hide page
            document.documentElement.className += 'loadstate';
        </script>
    </head>
    <body>
        <!-- loading animation -->
        <div id="qLoverlay"></div>
        <div id="qLbar"></div>

        <div id="wrapper">

            <!--Responsive navigation button-->  
            <div class="resBtn">
                <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
            </div>


            <!--Body content-->
            <div id="content" class="clearfix" style="margin-left: 0 !important;padding-top: 0px">
                <div class="contentwrapper"><!--Content wrapper-->
                    <div class="heading" style="margin-bottom: 10px">
                        <h3>
                            <?php
                            $siteConfig = SiteConfig::model()->listSiteConfig();
                            echo $siteConfig->client_name;
                            ?>
                        </h3>                    



                        <?php if (isset($this->breadcrumbs)): ?>
                            <?php
                            $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links' => $this->breadcrumbs,
                                'htmlOptions' => array('class' => 'breadcrumb'),
                                'separator' => '<span class="divider"><span class="icon16 icomoon-icon-arrow-right"></span></span>',
                                'homeLink' => '<a href="/site/index" class="tip" title="back to dashboard"><span class="icon16 icomoon-icon-screen"></span></a>'
                            ));
                            ?><!-- breadcrumbs -->
                        <?php endif ?>

                    </div><!-- End .heading-->
                    <!--  <div class="well well-small">
                        <ul class="bigBtnIcon">
                            <li>
                                
                                <a href="<?php echo url('manufacturing') ?>" <?php if ($_SERVER['REQUEST_URI']==url('manufacturing')) echo 'style="background: lightblue"'; ?>>
                                    <span class="icon entypo-icon-home"></span>
                                    <span class="txt">Dashboard - Halaman Depan</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('manufacturing/workorderDetSplit') ?>" <?php if ($_SERVER['REQUEST_URI']==url('manufacturing/workorderDetSplit')) echo 'style="background: lightblue"'; ?>>
                                    <span class="icon brocco-icon-cart"></span>
                                    <span class="txt">Daftar Nomor Potong</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('manufacturing/workorderProcess') ?>" <?php if ($_SERVER['REQUEST_URI']==url('manufacturing/workorderProcess')) echo 'style="background: lightblue"'; ?>>
                                    <span class="icon entypo-icon-users"></span>
                                    <span class="txt">Serah Terima Nomor Potong</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('manufacturing/saleryReport') ?>" class="pattern" <?php if ($_SERVER['REQUEST_URI']==url('manufacturing/saleryReport')) echo 'style="background: lightblue"'; ?>>
                                    <span class="icon silk-icon-calculator"></span>
                                    <span class="txt">Laporan Gaji yang Diperoleh</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo url('manufacturing/employment') ?>" class="pattern" <?php if ($_SERVER['REQUEST_URI']==url('manufacturing/employment')) echo 'style="background: lightblue"'; ?>>
                                    <span class="icon iconic-icon-key-stroke"></span>
                                    <span class="txt">Ganti Profil / Password</span>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                    <!--Build page from here: -->
                    <?php echo $content; ?>
                    <!-- End Build page -->
                </div><!-- End contentwrapper -->
                <div id="footer" class="span12">
                    <?php echo app()->name . ' ' . param('appVersion') ?> ©  2013 All Rights Reserved. Designed and Developed by : <a href="http://www.landa.co.id" target="_blank">Landa Systems</a>
                </div>
            </div>
            <!-- End #content -->
        </div><!-- End #wrapper -->
        <?php
        $cs->registerScriptFile(bt() . '/js/main.js', CClientScript::POS_END);
        ?>
    </body>
</html>
