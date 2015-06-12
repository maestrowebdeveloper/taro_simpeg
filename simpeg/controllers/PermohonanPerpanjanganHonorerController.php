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
        $return['tanggal_lahir'] = date('d-m-Y', strtotime($model->tanggal_lahir));
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
//                    Honorer::model()->updateAll(array(
//                        'tmt_mulai_kontrak' => $data->tmt_mulai,
//                        'tmt_akhir_kontrak' => $data->tmt_selesai
//                            ), 'id=' . $data->honorer_id);
                    $honorer = Honorer::model()->findByPk($data->honorer_id);
                    //save tmt mulai dan akhir
                    $honorer->tmt_mulai_kontrak = $data->tmt_mulai;
                    $honorer->tmt_akhir_kontrak = $data->tmt_selesai;

                    //masa kerja
                    $date1 = explode("-", $honorer->tmt_kontrak);
                    $tmt1 = mktime(0, 0, 0, $date1[1], $date1[2], $date1[0]);

                    $date2 = explode("-", $data->tmt_mulai);
                    $tmt2 = mktime(0, 0, 0, $date2[1], $date2[2], $date2[0]);

                    $tmt_kontrak = date("d-m-Y", $tmt1);
                    $tmt_mulai_kontrak = date("d-m-Y", $tmt2);

                    if (isset($tmt_kontrak) or !empty($tmt_kontrak)) {
                        $perubahan = array();
                        $perubahan['bulan'] = str_replace(" Bulan", "", KenaikanGaji::model()->masaKerja($tmt_kontrak, $tmt_mulai_kontrak, false, true));
                        $perubahan['tahun'] = str_replace(" Tahun", "", KenaikanGaji::model()->masaKerja($tmt_kontrak, $tmt_mulai_kontrak, true));
                        if($perubahan['tahun'] > 10 || $perubahan['bulan'] > 1){
                            $honorer->gaji = 750000;
                            $data->honor_saat_ini = 750000;
                        }else{
                            $honorer->gaji = 725000;
                            $data->honor_saat_ini = 725000;
                        }
                        $honorer->perubahan_masa_kerja = json_encode($perubahan);
                       
                    }
//                    logs($perubahan['tahun']);
                    $honorer->save();


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
            $model->tanggal =date('Y-m-d', strtotime($_POST['PermohonanPerpanjanganHonorer']['tanggal']));
            $model->tmt_mulai =date('Y-m-d', strtotime($_POST['PermohonanPerpanjanganHonorer']['tmt_mulai']));
            $model->tmt_selesai =date('Y-m-d', strtotime($_POST['PermohonanPerpanjanganHonorer']['tmt_selesai']));
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
             $model->tanggal =date('Y-m-d', strtotime($_POST['PermohonanPerpanjanganHonorer']['tanggal']));
            $model->tmt_mulai =date('Y-m-d', strtotime($_POST['PermohonanPerpanjanganHonorer']['tmt_mulai']));
            $model->tmt_selesai =date('Y-m-d', strtotime($_POST['PermohonanPerpanjanganHonorer']['tmt_selesai']));
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
//        $criteria = new CDbCriteria();

        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            foreach ($_POST['ceckbox'] as $data) {
                $a = $this->loadModel($data);
                if (!empty($a))
                    $a->delete();
            }
        }

        if (isset($_GET['PermohonanPerpanjanganHonorer'])) {
            $model->attributes = $_GET['PermohonanPerpanjanganHonorer'];

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

        $model = new PermohonanPerpanjanganHonorer;
        
         $model->attributes = $_GET['PermohonanPerpanjanganHonorer'];
//    
        
        $data = $model->search(true);



        Yii::app()->request->sendFile('Data Permohonan Perpanjangan Honorer - ' . date('YmdHi') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $data
                        ), true)
        );
    }

}
