<?php

class ReportController extends Controller {

    public $breadcrumbs;
    public $layout = 'main';

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // r
                'actions' => array('penerimaHukuman'),
                'expression' => 'app()->controller->isValidAccess("laporanHukumanPegawai","r")'
            ),
            array('allow', // r
                'actions' => array('penerimaPenghargaan'),
                'expression' => 'app()->controller->isValidAccess("laporanPenghargaanPegawai","r")'
            ),
            array('allow', // r
                'actions' => array('mengikutiPelatihan'),
                'expression' => 'app()->controller->isValidAccess("laporanMengikutiPelatihan","r")'
            ),
            array('allow', // r
                'actions' => array('statusJabatan'),
                'expression' => 'app()->controller->isValidAccess("laporanStatusJabatan","r")'
            ),
            array('allow', // r
                'actions' => array('unitSatuanKerja'),
                'expression' => 'app()->controller->isValidAccess("laporanUnitSatuan","r")'
            ),
            array('allow', // r
                'actions' => array('urutKepangkatan'),
                'expression' => 'app()->controller->isValidAccess("laporanUrutanKepangkatan","r")'
            ),
        );
    }

    public function actionUrutKepangkatan() {
        $model = new Pegawai('search');
        $model->unsetAttributes();
        if (isset($_GET['Pegawai'])) {
            $model->attributes = $_GET['Pegawai'];
        }
        $this->render('urutKepangkatan', array('model' => $model));
    }

    public function actionPegawai() {
        $model = new Pegawai();
        $post = "";
        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
            $post = "1";
        }
        $this->render('pegawai', array('model' => $model, 'post' => $post));
    }

    public function actionHonorer() {
        $model = new Honorer();
        $post = "";
        if (isset($_POST['Honorer'])) {
            $model->attributes = $_POST['Honorer'];
            $post = "1";
        }
        $this->render('honorer', array('model' => $model, 'post' => $post));
    }

    public function actionMengikutiPelatihan() {
        $model = new RiwayatPelatihan();
        if (isset($_POST['RiwayatPelatihan'])) {
            $model->attributes = $_POST['RiwayatPelatihan'];
            $model->id = '1';
        }
        $this->render('mengikutiPelatihan', array('model' => $model));
    }

    public function actionMengikutiPelatihanExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['RiwayatPelatihan_records'])) {
            $model = $session['RiwayatPelatihan_records'];
        } else
            $model = RiwayatPelatihan::model()->findAll();

        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('mengikutiPelatihanExcel', array(
                    'model' => $model,
                        ), true)
        );
    }

    public function actionPenerimaPenghargaan() {
        $model = new RiwayatPenghargaan();
        if (isset($_POST['RiwayatPenghargaan'])) {
            $model->attributes = $_POST['RiwayatPenghargaan'];
            $model->id = '1';
        }
        $this->render('penerimaPenghargaan', array('model' => $model));
    }

    public function actionPenerimaPenghargaanExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['RiwayatPenghargaan_records'])) {
            $model = $session['RiwayatPenghargaan_records'];
        } else
            $model = RiwayatPenghargaan::model()->findAll();

        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('penerimaPenghargaanExcel', array(
                    'model' => $model,
                        ), true)
        );
    }

    public function actionPenerimaHukuman() {
        $model = new RiwayatHukuman();
        if (isset($_POST['RiwayatHukuman'])) {
            $model->attributes = $_POST['RiwayatHukuman'];
            $model->id = '1';
        }
        $this->render('penerimaHukuman', array('model' => $model));
    }

    public function actionPenerimaHukumanExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['RiwayatHukuman_records'])) {
            $model = $session['RiwayatHukuman_records'];
        } else
            $model = RiwayatHukuman::model()->findAll();

        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('penerimaHukumanExcel', array(
                    'model' => $model,
                        ), true)
        );
    }

    public function actionSuratMasuk() {
        $model = new SuratMasuk();
        if (isset($_POST['SuratMasuk'])) {
            $model->attributes = $_POST['SuratMasuk'];
            $model->id = '1';
        }
        $this->render('suratMasuk', array('model' => $model));
    }

    public function actionSuratKeluar() {
        $model = new SuratKeluar();
        if (isset($_POST['SuratKeluar'])) {
            $model->attributes = $_POST['SuratKeluar'];
            $model->id = '1';
        }
        $this->render('suratKeluar', array('model' => $model));
    }

    public function actionPerpanjanganHonorer() {
        $model = new PermohonanPerpanjanganHonorer();
        if (isset($_POST['PermohonanPerpanjanganHonorer'])) {
            $model->attributes = $_POST['PermohonanPerpanjanganHonorer'];
            $model->id = '1';
        }
        $this->render('perpanjanganHonorer', array('model' => $model));
    }

    public function actionIjinBelajar() {
        $model = new PermohonanIjinBelajar();
        if (isset($_POST['PermohonanIjinBelajar'])) {
            $model->attributes = $_POST['PermohonanIjinBelajar'];
            $model->id = '1';
        }
        $this->render('ijinBelajar', array('model' => $model));
    }

    public function actionPermohonanMutasi() {
        $model = new PermohonanMutasi();
        if (isset($_POST['PermohonanMutasi'])) {
            $model->attributes = $_POST['PermohonanMutasi'];
            $model->id = '1';
        }
        $this->render('permohonanMutasi', array('model' => $model));
    }

    public function actionPermohonanPensiun() {
        $model = new PermohonanPensiun();
        if (isset($_POST['PermohonanPensiun'])) {
            $model->attributes = $_POST['PermohonanPensiun'];
            $model->id = '1';
        }
        $this->render('permohonanPensiun', array('model' => $model));
    }

    public function actionPensiun() {
        $model = new Pegawai();
        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
            $model->id = '1';
        }
        $this->render('pensiun', array('model' => $model));
    }

    public function actionExcelKepangkatan() {
        $unit_id = $_GET['unit_id'];
        $fu_id = $_GET['fu_id'];
        $ft_id = $_GET['ft_id'];

        $criteria = new CDbCriteria();
        if (!empty($unit_id) && $unit_id != 0) {
            $criteria->addCondition('unit_kerja_id=' . $unit_id);
        }
        if (!empty($fu_id) && $fu_id != 0) {
            $criteria->addCondition('jabatan_fu_id=' . $fu_id);
        }
        if (!empty($ft_id) && $ft_id != 0) {
            $criteria->addCondition('jabatan_ft_id=' . $ft_id);
        }

        $model = Pegawai::model()->findAll($criteria);

        return Yii::app()->request->sendFile('Laporan Daftar Urutan Kepangkatan Pegawai.xls', $this->renderPartial('_urutKepangkatan', array(
                            'model' => $model,
                                ), true)
        );
    }

    public function actionGetPendidikan() {
        $name = $_GET['term'];
        $jurusan = Jurusan::model()->findAll(array('condition' => 'Name like "%' . $name . '%"', 'limit' => '10'));
        $source = array();
        foreach ($jurusan as $val) {
            $source[] = array(
                'item_id' => $val->id,
                'label' => $val->Name,
                'value' => $val->Name,
            );
        }
        echo CJSON::encode($source);
    }

}
