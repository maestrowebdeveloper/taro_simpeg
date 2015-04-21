<?php

class PermohonanMutasiController extends Controller {

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

    public function cssJs() {
        cs()->registerScript('', '  
    


    $("#PermohonanMutasi_new_tipe_jabatan_0").click(function(event) { 
      $(".struktural").show();
      $(".fungsional_umum").hide();            
      $(".fungsional_tertentu").hide();   
      $("#s2id_PermohonanMutasi_new_jabatan_ft_id").select2("val", "0") ;           
      $("#s2id_PermohonanMutasi_new_jabatan_fu_id").select2("val", "0") ;           
    });

    $("#PermohonanMutasi_new_tipe_jabatan_1").click(function(event) { 
      $(".struktural").hide();
      $(".fungsional_umum").show();            
      $(".fungsional_tertentu").hide(); 
      $("#s2id_PermohonanMutasi_new_jabatan_ft_id").select2("val", "0") ;           
      $("#s2id_PermohonanMutasi_new_jabatan_struktural_id").select2("val", "0") ;                  
    });

    $("#PermohonanMutasi_new_tipe_jabatan_2").click(function(event) { 
      $(".struktural").hide();
      $(".fungsional_umum").hide();            
      $(".fungsional_tertentu").show();   
      $("#s2id_PermohonanMutasi_new_jabatan_struktural_id").select2("val", "0") ;           
      $("#s2id_PermohonanMutasi_new_jabatan_fu_id").select2("val", "0") ;                    
    });
   

    ');
    }

    public function actionStatusJabatan() {
        $data['eselon'] = '';
        $tipe = (!empty($_POST['PermohonanMutasi']['new_tipe_jabatan'])) ? $_POST['PermohonanMutasi']['new_tipe_jabatan'] : '';
        if ($tipe == "struktural") {
            $model = JabatanStruktural::model()->findByPk($_POST['PermohonanMutasi']['new_jabatan_struktural_id']);
            $data['eselon'] = isset($model->Eselon->nama) ? $model->Eselon->nama : '-';
        } elseif ($tipe == "fungsional_umum") {
            $model = JabatanFu::model()->findByPk($_POST['PermohonanMutasi']['new_jabatan_fu_id']);
        } elseif ($tipe == "fungsional_tertentu") {
            $model = JabatanFt::model()->findByPk($_POST['PermohonanMutasi']['new_jabatan_ft_id']);
        }
        if (!empty($model)) {
            $data['status'] = $model->status;
            echo json_encode($data);
        }
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
        $model = new PermohonanMutasi;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $this->cssJs();
        if (isset($_POST['PermohonanMutasi'])) {
            $model->attributes = $_POST['PermohonanMutasi'];
            $model->mutasi = $_POST['PermohonanMutasi']['mutasi'];
            $model->pejabat = $_POST['PermohonanMutasi']['pejabat'];
            if ($model->save()) {
                $pegawai = Pegawai::model()->findByPk($model->pegawai_id);
                if ($pegawai->jabatan_struktural_id != 0) {
                    $jabatan = JabatanStruktural::model()->findByPk($pegawai->jabatan_struktural_id);
                    $jabatan->status = 0;
                    $jabatan->save();
                } elseif ($pegawai->jabatan_fu_id != 0) {
                    $jabatan = JabatanFu::model()->findByPk($pegawai->jabatan_fu_id);
                    $jabatan->status = 0;
                    $jabatan->save();
                } elseif ($pegawai->jabatan_ft_id != 0) {
                    $jabatan = JabatanFt::model()->findByPk($pegawai->jabatan_ft_id);
                    $jabatan->status = 0;
                    $jabatan->save();
                }
//                $pegawai->tipe_jabatan = $model->new_tipe_jabatan;
//                $pegawai->jabatan_struktural_id = $model->new_jabatan_struktural_id;
//                $pegawai->jabatan_fu_id = $model->new_jabatan_fu_id;
//                $pegawai->jabatan_ft_id = $model->new_jabatan_ft_id;
//                $pegawai->save();

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

        if (isset($_POST['PermohonanMutasi'])) {
            $model->attributes = $_POST['PermohonanMutasi'];
            $model->mutasi = $_POST['PermohonanMutasi']['mutasi'];
            $model->pejabat = $_POST['PermohonanMutasi']['pejabat'];
            if ($model->save()) {
//                $pegawai = Pegawai::model()->findByPk($model->pegawai_id);
//                if ($pegawai->jabatan_struktural_id != 0) {
//                    $jabatan = JabatanStruktural::model()->findByPk($pegawai->jabatan_struktural_id);
//                    $jabatan->status = 0;
//                    $jabatan->saveNode();
//                    $pegawai->tmt_jabatan_struktural = $model->tmt;
//                } elseif ($pegawai->jabatan_fu_id != 0) {
//                    $jabatan = JabatanFu::model()->findByPk($pegawai->jabatan_fu_id);
//                    $jabatan->status = 0;
//                    $jabatan->saveNode();
//                    $pegawai->tmt_jabatan_fu = $model->tmt;
//                } elseif ($pegawai->jabatan_ft_id != 0) {
//                    $jabatan = JabatanFt::model()->findByPk($pegawai->jabatan_ft_id);
//                    $jabatan->status = 0;
//                    $jabatan->saveNode();
//                    $pegawai->tmt_jabatan_ft = $model->tmt;
//                }
//                $pegawai->tipe_jabatan = $model->new_tipe_jabatan;
//                $pegawai->jabatan_struktural_id = $model->new_jabatan_struktural_id;
//                $pegawai->jabatan_fu_id = $model->new_jabatan_fu_id;
//                $pegawai->jabatan_ft_id = $model->new_jabatan_ft_id;
//                $pegawai->unit_kerja_id = $model->new_unit_kerja_id;
//                $pegawai->save();
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionOtoritas() {
//        logs(implode(',', $_POST['id']));
        if (isset($_POST['ceckbox'])) {
            $id = $_POST['ceckbox'];
            if (isset($_POST['otoritas'])) {
                $model = PermohonanMutasi::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['ceckbox']) . ')'));
                foreach ($model as $a) {
//                    Pegawai::model()->updateAll(array(
//                        'tipe_jabatan'=>$a->new_tipe_jabatan,
//                        'jabatan_struktural_id'=>$a->new_jabatan_struktural_id,
//                        'jabatan_fu_id'=>$a->new_jabatan_fu_id,
//                        'jabatan_ft_id'=>$a->new_jabatan_ft_id,
//                        'unit_kerja_id'=>$a->new_unit_kerja_id,
//                        ),'id='.$a->pegawai_id);
                    
                    $pegawai = Pegawai::model()->findByPk($a->pegawai_id);
                if ($pegawai->jabatan_struktural_id != 0) {
                    $jabatan = JabatanStruktural::model()->findByPk($pegawai->jabatan_struktural_id);
                    $jabatan->status = 0;
                    $jabatan->saveNode();
                    $pegawai->tmt_jabatan_struktural = $a->tmt;
                } elseif ($pegawai->jabatan_fu_id != 0) {
                    $jabatan = JabatanFu::model()->findByPk($pegawai->jabatan_fu_id);
                    $jabatan->status = 0;
                    $jabatan->saveNode();
                    $pegawai->tmt_jabatan_fu = $a->tmt;
                } elseif ($pegawai->jabatan_ft_id != 0) {
                    $jabatan = JabatanFt::model()->findByPk($pegawai->jabatan_ft_id);
                    $jabatan->status = 0;
                    $jabatan->saveNode();
                    $pegawai->tmt_jabatan_ft = $a->tmt;
                }
                $pegawai->tipe_jabatan = $a->new_tipe_jabatan;
                $pegawai->jabatan_struktural_id = $a->new_jabatan_struktural_id;
                $pegawai->jabatan_fu_id = $a->new_jabatan_fu_id;
                $pegawai->jabatan_ft_id = $a->new_jabatan_ft_id;
                $pegawai->unit_kerja_id = $a->new_unit_kerja_id;
                $pegawai->save();
                
                // change status
                    $a->status = 1;
                    $a->save();
                }
                user()->setFlash('info', 'Data is update now.');
                $this->redirect(array('permohonanMutasi/index'));
            } else {
                PermohonanMutasi::model()->deleteAll('id IN (' . implode(',', $_POST['ceckbox']) . ')');
                user()->setFlash('danger', '<strong>Attention! </strong>Data is deleted.');
                $this->redirect(array('permohonanMutasi/index'));
            }
            
        } else {
            user()->setFlash('danger', '<strong>Error! </strong>Please chekked article and then choose the button.');
            $this->redirect(array('permohonanMutasi/index'));
        }
    }
    public function actionIndex() {

        $model = new PermohonanMutasi('search');
        $model->unsetAttributes();  // clear any default values
//        if (isset($_POST['action']) && isset($_POST['ceckbox'])) {
//            if ($_POST['action'] == 'del') {
//                foreach ($_POST['ceckbox'] as $data) {
//                    $a = $this->loadModel($data);
//                    if (!empty($a)) {
//                        
//                    }
//                    $a->delete();
//                }
//            } else {
//                foreach ($_POST['ceckbox'] as $data) {
//                    $model = $this->loadModel($data);
//                    $pegawai = Pegawai::model()->findByPk($data);
////                if (!empty($$model)){
//                    //change for pegawai
//                    $pegawai->tipe_jabatan = $model->new_tipe_jabatan;
//                    $pegawai->jabatan_struktural_id = $model->new_jabatan_struktural_id;
//                    $pegawai->jabatan_fu_id = $model->new_jabatan_fu_id;
//                    $pegawai->jabatan_ft_id = $model->new_jabatan_ft_id;
//                    $pegawai->unit_kerja_id = $model->new_unit_kerja_id;
//                    $pegawai->save();
//
//                    //chage status
//                    $model->status = 1;
//                    $model->save();
////                }
//                }
//            }
//        }



        if (isset($_GET['PermohonanMutasi'])) {
            $model->attributes = $_GET['PermohonanMutasi'];
            if ($model->new_unit_kerja_id == 0)
                unset($model->new_unit_kerja_id);
            if ($model->pegawai_id == 0)
                unset($model->pegawai_id);
            if ($model->new_jabatan_struktural_id == 0)
                unset($model->new_jabatan_struktural_id);
            if ($model->new_jabatan_ft_id == 0)
                unset($model->new_jabatan_ft_id);
            if ($model->new_jabatan_fu_id == 0)
                unset($model->new_jabatan_fu_id);
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
        $model = PermohonanMutasi::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'permohonan-mutasi-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
//        $session = new CHttpSession;
//        $session->open();
//
//        if (isset($session['PermohonanMutasi_records'])) {
//            $model = $session['PermohonanMutasi_records'];
//        } else
//            $model = PermohonanMutasi::model()->findAll();
//
//
//        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
//                    'model' => $model
//                        ), true)
//        );
    }

}
