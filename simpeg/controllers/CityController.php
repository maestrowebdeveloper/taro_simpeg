<?php

class CityController extends Controller {

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
                'actions' => array('create'),
                'expression' => 'app()->controller->isValidAccess(1,"c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess(1,"r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess(1,"u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess(1,"d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new City;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['City'])) {
            $model->attributes = $_POST['City'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['City'])) {
            $model->attributes = $_POST['City'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }
    
       public function actionGetListKota() {
        $name = $_GET["q"];
        $list = array();
        $data = City::model()->findAll(array('condition' => 'name like "%' . $name . '%"', 'limit' => '10'));
        if (empty($data)) {
            $list[] = array("id" => "0", "text" => "No Results Found..");
        } else {
            foreach ($data as $val) {
                $list[] = array("id" => $val->id, "text" => ucwords($val->Province->name) .' - '.$val->name);
            }
        }
        echo json_encode($list);
    }
    
       public function actionGetListKota2() {
        $name = $_GET["q"];
        $list = array();
        $data = City::model()->findAll(array('condition' => 'name like "%' . $name . '%"', 'limit' => '10'));
        if (empty($data)) {
            $list[] = array("id" => "0", "text" => "No Results Found..");
        } else {
            foreach ($data as $val) {
                $list[] = array("id" => $val->Province->name.' - '.$val->name, "text" => ucwords($val->Province->name) .' - '.$val->name);
            }
        }
        echo json_encode($list);
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
//        $session = new CHttpSession;
//        $session->open();
        $criteria = new CDbCriteria();

        $model = new City('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['City'])) {
            $model->attributes = $_GET['City'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');


            if (!empty($model->province_id))
                $criteria->addCondition('province_id = "' . $model->province_id . '"');
        }
//        $session['City_records'] = City::model()->findAll($criteria);


        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new City('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['City']))
            $model->attributes = $_GET['City'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = City::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'City-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDynaCities() {
        $t_data = City::model()->findAll('province_id=:province_id', array(':province_id' => (int) $_POST['province_id']));
        $data = CHtml::listData($t_data, 'id', 'name');
        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionTakeCity() {
        $province = $_POST['landaProvince'];
        $name = $_POST['name'];
        $prefix = $_POST['prefix'];
//        echo CHtml::dropDownList($prefix . 'city_' . $name, '', CHtml::listData(City::model()->findAll(array('condition' => 'province_id="' . $province . '"')), 'id', 'name'), array('class' => 'span3',));
        echo $this->widget(
                'bootstrap.widgets.TbSelect2', array(
            'name' => $prefix . 'city_' . $name,
            'value' => '',
            'data' => CHtml::listData(City::model()->findAll(array('condition' => 'province_id="' . $province . '"')), 'id', 'name'),
            'options' => array(
                'width' => '40%'
            )), true);
    }
    
    public function actionListAjax() {
        $data = City::model()->with('Province')->findAll(array('condition'=>'t.name like "%'.$_GET['q'].'%" OR Province.name like "%'.$_GET['q'].'%"'));
        if (empty($data)) {
            $list[] = array("id" => "0", "text" => "No Results Found..");
        } else {
            foreach ($data as $val) {
                $list[] = array("id" => $val->id, "text" => $val->fullName);
            }
        }
        echo json_encode($list);
    }

}
