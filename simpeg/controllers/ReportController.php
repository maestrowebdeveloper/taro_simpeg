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
            array('allow', // r
                'actions' => array('pensiun'),
                'expression' => 'app()->controller->isValidAccess("laporanPensiun","r")'
            ),
        );
    }

    public function actionUrutKepangkatan() {
        $model = new Pegawai('searchUrutKepangkatan');
        $model->unsetAttributes();
        if (isset($_GET['Pegawai'])) {
            $model->attributes = $_GET['Pegawai'];
        }

        $this->render('urutKepangkatan', array('model' => $model));
    }

    public function actionPegawai() {
        $model = new Pegawai('search2');
        $post = "";
        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
            $post = "1";
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['Pegawai'])) {
                $model->attributes = $_POST['Pegawai'];
                $post = "1";
            }
            $criteria2 = new CDbCriteria();
            $criteria2->with = array('RiwayatPendidikan');
            $criteria2->together = true;
            if (!empty($model->unit_kerja_id) && $model->unit_kerja_id > 0)
                $criteria2->compare('unit_kerja_id', $model->unit_kerja_id);
            if (!empty($model->golongan_id) && $model->golongan_id > 0)
                $criteria2->compare('golongan_id', $model->golongan_id);
            if (!empty($model->kedudukan_id) && $model->kedudukan_id > 0)
                $criteria2->compare('kedudukan_id', $model->kedudukan_id);
            if (!empty($model->tipe_jabatan))
                $criteria2->compare('tipe_jabatan', $model->tipe_jabatan);
            if (isset($_POST['jurusan']) and ! empty($_POST['jurusan'])) {
                $criteria2->compare('RiwayatPendidikan.jurusan', $_POST['jurusan'], true, 'OR');
                $criteria2->compare('RiwayatPendidikan.id_jurusan', $_POST['id_jurusan'], true, 'OR');
            }
            $criteria2->addCondition('t.id = RiwayatPendidikan.pegawai_id');

            if (!empty($model->tmt_pns) && !empty($model->tmt_pensiun))
                $criteria2->addInCondition('tmt_pensiun between "' . $model->tmt_pns . '" and "' . $model->tmt_pensiun . '"');
            $data = Pegawai::model()->findAll($criteria2);
            Yii::app()->request->sendFile('Laporan PNS - ' . date('YmdHis') . '.xls', $this->renderPartial('_pegawai', array(
                        'model' => $data,
                            ), true)
            );
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
        if (isset($_POST['export'])) {
            if (isset($_POST['Honorer'])) {
                $model->attributes = $_POST['Honorer'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Honorer - ' . date('YmdHis') . '.xls', $this->renderPartial('_honorer', array(
                        'model' => $model,
                            ), true)
            );
        }
        $this->render('honorer', array('model' => $model, 'post' => $post));
    }

    public function actionMengikutiPelatihan() {
        $model = new RiwayatPelatihan();
        if (isset($_POST['RiwayatPelatihan'])) {
            $criteria2 = new CDbCriteria();
            $model->attributes = $_POST['RiwayatPelatihan'];
            $model->id = '1';

            if (!empty($model->tahun) && !empty($model->created))
                $criteria2->condition = 'tahun between "' . $model->tahun . '" and "' . $model->created . '"';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['RiwayatPelatihan'])) {
                $model->attributes = $_POST['RiwayatPelatihan'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Riwayat Pelatihan - ' . date('YmdHis') . '.xls', $this->renderPartial('_mengikutiPelatihan', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('mengikutiPelatihan', array('model' => $model));
    }

    public function actionPenerimaPenghargaan() {
        $model = new RiwayatPenghargaan();
        if (isset($_POST['RiwayatPenghargaan'])) {
            $model->attributes = $_POST['RiwayatPenghargaan'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['RiwayatPenghargaan'])) {
                $model->attributes = $_POST['RiwayatPenghargaan'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Penerima Penghargaan - ' . date('YmdHis') . '.xls', $this->renderPartial('_penerimaPenghargaan', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('penerimaPenghargaan', array('model' => $model));
    }

    public function actionPenerimaHukuman() {
        $model = new RiwayatHukuman();
        if (isset($_POST['RiwayatHukuman'])) {
            $model->attributes = $_POST['RiwayatHukuman'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['RiwayatHukuman'])) {
                $model->attributes = $_POST['RiwayatHukuman'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Penerima Hukuman - ' . date('YmdHis') . '.xls', $this->renderPartial('_penerimaHukuman', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('penerimaHukuman', array('model' => $model));
    }

    public function actionSuratMasuk() {
        $model = new SuratMasuk();
        if (isset($_POST['SuratMasuk'])) {
            $model->attributes = $_POST['SuratMasuk'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['SuratMasuk'])) {
                $model->attributes = $_POST['SuratMasuk'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Surat Masuk - ' . date('YmdHis') . '.xls', $this->renderPartial('_suratMasuk', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('suratMasuk', array('model' => $model));
    }

    public function actionSuratKeluar() {
        $model = new SuratKeluar();
        if (isset($_POST['SuratKeluar'])) {
            $model->attributes = $_POST['SuratKeluar'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['SuratKeluar'])) {
                $model->attributes = $_POST['SuratKeluar'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Surat Keluar - ' . date('YmdHis') . '.xls', $this->renderPartial('_suratKeluar', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('suratKeluar', array('model' => $model));
    }

    public function actionPerpanjanganHonorer() {
        $model = new PermohonanPerpanjanganHonorer();
        if (isset($_POST['PermohonanPerpanjanganHonorer'])) {
            $model->attributes = $_POST['PermohonanPerpanjanganHonorer'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['PermohonanPerpanjanganHonorer'])) {
                $model->attributes = $_POST['PermohonanPerpanjanganHonorer'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Permohonan Perpanjangan Honorer - ' . date('YmdHis') . '.xls', $this->renderPartial('_perpanjanganHonorer', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('perpanjanganHonorer', array('model' => $model));
    }

    public function actionIjinBelajar() {
        $model = new PermohonanIjinBelajar();
        if (isset($_POST['PermohonanIjinBelajar'])) {
            $model->attributes = $_POST['PermohonanIjinBelajar'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['PermohonanIjinBelajar'])) {
                $model->attributes = $_POST['PermohonanIjinBelajar'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Permohonan Izin Belajar - ' . date('YmdHis') . '.xls', $this->renderPartial('_ijinBelajar', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('ijinBelajar', array('model' => $model));
    }

    public function actionPermohonanMutasi() {
        $model = new PermohonanMutasi();
        if (isset($_POST['PermohonanMutasi'])) {
            $model->attributes = $_POST['PermohonanMutasi'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['PermohonanMutasi'])) {
                $model->attributes = $_POST['PermohonanMutasi'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan Permohonan Mutasi - ' . date('YmdHis') . '.xls', $this->renderPartial('_permohonanMutasi', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('permohonanMutasi', array('model' => $model));
    }

    public function actionPermohonanPensiun() {
        $model = new PermohonanPensiun();
        if (isset($_POST['PermohonanPensiun'])) {
            $model->attributes = $_POST['PermohonanPensiun'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['PermohonanPensiun'])) {
                $model->attributes = $_POST['PermohonanPensiun'];
                $post = "1";
            }
            Yii::app()->request->sendFile('Laporan PermohonanPensiun - ' . date('YmdHis') . '.xls', $this->renderPartial('_permohonanPensiun', array(
                        'model' => $model,
                        'post', $post
                            ), true)
            );
        }
        $this->render('permohonanPensiun', array('model' => $model));
    }

    public function actionStrukturOrganisasi() {
        $this->layout = "mainWide";
        $model = array();
        if (isset($_POST['exportExcel'])) {
            Yii::app()->request->sendFile('Laporan Struktur Organisasi - ' . date('YmdHis') . '.xls', $this->renderPartial('strukturOrganisasi', array(
                        'model' => $model,
                            ), true)
            );
        }
        $this->render('strukturOrganisasi', array('model' => $model));
    }

    public function actionPensiun() {
        $model = new Pegawai();
        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
            $model->id = '1';
        }
        if (isset($_POST['export'])) {
            if (isset($_POST['Pegawai'])) {
                $model->attributes = $_POST['Pegawai'];
                $model->id = '1';
            }
            Yii::app()->request->sendFile('Laporan Pensiun - ' . date('YmdHis') . '.xls', $this->renderPartial('_pensiun', array(
                        'model' => $model,
//                        'post',$post
                            ), true)
            );
        }
        $this->render('pensiun', array('model' => $model));
    }

    public function actionExcelKepangkatan() {
        $tipe_jabatan = $_GET['tipe_jabatan'];

        $criteria2 = new CDbCriteria();

        $criteria2->together = true;
        $criteria2->addCondition('t.kedudukan_id="1"');
//        $criteria2->with = array('RiwayatPendidikan', 'RiwayatJabatan', 'Pangkat.Golongan');
        $criteria2->with = array('JabatanFt', 'Pangkat.Golongan');

        if (!empty($tipe_jabatan)) {
            if ($tipe_jabatan == "guru") {
                $criteria2->addCondition('JabatanFt.type = "guru"');
            } else {
                $criteria2->addCondition('JabatanFt.type != "guru" OR tipe_jabatan="struktural" OR tipe_jabatan="fungsional_umum" ');
            }
        }

        $model = Pegawai::model()->findAll($criteria2);

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

    public function actionExcelPegawai() {
        $this->render('_pegawai', array());
    }

}
