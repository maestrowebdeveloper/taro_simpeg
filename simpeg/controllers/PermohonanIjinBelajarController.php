<?php

class PermohonanIjinBelajarController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("permohonanIjinBelajar","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("permohonanIjinBelajar","r")'
            ),
            array('allow', // u
                'actions' => array( 'update'),
                'expression' => 'app()->controller->isValidAccess("permohonanIjinBelajar","u")'
            ),
            array('allow', // d
                'actions' => array( 'delete'),
                'expression' => 'app()->controller->isValidAccess("permohonanIjinBelajar","d")'
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
        $model = new PermohonanIjinBelajar;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PermohonanIjinBelajar'])) {
            $model->attributes = $_POST['PermohonanIjinBelajar'];
            $pegawai = Pegawai::model()->findByPk($model->pegawai_id);
            $model->nip = $pegawai->nip;
            $model->nama = $pegawai->namaGelar;
            $model->jabatan = $pegawai->JabatanStruktural->jabatan;
            $model->unit_kerja = $pegawai->unitKerja;
            $model->golongan = $pegawai->golongan;
//            $model->pegawai_id = $_POST['id'];
            $model->tanggal = date('Y-m-d', strtotime($_POST['PermohonanIjinBelajar']['tanggal']));
            $model->tanggal_usul = date('Y-m-d', strtotime($_POST['PermohonanIjinBelajar']['tanggal_usul']));
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

        if (isset($_POST['PermohonanIjinBelajar'])) {
            $model->attributes = $_POST['PermohonanIjinBelajar'];
            $pegawai = Pegawai::model()->findByPk($model->pegawai_id);
            $model->nip = $pegawai->nip;
            $model->nama = $pegawai->namaGelar;
            $model->jabatan = $pegawai->jabatan;
            $model->unit_kerja = $pegawai->unitKerja;
            $model->golongan = $pegawai->golongan;
//            $model->pegawai_id = $_POST['id'];
//            $model->tanggal = date('Y-d-m', strtotime($_POST['PermohonanIjinBelajar']['tanggal']));
//            $model->tanggal_usul = date('Y-d-m', strtotime($_POST['PermohonanIjinBelajar']['tanggal_usul']));

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $model = new PermohonanIjinBelajar('search');
        $model->unsetAttributes();  // clear any default values
        $criteria = new CDbCriteria();

        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            foreach ($_POST['ceckbox'] as $data) {
                $a = $this->loadModel($data);
                if (!empty($a))
                    $a->delete();
            }
        }

        if (isset($_GET['PermohonanIjinBelajar'])) {
            $model->attributes = $_GET['PermohonanIjinBelajar'];
            if ($model->pegawai_id == 0)
                unset($model->pegawai_id);
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
        $model = PermohonanIjinBelajar::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'permohonan-ijin-belajar-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        
        $jenjang_pendidikan =$_GET['jenjang_pendidikan'];
        $nomor_register =$_GET['nomor_register'];
        $tanggal = $_GET['tanggal'];
        $pegawai_id = $_GET['pegawai_id'];
        $jurusan = $_GET['jurusan'];
        $nama_sekolah = $_GET['nama_sekolah'];
        
        $criteria = new CDbCriteria;
        $criteria->compare('jenjang_pendidikan', $jenjang_pendidikan, true);
        $criteria->compare('pegawai_id', $pegawai_id);
        $criteria->compare('nomor_register', $nomor_register, true);
        $criteria->compare('tanggal', $tanggal, true);
        $criteria->compare('jurusan', $jurusan, true);
        $criteria->compare('nama_sekolah', $nama_sekolah, true);
        
            $model = PermohonanIjinBelajar::model()->findAll($criteria);


        Yii::app()->request->sendFile('Data Permohonan Ijin Belajar -'.date('YmdHi') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }
    
    public function actionRangePrint(){
         $model = new PermohonanIjinBelajar;
        $model->unsetAttributes();  // clear any default values  
        if (isset($_POST['PermohonanIjinBelajar'])) {
            $model->attributes = $_POST['PermohonanIjinBelajar'];
        }
//        $this->cssJs();
        $this->render('rangePrint', array(
            'model' => $model,
        ));
    }

}
