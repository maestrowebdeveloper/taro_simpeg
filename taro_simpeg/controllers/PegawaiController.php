<?php

class PegawaiController extends Controller {

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
                'expression' => 'app()->controller->isValidAccess("pegawai","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("pegawai","r")'
            ),
            array('allow', // u
                'actions' => array('index', 'update'),
                'expression' => 'app()->controller->isValidAccess("pegawai","u")'
            ),
            array('allow', // d
                'actions' => array('index', 'delete'),
                'expression' => 'app()->controller->isValidAccess("pegawai","d")'
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function cssJs() {
        cs()->registerScript('', '  
    
    $("#myTab a").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    })

    $("#Pegawai_tipe_jabatan_0").click(function(event) { 
      $(".struktural").show();
      $(".fungsional_umum").hide();            
      $(".fungsional_tertentu").hide();   
      $("#s2id_Pegawai_jabatan_ft_id").select2("val", "0") ;           
      $("#s2id_Pegawai_jabatan_fu_id").select2("val", "0") ; 
      $("#Pegawai_tmt_jabatan_fu").val("");            
      $("#Pegawai_tmt_jabatan_ft").val("");           
      $("#eselon").val("-");
      $("#masa_kerja").val("0");
    });

    $("#Pegawai_tipe_jabatan_1").click(function(event) { 
      $(".struktural").hide();
      $(".fungsional_umum").show();            
      $(".fungsional_tertentu").hide(); 
      $("#s2id_Pegawai_jabatan_ft_id").select2("val", "0") ;           
      $("#s2id_Pegawai_jabatan_struktural_id").select2("val", "0") ;  
      $("#Pegawai_tmt_jabatan_ft").val("");            
      $("#Pegawai_tmt_jabatan_struktural").val("");
      $("#eselon").val("-");
      $("#masa_kerja").val("0");
    });

    $("#Pegawai_tipe_jabatan_2").click(function(event) { 
      $(".struktural").hide();
      $(".fungsional_umum").hide();            
      $(".fungsional_tertentu").show();   
      $("#s2id_Pegawai_jabatan_struktural_id").select2("val", "0") ;           
      $("#s2id_Pegawai_jabatan_fu_id").select2("val", "0") ;  
      $("#Pegawai_tmt_jabatan_fu").val("");            
      $("#Pegawai_tmt_jabatan_struktural").val("");                    
      $("#eselon").val("-");
      $("#masa_kerja").val("0");
    });
   

    ');
    }

    public function actionGetDetail() {
        $id = $_POST["id"];
        $model = Pegawai::model()->findByPk($id);
        $return['id'] = $id;
        $return['nama'] = $model->namaGelar;
        $return['jenis_kelamin'] = $model->jenis_kelamin;
        $return['jabatan'] = $model->jabatan;
        $return['tipe_jabatan'] = $model->tipe;
        $return['unit_kerja'] = $model->unitKerja;
        $return['masa_kerja'] = $model->masaKerja;
        $return['tempat_lahir'] = $model->tempat_lahir;
        $return['tanggal_lahir'] = $model->tanggal_lahir;
        echo json_encode($return);
    }

    public function actionGetPangkat() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatPangkat::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formPangkat', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formPangkat', array('model' => new RiwayatPangkat, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeletePangkat() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatPangkat::model()->findByPk($id)->delete();
        $pangkat = RiwayatPangkat::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tmt_pangkat DESC'));
        echo $this->renderPartial('/pegawai/_tablePangkat', array('pangkat' => $pangkat, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSavePangkat() {
        if (isset($_POST['RiwayatPangkat'])) {
            if (empty($_POST['RiwayatPangkat']['id']))
                $model = new RiwayatPangkat;
            else
                $model = RiwayatPangkat::model()->findByPk($_POST['RiwayatPangkat']['id']);

            $model->attributes = $_POST['RiwayatPangkat'];
            $golongan = Golongan::model()->findByPk($model->golongan_id);
            $model->nama_golongan = $golongan->golongan;
            if ($model->save()) {
                $pangkat = RiwayatPangkat::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tmt_pangkat DESC'));
                echo $this->renderPartial('/pegawai/_tablePangkat', array('pangkat' => $pangkat, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    public function actionGetJabatan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatJabatan::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formJabatan', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formJabatan', array('model' => new RiwayatJabatan, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeleteJabatan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatJabatan::model()->findByPk($id)->delete();
        $jabatan = RiwayatJabatan::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tmt_mulai DESC'));
        echo $this->renderPartial('/pegawai/_tableJabatan', array('jabatan' => $jabatan, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSaveJabatan() {
        if (isset($_POST['RiwayatJabatan'])) {
            if (empty($_POST['RiwayatJabatan']['id']))
                $model = new RiwayatJabatan;
            else
                $model = RiwayatJabatan::model()->findByPk($_POST['RiwayatJabatan']['id']);

            $model->attributes = (isset($_POST['RiwayatJabatan']))?$_POST['RiwayatJabatan']:'';
            $model->tipe_jabatan = (isset($_POST['RiwayatJabatan']['tipe_jabatan']))?$_POST['RiwayatJabatan']['tipe_jabatan']:'';
            $model->jabatan_struktural_id = (isset($_POST['RiwayatJabatan']['jabatan_struktural_id']))?$_POST['RiwayatJabatan']['jabatan_struktural_id']:'';
            $model->jabatan_fu_id = (isset($_POST['RiwayatJabatan']['jabatan_fu_id']))?$_POST['RiwayatJabatan']['jabatan_fu_id']:'';
            $model->jabatan_ft_id = (isset($_POST['RiwayatJabatan']['jabatan_ft_id']))?$_POST['RiwayatJabatan']['jabatan_ft_id']:'';
            if ($model->save()) {
                $jabatan = RiwayatJabatan::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tmt_mulai DESC'));
                echo $this->renderPartial('/pegawai/_tableJabatan', array('jabatan' => $jabatan, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }            
        }
    }

    public function actionGetGajiPokok() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatGaji::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formGaji', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formGaji', array('model' => new RiwayatGaji, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeleteGajiPokok() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatGaji::model()->findByPk($id)->delete();
        $gaji = RiwayatGaji::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tmt_mulai DESC'));
        echo $this->renderPartial('/pegawai/_tableGaji', array('gaji' => $gaji, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSaveGajiPokok() {
        if (isset($_POST['RiwayatGaji'])) {
            if (empty($_POST['RiwayatGaji']['id']))
                $model = new RiwayatGaji;
            else
                $model = RiwayatGaji::model()->findByPk($_POST['RiwayatGaji']['id']);

            $model->attributes = $_POST['RiwayatGaji'];
            if ($model->save()) {
                $gaji = RiwayatGaji::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tmt_mulai DESC'));
                echo $this->renderPartial('/pegawai/_tableGaji', array('gaji' => $gaji, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    public function actionGetKeluarga() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatKeluarga::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formKeluarga', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formKeluarga', array('model' => new RiwayatKeluarga, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeleteKeluarga() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatKeluarga::model()->findByPk($id)->delete();
        $keluarga = RiwayatKeluarga::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'hubungan DESC'));
        echo $this->renderPartial('/pegawai/_tableKeluarga', array('keluarga' => $keluarga, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSaveKeluarga() {
        if (isset($_POST['RiwayatKeluarga'])) {
            if (empty($_POST['RiwayatKeluarga']['id']))
                $model = new RiwayatKeluarga;
            else
                $model = RiwayatKeluarga::model()->findByPk($_POST['RiwayatKeluarga']['id']);

            $model->attributes = $_POST['RiwayatKeluarga'];

            if ($model->hubungan == "anak") {
                $model->nomor_karsu = "-";
                $model->tanggal_pernikahan = "-";
                $model->status = "-";
            } else {
                $model->anak_ke = "-";
                $model->status_anak = "-";
            }

            if ($model->save()) {
                $keluarga = RiwayatKeluarga::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'hubungan DESC'));
                echo $this->renderPartial('/pegawai/_tableKeluarga', array('keluarga' => $keluarga, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    public function actionGetPendidikan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatPendidikan::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formPendidikan', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formPendidikan', array('model' => new RiwayatPendidikan, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeletePendidikan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatPendidikan::model()->findByPk($id)->delete();
        $pendidikan = RiwayatPendidikan::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tahun DESC'));
        echo $this->renderPartial('/pegawai/_tablePendidikan', array('pendidikan' => $pendidikan, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSavePendidikan() {
        if (isset($_POST['RiwayatPendidikan'])) {
            if (empty($_POST['RiwayatPendidikan']['id']))
                $model = new RiwayatPendidikan;
            else
                $model = RiwayatPendidikan::model()->findByPk($_POST['RiwayatPendidikan']['id']);

            $model->attributes = $_POST['RiwayatPendidikan'];
            if ($model->save()) {
                $pendidikan = RiwayatPendidikan::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tahun DESC'));
                echo $this->renderPartial('/pegawai/_tablePendidikan', array('pendidikan' => $pendidikan, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    public function actionGetPelatihan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatPelatihan::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formPelatihan', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formPelatihan', array('model' => new RiwayatPelatihan, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeletePelatihan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatPelatihan::model()->findByPk($id)->delete();
        $pelatihan = RiwayatPelatihan::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tanggal DESC'));
        echo $this->renderPartial('/pegawai/_tablePelatihan', array('pelatihan' => $pelatihan, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSavePelatihan() {
        if (isset($_POST['RiwayatPelatihan'])) {
            if (empty($_POST['RiwayatPelatihan']['id']))
                $model = new RiwayatPelatihan;
            else
                $model = RiwayatPelatihan::model()->findByPk($_POST['RiwayatPelatihan']['id']);

            $model->attributes = $_POST['RiwayatPelatihan'];

            if ($model->save()) {
                $pelatihan = RiwayatPelatihan::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tanggal DESC'));
                echo $this->renderPartial('/pegawai/_tablePelatihan', array('pelatihan' => $pelatihan, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    public function actionGetPenghargaan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatPenghargaan::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formPenghargaan', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formPenghargaan', array('model' => new RiwayatPenghargaan, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeletePenghargaan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatPenghargaan::model()->findByPk($id)->delete();
        $penghargaan = RiwayatPenghargaan::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tanggal_pemberian DESC'));
        echo $this->renderPartial('/pegawai/_tablePenghargaan', array('penghargaan' => $penghargaan, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSavePenghargaan() {
        if (isset($_POST['RiwayatPenghargaan'])) {
            if (empty($_POST['RiwayatPenghargaan']['id']))
                $model = new RiwayatPenghargaan;
            else
                $model = RiwayatPenghargaan::model()->findByPk($_POST['RiwayatPenghargaan']['id']);

            $model->attributes = $_POST['RiwayatPenghargaan'];

            if ($model->save()) {
                $penghargaan = RiwayatPenghargaan::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tanggal_pemberian DESC'));
                echo $this->renderPartial('/pegawai/_tablePenghargaan', array('penghargaan' => $penghargaan, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    public function actionGetHukuman() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatHukuman::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formHukuman', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formHukuman', array('model' => new RiwayatHukuman, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeleteHukuman() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatHukuman::model()->findByPk($id)->delete();
        $hukuman = RiwayatHukuman::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tanggal_pemberian DESC'));
        echo $this->renderPartial('/pegawai/_tableHukuman', array('hukuman' => $hukuman, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSaveHukuman() {
        if (isset($_POST['RiwayatHukuman'])) {
            if (empty($_POST['RiwayatHukuman']['id']))
                $model = new RiwayatHukuman;
            else
                $model = RiwayatHukuman::model()->findByPk($_POST['RiwayatHukuman']['id']);

            $model->attributes = $_POST['RiwayatHukuman'];

            if ($model->save()) {
                $hukuman = RiwayatHukuman::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tanggal_pemberian DESC'));
                echo $this->renderPartial('/pegawai/_tableHukuman', array('hukuman' => $hukuman, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    public function actionUpload() {

        $id = $_GET['id'];
        Yii::import("common.extensions.EAjaxUpload.qqFileUploader");
        $folder = 'images/file/' . $id . '/'; // folder for uploaded files             
        if (!file_exists($folder))
            mkdir($folder, '777');
        $allowedExtensions = array("jpg", "jpeg", "gif", "png", "gif", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "zip", "rar"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 7 * 1024 * 1024;
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        $model = new File;
        $model->pegawai_id = $_GET['id'];
        $model->nama = ($result['filename']);
        $model->save();
        echo $return; // it's array
    }

    public function actionDeleteFile() {

        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $model = File::model()->findByPk($id);
        if (!empty($model)) {
            $file = 'images/file/' . $model->pegawai_id . '/' . $model->nama;
            if (file_exists($file))
                unlink($file);
            $model->delete();
            echo $id;
        }
    }

    public function actionRemovephoto($id) {
        Pegawai::model()->updateByPk($id, array('foto' => NULL));
    }

    public function actionUlangTahun() {
        $model = new Pegawai('search');
        $honorer = new Honorer('search');
        $model->unsetAttributes();  // clear any default values
        $honorer->unsetAttributes();  // clear any default values
        $this->render('ulangTahun', array(
            'model' => $model,
            'honorer' => $honorer,
        ));
    }

    public function actionUlangTahunExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Pegawai_records'])) {
            $model = $session['Pegawai_records'];
        } else
            $model = Pegawai::model()->findAll();

        if (isset($session['Honorer_records'])) {
            $honorer = $session['Honorer_records'];
        } else
            $honorer = Honorer::model()->findAll();

        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelUlangTahun', array(
                    'model' => $model,
                    'honorer' => $honorer,
                        ), true)
        );
    }

    public function actionCheckError() {
        $model = new Pegawai('search');
        $model->unsetAttributes();  // clear any default values
        $this->render('checkError', array(
            'model' => $model,
        ));
    }

    public function actionImportData() {    
        $model = new Pegawai('search');
        $model->unsetAttributes();  // clear any default values  
        $this->render('importDataPegawai', array(    
            'model' => $model,        
        ));
    }

    public function actionCheckErrorExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Pegawai_records'])) {
            $model = $session['Pegawai_records'];
        } else
            $model = Pegawai::model()->findAll();

        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelCheckError', array(
                    'model' => $model,
                        ), true)
        );
    }

    public function actionStatusJabatan() {
        $data['masa_kerja'] = 0;
        $data['eselon'] = '';
        $tipe = (!empty($_POST['Pegawai']['tipe_jabatan'])) ? $_POST['Pegawai']['tipe_jabatan'] : '';
        if ($tipe == "struktural") {
            $model = JabatanStruktural::model()->findByPk($_POST['Pegawai']['jabatan_struktural_id']);
            $data['eselon'] = isset($model->Eselon->nama) ? $model->Eselon->nama : '-';
            $data['masa_kerja'] = isset($model->Eselon->masa_kerja) ? $model->Eselon->masa_kerja : 0;
        } elseif ($tipe == "fungsional_umum") {
            $model = JabatanFu::model()->findByPk($_POST['Pegawai']['jabatan_fu_id']);
        } elseif ($tipe == "fungsional_tertentu") {
            $model = JabatanFt::model()->findByPk($_POST['Pegawai']['jabatan_ft_id']);
        }
        if (!empty($model)) {
            $data['status'] = $model->status;
            echo json_encode($data);
        }
    }

    public function actionFungsionalTertentu() {
        $data = JabatanFungsional::model()->with('DetailJf')->find(array('condition' => 't.jabatan_ft_id = ' . $_POST['Pegawai']['jabatan_ft_id'] . ' and DetailJf.golongan_id = ' . $_POST['Pegawai']['golongan_id']));
        $tmp = isset($data->nama) ? $data->nama : '-';
        echo $tmp;
//        $data = JabatanFungsional::model()->with('DetailJf')->find();
//        echo $data->nama;
//        $jabatan = JabatanFt::model()->find(array('condition' => 'jabatan_ft_id=' . $_POST['Pegawai']['jabatan_ft_id']));
//        echo $_POST['Pegawai']['golongan_id']. ;
    }

    public function actionRiwayatStatusJabatan() {
        $data['masa_kerja'] = 0;
        $data['eselon'] = '';
        $tipe = (!empty($_POST['RiwayatJabatan']['tipe_jabatan'])) ? $_POST['RiwayatJabatan']['tipe_jabatan'] : '';
        if ($tipe == "struktural") {
            $model = JabatanStruktural::model()->findByPk($_POST['RiwayatJabatan']['jabatan_struktural_id']);
            $data['eselon'] = isset($model->Eselon->nama) ? $model->Eselon->nama : '-';
            $data['masa_kerja'] = isset($model->Eselon->masa_kerja) ? $model->Eselon->masa_kerja : 0;
        } elseif ($tipe == "fungsional_umum") {
            $model = JabatanFu::model()->findByPk($_POST['RiwayatJabatan']['jabatan_fu_id']);
        } elseif ($tipe == "fungsional_tertentu") {
            $model = JabatanFt::model()->findByPk($_POST['RiwayatJabatan']['jabatan_ft_id']);
        }
        if (!empty($model)) {
            $data['status'] = $model->status;
            echo json_encode($data);
        }
    }

    public function actionSearchJson() {
        $user = (empty(Yii::app()->session['searchPegawai'])) ? Pegawai::model()->findAll(array('condition' => 'nama like "%' . $_POST['queryString'] . '%"')) : Yii::app()->session['searchPegawai'];
        $results = array();
        foreach ($user as $no => $o) {
            $results[$no]['url'] = url('pegawai/' . $o->id);
            $results[$no]['img'] = $o->imgUrl['small'];
            $results[$no]['title'] = $o->nama;
            $results[$no]['description'] = $o->golongan . '<br/>' . $o->jabatan;
        }
        echo json_encode($results);
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
        $model = new Pegawai;


        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Pegawai'])) {

            $model->attributes = $_POST['Pegawai'];
            $model->tmt_cpns = $_POST['Pegawai']['tmt_cpns'];
            $model->tmt_jabatan_struktural = $_POST['Pegawai']['tmt_jabatan_struktural'];
            $model->tmt_jabatan_fu = $_POST['Pegawai']['tmt_jabatan_fu'];
            $model->tmt_jabatan_ft = $_POST['Pegawai']['tmt_jabatan_ft'];
            $model->tmt_eselon = $_POST['Pegawai']['tmt_eselon'];
            $model->tanggal_lahir = $_POST['Pegawai']['tanggal_lahir'];
            $model->kota = $_POST['kota'];
            $model->tempat_lahir = $_POST['tempat_lahir'];

            $file = CUploadedFile::getInstance($model, 'foto');
            if (is_object($file)) {
                $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
            } else {
                unset($model->foto);
            }

            if ($model->tipe_jabatan == "struktural") {
                $model->jabatan_fu_id = "";
                $model->tmt_jabatan_fu = "";
                $model->jabatan_ft_id = "";
                $model->tmt_jabatan_ft = "";
                $jabatan = JabatanStruktural::model()->findByPk($model->jabatan_struktural_id);
            } elseif ($model->tipe_jabatan == "fungsional_umum") {
                $model->jabatan_ft_id = "";
                $model->tmt_jabatan_ft = "";
                $model->jabatan_struktural_id = "";
                $model->tmt_jabatan_struktural = "";
                $jabatan = JabatanFu::model()->findByPk($model->jabatan_fu_id);
            } elseif ($model->tipe_jabatan == "fungsional_tertentu") {
                $model->jabatan_fu_id = "";
                $model->tmt_jabatan_fu = "";
                $model->jabatan_struktural_id = "";
                $model->tmt_jabatan_struktural = "";
                $jabatan = JabatanFt::model()->findByPk($model->jabatan_ft_id);
            }


            if ($model->save()) {
                if (!empty($jabatan)) {
                    $jabatan->status = 1;
                    $jabatan->saveNode();
                }
                if (is_object($file)) {
                    $file->saveAs('images/pegawai/' . $model->foto);
                    Yii::app()->landa->createImg('pegawai/', $model->foto, $model->id);
                }
                $this->redirect(array('update', 'id' => $model->id));
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

        if (isset($_POST['Pegawai'])) {

            if ($model->tipe_jabatan == "struktural") {
                $jabatan = JabatanStruktural::model()->findByPk($model->jabatan_struktural_id);
            } elseif ($model->tipe_jabatan == "fungsional_umum") {
                $jabatan = JabatanFu::actioninmodel()->findByPk($model->jabatan_fu_id);
            } elseif ($model->tipe_jabatan == "fungsional_tertentu") {
                $jabatan = JabatanFt::model()->findByPk($model->jabatan_ft_id);
            }
            if (!empty($jabatan)) {
                $jabatan->status = 0;
                $jabatan->saveNode();
                $jabatan = "";
            }



            $model->attributes = $_POST['Pegawai'];
            $model->tmt_jabatan_struktural = $_POST['Pegawai']['tmt_jabatan_struktural'];
            $model->tmt_jabatan_fu = $_POST['Pegawai']['tmt_jabatan_fu'];
            $model->tmt_jabatan_ft = $_POST['Pegawai']['tmt_jabatan_ft'];
            $model->tmt_eselon = $_POST['Pegawai']['tmt_eselon'];
            $model->tanggal_lahir = $_POST['Pegawai']['tanggal_lahir'];
            $model->kota = $_POST['kota'];
            $model->tempat_lahir = $_POST['tempat_lahir'];


            $file = CUploadedFile::getInstance($model, 'foto');
            if (is_object($file)) {
                $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
            } else {
                unset($model->foto);
            }

            if ($model->tipe_jabatan == "struktural") {
                $model->jabatan_fu_id = "";
                $model->tmt_jabatan_fu = "";
                $model->jabatan_ft_id = "";
                $model->tmt_jabatan_ft = "";
                $jabatan = JabatanStruktural::model()->findByPk($model->jabatan_struktural_id);
            } elseif ($model->tipe_jabatan == "fungsional_umum") {
                $model->jabatan_ft_id = "";
                $model->tmt_jabatan_ft = "";
                $model->jabatan_struktural_id = "";
                $model->tmt_jabatan_struktural = "";
                $jabatan = JabatanFu::model()->findByPk($model->jabatan_fu_id);
            } elseif ($model->tipe_jabatan == "fungsional_tertentu") {
                $model->jabatan_fu_id = "";
                $model->tmt_jabatan_fu = "";
                $model->jabatan_struktural_id = "";
                $model->tmt_jabatan_struktural = "";
                $jabatan = JabatanFt::model()->findByPk($model->jabatan_ft_id);
            }


            if ($model->save()) {
                if (!empty($jabatan)) {
                    $jabatan->status = 1;
                    $jabatan->saveNode();
                }
                $file = CUploadedFile::getInstance($model, 'foto');
                if (is_object($file)) {
                    $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
                    $file->saveAs('images/pegawai/' . $model->foto);
                    Yii::app()->landa->createImg('pegawai/', $model->foto, $model->id);
                }
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
            RiwayatPangkat::model()->deleteAll('pegawai_id=' . $id);
            RiwayatJabatan::model()->deleteAll('pegawai_id=' . $id);
            RiwayatGaji::model()->deleteAll('pegawai_id=' . $id);
            RiwayatKeluarga::model()->deleteAll('pegawai_id=' . $id);
            RiwayatPendidikan::model()->deleteAll('pegawai_id=' . $id);
            RiwayatPelatihan::model()->deleteAll('pegawai_id=' . $id);
            RiwayatPenghargaan::model()->deleteAll('pegawai_id=' . $id);
            RiwayatHukuman::model()->deleteAll('pegawai_id=' . $id);

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
        $model = new Pegawai('search');
        $model->unsetAttributes();  // clear any default values
        $criteria = new CDbCriteria();
        if (isset($_GET['Pegawai'])) {
            $model->attributes = $_GET['Pegawai'];
            if ($model->tempat_lahir == 0)
                unset($model->tempat_lahir);
            if ($model->kota == 0)
                unset($model->kota);
            if ($model->kedudukan_id == 0)
                unset($model->kedudukan_id);
            if ($model->unit_kerja_id == 0)
                unset($model->unit_kerja_id);
            if ($model->golongan_id == 0)
                unset($model->golongan_id);
            if ($model->jabatan_struktural_id == 0)
                unset($model->jabatan_struktural_id);
            if ($model->jabatan_fu_id == 0)
                unset($model->jabatan_fu_id);
            if ($model->jabatan_ft_id == 0)
                unset($model->jabatan_ft_id);
        }

        $this->cssJs();
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            foreach ($_POST['ceckbox'] as $data) {
                $this->loadModel($data)->delete();
                RiwayatPangkat::model()->deleteAll('pegawai_id=' . $id);
                RiwayatJabatan::model()->deleteAll('pegawai_id=' . $id);
                RiwayatGaji::model()->deleteAll('pegawai_id=' . $id);
                RiwayatKeluarga::model()->deleteAll('pegawai_id=' . $id);
                RiwayatPendidikan::model()->deleteAll('pegawai_id=' . $id);
                RiwayatPelatihan::model()->deleteAll('pegawai_id=' . $id);
                RiwayatPenghargaan::model()->deleteAll('pegawai_id=' . $id);
                RiwayatHukuman::model()->deleteAll('pegawai_id=' . $id);
            }
        }


        $this->render('index', array(
            'model' => $model,
        ));
    }

    public function actionRekap() {
        $model = new Pegawai;
        $model->unsetAttributes();  // clear any default values  
        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
        }
        $this->cssJs();
        $this->render('rekap', array(
            'model' => $model,
        ));
    }

    public function actionRekapExcel() {

        $session = new CHttpSession;
        $session->open();
        $model = (isset($session['RekapExcel_records'])) ? $session['RekapExcel_records'] : array();
        $unit_kerja = (isset($session['RekapUnitKerjaExcel_records'])) ? $session['RekapUnitKerjaExcel_records'] : "-";


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('rekapExcel', array(
                    'model' => $model, 'unit_kerja' => $unit_kerja,
                        ), true)
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Pegawai::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'pegawai-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGenerateExcel() {
//        $session = new CHttpSession;
//        $session->open();
//
//        if (isset($session['Pegawai_records'])) {
//            $model = $session['Pegawai_records'];
//        } else
            $model = Pegawai::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelReport', array(
                    'model' => $model
                        ), true)
        );
    }

    //-----------------------------------------------------------------------------------
    public function actionCariRiwayatPangkat() {

        $criteria = new CDbCriteria();
        $model = new RiwayatPangkat('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['RiwayatPangkat'])) {
            $model->attributes = $_GET['RiwayatPangkat'];
        }
        $this->render('cariRiwayatPangkat', array('model' => $model,));
    }

    public function actionCariRiwayatPangkatExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['RiwayatPangkat_records'])) {
            $model = $session['RiwayatPangkat_records'];
        } else
            $model = RiwayatPangkat::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelRiwayatPangkat', array(
                    'model' => $model
                        ), true)
        );
    }

    //-----------------------------------------------------------------------------------
    public function actionCariRiwayatJabatan() {

        $criteria = new CDbCriteria();
        $model = new RiwayatJabatan('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['RiwayatJabatan'])) {
            $model->attributes = $_GET['RiwayatJabatan'];
        }
        $this->render('cariRiwayatJabatan', array('model' => $model,));
    }

    public function actionCariRiwayatJabatanExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['RiwayatJabatan_records'])) {
            $model = $session['RiwayatJabatan_records'];
        } else
            $model = RiwayatJabatan::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelRiwayatJabatan', array(
                    'model' => $model
                        ), true)
        );
    }

    //-----------------------------------------------------------------------------------
    public function actionCariRiwayatGaji() {

        $criteria = new CDbCriteria();
        $model = new RiwayatGaji('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['RiwayatGaji'])) {
            $model->attributes = $_GET['RiwayatGaji'];
        }
        $this->render('cariRiwayatGaji', array('model' => $model,));
    }

    public function actionCariRiwayatGajiExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['RiwayatGaji_records'])) {
            $model = $session['RiwayatGaji_records'];
        } else
            $model = RiwayatGaji::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelRiwayatGaji', array(
                    'model' => $model
                        ), true)
        );
    }

    //-----------------------------------------------------------------------------------
    public function actionCariRiwayatKeluarga() {

        $criteria = new CDbCriteria();
        $model = new RiwayatKeluarga('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['RiwayatKeluarga'])) {
            $model->attributes = $_GET['RiwayatKeluarga'];
        }
        $this->render('cariRiwayatKeluarga', array('model' => $model,));
    }

    public function actionCariRiwayatKeluargaExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['RiwayatKeluarga_records'])) {
            $model = $session['RiwayatKeluarga_records'];
        } else
            $model = RiwayatKeluarga::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelRiwayatKeluarga', array(
                    'model' => $model
                        ), true)
        );
    }

    //-----------------------------------------------------------------------------------
    public function actionCariRiwayatPendidikan() {

        $criteria = new CDbCriteria();
        $model = new RiwayatPendidikan('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['RiwayatPendidikan'])) {
            $model->attributes = $_GET['RiwayatPendidikan'];
        }
        $this->render('cariRiwayatPendidikan', array('model' => $model,));
    }

    public function actionCariRiwayatPendidikanExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['RiwayatPendidikan_records'])) {
            $model = $session['RiwayatPendidikan_records'];
        } else
            $model = RiwayatPendidikan::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHis') . '.xls', $this->renderPartial('excelRiwayatPendidikan', array(
                    'model' => $model
                        ), true)
        );
    }

}
