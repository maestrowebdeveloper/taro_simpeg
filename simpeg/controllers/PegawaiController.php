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
                'actions' => array('create'),
                'expression' => 'app()->controller->isValidAccess("pegawai","c")'
            ),
            array('allow', // r
                'actions' => array('index', 'view'),
                'expression' => 'app()->controller->isValidAccess("pegawai","r")'
            ),
            array('allow', // u
                'actions' => array('update'),
                'expression' => 'app()->controller->isValidAccess("pegawai","u")'
            ),
            array('allow', // d
                'actions' => array('delete'),
                'expression' => 'app()->controller->isValidAccess("pegawai","d")'
            ),
            array('allow', // d
                'actions' => array('rekap'),
                'expression' => 'app()->controller->isValidAccess("rekapPegawai","r")'
            ),
            array('allow', // d
                'actions' => array('rekapEselon'),
                'expression' => 'app()->controller->isValidAccess("rekapEselon","r")'
            ),
            array('allow', // d
                'actions' => array('rekapJabfung'),
                'expression' => 'app()->controller->isValidAccess("rekapJabfung","r")'
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
    ');
    }

    public function actionGetDetail() {
        $id = $_POST["id"];
        $model = Pegawai::model()->findByPk($id);
        $return['id'] = $id;
        $return['nama'] = $model->namaGelar;
        $return['nip'] = $model->nip;
        $return['jenis_kelamin'] = (!empty($model->jenis_kelamin)) ? $model->jenis_kelamin : '-';
        $return['jabatan'] = $model->jabatan;
        $return['tipe_jabatan'] = $model->tipe;
        $return['unit_kerja'] = $model->unitKerja;
        $return['masa_kerja'] = $model->masaKerja;
        $return['tempat_lahir'] = $model->tempat_lahir;
        $return['tanggal_lahir'] = $model->tanggal_lahir;
        $return['alamat'] = $model->alamat;
        $return['pendidikan_terakhir'] = $model->pendidikanTerakhir . ' - ' . $model->pendidikanJurusan;
        echo json_encode($return);
    }

    public function actionGetListPegawai() {
        $name = $_GET["q"];
        $list = array();
        $data = Pegawai::model()->findAll(array('condition' => 'nama like "%' . $name . '%" and kedudukan_id="1"', 'limit' => '10'));
        if (empty($data)) {
            $list[] = array("id" => "0", "text" => "No Results Found..");
        } else {
            foreach ($data as $val) {
                $list[] = array("id" => $val->id, "text" => $val->nip . ' - ' . $val->namaGelar);
            }
        }
        echo json_encode($list);
    }

    public function actionGetListPegawaicpns() {
        $name = $_GET["q"];
        $list = array();
        $data = Pegawai::model()->findAll(array('condition' => 'nama like "%' . $name . '%" and (tmt_pns is null or tmt_pns="0000-00-00") and kedudukan_id="1"', 'limit' => '10'));
        if (empty($data)) {
            $list[] = array("id" => "0", "text" => "No Results Found..");
        } else {
            foreach ($data as $val) {
                $list[] = array("id" => $val->id, "text" => $val->nip . ' - ' . $val->nama);
            }
        }
        echo json_encode($list);
    }

    public function actionSelectPangkat() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $model = RiwayatPangkat::model()->findByPk($id);
        if (!empty($model)) {
            $data['id'] = $model->id;
            $data['nama_golongan'] = $model->golongan;
            $data['tmt_pangkat'] = $model->tmt_pangkat;
            echo json_encode($data);
        }
    }

    public function actionGetTablePangkat() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pangkat = RiwayatPangkat::model()->findAll(array('condition' => 'pegawai_id=' . $id, 'order' => 'tmt_pangkat DESC'));
        echo $this->renderPartial('/pegawai/_tablePangkat', array('pangkat' => $pangkat, 'edit' => true, 'pegawai_id' => $id));
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
        $data = array();
        $pangkatPegawai = (!empty($_POST['riwayat_pangkat_pegawai'])) ? $_POST['riwayat_pangkat_pegawai'] : 0;
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatPangkat::model()->findByPk($id)->delete();
        $pangkat = RiwayatPangkat::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tmt_pangkat DESC'));
        $data['body'] = $this->renderPartial('/pegawai/_tablePangkat', array('pangkat' => $pangkat, 'edit' => true, 'pegawai_id' => $pegawai_id), true);
//        if (!empty($pegawai_id)) {
//            $PangkatPegawai = Pegawai::model()->findbyPk($pegawai_id);
        if ($pangkatPegawai == $id)
            $data['default'] = 1;
        else
            $data['default'] = 0;
