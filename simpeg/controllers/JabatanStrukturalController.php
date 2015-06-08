<?php

class JabatanStrukturalController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("jabatanStruktural","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("jabatanStruktural","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("jabatanStruktural","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("jabatanStruktural","d")'
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

    public function actionGetUnitKerja() {
        $name = $_GET["q"];
        $data = array();
        $pegawai = JabatanStruktural::model()->findAll(array('condition' => 'nama like "%' . $name . '%"', 'limit' => 15));
        if (empty($pegawai)) {
            $data[] = array('id' => '0', 'text' => 'Tidak Ada Nama Yang Cocok');
        } else {
            foreach ($pegawai as $val) {
                $data[] = array('id' => $val->id, 'text' => $val->nama);
            }
        }
        echo json_encode($data);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new JabatanStruktural;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);


        if (isset($_POST['JabatanStruktural'])) {
            if ($_POST['JabatanStruktural']['parent_id']) {
                $child = new JabatanStruktural;
                $child->attributes = $_POST['JabatanStruktural'];

                $root = $model->findByPk($_POST['JabatanStruktural']['parent_id']);
                if ($child->appendTo($root))
                    $this->redirect(array('view', 'id' => $child->id));
            }else {
                $model->attributes = $_POST['JabatanStruktural'];
                if ($model->saveNode())
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionMigration() {
//        echo empty(NULL);
        JabatanStruktural::model()->deleteAll();

        $var = cmd("SELECT * FROM temp ORDER BY id")->query();
        foreach ($var as $val) {
            if (empty($val['maju'])) { //0, null, ''
                $model = new JabatanStruktural;
                $model->id = $val['id'];
                $model->nama = $val['name'];
                $model->jabatan = $val['jabatan'];
                $model->unit_kerja_id = $val['unit_kerja_id'];
                $model->eselon_id = $val['eselon_id'];
                $model->parent_id = 0;
                $model->saveNode();
                $parent = $val['id'];
            } elseif ($val['maju'] == 1) {
                $child = new JabatanStruktural;
                $child->id = $val['id'];
                $child->nama = $val['name'];
                $child->jabatan = $val['jabatan'];
                $child->unit_kerja_id = $val['unit_kerja_id'];
                $child->eselon_id = $val['eselon_id'];
                $child->parent_id = $parent;
                $root = JabatanStruktural::model()->findByPk($parent);
                echo (empty($root)) ? '-----' . $parent : '';
                $child->appendTo($root);
////
                $parent_1 = $val['id'];
            } elseif ($val['maju'] == 2) {
                $child = new JabatanStruktural;
                $child->id = $val['id'];
                $child->nama = $val['name'];
                $child->jabatan = $val['jabatan'];
                $child->unit_kerja_id = $val['unit_kerja_id'];
                $child->eselon_id = $val['eselon_id'];
                $child->parent_id = $parent_1;
                $root = JabatanStruktural::model()->findByPk($parent_1);
                echo (empty($root)) ? '-----' . $parent_1 : '';
                $child->appendTo($root);
            } else {
//                echo $val['id'] ;
            }
//            echo "-----" . $val['id'] . "-----" . $val['name'] . '-----' . $val['maju'] . '-----' . $val['ordering'];
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


        if (isset($_POST['JabatanStruktural'])) {
            if ($_POST['JabatanStruktural']['parent_id']) {
                $model->attributes = $_POST['JabatanStruktural'];
                if ($model->saveNode()) {
                    $root = $model->findByPk($_POST['JabatanStruktural']['parent_id']);
                    $model->moveAsFirst($root);
                    $this->redirect(array('view', 'id' => $model->id));
                }
            } else {
                $model->attributes = $_POST['JabatanStruktural'];
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
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            foreach ($_POST['ceckbox'] as $data) {
                $a = JabatanStruktural::model()->findByPk($data);
                if (!empty($a))
                    $a->deleteNode();
            }
        }

        $criteria = new CDbCriteria();
        $model = new JabatanStruktural('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['JabatanStruktural'])) {
            $model->attributes = $_GET['JabatanStruktural'];


            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');


            if (!empty($model->nama))
                $criteria->addCondition('nama = "' . $model->nama . '"');


            if (!empty($model->keterangan))
                $criteria->addCondition('keterangan = "' . $model->keterangan . '"');


            if (!empty($model->unit_kerja_id))
                $criteria->addCondition('unit_kerja_id = "' . $model->unit_kerja_id . '"');


            if (!empty($model->eselon_id))
                $criteria->addCondition('eselon_id = "' . $model->eselon_id . '"');


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
        $model = JabatanStruktural::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'jabatan-struktural-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

//	public function actionGenerateExcel() {
//        $session = new CHttpSession;
//        $session->open();
//
//        if (isset($session['JabatanStruktural_records'])) {
//            $model = $session['JabatanStruktural_records'];
//        } else
//            $model = JabatanStruktural::model()->findAll();
//
//
//        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelReport', array(
//                    'model' => $model
//                        ), true)
//        );
//    }
}
