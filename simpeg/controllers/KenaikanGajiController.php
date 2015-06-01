<?php

class KenaikanGajiController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("kenaikanGaji","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("kenaikanGaji","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("kenaikanGaji","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("kenaikanGaji","d")'
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
    public function actionGetPegawai() {
        if (!empty($_POST['bulan']) and !empty($_POST['tahun'])) {
            $bulan = substr("0" . $_POST['bulan'], -2, 2);
            $query = KenaikanGaji::model()->findAll(array('condition' => 'month(tmt_baru) = "' . $bulan . '" and year(tmt_baru) = "' . $_POST['tahun'] . '"'));
            echo $this->renderPartial('/kenaikanGaji/_tablePegawai', array('query' => $query, 'bulan' => $bulan, 'tahun' => $_POST['tahun']));
        }
    }

    public function actionGetListPegawai() {
        if (!empty($_POST['bulan']) and !empty($_POST['tahun'])) {
            $bulan = substr("0" . $_POST['bulan'], -2, 2);
            $query = Pegawai::model()->with('Pangkat')->findAll(array('condition' => 't.kedudukan_id = 1 and month(t.tmt_cpns) <= "' . $bulan . '" ', 'order' => 'Pangkat.golongan_id ASC'));
            echo $this->renderPartial('/kenaikanGaji/_tableListPegawai', array('query' => $query, 'bulan' => $bulan, 'tahun' => $_POST['tahun']));
        }
    }

    public function actionCreate() {
        $model = new KenaikanGaji;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['proses'])) {
            for ($i = 0; $i < count($_POST['pegawai_id']); $i++) {
                $bulan = substr("0" . $_POST['bulan'], -2, 2);
                $valPegawai = Pegawai::model()->findByPk($_POST['pegawai_id'][$i]);

                $tglKenaikan = date("Y-m-d", strtotime($_POST['tmt_mulai'][$i]));
                
                $delRiwayatgaji = RiwayatGaji::model()->deleteAll(array('condition' => 'pegawai_id='.$valPegawai->id.' and month(tmt_mulai)="'.$bulan.'" and year(tmt_mulai)="'.$_POST['tahun'].'"'));
                $riwayatGaji = new RiwayatGaji;
                $riwayatGaji->nomor_register = date("ymisd");
                $riwayatGaji->pegawai_id = $valPegawai->id;
                $riwayatGaji->gaji = $_POST['gaji_baru'][$i];
                $riwayatGaji->dasar_perubahan = "Kenaikan gaji berkala bulan " . $bulan . " tahun " . $_POST['tahun'];
                $riwayatGaji->tmt_mulai = $_POST['tmt_mulai'][$i];
                $riwayatGaji->save();

                $delKgb = KenaikanGaji::model()->deleteAll(array('condition' => 'pegawai_id='.$valPegawai->id.' and month(tanggal)="'.$bulan.'" and year(tanggal)="'.$_POST['tahun'].'"'));
                $kgb = new KenaikanGaji;
                $kgb->pegawai_id = $valPegawai->id;
                $kgb->gaji_pokok_lama = $_POST['gaji_lama'][$i];
                $kgb->gaji_pokok_baru = $_POST['gaji_baru'][$i];
                $kgb->tmt_lama = $_POST['tmt_lama'][$i];
                $kgb->tmt_baru = $_POST['tmt_mulai'][$i];
                $kgb->created = date("Y-m-d h:i:s");
                $kgb->nomor_register = '';
                $kgb->sifat = '';
                $kgb->perihal = '';
                $kgb->pejabat = '';
                $kgb->tanggal = $_POST['tmt_mulai'][$i];
                $kgb->no_sk_akhiir = $_POST['no_sk_akhir'][$i];
                $kgb->tanggal_sk_akhir = $_POST['tanggal_sk_akhir'][$i];
                $kgb->save();

                $valPegawai->riwayat_gaji_id = $riwayatGaji->id;
                $valPegawai->save();
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

        if (isset($_POST['KenaikanGaji'])) {
            $model->attributes = $_POST['KenaikanGaji'];
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
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new KenaikanGaji;
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
        $model = KenaikanGaji::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'kenaikan-gaji-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
