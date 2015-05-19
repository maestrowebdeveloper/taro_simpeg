<?php

class PermohonanPensiunController extends Controller {

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
        $model = new PermohonanPensiun;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PermohonanPensiun'])) {
            $model->attributes = $_POST['PermohonanPensiun'];
            $pegawai = Pegawai::model()->findByPk($model->pegawai_id);
            if (!empty($pegawai)) {
                $model->unit_kerja_id = $pegawai->unit_kerja_id;
                $model->tipe_jabatan = $pegawai->tipe_jabatan;
                $model->jabatan_struktural_id = $pegawai->jabatan_struktural_id;
                $model->jabatan_fu_id = $pegawai->jabatan_fu_id;
                $model->jabatan_ft_id = $pegawai->jabatan_ft_id;
            }
            if ($model->save()) {
                $pegawai->kedudukan_id = 14;
                $pegawai->tmt_pensiun = $model->tmt;
                $pegawai->save();
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

        if (isset($_POST['PermohonanPensiun'])) {
            $model->attributes = $_POST['PermohonanPensiun'];
            $pegawai = Pegawai::model()->findByPk($model->pegawai_id);
            if (!empty($pegawai)) {
                $model->unit_kerja_id = $pegawai->unit_kerja_id;
                $model->tipe_jabatan = $pegawai->tipe_jabatan;
                $model->jabatan_struktural_id = $pegawai->jabatan_struktural_id;
                $model->jabatan_fu_id = $pegawai->jabatan_fu_id;
                $model->jabatan_ft_id = $pegawai->jabatan_ft_id;
            }
            if ($model->save()) {
                $pegawai->kedudukan_id = 14;
                $pegawai->tmt_pensiun = $model->tmt;
                $pegawai->save();
                $this->redirect(array('view', 'id' => $model->id));
            }
        }
        $pegawai = Pegawai::model()->findByPk($model->pegawai_id);
        if (!empty($pegawai)) {
            $model->unit_kerja_id = $pegawai->unitKerja;
            $model->tipe_jabatan = $pegawai->tipe;
            $model->jabatan_struktural_id = $pegawai->jabatan;
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

        $model = new PermohonanPensiun('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            foreach ($_POST['ceckbox'] as $data) {
                $a = $this->loadModel($data);
                if (!empty($a))
                    $a->delete();
            }
        }
        $criteria = new CDbCriteria();

        if (isset($_GET['PermohonanPensiun'])) {
            $model->attributes = $_GET['PermohonanPensiun'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->nomor_register))
                $criteria->addCondition('nomor_register = "' . $model->nomor_register . '"');


            if (!empty($model->tanggal))
                $criteria->addCondition('tanggal = "' . $model->tanggal . '"');


            if (!empty($model->pegawai_id))
                $criteria->addCondition('pegawai_id = "' . $model->pegawai_id . '"');


            if (!empty($model->unit_kerja_id))
                $criteria->addCondition('unit_kerja_id = "' . $model->unit_kerja_id . '"');


            if (!empty($model->tipe_jabatan))
                $criteria->addCondition('tipe_jabatan = "' . $model->tipe_jabatan . '"');


            if (!empty($model->jabatan_struktural_id))
                $criteria->addCondition('jabatan_struktural_id = "' . $model->jabatan_struktural_id . '"');


            if (!empty($model->jabatan_fu_id))
                $criteria->addCondition('jabatan_fu_id = "' . $model->jabatan_fu_id . '"');


            if (!empty($model->jabatan_ft_id))
                $criteria->addCondition('jabatan_ft_id = "' . $model->jabatan_ft_id . '"');


            if (!empty($model->masa_kerja))
                $criteria->addCondition('masa_kerja = "' . $model->masa_kerja . '"');


            if (!empty($model->tmt))
                $criteria->addCondition('tmt = "' . $model->tmt . '"');


            if (!empty($model->created))
                $criteria->addCondition('created = "' . $model->created . '"');


            if (!empty($model->created_user_id))
                $criteria->addCondition('created_user_id = "' . $model->created_user_id . '"');


            if (!empty($model->modified))
                $criteria->addCondition('modified = "' . $model->modified . '"');
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
        $model = PermohonanPensiun::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'permohonan-pensiun-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {

        $noregister = $_GET['noregister'];
        $tanggal = $_GET['tanggal'];
        $pegawai_id = $_GET['pegawai_id'];
        $tmt = $_GET['tmt'];

        $criteria = new CDbCriteria;
        if (!empty($noregister))
        $criteria->compare('nomor_register', $noregister, true);
        if (!empty($tanggal))
        $criteria->compare('tanggal', $tanggal, true);
        if (!empty($pegawai_id))
        $criteria->compare('pegawai_id', $pegawai_id);
        if (!empty($tmt))
        $criteria->compare('tmt',  $tmt, true);


        $model = PermohonanPensiun::model()->findAll($criteria);


        Yii::app()->request->sendFile('Data Permohonan Pensiun '.date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

}
