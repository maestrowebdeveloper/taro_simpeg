<?php

class PermohonanPerpanjanganHonorerController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("permohonanPerpanjanganHonorer","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("permohonanPerpanjanganHonorer","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("permohonanPerpanjanganHonorer","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("permohonanPerpanjanganHonorer","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionGetNilai() {
        $id = $_POST["id"];
        $nilai = NilaiHonorer::model()->findAll(array('condition' => 'pegawai_id=' . $_POST['id'], 'order' => 'tahun DESC', 'limit' => 5));
        $table = '';
        $table .= ' <fieldset>
                        <legend>Riwayat Nilai SKP</legend>
                    </fieldset>
                    <table class="table table-bordered">
                    <thead>   
                        <tr>
                            <th rowspan="2">Tahun</th>
                            <th rowspan="2">Nomor Register</th>        
                            <th colspan="6">Nilai</th>  
                        </tr>         
                        <tr>
                            <th>Hasil Kerja</th>
                            <th>Orientasi Pelayanan</th>
                            <th>Integritas</th>
                            <th>Disiplin</th>
                            <th>Kerja Sama</th>
                            <th>Kreativitas</th>
                        </tr>
                    </thead>
                    <tbody>';
        if (!empty($nilai)) {
            foreach ($nilai as $val) {
                $table .= '<tr>';
                $table .= '<td>' . $val->tahun . '</td>';
                $table .= '<td>' . $val->no_register . '</td>';
                $table .= '<td>' . $val->nilai_hasil_kerja . '</td>';
                $table .= '<td>' . $val->nilai_orientasi_pelayanan . '</td>';
                $table .= '<td>' . $val->nilai_integritas . '</td>';
                $table .= '<td>' . $val->nilai_disiplin . '</td>';
                $table .= '<td>' . $val->nilai_kerja_sama . '</td>';
                $table .= '<td>' . $val->nilai_kreativitas . '</td>';
                $table .= '</tr>';
            }
        } else {
            $table .= '<tr><td colspan="8">No Data Available</td></tr>';
        }
        $table .= '</tbody>
                    </table>';
        $return['table'] = $table;

        $model = Honorer::model()->findByPk($id);
        $return['id'] = $id;
        $return['nama'] = $model->nama;
        $return['jenis_kelamin'] = $model->jenis_kelamin;
        $return['unit_kerja'] = $model->unitKerja;
        $return['masa_kerja'] = $model->masaKerja;
        $return['tempat_lahir'] = $model->tempat_lahir;
        $return['tanggal_lahir'] = $model->tanggal_lahir;
        $return['kota'] = $model->kota;
        $return['alamat'] = $model->alamat;
        $return['pendidikan_terakhir'] = $model->pendidikan;
//        $return['pendidikan_terakhir'] = "";
        echo json_encode($return);
    }

    public function actionView($id) {
        cs()->registerScript('read', '
                    $("form input, form textarea, form select").each(function(){
                    $(this).prop("disabled", true);
                });');
        $_GET['v'] = true;
        $this->actionUpdate($id);
    }

    public function actionPerpanjang() {
        if (isset($_POST['ceckbox'])) {
            $id = $_POST['ceckbox'];
            if (isset($_POST['perpanjang'])) {
                $model = PermohonanPerpanjanganHonorer::model()->findAll(array('condition' => 'id IN (' . implode(',', $_POST['ceckbox']) . ') and status=0'));
                foreach ($model as $data) {

                    //di honorer tmt mulai dan akhir
                    Honorer::model()->updateAll(array(
                        'tmt_mulai_kontrak' => $data->tmt_mulai,
                        'tmt_akhir_kontrak' => $data->tmt_selesai
                            ), 'id=' . $data->honorer_id);
                    // update statusnya
                    $data->status = 1;
                    $data->save();
                }
                user()->setFlash('confirm', 'Data succes.');
                $this->redirect(array('permohonanPerpanjanganHonorer/index'));
            } else {
                PermohonanPerpanjanganHonorer::model()->deleteAll('id IN (' . implode(',', $_POST['ceckbox']) . ')');
                user()->setFlash('danger', '<strong>Attention! </strong>Data is deleted.');
                $this->redirect(array('permohonanPerpanjanganHonorer/index'));
            }
        } else {
            user()->setFlash('danger', 'Data not selected.');
            $this->redirect(array('permohonanPerpanjanganHonorer/index'));
        }
    }

    public function actionCreate() {
        $model = new PermohonanPerpanjanganHonorer;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['PermohonanPerpanjanganHonorer'])) {
            $model->attributes = $_POST['PermohonanPerpanjanganHonorer'];
//            $honorer = Honorer::model()->findByPk($model->honorer_id);
//            $model->unit_kerja_id = $honorer->unit_kerja_id;
//            $model->masa_kerja = $honorer->masaKerja;
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

        if (isset($_POST['PermohonanPerpanjanganHonorer'])) {
            $model->attributes = $_POST['PermohonanPerpanjanganHonorer'];
//            $honorer = Honorer::model()->findByPk($model->honorer_id);
//            $model->unit_kerja_id = $honorer->unit_kerja_id;
//            $model->masa_kerja = $honorer->masaKerja;
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

        $model = new PermohonanPerpanjanganHonorer('search');
        $model->unsetAttributes();  // clear any default values
        $criteria = new CDbCriteria();

        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            foreach ($_POST['ceckbox'] as $data) {
                $a = $this->loadModel($data);
                if (!empty($a))
                    $a->delete();
            }
        }

        if (isset($_GET['PermohonanPerpanjanganHonorer'])) {
            $model->attributes = $_GET['PermohonanPerpanjanganHonorer'];

            if ($model->honorer_id == 0)
                unset($model->honorer_id);
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
        $model = PermohonanPerpanjanganHonorer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'permohonan-perpanjangan-honorer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {

        $noregister = $_GET['noregister'];
        $tanggal = $_GET['tanggal'];
        $honorer_id = $_GET['honorer_id'];
        $tmt_mulai = $_GET['tmt_mulai'];
        $tmt_selesai = $_GET['tmt_selesai'];

        $criteria = new CDbCriteria;
        if (!empty($noregister))
            $criteria->compare('nomor_register', $noregister, true);
        if (!empty($tanggal))
            $criteria->compare('tanggal', $tanggal, true);
        if (!empty($honorer_id))
            $criteria->compare('honorer_id', $honorer_id);
        if (!empty($tmt_mulai))
            $criteria->compare('tmt_mulai', $tmt_mulai, true);
        if (!empty($tmt_selesai))
            $criteria->compare('tmt_selesai', $tmt_selesai, true);

        $model = PermohonanPerpanjanganHonorer::model()->findAll($criteria);


        Yii::app()->request->sendFile('Data Permohonan Perpanjangan Honorer - ' . date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

}
