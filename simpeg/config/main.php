<?php
Yii::setPathOfAlias('', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Sistem Informasi Pegawai',
    'language' => 'en',
    'preload' => array('log', 'bootstrap'),
    'import' => array(
        'application.models.*',
        'common.models.*',
        'common.components.*',
        'common.extensions.*',
        'common.extensions.image.helpers.*',
    ),
    'aliases' => array(
        'xupload' => 'common.extensions.xupload'
    ),
    'modules' => array(
        'landa',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'landak',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '192.168.1.90','192.168.1.41'),
            'generatorPaths' => array(
                'common.extensions.giiplus'  //Ajax Crud template path
            ),
        ),
    ),
    
    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=' . $db,
            'emulatePrepare' => true,
            'username' => $dbUser,
            'password' => $dbPwd,
            'tablePrefix' => '',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true
        ),
        'landa' => array(
            'class' => 'LandaCore',
        ),
        'messages' => array(
            'basePath' => $root . 'common/messages/',
        ),
        'user' => array(
            'loginUrl' => array('/site/login'),
            'allowAutoLogin' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'dashboard' => '/site',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
            'urlSuffix' => '.html',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
//        'log' => array(
//            'class' => 'CLogRouter',
//            'routes' => array(
//                array(
//                    'class' => 'common.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
//                    'ipFilters' => array('127.0.0.1', '192.168.1.90'),
//                ),
//                array(
//                    'class' => 'CFileLogRoute',
//                    'levels' => 'error, warning',
//                ),
//            ),
//        ),
        'bootstrap' => array(
            'class' => 'common.extensions.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
            'fontAwesomeCss' => true,
        ),
        'image' => array(
            'class' => 'common.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),
        'themeManager' => array(
            'basePath' => $root . 'common/themes/backend/',
            'baseUrl' => $themesUrl . 'backend/', //this is the important part, setup a subdomain just for your common dir
        ),
        'cache' => array(
            //'class'=>'system.caching.CMemCache',
            'class' => 'system.caching.CFileCache'
        ),
    ),
    'params' => array(
        'appVersion'=>'v.1',
        'client'=>$client,
        'clientName'=>$clientName,
        'id' => '1',
        'urlImg' => $rootUrl . 'images/',
        'pathImg' => (isset($pathImg)) ? $pathImg : $root . 'taro_simpeg/www/' . $client . '/images/',
        'menu' => $menu,
    ),
);
?>
