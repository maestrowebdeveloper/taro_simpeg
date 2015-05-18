<?php

class UnitKerjaController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("unitKerja","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("unitKerja","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("unitKerja","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("unitKerja","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        /* $this->render('view',array(
          'model'=>$this->loadModel($id),
          )); */
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
        $model = new UnitKerja;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UnitKerja'])) {

            $model->attributes = $_POST['UnitKerja'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionMigration() {
        //contoh migrasi 1 level
        $var = explode('||', 'Sekretariat Daerah||Sekretariat DPRD||Dinas Pendidikan||Dinas Kesehatan||Dinas Sosial, Tenaga Kerja dan Transmigrasi||Dinas Perhubungan, Komunikasi dan Informatika||Dinas Kependudukan dan Pencatatan Sipil||Dinas Kebudayaan, Pariwisata, Pemuda dan Olah Raga||Dinas Pekerjaan Umum Cipta Karya dan Tata Ruang||Rumah Sakit Umum Daerah||Dinas Pekerjaan Umum Bina Marga||Dinas Pekerjaan Umum Pengairan||Dinas Koperasi, Usaha Kecil dan Menengah||Dinas Perindustrian, Perdagangan dan Pertambangan||Dinas Pertanian||Dinas Kehutanan dan Perkebunan||Dinas Kelautan, Perikanan dan Peternakan||Dinas Pendapatan, Pengelolaan Keuangan dan Aset||Inspektorat||Badan Perencanaan Pembangunan Daerah||Badan Kesatuan Bangsa dan politik||Badan Pemberdayaan Masyarakat||Badan Pemberdayaan Perempuan dan Keluarga Berencana||Badan Kepegawaian Daerah||Badan Ketahanan Pangan dan Pelaksana Penyuluhan Pertanian||Badan Lingkungan Hidup||Kantor Pelayanan Perijinan dan Penanaman Modal||Kantor Perpustakaan dan Arsip Daerah||Satuan Polisi Pamong Praja||Kecamatan Sampang||Kecamatan Omben||Kecamatan Camplong||Kecamatan Torjun||Kecamatan Jrengik||Kecamatan Sreseh||Kecamatan Kedungdung||Kecamatan Tambelangan||Kecamatan Robatal||Kecamatan Ketapang||Kecamatan Banyuates||Kecamatan Sokobanah||Kecamatan Pangarengan||Kecamatan Karang Penang||Kelurahan Gunung Sekar  Kecamatan Sampang||Kelurahan Dalpenang  Kecamatan Sampang||Kelurahan Rong Tengah  Kecamatan Sampang||Kelurahan Banyuanyar  Kecamatan Sampang||Kelurahan Polagan  Kecamatan Sampang||Kelurahan Karang Dalam  Kecamatan Sampang||Sekretariat KPUD||Badan Penanggulangan Bencana Daerah||Pemerintah Kabupaten Sampang||Sekretariat Dewan Pengurus KORPRI)');
        foreach ($var as $val) {
            $model = new UnitKerja;
            $model->nama = $val;
            $model->save();
        }
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

        if (isset($_POST['UnitKerja'])) { {
                $model->attributes = $_POST['UnitKerja'];
                if ($model->save())
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


//        $session = new CHttpSession;
//        $session->open();
        $criteria = new CDbCriteria();

        $model = new UnitKerja('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['UnitKerja'])) {
            $model->attributes = $_GET['UnitKerja'];



            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->nama))
                $criteria->addCondition('nama = "' . $model->nama . '"');


            if (!empty($model->keterangan))
                $criteria->addCondition('keterangan = "' . $model->keterangan . '"');


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
//        $session['UnitKerja_records'] = UnitKerja::model()->findAll($criteria);
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            UnitKerja::model()->deleteAll(array(
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
        $model = UnitKerja::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'unit-kerja-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

//    public function actionGenerateExcel() {
//        $session = new CHttpSession;
//        $session->open();
//
//        if (isset($session['UnitKerja_records'])) {
//            $model = $session['UnitKerja_records'];
//        } else
//            $model = UnitKerja::model()->findAll();
//
//
//        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
//                    'model' => $model
//                        ), true)
//        );
//    }
}
