<?php

class JabatanHonorerController extends Controller {

    public $breadcrumbs;

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'main';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // c
                'actions' => array('create'),
                'expression' => 'app()->controller->isValidAccess("jabatanHonorer","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("jabatanHonorer","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("jabatanHonorer","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("jabatanHonorer","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        cs()->registerScript('read', '
                    $("form input, form textarea, form select").each(function(){
                    $(this).prop("disabled", true);
                });');
        $_GET['v'] = true;
        $this->actionUpdate($id);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new JabatanHonorer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['JabatanHonorer'])) {
            if ($_POST['JabatanHonorer']['parent_id']) {
                $child = new JabatanHonorer;
                $child->attributes = $_POST['JabatanHonorer'];

                $root = $model->findByPk($_POST['JabatanHonorer']['parent_id']);
                if ($child->appendTo($root))
                    $this->redirect(array('view', 'id' => $child->id));
            }else {
                $model->attributes = $_POST['JabatanHonorer'];
                if ($model->saveNode())
                    $this->redirect(array('view', 'id' => $model->id));
            }
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

        if (isset($_POST['JabatanHonorer'])) {
            if ($_POST['JabatanHonorer']['parent_id']) {
                $model->attributes = $_POST['JabatanHonorer'];
                if ($model->saveNode()) {
                    $root = $model->findByPk($_POST['JabatanHonorer']['parent_id']);
                    $model->moveAsFirst($root);
                    $this->redirect(array('view', 'id' => $model->id));
                }
            } else {
                $model->attributes = $_POST['JabatanHonorer'];
                $model->saveNode();
                if (!($model->isRoot()))
                    $model->moveAsRoot();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->deleteNode();

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

        $model = new JabatanHonorer('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['JabatanHonorer'])) {
            $criteria = new CDbCriteria();
            $model->attributes = $_GET['JabatanHonorer'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->nama))
                $criteria->addCondition('nama = "' . $model->nama . '"');


            if (!empty($model->keterangan))
                $criteria->addCondition('keterangan = "' . $model->keterangan . '"');


            if (!empty($model->status))
                $criteria->addCondition('status = "' . $model->status . '"');


            if (!empty($model->level))
                $criteria->addCondition('level = "' . $model->level . '"');


            if (!empty($model->lft))
                $criteria->addCondition('lft = "' . $model->lft . '"');


            if (!empty($model->rgt))
                $criteria->addCondition('rgt = "' . $model->rgt . '"');


            if (!empty($model->root))
                $criteria->addCondition('root = "' . $model->root . '"');


            if (!empty($model->parent_id))
                $criteria->addCondition('parent_id = "' . $model->parent_id . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            JabatanHonorer::model()->deleteAll(array(
                'condition' => 'id IN(' . implode(',', $_POST['ceckbox']) . ')'
            ));
        }

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = JabatanHonorer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'jabatan-honorer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

//	public function actionGenerateExcel() {
//        $session = new CHttpSession;
//        $session->open();
//
//        if (isset($session['JabatanHonorer_records'])) {
//            $model = $session['JabatanHonorer_records'];
//        } else
//            $model = JabatanHonorer::model()->findAll();
//
//
//        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelReport', array(
//                    'model' => $model
//                        ), true)
//        );
//    }
}
