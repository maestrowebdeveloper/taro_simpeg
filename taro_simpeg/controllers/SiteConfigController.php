<?php

class SiteConfigController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // c
                'actions' => array('index', 'create'),
                'expression' => 'app()->controller->isValidAccess(1,"c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess(1,"r")'
            ),
            array('allow', // u
                'actions' => array('index', 'update'),
                'expression' => 'app()->controller->isValidAccess(1,"u")'
            ),
            array('allow', // d
                'actions' => array('index', 'delete'),
                'expression' => 'app()->controller->isValidAccess(1,"d")'
            )
        );
    }

   public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        cs()->registerScript('tab', '$("#myTab a").click(function(e) {
                                        e.preventDefault();
                                        $(this).tab("show");
                                    })');

        if (isset($_POST['SiteConfig'])) {
            $model->attributes = $_POST['SiteConfig'];
            $model->city_id = $_POST['city_id'];

            $file = CUploadedFile::getInstance($model, 'client_logo');
            if (is_object($file)) {
                $model->client_logo = Yii::app()->landa->urlParsing($model->client_name) . '.' . $file->extensionName;
            } else {
                unset($model->client_logo);
            }

            $settings = array();  
            $settings['price_sell_persentase']=$_POST['price_sell_persentase']; 
            $settings['beginingBalance']=$_POST['beginingBalance'];                    
            $model->settings = json_encode($settings);

            if ($model->save()) {
                if (is_object($file)) {
                    $file->saveAs('images/site/' . $model->client_logo);
                    app()->landa->createImg('site/', $model->client_logo, $model->id, false);
                }
                //clear session site
                unset(Yii::app()->session['site']);

                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $this->render('update', array(
            'model' => $model,
        ));
    }

    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = SiteConfig::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'site-config-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


}