//        }
        echo CJSON::encode($data);
    }

    public function actionSavePangkat() {
        if (isset($_POST['RiwayatPangkat'])) {
            if (empty($_POST['RiwayatPangkat']['id']))
                $model = new RiwayatPangkat;
            else
                $model = RiwayatPangkat::model()->findByPk($_POST['RiwayatPangkat']['id']);

            $model->attributes = $_POST['RiwayatPangkat'];
            $model->no_sk = $_POST['RiwayatPangkat']['no_sk'];
            $model->tgl_sk = $_POST['RiwayatPangkat']['tgl_sk'];
            $golongan = Golongan::model()->findByPk($model->golongan_id);
            $model->golongan_id = $golongan->id;
            if ($model->save()) {
                $pangkat = RiwayatPangkat::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tmt_pangkat DESC'));
                echo $this->renderPartial('/pegawai/_tablePangkat', array('pangkat' => $pangkat, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    public function actionSelectJabatan() {
        $jabatan = '';
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $model = RiwayatJabatan::model()->findByPk($id);

        if ($model->tipe_jabatan == "struktural") {
            $pegawai = Pegawai::model()->findAll(array('condition' => 'jabatan_struktural_id=' . $model->jabatan_struktural_id . ' and kedudukan_id=1 and tipe_jabatan="struktural"'));
            $jabatan = isset($model->JabatanStruktural->jabatan) ? $model->JabatanStruktural->jabatan : "-";
            if (count($pegawai) != 0) {
                if (!empty($model)) {
                    foreach ($pegawai as $as) {
                        $data['pegawai'] = $as->nama;
                        $data['nip'] = $as->nip;
                    }
                    $data['isi'] = 1;
                }
            } else {

                $data['id'] = $model->id;
                $data['tipe'] = $model->tipe;
                $data['jabatan'] = $jabatan;
                $data['tmt'] = $model->tmt_mulai;
                $data['bidang'] = isset($model->JabatanStruktural->nama) ? $model->JabatanStruktural->nama : "-";
                $data['status'] = $model->statusjabatan;
                $data['isi'] = 0;

//            logs($data);
            }
        } elseif ($model->tipe_jabatan == "fungsional_tertentu") {
            $jabatan = isset($model->JabatanFt->nama) ? $model->JabatanFt->nama : "-";
            $data['id'] = $model->id;
            $data['tipe'] = $model->tipe;
            $data['jabatan'] = $jabatan;
            $data['tmt'] = $model->tmt_mulai;
            $data['bidang'] = isset($model->JabatanStruktural->nama) ? $model->JabatanStruktural->nama : "-";
            $data['status'] = $model->statusjabatan;
            $data['isi'] = 0;
        } else {
            $jabatan = isset($model->JabatanFu->nama) ? $model->JabatanFu->nama : "-";
            $data['id'] = $model->id;
            $data['tipe'] = $model->tipe;
            $data['jabatan'] = $jabatan;
            $data['tmt'] = $model->tmt_mulai;
            $data['bidang'] = isset($model->JabatanStruktural->nama) ? $model->JabatanStruktural->nama : "-";
            $data['status'] = $model->statusjabatan;
            $data['isi'] = 0;
        }

        echo json_encode($data);
    }

    public function actionSelectGaji() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $model = RiwayatGaji::model()->findByPk($id);
        if (!empty($model)) {
            $data['id'] = $model->id;
            $data['gaji'] = landa()->rp($model->gaji);
            $data['tmt'] = $model->tmt_mulai;

            echo json_encode($data);
        }
    }

    public function actionGetTableJabatan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $jabatan = RiwayatJabatan::model()->findAll(array('condition' => 'pegawai_id=' . $id, 'order' => 'tmt_mulai DESC'));
        echo $this->renderPartial('/pegawai/_tableJabatan', array('jabatan' => $jabatan, 'edit' => true, 'pegawai_id' => $id));
    }

    public function actionGetTableGaji() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $gaji = RiwayatGaji::model()->findAll(array('condition' => 'pegawai_id=' . $id, 'order' => 'tmt_mulai DESC'));
        echo $this->renderPartial('/pegawai/_tableGaji', array('gaji' => $gaji, 'edit' => true, 'pegawai_id' => $id));
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
        $data = array();
        $jabatanPegawai = (!empty($_POST['riwayat_jabatan_pegawai'])) ? $_POST['riwayat_jabatan_pegawai'] : 0;
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatJabatan::model()->findByPk($id)->delete();
        $jabatan = RiwayatJabatan::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tmt_mulai DESC'));
        $data['body'] = $this->renderPartial('/pegawai/_tableJabatan', array('jabatan' => $jabatan, 'edit' => true, 'pegawai_id' => $pegawai_id), true);
//        if (!empty($pegawai_id)) {
//            $JabatanPegawai = Pegawai::model()->findbyPk($pegawai_id);
        if ($jabatanPegawai == $id)
            $data['default'] = 1;
        else
            $data['default'] = 0;
//        }
        echo CJSON::encode($data);
    }

    public function actionSaveJabatan() {
        if (isset($_POST['RiwayatJabatan'])) {
            if (empty($_POST['RiwayatJabatan']['id']))
                $model = new RiwayatJabatan;
            else
                $model = RiwayatJabatan::model()->findByPk($_POST['RiwayatJabatan']['id']);

            $model->attributes = (isset($_POST['RiwayatJabatan'])) ? $_POST['RiwayatJabatan'] : '';
            $model->tipe_jabatan = (isset($_POST['RiwayatJabatan']['tipe_jabatan'])) ? $_POST['RiwayatJabatan']['tipe_jabatan'] : '';

            $model->jabatan_fu_id = (isset($_POST['RiwayatJabatan']['jabatan_fu_id'])) ? $_POST['RiwayatJabatan']['jabatan_fu_id'] : '';
            $model->jabatan_ft_id = (isset($_POST['RiwayatJabatan']['jabatan_ft_id'])) ? $_POST['RiwayatJabatan']['jabatan_ft_id'] : '';
            $model->type = (isset($_POST['RiwayatJabatan']['type'])) ? $_POST['RiwayatJabatan']['type'] : '';
            if ($model->tipe_jabatan == "struktural") {
                $model->tmt_mulai = $_POST['tmt_mulai_struktural'];
                $model->no_sk_struktural = $_POST['RiwayatJabatan']['no_sk_struktural'];
                $model->tanggal_sk_struktural = $_POST['tanggal_sk_struktural'];
                $model->jabatan_struktural_id = (isset($_POST['RiwayatJabatan']['jabatan_struktural_id'])) ? $_POST['RiwayatJabatan']['jabatan_struktural_id'] : '';
            } else if ($model->tipe_jabatan == "fungsional_umum") {
                $model->tmt_mulai = $_POST['tmt_mulai_fu'];
                $model->jabatan_fu_id = $_POST['RiwayatJabatan']['jabatan_fu_id'];
                $model->jabatan_struktural_id = (isset($_POST['RiwayatJabatan']['jabatan_struktural_id'])) ? $_POST['RiwayatJabatan']['jabatan_struktural_id'] : '';
            } else if ($model->tipe_jabatan == "fungsional_tertentu") {
                $model->tmt_mulai = $_POST['tmt_mulai_ft'];
                $model->no_sk_struktural = $_POST['RiwayatJabatan']['no_sk_ft'];
                $model->tanggal_sk_ft = $_POST['tanggal_sk_ft'];
                $model->jabatan_ft_id = $_POST['RiwayatJabatan']['jabatan_ft_id'];
                $model->jabatan_struktural_id = (isset($_POST['RiwayatJabatan']['jabatan_struktural_id'])) ? $_POST['RiwayatJabatan']['jabatan_struktural_id'] : '';
            }
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
        $data = array();
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $gajiPegawai = (!empty($_POST['riwayat_gaji_pegawai'])) ? $_POST['riwayat_gaji_pegawai'] : 0;
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatGaji::model()->findByPk($id)->delete();
        $gaji = RiwayatGaji::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tmt_mulai DESC'));
        $data['body'] = $this->renderPartial('/pegawai/_tableGaji', array('gaji' => $gaji, 'edit' => true, 'pegawai_id' => $pegawai_id), true);
//        if (!empty($pegawai_id)) {
        if ($gajiPegawai == $id)
            $data['default'] = 1;
        else
            $data['default'] = 0;
//        }
        echo CJSON::encode($data);
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

    public function actionGetKeluargaPegawai() {
        $name = $_GET["q"];
        $data = array();
        $pegawai = Pegawai::model()->findAll(array('condition' => 'nama like "%' . $name . '%"', 'limit' => 15));
        if (empty($pegawai)) {
            $data[] = array('id' => '0', 'text' => 'Tidak Ada Nama Yang Cocok');
        } else {
            foreach ($pegawai as $val) {
                $data[] = array('id' => $val->id, 'text' => $val->nama);
            }
        }
        echo json_encode($data);
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
            $model->nomor_karsu = $_POST['RiwayatKeluarga']['nomor_karsu'];
            $model->nomor_karsi = $_POST['RiwayatKeluarga']['nomor_karsi'];
            $model->pendidikan_terakhir = $_POST['RiwayatKeluarga']['pendidikan_terakhir'];
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

    public function actionGetTablePendidikan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pendidikan = RiwayatPendidikan::model()->findAll(array('condition' => 'pegawai_id=' . $id, 'order' => 'tahun DESC'));
        echo $this->renderPartial('/pegawai/_tablePendidikan', array('pendidikan' => $pendidikan, 'edit' => true, 'pegawai_id' => $id));
    }

    public function actionGetJurusanTingkat() {
        $name = $_GET["q"];
        $data = array();
        $pegawai = Jurusan::model()->findAll(array('condition' => 'Name like "%' . $name . '%"', 'limit' => 15));
        if (empty($pegawai)) {
            $data[] = array('id' => '0', 'text' => 'Tidak Ada Nama Yang Cocok');
        } else {
            foreach ($pegawai as $val) {
                $data[] = array('id' => $val->id, 'text' => $val->tingkat . ' - ' . $val->Name);
            }
        }
        echo json_encode($data);
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

    public function actionSelectPendidikan() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $model = RiwayatPendidikan::model()->findByPk($id);
        if (!empty($model)) {
            $data['id'] = $model->id;
            $data['jenjang_pendidikan'] = $model->tingkatPendidikan;
            $data['tahun'] = $model->tahun;
            $data['jurusan'] = $model->jurusanPegawai;
            echo json_encode($data);
        }
    }

    public function actionDeletePendidikan() {
        $data = array();
        $pendidikanPegawai = (!empty($_POST['riwayat_pendidikan_pegawai'])) ? $_POST['riwayat_pendidikan_pegawai'] : 0;
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatPendidikan::model()->findByPk($id)->delete();
        $pendidikan = RiwayatPendidikan::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tahun DESC'));
        $data['body'] = $this->renderPartial('/pegawai/_tablePendidikan', array('pendidikan' => $pendidikan, 'edit' => true, 'pegawai_id' => $pegawai_id), true);
//        if (!empty($pegawai_id)) {
//            $PendidikanPegawai = Pegawai::model()->findbyPk($pegawai_id);
        if ($pendidikanPegawai == $id)
            $data['default'] = 1;
        else
            $data['default'] = 0;
//        }
        echo CJSON::encode($data);
    }

    public function actionSavePendidikan() {
        if (isset($_POST['RiwayatPendidikan'])) {
            if (empty($_POST['RiwayatPendidikan']['id']))
                $model = new RiwayatPendidikan;
            else
                $model = RiwayatPendidikan::model()->findByPk($_POST['RiwayatPendidikan']['id']);

            $model->attributes = $_POST['RiwayatPendidikan'];
//            $model->jenjang_pendidikan = 'hjhj';
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
        $pelatihan = RiwayatPelatihan::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tahun DESC'));
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
                $pelatihan = RiwayatPelatihan::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tahun DESC'));
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

    public function actionGetMasaKerja() {
        $bulan = (!empty($_POST['bulan']) ? ($_POST['bulan']) : 0) * -1;
        $tahun = (!empty($_POST['tahun']) ? ($_POST['tahun']) : 0) * -1;
        $date = explode("-", $_POST['tmt_cpns']);
        $tmt = mktime(0, 0, 0, $date[1] + $bulan, $date[2], $date[0] + $tahun);
        $tmt_cpns = date("d-m-Y", $tmt);
        if (isset($tmt_cpns) or !empty($tmt_cpns)) {
            $data = array();
            $data['bulan'] = str_replace(" Bulan", "", landa()->usia(date('d-m-Y', strtotime($tmt_cpns)), false, true));
            $data['tahun'] = str_replace(" Tahun", "", landa()->usia(date('d-m-Y', strtotime($tmt_cpns)), true));
            echo json_encode($data);
        }
    }

    // riwayat cuti
    public function actionGetCuti() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        $model = RiwayatCuti::model()->findByPk($id);
        if (!empty($model)) {
            echo $this->renderPartial('/pegawai/_formCuti', array('model' => $model, 'pegawai_id' => $pegawai));
        } else {
            echo $this->renderPartial('/pegawai/_formCuti', array('model' => new RiwayatCuti, 'pegawai_id' => $pegawai));
        }
    }

    public function actionDeleteCuti() {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : '';
        $pegawai_id = (!empty($_POST['pegawai'])) ? $_POST['pegawai'] : '';
        RiwayatCuti::model()->findByPk($id)->delete();
        $cuti = RiwayatCuti::model()->findAll(array('condition' => 'pegawai_id=' . $pegawai_id, 'order' => 'tanggal_sk DESC'));
        echo $this->renderPartial('/pegawai/_tableCuti', array('cuti' => $cuti, 'edit' => true, 'pegawai_id' => $pegawai_id));
    }

    public function actionSaveCuti() {
        if (isset($_POST['RiwayatCuti'])) {
            if (empty($_POST['RiwayatCuti']['id']))
                $model = new RiwayatCuti;
            else
                $model = RiwayatCuti::model()->findByPk($_POST['RiwayatCuti']['id']);

            $model->attributes = $_POST['RiwayatCuti'];
            $model->pejabat = $_POST['RiwayatCuti']['pejabat'];

            if ($model->save()) {
                $cuti = RiwayatCuti::model()->findAll(array('condition' => 'pegawai_id=' . $model->pegawai_id, 'order' => 'tanggal_sk DESC'));
                echo $this->renderPartial('/pegawai/_tableCuti', array('cuti' => $cuti, 'edit' => true, 'pegawai_id' => $model->pegawai_id));
            }
        }
    }

    ///hukuman
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
        }
        else
            $model = Pegawai::model()->findAll();

        if (isset($session['Honorer_records'])) {
            $honorer = $session['Honorer_records'];
        }
        else
            $honorer = Honorer::model()->findAll();

        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelUlangTahun', array(
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
        if (isset($_POST['Pegawai'])) {
            if (isset($_POST['pegawai'])) {

                $file = CUploadedFile::getInstance($model, 'modified');
                if (is_object($file)) { //jika filenya valid
                    $file->saveAs('images/file/' . $file->name);
                    $data = new Spreadsheet_Excel_Reader('images/file/' . $file->name);
                    $total_pegawai = $gagal = $sukses = 0;
                    for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++) {
                        if (!empty($data->sheets[0]['cells'][$j][1])) {
                            $id = array();
                            $pegawai = new Pegawai;
                            $pegawai->nip = (isset($data->sheets[0]['cells'][$j][1])) ? $data->sheets[0]['cells'][$j][1] : '';
                            $pegawai->nip_lama = (isset($data->sheets[0]['cells'][$j][2])) ? $data->sheets[0]['cells'][$j][2] : '';
                            $pegawai->nama = (isset($data->sheets[0]['cells'][$j][3])) ? $data->sheets[0]['cells'][$j][3] : '';
                            $pegawai->gelar_depan = (isset($data->sheets[0]['cells'][$j][4])) ? $data->sheets[0]['cells'][$j][4] : '';
                            $pegawai->gelar_belakang = (isset($data->sheets[0]['cells'][$j][5])) ? $data->sheets[0]['cells'][$j][5] : '';
                            $pegawai->tempat_lahir = (isset($data->sheets[0]['cells'][$j][6])) ? $data->sheets[0]['cells'][$j][6] : '';
                            $pegawai->tanggal_lahir = (isset($data->sheets[0]['cells'][$j][7])) ? $data->sheets[0]['cells'][$j][7] : '';
                            $pegawai->jenis_kelamin = (isset($data->sheets[0]['cells'][$j][8])) ? $data->sheets[0]['cells'][$j][8] : '';
                            $pegawai->agama = (isset($data->sheets[0]['cells'][$j][9])) ? $data->sheets[0]['cells'][$j][9] : '';
                            $pegawai->status_pernikahan = (isset($data->sheets[0]['cells'][$j][10])) ? $data->sheets[0]['cells'][$j][10] : '';
                            $pegawai->alamat = (isset($data->sheets[0]['cells'][$j][11])) ? $data->sheets[0]['cells'][$j][11] : '';
                            $pegawai->kode_pos = (isset($data->sheets[0]['cells'][$j][12])) ? $data->sheets[0]['cells'][$j][12] : '';
                            $pegawai->hp = (isset($data->sheets[0]['cells'][$j][13])) ? $data->sheets[0]['cells'][$j][13] : '';
                            $pegawai->email = (isset($data->sheets[0]['cells'][$j][14])) ? $data->sheets[0]['cells'][$j][14] : '';
                            $pegawai->golongan_darah = (isset($data->sheets[0]['cells'][$j][15])) ? $data->sheets[0]['cells'][$j][15] : '';
                            $pegawai->bpjs = (isset($data->sheets[0]['cells'][$j][16])) ? $data->sheets[0]['cells'][$j][16] : '';
                            $pegawai->kpe = (isset($data->sheets[0]['cells'][$j][17])) ? $data->sheets[0]['cells'][$j][17] : '';
                            $pegawai->npwp = (isset($data->sheets[0]['cells'][$j][18])) ? $data->sheets[0]['cells'][$j][18] : '';
                            $pegawai->no_taspen = (isset($data->sheets[0]['cells'][$j][19])) ? $data->sheets[0]['cells'][$j][19] : '';
                            $pegawai->karpeg = (isset($data->sheets[0]['cells'][$j][20])) ? $data->sheets[0]['cells'][$j][20] : '';
                            $pegawai->tmt_cpns = (isset($data->sheets[0]['cells'][$j][21])) ? $data->sheets[0]['cells'][$j][21] : '';
                            $pegawai->no_sk_cpns = (isset($data->sheets[0]['cells'][$j][22])) ? $data->sheets[0]['cells'][$j][22] : '';
                            $pegawai->tanggal_sk_cpns = (isset($data->sheets[0]['cells'][$j][23])) ? $data->sheets[0]['cells'][$j][23] : '';
                            $pegawai->tmt_pns = (isset($data->sheets[0]['cells'][$j][24])) ? $data->sheets[0]['cells'][$j][24] : '';
                            $pegawai->no_sk_pns = (isset($data->sheets[0]['cells'][$j][25])) ? $data->sheets[0]['cells'][$j][25] : '';
                            $pegawai->tanggal_sk_pns = (isset($data->sheets[0]['cells'][$j][26])) ? $data->sheets[0]['cells'][$j][26] : '';
                            if ($pegawai->save()) {
                                $sukses++;
                            } else {
                                $gagal++;
                            }
                            $total_pegawai++;
                        }
                    }
                    user()->setFlash('info', '<strong>Berhasil! </strong>Total Pegawai : ' . $total_pegawai . ', Berhasil : ' . $sukses . ', Gagal : ' . $gagal);
                }
            } else {
                $file = CUploadedFile::getInstance($model, 'modified');
                if (is_object($file)) { //jika filenya valid
                    $file->saveAs('images/file/' . $file->name);
                    $data = new Spreadsheet_Excel_Reader('images/file/' . $file->name);
                    $total_pegawai = $gagal = $sukses = 0;
                    for ($j = 2; $j <= $data->sheets[0]['numRows']; $j++) {
                        if (!empty($data->sheets[0]['cells'][$j][1])) {
                            $riwayat_id = array();
                            $model = new RiwayatPangkat;
                            // cari pegawai
                            $nip = (isset($data->sheets[0]['cells'][$j][1])) ? $data->sheets[0]['cells'][$j][1] : '';
                            $cariPegawai = Pegawai::model()->find(array('condition' => 'nip=' . $nip));
                            // save riwayat pangkat
                            $model->nomor_register = (isset($data->sheets[0]['cells'][$j][2])) ? $data->sheets[0]['cells'][$j][2] : '';
                            $model->pegawai_id = $cariPegawai->id;
                            $model->golongan_id = (isset($data->sheets[0]['cells'][$j][3])) ? $data->sheets[0]['cells'][$j][3] : '';
                            if ($model->save()) {
                                Pegawai::model()->updateAll(array(
                                        'riwayat_pangkat_id' => $model->id,
                                            ), 'id=' . $model->pegawai_id);
                                $sukses++;
                            } else {
                                $gagal++;
                            }
                            $total_pegawai++;
                        }
                    }

                    user()->setFlash('info', '<strong>Berhasil! </strong>Total Riwata : ' . $total_pegawai . ', Berhasil : ' . $sukses . ', Gagal : ' . $gagal);
                }
            }
        }
        $this->render('importDataPegawai', array(
            'model' => $model,
        ));
    }

    public function actionCheckErrorExcel() {
        $session = new CHttpSession;
        $session->open();

        if (isset($session['Pegawai_records'])) {
            $model = $session['Pegawai_records'];
        }
        else
            $model = Pegawai::model()->findAll();

        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelCheckError', array(
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
        $gol_id = isset($_POST['golongan_id']) ? $_POST['golongan_id'] : 0;
        $jabatanFungsional = JabatanFungsional::model()->find(array('condition' => 'jabatan_ft_id = ' . $_POST['jabatan_ft_id'] . ' and (min_golongan_id <= ' . $gol_id . ' and max_golongan_id >= ' . $gol_id . ' ) '));
        echo!empty($jabatanFungsional) ? $jabatanFungsional->nama : "-";
//        echo $gol_id;
//        $data = JabatanFungsional::model()->with('DetailJf')->find(array('condition' => 't.jabatan_ft_id = ' . $_POST['jabatan_ft_id']));
//        $tmp = isset($data->nama) ? $data->nama : '-';
//        echo $tmp;
//        logs(print_r($jabatanFungsional));
    }

    public function actionRiwayatStatusJabatan() {
        $data['masa_kerja'] = 0;
        $data['eselon'] = '';
        $data['jabatan'] = '';

        $tipe = (!empty($_POST['RiwayatJabatan']['tipe_jabatan'])) ? $_POST['RiwayatJabatan']['tipe_jabatan'] : '';
        if ($tipe == "struktural") {
//            $pegawai = Pegawai::model()->findAll(array('condition' => 'jabatan_struktural_id=' . $_POST['RiwayatJabatan']['jabatan_struktural_id'] . ' and tipe_jabtan="struktural and kedudukan_id=1"'));

            $model = JabatanStruktural::model()->findByPk($_POST['RiwayatJabatan']['jabatan_struktural_id']);
            $data['eselon'] = isset($model->Eselon->nama) ? $model->Eselon->nama : '-';
            $data['jabatan'] = $model->jabatan;
        } elseif ($tipe == "fungsional_umum") {
            $model = JabatanFu::model()->findByPk($_POST['RiwayatJabatan']['jabatan_fu_id']);
        } elseif ($tipe == "fungsional_tertentu") {
            $model = JabatanFt::model()->findByPk($_POST['RiwayatJabatan']['jabatan_ft_id']);
        }
//        if (!empty($model)) {
//            $data['status'] = $model->status;
        echo json_encode($data);
//        }
    }

    public function actionSearchJson() {
        $user = Pegawai::model()->findAll(array('condition' => 'nama like "%' . $_POST['queryString'] . '%" OR nip like "%' . $_POST['queryString'] . '%"'));
        $results = array();
        foreach ($user as $no => $o) {
            $sGol = (isset($o->Pangkat->Golongan->nama)) ? $o->Pangkat->Golongan->nama : "-";
            $sJab = (isset($o->RiwayatJabatan->jabatanPegawai)) ? $o->RiwayatJabatan->jabatanPegawai : "-";
            $results[$no]['url'] = url('pegawai/' . $o->id);
            $results[$no]['img'] = $o->imgUrl;
            $results[$no]['title'] = $o->nip . '<br/>' . $o->namaGelar;
            $results[$no]['description'] = $sJab . '<br/>' . $sGol;
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
            $model->nip_lama = $_POST['Pegawai']['nip_lama'];
            $perubahan['tahun'] = $_POST['kalkulasiTahun'];
            $perubahan['bulan'] = $_POST['kalkulasiBulan'];
            $model->perubahan_masa_kerja = json_encode($perubahan);
            $model->tanggal_lahir = $_POST['Pegawai']['tanggal_lahir'];
            $model->city_id = $_POST['Pegawai']['city_id'];
            $model->karpeg = $_POST['Pegawai']['karpeg'];
            $model->no_taspen = $_POST['Pegawai']['no_taspen'];
            $model->tempat_lahir = $_POST['Pegawai']['tempat_lahir'];
            $model->no_sk_cpns = $_POST['Pegawai']['no_sk_cpns'];
            $model->no_sk_pns = $_POST['Pegawai']['no_sk_pns'];
            $model->tanggal_sk_cpns = $_POST['Pegawai']['tanggal_sk_cpns'];
            $model->tanggal_sk_pns = $_POST['Pegawai']['tanggal_sk_pns'];
            $model->riwayat_gaji_id = $_POST['Pegawai']['riwayat_gaji_id'];
            $model->tmt_keterangan_kedudukan = $_POST['Pegawai']['tmt_keterangan_kedudukan'];
            $model->ket_tmt_cpns = $_POST['Pegawai']['ket_tmt_cpns'];

            $riwayat = RiwayatJabatan::model()->findByPk($_POST['Pegawai']['riwayat_jabatan_id']);
            if (!empty($riwayat)) {
                if (!empty($riwayat)) {
                    //simpan jabatan di tabel pegawai
                    $model->jabatan_struktural_id = $riwayat->jabatan_struktural_id;
                    $model->jabatan_fu_id = $riwayat->jabatan_fu_id;
                    $model->jabatan_ft_id = $riwayat->jabatan_ft_id;
                    $model->tipe_jabatan = $riwayat->tipe_jabatan;
                    if ($riwayat->tipe_jabatan == "struktural") {
                        //simpan status jabatan struktural
                        $jabatan = JabatanStruktural::model()->findByPk($riwayat->jabatan_struktural_id);
                        $jabatan->status = 1;
                        $jabatan->save();
                    }
                }
            }

            $file = CUploadedFile::getInstance($model, 'foto');
            if (is_object($file)) {
                $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
            } else {
                unset($model->foto);
            }

            if ($model->save()) {
                $id = Pegawai::model()->find(array('condition' => 'nip=' . $model->nip, 'order' => 'id DESC'));
                if (is_object($file)) {
                    $file->saveAs('images/pegawai/' . $model->foto, 0777);
                    Yii::app()->landa->createImg('pegawai/', $model->foto, $model->id);
                }
                $this->redirect(array('update', 'id' => $id->id));
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
            $jabatanStruktural = 0;
//            if (isset($model->RiwayatJabatan->id)) {
//                if ($model->RiwayatJabatan->tipe_jabatan == "struktural") {
//                    $jabatan = JabatanStruktural::model()->findByPk($model->RiwayatJabatan->jabatan_struktural_id);
////                    $jabatanStruktural = $jabatan->id;
//                }
//                if (!empty($jabatan)) {
//                    $jabatan->status = 0;
//                    $jabatan->saveNode();
//                    $jabatan = "";
//                }
//            }

            $model->attributes = $_POST['Pegawai'];
            $perubahan['tahun'] = $_POST['kalkulasiTahun'];
            $perubahan['bulan'] = $_POST['kalkulasiBulan'];
            $model->nip_lama = $_POST['Pegawai']['nip_lama'];
            $model->perubahan_masa_kerja = json_encode($perubahan);
            $model->tanggal_lahir = $_POST['Pegawai']['tanggal_lahir'];
            $model->city_id = $_POST['Pegawai']['city_id'];
            $model->tempat_lahir = $_POST['Pegawai']['tempat_lahir'];
            $model->karpeg = $_POST['Pegawai']['karpeg'];
            $model->riwayat_jabatan_id = $_POST['Pegawai']['riwayat_jabatan_id'];
            $model->no_sk_cpns = $_POST['Pegawai']['no_sk_cpns'];
            $model->no_sk_pns = $_POST['Pegawai']['no_sk_pns'];
            $model->tanggal_sk_cpns = $_POST['Pegawai']['tanggal_sk_cpns'];
            $model->tanggal_sk_pns = $_POST['Pegawai']['tanggal_sk_pns'];
            $model->riwayat_gaji_id = $_POST['Pegawai']['riwayat_gaji_id'];
            $model->ket_tmt_cpns = $_POST['Pegawai']['ket_tmt_cpns'];
            $model->tmt_keterangan_kedudukan = $_POST['Pegawai']['tmt_keterangan_kedudukan'];

            $file = CUploadedFile::getInstance($model, 'foto');
            if (is_object($file)) {
                $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
            } else {
                unset($model->foto);
            }

            $riwayat = RiwayatJabatan::model()->findByPk($_POST['Pegawai']['riwayat_jabatan_id']);
            if (!empty($riwayat)) {
                //simpan jabatan di tabel pegawai
                $model->jabatan_struktural_id = $riwayat->jabatan_struktural_id;
                $model->jabatan_fu_id = $riwayat->jabatan_fu_id;
                $model->jabatan_ft_id = $riwayat->jabatan_ft_id;
                $model->tipe_jabatan = $riwayat->tipe_jabatan;
//                if ($riwayat->tipe_jabatan == "struktural") {
//                    $jabatan = JabatanStruktural::model()->findByPk($riwayat->jabatan_struktural_id);
//                    $jabatan->status = 1;
//                    $jabatan->saveNode();
//                }
            } else {
                $model->jabatan_fu_id = "";
                $model->jabatan_ft_id = "";
                $model->jabatan_struktural_id = "";
            }

            $file = CUploadedFile::getInstance($model, 'foto');
            if (is_object($file)) {
                $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
                $file->saveAs('images/pegawai/' . $model->foto);
//                Yii::app()->landa->createImg('pegawai/', $model->foto, $model->id);
            }

            if ($model->save()) {
//                $file = CUploadedFile::getInstance($model, 'foto');
//                if (is_object($file)) {
//                    $model->foto = Yii::app()->landa->urlParsing($model->nama) . '.' . $file->extensionName;
//                    $file->saveAs('images/pegawai/' . $model->foto, 0777);
//                    Yii::app()->landa->createImg('pegawai/', $model->foto, $model->id);
//                }
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
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Pegawai('search');
        $model->unsetAttributes();  // clear any default values
        $criteria = new CDbCriteria();
        //logs($model);
        $model->kedudukan_id = 1;
        if (isset($_GET['Pegawai'])) {
            $model->attributes = $_GET['Pegawai'];
            //if ($model->nip == 0 or $model->nip == "")
            //     unset($model->nip);
            if ($model->tempat_lahir == 0)
                unset($model->tempat_lahir);
            if ($model->city_id == 0)
                unset($model->city_id);
            if ($model->kedudukan_id == 0)
                unset($model->kedudukan_id);
//            if ($model->unit_kerja_id == 0)
//                unset($model->unit_kerja_id);
//            if ($model->golongan_id == 0)
//                unset($model->golongan_id);
            if ($model->jabatan_struktural_id == 0)
                unset($model->jabatan_struktural_id);
            if ($model->jabatan_fu_id == 0)
                unset($model->jabatan_fu_id);
            if ($model->jabatan_ft_id == 0)
                unset($model->jabatan_ft_id);
//            if (isset($_GET['type']) && $_GET['type'] == 'export') {
//
//            //$model->attributes = $_GET['Pegawai'];
//            //logs($model);
//            Yii::app()->request->sendFile('Data Pegawai - ' . date('YmdHi') . '.xls', $this->renderPartial('excelReport', array(
//                        'model' => $model,
//                    ),true)
//            );
//        }
        }

        $this->cssJs();
        if (isset($_POST['delete']) && isset($_POST['ceckbox'])) {
            foreach ($_POST['ceckbox'] as $data) {
                $this->loadModel($data)->delete();
                RiwayatPangkat::model()->deleteAll('pegawai_id=' . $data);
                RiwayatJabatan::model()->deleteAll('pegawai_id=' . $data);
                RiwayatGaji::model()->deleteAll('pegawai_id=' . $data);
                RiwayatKeluarga::model()->deleteAll('pegawai_id=' . $data);
                RiwayatPendidikan::model()->deleteAll('pegawai_id=' . $data);
                RiwayatPelatihan::model()->deleteAll('pegawai_id=' . $data);
                RiwayatPenghargaan::model()->deleteAll('pegawai_id=' . $data);
                RiwayatHukuman::model()->deleteAll('pegawai_id=' . $data);
                RiwayatCuti::model()->deleteAll('pegawai_id=' . $data);
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
            if (isset($_POST['export'])) {

                Yii::app()->request->sendFile('Rekap Data Pegawai - ' . date('YmdHi') . '.xls', $this->renderPartial('_rekap', array(
                            'model' => $model,
                                ), true)
                );
            }
        }
        $this->cssJs();
        $this->render('rekap', array(
            'model' => $model,
        ));
    }

    public function actionRekapEselon() {
        $model = new Pegawai;
        $model->unsetAttributes();  // clear any default values  
        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
        }
        if (isset($_GET['export'])) {

            Yii::app()->request->sendFile('Rekap Data Eselon - ' . date('YmdHi') . '.xls', $this->renderPartial('_rekapEselon', array(
                        'model' => $model,
                            ), true)
            );
        }
        $this->cssJs();
        $this->render('rekapEselon', array(
            'model' => $model,
        ));
    }

    public function actionRekapJabfung() {
        $model = new Pegawai;
        $model->unsetAttributes();  // clear any default values  
        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
        }
        if (isset($_GET['export'])) {
            Yii::app()->request->sendFile('Rekap Jabatan Fungsional - ' . date('YmdHi') . '.xls', $this->renderPartial('_rekapJabfung', array(
                        'model' => $model,
                            ), true)
            );
        }
        $this->cssJs();
        $this->render('rekapJabfung', array(
            'model' => $model,
        ));
    }

    public function actionRekapBatasPensiun() {
        $model = new Pegawai;
        $model->unsetAttributes();  // clear any default values  
        if (isset($_POST['Pegawai'])) {
            $model->attributes = $_POST['Pegawai'];
        }
        if (isset($_POST['export'])) {
            Yii::app()->request->sendFile('Rekap Jabatan Fungsional - ' . date('YmdHi') . '.xls', $this->renderPartial('_rekapBatasPensiun', array(
                        'model' => $model,
                            ), true)
            );
        }
        $this->cssJs();
        $this->render('rekapBatasPensiun', array(
            'model' => $model,
        ));
    }

    public function actionRekapExcel() {

        $session = new CHttpSession;
        $session->open();
        $model = (isset($session['RekapExcel_records'])) ? $session['RekapExcel_records'] : array();
        $unit_kerja = (isset($session['RekapUnitKerjaExcel_records'])) ? $session['RekapUnitKerjaExcel_records'] : "-";


        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('rekapExcel', array(
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
        $nip = $_GET['nip'];
        $kedudukan_id = $_GET['kedudukan_id'];
        $nama = $_GET['nama'];
        $pegawai_ft = $_GET['pegawai_ft'];
        $gelar_dpn = $_GET['gelar_depan'];
        $gelar_blk = $_GET['gelar_belakang'];
        $hp = $_GET['hp'];
        $jurusan = $_GET['jurusan'];
        $agama = $_GET['agama'];
        $type_jabatan = $_GET['tipe_jabatan'];
        $satuan_kerja = $_GET['satuan_kerja'];
        //satuan kerja
        $satuanKerja = JabatanStruktural::model()->findAll(array('condition' => 'unit_kerja_id = ' . $_GET['satuan_kerja']));
        $id = array();
        if (empty($satuanKerja)) {
            
        } else {
            foreach ($satuanKerja as $val) {
                $id[] = $val->id;
            }
        }
        //jabatan_ft
        $jabFt = JabatanFt::model()->findAll(array('condition' => 'type ="' . $_GET['pegawai_ft'] . '"'));
        $id = array();
        if (empty($jabFt)) {
            
        } else {
            foreach ($jabFt as $val) {
                $id[] = $val->id;
            }
        }


        $unit_kerja = $_GET['unit_kerja'];

        $jns_kelamin = $_GET['jenis_kelamin'];
        $sts_pernikahan = $_GET['status_pernikahan'];

        $criteria = new CDbCriteria;
        $criteria->with = array('RiwayatJabatan', 'RiwayatPangkat', 'RiwayatKeluarga', 'JabatanStruktural', 'UnitKerja');
        $criteria->compare('nip', $nip, true);
        $criteria->addCondition('nama like "%' . $nama . '%"');
        $criteria->compare('gelar_depan', $gelar_dpn, true);
        $criteria->compare('gelar_belakang', $gelar_blk, true);
        $criteria->compare('hp', $hp, true);
        if (!empty($pegawai_ft))
            $criteria->addCondition('RiwayatJabatan.jabatan_ft_id IN (' . implode(",", $id) . ')');
        $criteria->compare('jurusan', $jurusan, true);
        $criteria->compare('kedudukan_id', $kedudukan_id);
        $criteria->compare('agama', $agama, true);
        $criteria->compare('tipe_jabatan', $type_jabatan, true);
        if (!empty($satuan_kerja))
            $criteria->addCondition('RiwayatJabatan.jabatan_struktural_id IN (' . implode(",", $id) . ') ');
        if (!empty($unit_kerja)) {
            $criteria->compare('t.jabatan_struktural_id', $unit_kerja);
        }
        $criteria->compare('jenis_kelamin', $jns_kelamin, true);
        $criteria->compare('status_pernikahan', $sts_pernikahan, true);

        $model = Pegawai::model()->findAll($criteria);
        
//        $model = cmd('SELECT pegawai.*,jabatan_struktural.nama as unitKerja, jabatan_struktural.level as level, '
//        . 'golongan.nama as nama_golongan, golongan.keterangan as gol_keterangan, eselon.nama as nama_eselon, jurusan.Name as pendidikan FROM pegawai '
//        . 'LEFT JOIN riwayat_jabatan ON pegawai.id = riwayat_jabatan.pegawai_id '
//        . 'LEFT JOIN jabatan_struktural ON jabatan_struktural.id = riwayat_jabatan.jabatan_struktural_id '
//        . 'LEFT JOIN eselon ON eselon.id = jabatan_struktural.eselon_id '
//        . 'LEFT JOIN riwayat_pangkat ON pegawai.id = riwayat_pangkat.pegawai_id '
//        . 'LEFT JOIN golongan ON golongan.id = riwayat_pangkat.golongan_id '
//        . 'LEFT JOIN riwayat_pendidikan ON pegawai.id = riwayat_pendidikan.pegawai_id '
//        . 'LEFT JOIN jurusan ON jurusan.id = riwayat_pendidikan.id_jurusan '
//        . 'ORDER BY jabatan_struktural.root,jabatan_struktural.lft')->query();

        Yii::app()->request->sendFile('Data Pegawai -' . date('YmdHi') . '.xls', $this->renderPartial('excelReport', array(
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
        }
        else
            $model = RiwayatPangkat::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelRiwayatPangkat', array(
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
        }
        else
            $model = RiwayatJabatan::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelRiwayatJabatan', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionGetPensiun() {
        $tgl_lahir = (!empty($_POST['tanggal_lahir'])) ? $_POST['tanggal_lahir'] : date("Y-m-d");
        $id_riwayat = $_POST['riwayatJabatan'];
        $jabatan = RiwayatJabatan::model()->findByPk($id_riwayat);
        $bup = 0;
        if (!empty($jabatan)) {
            if ($jabatan->tipe_jabatan == "struktural") {
                $eselon = isset($jabatan->JabatanStruktural->Eselon->nama) ? $jabatan->JabatanStruktural->Eselon->nama : "-";
                $tingkatEselon = substr($eselon, 0, 2);
                if ($tingkatEselon == "II") {
                    $bup = 60;
                } else if ($tingkatEselon == "III" or $tingkatEselon == "IV" or $tingkatEselon == "V") {
                    $bup = 58;
                }
            } else if ($jabatan->tipe_jabatan == "fungsional_umum") {
                $bup = 58;
            } else if ($jabatan->tipe_jabatan == "fungsional_tertentu") {
                $bup = 60;
            }
        } else {
            $bup = 0;
        }
        $date = explode("-", $tgl_lahir);
        $tmt_pensiun = mktime(0, 0, 0, $date[1], $date[2], $date[0] + $bup);
        echo date("Y-m-d", $tmt_pensiun);
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
        }
        else
            $model = RiwayatGaji::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelRiwayatGaji', array(
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
        }
        else
            $model = RiwayatKeluarga::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelRiwayatKeluarga', array(
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
        }
        else
            $model = RiwayatPendidikan::model()->findAll();


        Yii::app()->request->sendFile(date('YmdHi') . '.xls', $this->renderPartial('excelRiwayatPendidikan', array(
                    'model' => $model
                        ), true)
        );
    }

    public function actionMigrasipensiun() {
        /// change tmt pensiun struktural
        $struktural = Pegawai::model()->with('JabatanStruktural.Eselon')->findAll(array('condition' => 'JabatanStruktural.eselon_id = Eselon.id and t.tipe_jabatan="struktural" and kedudukan_id=1'));
        foreach ($struktural as $data) {
            $tingkatEselon = substr($data->JabatanStruktural->Eselon->nama, 0, 2);
            if ($tingkatEselon == 'II') {
                $date = explode("-", $data->tanggal_lahir);
                $tmt_pensiun = mktime(0, 0, 0, $date[1], $date[2], $date[0] + 60);
                $data->tmt_pensiun = date("Y-m-d", $tmt_pensiun);
                $data->save();
            } elseif ($tingkatEselon == 'III' or $tingkatEselon == 'IV' or $tingkatEselon == 'V') {
                $date = explode("-", $data->tanggal_lahir);
                $tmt_pensiun = mktime(0, 0, 0, $date[1], $date[2], $date[0] + 58);
                $data->tmt_pensiun = date("Y-m-d", $tmt_pensiun);
                $data->save();
            }
        }

        /// change tmt pensiun tertentu
        $tertentu = Pegawai::model()->findAll(array('condition' => 'tipe_jabatan="fungsional_tertentu" and kedudukan_id=1'));
        foreach ($tertentu as $data) {
            $date = explode("-", $data->tanggal_lahir);
            $tmt_pensiun = mktime(0, 0, 0, $date[1], $date[2], $date[0] + 60);
            $data->tmt_pensiun = date("Y-m-d", $tmt_pensiun);
//                $data->tmt_pensiun = date('Y-m-d',strtotime("2032-11-10"));
            $data->save();
        }

//        / change tmt pensiun fungsioanal
        $tertentu = Pegawai::model()->with('JabatanFu')->findAll(array('condition' => 't.tipe_jabatan="fungsional_umum" and kedudukan_id=1'));
        foreach ($tertentu as $data) {
            $date = explode("-", $data->tanggal_lahir);
            $tmt_pensiun = mktime(0, 0, 0, $date[1], $date[2], $date[0] + 58);
            $data->tmt_pensiun = date("Y-m-d", $tmt_pensiun);
//                $data->tmt_pensiun = date('Y-m-d',strtotime("2032-11-10"));
            $data->save();
        }
        echo 'sukses';
    }

    public function actionMigrasibup() {
        /// change bup struktural
        $struktural = Pegawai::model()->with('JabatanStruktural.Eselon')->findAll(array('condition' => 'JabatanStruktural.eselon_id = Eselon.id and t.tipe_jabatan="struktural" and kedudukan_id=1'));
        foreach ($struktural as $data) {
            $tingkatEselon = substr($data->JabatanStruktural->Eselon->nama, 0, 2);
            if ($tingkatEselon == 'II') {
                $data->bup = 60;
                $data->save();
            } elseif ($tingkatEselon == 'III' or $tingkatEselon == 'IV' or $tingkatEselon == 'V') {
                $data->bup = 58;
                $data->save();
            }
        }

        /// change bup tertentu
        $tertentu = Pegawai::model()->findAll(array('condition' => 'tipe_jabatan="fungsional_tertentu" and kedudukan_id=1'));
        foreach ($tertentu as $data) {
            $date = explode("-", $data->tanggal_lahir);
            $tmt_pensiun = mktime(0, 0, 0, $date[1], $date[2], $date[0] + 60);
            $data->bup = 60;
            $data->save();
        }

//        / change bup fungsioanal
        $tertentu = Pegawai::model()->with('JabatanFu')->findAll(array('condition' => 't.tipe_jabatan="fungsional_umum" and kedudukan_id=1'));
        foreach ($tertentu as $data) {
            $data->bup = 58;
            $data->save();
        }
        echo 'sukses';
    }

    public function actionCoba() {
//        $criteria = new CDbCriteria;
//        $criteria->with = array('RiwayatJabatan', 'Pangkat', 'RiwayatKeluarga', 'JabatanStruktural', 'UnitKerja');
//        $model = Pegawai::model()->findAll($criteria);
//        
//        $aa = cmd('SELECT * FROM pegawai')->query();
//        foreach($aa as $a){
//            echo $a['id'].'<br/>';
//        }

        cmd('SELECT pegawai.*,jabatan_struktural.nama as unitKerja, jabatan_struktural.level as level, '
                . 'golongan.nama as nama_golongan, golongan.keterangan as gol_keterangan, eselon.nama as nama_eselon, jurusan.Name as pendidikan FROM pegawai '
                . 'INNER JOIN riwayat_jabatan ON pegawai.id = riwayat_jabatan.pegawai_id '
                . 'RIGHT JOIN jabatan_struktural ON jabatan_struktural.id = riwayat_jabatan.jabatan_struktural_id '
                . 'INNER JOIN eselon ON eselon.id = jabatan_struktural.eselon_id '
                . 'INNER JOIN riwayat_pangkat ON pegawai.id = riwayat_pangkat.pegawai_id '
                . 'INNER JOIN golongan ON golongan.id = riwayat_pangkat.golongan_id '
                . 'INNER JOIN riwayat_pendidikan ON pegawai.id = riwayat_pendidikan.pegawai_id '
                . 'INNER JOIN jurusan ON jurusan.id = riwayat_pendidikan.id_jurusan '
                . 'ORDER BY jabatan_struktural.root,jabatan_struktural.lft')->query();
    }

}
