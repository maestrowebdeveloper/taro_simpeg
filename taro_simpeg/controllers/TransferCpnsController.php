<?php

class TransferCpnsController extends Controller {

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
                'actions' => array('index', 'create'),
                'expression' => 'app()->controller->isValidAccess("transferCpns","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("transferCpns","r")'
            ),
            array('allow', // u
                'actions' => array('index', 'update'),
                'expression' => 'app()->controller->isValidAccess("transferCpns","u")'
            ),
            array('allow', // d
                'actions' => array('index', 'delete'),
                'expression' => 'app()->controller->isValidAccess("transferCpns","d")'
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

    public function actionTransfer() {
//        logs(implode(',', $_POST['id']));
        if (isset($_POST['ceckbox'])) {
            
            if (isset($_POST['transfer'])) {
                $id = $_POST['ceckbox'];
                $jumlah=0;
                $model = TransferCpns::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['ceckbox']) . ') and status=1'));
                $jumlah = count($model);
                foreach ($model as $data) {
                    // update kesehatan di pegawai
                    Pegawai::model()->updateAll(array(
                        'nomor_kesehatan' => $data->nomor_kesehatan,
                        'tanggal_kesehatan' => $data->tanggal_kesehatan
                            ), 'id=' . $data->pegawai_id);

                    // add riwayat diklat
                    $diklat = new RiwayatPelatihan;
                    $diklat->nomor_sttpl = $data->nomor_diklat;
                    $diklat->pelatihan_id = $data->pelatihan_id;
                    $diklat->tanggal = $data->tanggal_diklat;
                    $diklat->pegawai_id = $data->pegawai_id;
                    $diklat->save();
                    
                    TransferCpns::model()->updateAll(array(
                        'status' => 2,
                            ), 'id=' . $data->id);
                    
                }
                user()->setFlash('danger', ''.$jumlah.' Pegawai CPNS sudah berhasil d trasnfer ke PNS');
                    $this->redirect(array('transferCpns/index'));
            } else {
                TransferCpns::model()->deleteAll('id IN (' . implode(',', $_POST['ceckbox']) . ')');
                user()->setFlash('danger', 'Data berhasil di hapus.');
                $this->redirect(array('transferCpns/index'));
            }
        }else{
          user()->setFlash('danger', 'Tidak ada yang terpilih.');
                $this->redirect(array('transferCpns/index'));  
        }
    }

    public function actionGetNilai() {
        $id = $_POST['id'];
        $model = Pegawai::model()->findByPk($id);
        $return['id'] = $id;
        $return['nip'] = $model->nip;
        $return['nama'] = $model->nama;
        $return['jenis_kelamin'] = $model->jenis_kelamin;
        $return['unit_kerja'] = $model->unitKerja;
        $return['masa_kerja'] = $model->masaKerja;
        $return['tempat_lahir'] = $model->tempatLahir;
        $return['tanggal_lahir'] = $model->tanggal_lahir;
        $return['pendidikan_terakhir'] = $model->Pendidikan->jenjang_pendidikan.' - '.$model->Pendidikan->Jurusan->Name;
        $return['tahun_pendidikan'] = $model->Pendidikan->tahun;
        $return['golru'] = $model->golongan;
        $return['tmt'] = $model->tmt_cpns;
        $return['jabatan'] = $model->jabatan;
        echo json_encode($return);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new TransferCpns;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['TransferCpns'])) {
            $model->attributes = $_POST['TransferCpns'];
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

        if (isset($_POST['TransferCpns'])) {
            $model->attributes = $_POST['TransferCpns'];
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

        $model = new TransferCpns('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['TransferCpns'])) {
            $model->attributes = $_GET['TransferCpns'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->pegawai_id))
                $criteria->addCondition('pegawai_id = "' . $model->pegawai_id . '"');


            if (!empty($model->nomor_kesehatan))
                $criteria->addCondition('nomor_kesehatan = "' . $model->nomor_kesehatan . '"');


            if (!empty($model->tanggal_kesehatan))
                $criteria->addCondition('tanggal_kesehatan = "' . $model->tanggal_kesehatan . '"');


            if (!empty($model->pelatihan_id))
                $criteria->addCondition('pelatihan_id = "' . $model->pelatihan_id . '"');


            if (!empty($model->nomor_diklat))
                $criteria->addCondition('nomor_diklat = "' . $model->nomor_diklat . '"');


            if (!empty($model->tanggal_diklat))
                $criteria->addCondition('tanggal_diklat = "' . $model->tanggal_diklat . '"');


            if (!empty($model->status))
                $criteria->addCondition('status = "' . $model->status . '"');
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
        $model = TransferCpns::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'transfer-cpns-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
