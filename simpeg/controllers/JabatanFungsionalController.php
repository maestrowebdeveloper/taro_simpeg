<?php

class JabatanFungsionalController extends Controller {

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
        $model = new JabatanFungsional;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['JabatanFungsional'])) {
            $model->attributes = $_POST['JabatanFungsional'];
            if ($model->save()) {
                if (isset($_POST['golongan_id'])) {
                    for ($i = 0; $i < count($_POST['golongan_id']); $i++) {
                        $det = new DetailJf;
                        $det->jabatan_fungsional_id = $model->id;
                        $det->golongan_id = $_POST['golongan_id'][$i];
                        $det->save();
                    }
                    $this->redirect(array('view', 'id' => $model->id));
                }
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

        if (isset($_POST['JabatanFungsional'])) {
            $model->attributes = $_POST['JabatanFungsional'];
            if ($model->save()) {
                DetailJf::model()->deleteAll('jabatan_fungsional_id=' . $model->id);
                if (isset($_POST['golongan_id'])) {
                    for ($i = 0; $i < count($_POST['golongan_id']); $i++) {
                        $det = new DetailJf;
                        $det->jabatan_fungsional_id = $model->id;
                        $det->golongan_id = $_POST['golongan_id'][$i];
                        $det->save();
                    }
                    $this->redirect(array('view', 'id' => $model->id));
                }
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
        $criteria = new CDbCriteria();
        $model = new JabatanFungsional('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['JabatanFungsional'])) {
            $model->attributes = $_GET['JabatanFungsional'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->nama))
                $criteria->addCondition('nama = "' . $model->nama . '"');


            if (!empty($model->keterangan))
                $criteria->addCondition('keterangan = "' . $model->keterangan . '"');


            if (!empty($model->golongan_id))
                $criteria->addCondition('golongan_id = "' . $model->golongan_id . '"');


            if (!empty($model->jabatan_ft_id))
                $criteria->addCondition('jabatan_ft_id = "' . $model->jabatan_ft_id . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
        }
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            JabatanFungsional::model()->deleteAll(array(
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
        $model = JabatanFungsional::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'jabatan-fungsional-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
