<?php

class HonorerController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("honorer","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("honorer","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("honorer","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("honorer","d")'
            )
        );
    }

    public function cssJs() {
        cs()->registerScript('', '  
	    
	    $("#myTab a").click(function(e) {
	        e.preventDefault();
	        $(this).tab("show");
	    })

	    ');
    }

    public function actionGetMasaKerja() {
//        $bulan = (!empty($_POST['bulan']) ? ($_POST['bulan']) : 0) * -1;
//        $tahun = (!empty($_POST['tahun']) ? ($_POST['tahun']) : 0) * -1;
        $date1 = explode("-", $_POST['tmt_kontrak']);
        $tmt1 = mktime(0, 0, 0, $date1[1], $date1[2], $date1[0]);

        $date2 = explode("-", $_POST['tmt_mulai_kontrak']);
        $tmt2 = mktime(0, 0, 0, $date2[1], $date2[2], $date2[0]);

        $tmt_kontrak = date("d-m-Y", $tmt1);
        $tmt_mulai_kontrak = date("d-m-Y", $tmt2);

        if (isset($tmt_kontrak) or !empty($tmt_kontrak)) {
            $data = array();
            $data['bulan'] = str_replace(" Bulan", "", KenaikanGaji::model()->masaKerja($tmt_kontrak, $tmt_mulai_kontrak, false, true));
            $data['tahun'] = str_replace(" Tahun", "", KenaikanGaji::model()->masaKerja($tmt_kontrak, $tmt_mulai_kontrak, true));
            echo json_encode($data);
        }
    }

    public function actionDeleteNilai() {
        $model = NilaiHonorer::model()->deleteByPk($_POST['id']);
        $nilai = NilaiHonorer::model()->findAll(array('condition' => 'pegawai_id=' . $_POST['pegawai'], 'order' => 'tahun DESC'));
        echo $this->renderPartial('/honorer/_tableNilai', array('pegawai_id' => $_POST['pegawai'], 'nilai' => $nilai, 'edit' => 1));
    }

    public function actionSaveNilai() {
        if (isset($_POST['NilaiHonorer'])) {
            if (empty($_POST['NilaiHonorer']['id'])) {
                $model = new NilaiHonorer;
            } else {
                $model = NilaiHonorer::model()->findByPk($_POST['NilaiHonorer']['id']);
            }
            $model->attributes = $_POST['NilaiHonorer'];
            if ($model->save()) {
                $nilai = NilaiHonorer::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tahun DESC'));
                echo $this->renderPartial('/honorer/_tableNilai', array('pegawai_id' => $model->pegawai_id, 'nilai' => $nilai, 'edit' => 1));
            }
        }
    }

    public function actionGetNilaiSkp() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = NilaiHonorer::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/honorer/_formNilai', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/honorer/_formNilai', array('model' => new NilaiHonorer, 'pegawai_id' => $pegawai));
        }
    }

    public function actionGetListHonorer() {
        $name = $_GET["q"];
        $list = array();
        $data = Honorer::model()->findAll(array('condition' => 'nama like "%' . $name . '%" and kode in (20,40)', 'limit' => '10'));
        if (empty($data)) {
            $list[] = array("id" => "0", "text" => "No Results Found..");
        } else {
            foreach ($data as $val) {
                $list[] = array("id" => $val->id, "text" => $val->nama);
            }
        }
        echo json_encode($list);
    }

    public function actionGetDetail() {
        $id = $_POST["id"];
        $model = Honorer::model()->findByPk($id);
        $return['id'] = $id;
        $return['nama'] = $model->nama;
        $return['jenis_kelamin'] = $model->jenis_kelamin;
        $return['unit_kerja'] = $model->unitKerja;
        $return['masa_kerja'] = $model->masaKerja;
        $return['tempat_lahir'] = $model->tempat_lahir;
        $return['tanggal_lahir'] = $model->tanggal_lahir;
        $return['city'] = $model->namaCity;
//        $return['nama_kota'] = $model->namaKota;
        $return['alamat'] = $model->alamat;
        $return['pendidikan_terakhir'] = $model->pendidikan_terakhir;
        echo json_encode($return);
    }

    public function actionRemovephoto($id) {
        Honorer::model()->updateByPk($id, array('foto' => NULL));
    }

    public function actionView($id) {
        $this->cssJs();
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
        $this->cssJs();
        $model = new Honorer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Honorer'])) {
            $model->attributes = $_POST['Honorer'];
            $model->city_id = $_POST['Honorer']['city_id'];
//            $model->kota = $_POST['id'];
            $perubahan['tahun'] = $_POST['kalkulasiTahun'];
            $perubahan['bulan'] = $_POST['kalkulasiBulan'];
            $model->perubahan_masa_kerja = json_encode($perubahan);
            $model->tempat_lahir = $_POST['Honorer']['tempat_lahir'];
            $model->tanggal_lahir = date('Y-m-d', strtotime($_POST['Honorer']['tanggal_lahir']));
            $model->tanggal_register = date('Y-m-d', strtotime($_POST['Honorer']['tanggal_register']));
            $model->tmt_kontrak = date('Y-m-d', strtotime($_POST['Honorer']['tmt_kontrak']));
            $model->tmt_mulai_kontrak = date('Y-m-d', strtotime($_POST['Honorer']['tmt_mulai_kontrak']));
            $model->tmt_akhir_kontrak = date('Y-m-d', strtotime($_POST['Honorer']['tmt_akhir_kontrak']));
            $model->gelar_depan = $_POST['Honorer']['gelar_depan'];
            $model->gelar_belakang = $_POST['Honorer']['gelar_belakang'];

            $file = CUploadedFile::getInstance($model, 'foto');
            if (is_object($file)) {
                $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
            } else {
                unset($model->foto);
            }

            if ($model->save()) {
                if (is_object($file)) {
                    $file->saveAs('images/honorer/' . $model->foto);
                    Yii::app()->landa->createImg('honorer/', $model->foto, $model->id);
                }
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
        $this->cssJs();
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Honorer'])) {
            $model->attributes = $_POST['Honorer'];
            $model->city_id = $_POST['Honorer']['city_id'];
//            $model->kota = $_POST['id'];
            $model->tempat_lahir = $_POST['Honorer']['tempat_lahir'];
            $model->tanggal_lahir = date('Y-m-d', strtotime($_POST['Honorer']['tanggal_lahir']));
            $model->tanggal_register = date('Y-m-d', strtotime($_POST['Honorer']['tanggal_register']));
            $model->tmt_kontrak = date('Y-m-d', strtotime($_POST['Honorer']['tmt_kontrak']));
            $model->tmt_mulai_kontrak = date('Y-m-d', strtotime($_POST['Honorer']['tmt_mulai_kontrak']));
            $model->tmt_akhir_kontrak = date('Y-m-d', strtotime($_POST['Honorer']['tmt_akhir_kontrak']));
            $file = CUploadedFile::getInstance($model, 'foto');
            if (is_object($file)) {
                $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
            } else {
                unset($model->foto);
            }

            if ($model->save()) {
                $file = CUploadedFile::getInstance($model, 'foto');
                if (is_object($file)) {
                    $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
                    $file->saveAs('images/honorer/' . $model->foto);
//                    Yii::app()->landa->createImg('honorer/', $model->foto, $model->id);
                }
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionGetListKota() {
        //$guestName = User::model()->listUsers('guest');
        $name = $_GET['term'];
        $guestName = City::model()->findAll(array('condition' => 'name like "%' . $name . '%"', 'limit' => '10'));
        $source = array();
        foreach ($guestName as $val) {
//            if (empty($val->company)) {
//                $name = $val->name;
//            } else {
            $name = $val->Province->name . ' - ' . $val->name;
//            }
            $source[] = array(
                'item_id' => $val->id,
                'label' => $name,
                'value' => $val->name,
            );
        }
        echo CJSON::encode($source);
    }

    public function actionUpload() {

        $id = $_GET['id'];
        Yii::import("common.extensions.EAjaxUpload.qqFileUploader");

        $folder = 'images/file/honorer/' . $id . '/'; // folder for uploaded files             
        if (!file_exists($folder)) {
            mkdir($folder, 0777);
        }
        $allowedExtensions = array("jpg", "jpeg", "gif", "png", "gif", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "zip", "rar"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 7 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $model = new File;
        $model->pegawai_id = $_GET['id'];
        $model->nama = ($result['filename']);
        $model->type = 'honorer';
        $model->save();
        echo $return; // it's array
    }

    /**
     * Deletes a particular mode
     * l.
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
        $model = new Honorer('search');
        $model->unsetAttributes();  // clear any default values
        $model->kode = 40;

        if (isset($_GET['Honorer'])) {
            $model->attributes = $_GET['Honorer'];
        }
        if (isset($_POST['ceckbox'])) {
            if (isset($_POST['delete'])) {
                Honorer::model()->deleteAll(array(
                    'condition' => 'id IN(' . implode(',', $_POST['ceckbox']) . ')'
                ));
            } else {
                $data = $data = Honorer::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['ceckbox']) . ')'));
                ;
                ;
                Yii::app()->request->sendFile('Data Pegawai Honorer - ' . date('YmdHi') . '.xls', $this->renderPartial('excelReport', array(
                            'model' => $data,
                                ), true)
                );
            }
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
        $model = Honorer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'honorer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
        $model = new Honorer;
        $model->attributes = $_GET['Honorer'];
        $data = $model->search(true);
        Yii::app()->request->sendFile('Data Pegawai Honorer - ' . date('YmdHi') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $data,
                        ), true)
        );
    }

    public function actionPindahStatus() {
        $model = Honorer::model()->findAll();
        foreach ($model as $data) {
            if ($data->kode != 40) {
                Honorer::model()->updateAll(array(
                    'kode' => 20,), 'id=' . $data->id);
            }
        }
    }

}
