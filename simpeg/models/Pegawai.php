<?php

class Pegawai extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{pegawai}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nip, nama, tanggal_lahir, jenis_kelamin,  kedudukan_id', 'required'),
            array('gelar_depan, ketarangan, ket_agama, riwayat_jabatan_id,riwayat_pangkat_id,riwayat_gaji_id,pendidikan_id,gelar_belakang,modified_user_id, tempat_lahir,agama, kedudukan_id,tmt_keterangan_kedudukan, status_pernikahan, alamat, city_id, kode_pos, hp, golongan_darah, bpjs, npwp,karpeg, foto, tmt_cpns, tmt_pns, tmt_golongan, tipe_jabatan, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, tmt_pensiun,no_sk_cpns,tanggal_sk_cpns,no_sk_pns,tanggal_sk_pns, created, created_user_id, id, no_taspen', 'safe'),
            array('kedudukan_id, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, created_user_id, id', 'numerical', 'integerOnly' => true),
            array('nip, gelar_depan, gelar_belakang, keterangan, bpjs, kpe, npwp', 'length', 'max' => 50),
            array('nama', 'length', 'max' => 100),
            array('jenis_kelamin', 'length', 'max' => 11),
            array('agama', 'length', 'max' => 9),
            array('kode_pos', 'length', 'max' => 10),
            array('status_pernikahan', 'length', 'max' => 12),
            array('hp', 'length', 'max' => 25),
            array('golongan_darah', 'length', 'max' => 5),
            array('foto', 'length', 'max' => 225),
            array('tipe_jabatan', 'length', 'max' => 19),
            array('modified, ket_tmt_cpns', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, ketarngan, nip, nama, gelar_depan, gelar_belakang, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, kedudukan_id,tmt_keterangan_kedudukan, status_pernikahan, alamat, city_id, kode_pos, hp, golongan_darah, bpjs, kpe, npwp,karpeg, foto, tmt_cpns, tmt_pns,no_sk_cpns,tanggal_sk_cpns,no_sk_pns,tanggal_sk_pns, tmt_golongan, tipe_jabatan, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, tmt_pensiun, nomor_kesehatan, tanggal_kesehatan,  created, created_user_id, modified, ket_tmt_cpns', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
//            'UnitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja_id'),
//            'Golongan' => array(self::BELONGS_TO, 'Golongan', 'golongan_id'),
//            'TempatLahir' => array(self::BELONGS_TO, 'City', 'tempat_lahir'),
            'City' => array(self::BELONGS_TO, 'City', 'city_id'),
            'Kedudukan' => array(self::BELONGS_TO, 'Kedudukan', 'kedudukan_id'),
            'JabatanStruktural' => array(self::BELONGS_TO, 'JabatanStruktural', 'jabatan_struktural_id'),
            'JabatanFu' => array(self::BELONGS_TO, 'JabatanFu', 'jabatan_fu_id'),
            'JabatanFt' => array(self::BELONGS_TO, 'JabatanFt', 'jabatan_ft_id'),
            'LastEdit' => array(self::BELONGS_TO, 'User', 'modified_user_id'),
            'Pendidikan' => array(self::BELONGS_TO, 'RiwayatPendidikan', 'pendidikan_id'),
            'Pangkat' => array(self::BELONGS_TO, 'RiwayatPangkat', 'riwayat_pangkat_id'),
            'Gaji' => array(self::BELONGS_TO, 'RiwayatGaji', 'riwayat_gaji_id'),
            'RiwayatJabatan' => array(self::BELONGS_TO, 'RiwayatJabatan', 'riwayat_jabatan_id'),
            'RiwayatPendidikan' => array(self::HAS_MANY, 'RiwayatPendidikan', 'pegawai_id'),
            'RiwayatKeluarga' => array(self::HAS_MANY, 'RiwayatKeluarga', 'pegawai_id'),
            'PermohonanMutasi' => array(self::HAS_MANY, 'PermohonanMutasi', 'pegawai_id'),
            'UnitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'gelar_depan' => 'Gelar Depan',
            'gelar_belakang' => 'Gelar Belakang',
            'tempat_lahir' => 'Tempat Lahir',
            'tempat_lahir_lainnya' => 'Tempat Lahir Lainnya',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'ket_agama' => 'Keterangan Agama',
            'kedudukan_id' => 'Kedudukan',
            'status_pernikahan' => 'Status Pernikahan',
            'alamat' => 'Alamat',
            'city_id' => 'Kota',
            'kode_pos' => 'Kode Pos',
            'hp' => 'Hp',
            'golongan_darah' => 'Golongan Darah',
            'bpjs' => 'BPJS/ASKES/KIS',
            'npwp' => 'No. NPWP',
            'kpe' => 'KPE',
            'karpeg' => 'Kartu Pegawai',
            'keterangan' => 'Keterangan',
            'no_taspen' => 'No. TASPEN',
            'foto' => 'Foto',
            'tmt_cpns' => 'Tmt CPNS',
            'tmt_pns' => 'Tmt PNS',
            'tmt_golongan' => 'Tmt Golongan',
            'tipe_jabatan' => 'Tipe Jabatan',
            'jabatan_struktural_id' => 'Jabatan Struktural',
            'jabatan_fu_id' => 'Jabatan Fu',
            'jabatan_ft_id' => 'Jabatan Ft',
            'tmt_pensiun' => 'Tmt Pensiun',
            'no_sk_cpns' => 'No SK',
            'tanggal_sk_cpns' => 'Tanggal SK',
            'no_sk_pns' => 'No SK',
            'tanggal_sk_pns' => 'Tanggal SK',
            'created' => 'Created',
            'created_user_id' => 'Created User',
            'modified_user_id' => 'Last Edit',
            'modified' => 'Upload File Excel',
            'tmt_keterangan_kedudukan' => 'Tmt Keterangan',
            'ket_tmt_cpns' => ''
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('Pangkat', 'RiwayatJabatan');

        if (isset($_GET['today'])) {
            $today = date('m/d');
            $criteria->addCondition('date_format(tanggal_lahir,"%m/%d") = "' . $today . '"');
        }

        if (isset($_GET['week'])) {
            $today = date('m/d');
            $week = date('m/d', strtotime("+7 day", strtotime($today)));
            $criteria->addCondition('date_format(tanggal_lahir,"%m/%d") between "' . $today . '" and "' . $week . '"');
        }

        if (isset($_GET['nextweek'])) {
            $today = date('m/d');
            $week = date('m/d', strtotime("+7 day", strtotime($today)));
            $nextweek = date('m/d', strtotime("+7 day", strtotime($week)));
            $criteria->addCondition('date_format(tanggal_lahir,"%m/%d") between "' . $week . '" and "' . $nextweek . '"');
        }

        if (isset($_GET['month'])) {
            $today = date('m');
            $criteria->addCondition('date_format(tanggal_lahir,"%m") = "' . $today . '"');
        }

        if (isset($_GET['nextmonth'])) {
            $today = date('Y-m-d');
            $nextmonth = date('m', strtotime("+1 month", strtotime($today)));
            $criteria->addCondition('date_format(tanggal_lahir,"%m") = "' . $nextmonth . '"');
        }

        if (isset($_GET['lahir'])) {
            $criteria->addCondition('tanggal_lahir = "0000-00-00"');
            $criteria->addCondition('tanggal_lahir = ""');
        }
        if (isset($_GET['jk']))
            $criteria->addCondition('jenis_kelamin = ""');
        if (isset($_GET['agama']))
            $criteria->addCondition('agama = ""');
        if (isset($_GET['pangkat']))
            $criteria->addCondition('t.riwayat_pangkat_id = ""');
        if (isset($_GET['pendidikan']))
            $criteria->addCondition('pendidikan_id = ""');
        if (isset($_GET['jabatan'])) {
            $criteria->addCondition('t.jabatan_struktural_id = ""');
            $criteria->addCondition('t.jabatan_fu_id = ""');
            $criteria->addCondition('t.jabatan_ft_id = ""');
        }

        //tambahan tindik
        if (isset($_GET['jurusan']) and !empty($_GET['jurusan'])) {
            $pegawai = RiwayatPendidikan::model()->with('Jurusan')->findAll(array('condition' => 'Jurusan.Name like "%' . $_GET['jurusan'] . '%"'));
            $id = array();
            if (empty($pegawai)) {
                
            } else {
                foreach ($pegawai as $val) {
                    $id[] = $val->pegawai_id;
                }
                $criteria->addCondition('t.id IN (' . implode(",", $id) . ')');
            }
        }
        if (isset($_GET['unit_kerja']) and !empty($_GET['unit_kerja'])) {
            $criteria->addCondition("RiwayatJabatan.jabatan_struktural_id = " . $_GET['unit_kerja']);
        }
        if (isset($_GET['satuan_kerja']) and !empty($_GET['satuan_kerja'])) {
            $satuanKerja = JabatanStruktural::model()->findAll(array('condition' => 'unit_kerja_id = ' . $_GET['satuan_kerja']));
            $id = array();
            if (empty($satuanKerja)) {
                
            } else {
                foreach ($satuanKerja as $val) {
                    $id[] = $val->id;
                }
            }
            $criteria->addCondition('RiwayatJabatan.jabatan_struktural_id IN (' . implode(",", $id) . ')');
        }
        //

        $criteria->compare('id', $this->id);
        $criteria->compare('nip', $this->nip, true);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('gelar_depan', $this->gelar_depan, true);
        $criteria->compare('gelar_belakang', $this->gelar_belakang, true);
        $criteria->compare('tempat_lahir', $this->tempat_lahir);
        $criteria->compare('tanggal_lahir', $this->tanggal_lahir, true);
        $criteria->compare('jenis_kelamin', $this->jenis_kelamin, true);
        $criteria->compare('agama', $this->agama, true);
        $criteria->compare('tmt_keterangan_kedudukan', $this->tmt_keterangan_kedudukan, true);
        $criteria->compare('Pangkat.golongan_id', isset($_POST['golongan_id']) ? $_POST['golongan_id'] : "", true);
        $criteria->compare('kedudukan_id', $this->kedudukan_id);
        $criteria->compare('status_pernikahan', $this->status_pernikahan, true);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('kode_pos', $this->kode_pos, true);
        $criteria->compare('hp', $this->hp, true);
        $criteria->compare('golongan_darah', $this->golongan_darah, true);
        $criteria->compare('bpjs', $this->bpjs, true);
        $criteria->compare('npwp', $this->npwp, true);
        $criteria->compare('kpe', $this->kpe, true);
        $criteria->compare('kpe', $this->karpeg, true);
        $criteria->compare('kpe', $this->no_taspen, true);
        $criteria->compare('foto', $this->foto, true);
        $criteria->compare('tmt_cpns', $this->tmt_cpns, true);
        $criteria->compare('tmt_pns', $this->tmt_pns, true);
        $criteria->compare('t.riwayat_pangkat_id', $this->riwayat_pangkat_id);
        if (isset($_POST['Pegawai'])) {
            $criteria->compare('Pangkat.tmt_pangkat', $_POST['Pegawai']['tmt_golongan'], true);
        }
        $criteria->compare('t.tipe_jabatan', $this->tipe_jabatan, true);
        $criteria->compare('t.jabatan_struktural_id', $this->jabatan_struktural_id);
        $criteria->compare('t.jabatan_fu_id', $this->jabatan_fu_id);
        $criteria->compare('t.jabatan_ft_id', $this->jabatan_ft_id);
        $criteria->compare('tmt_pensiun', $this->tmt_pensiun, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'nama')
        ));

        return $data;
    }

    public function search2() {
        $criteria2 = new CDbCriteria();
        $criteria2->with = array('RiwayatPendidikan', 'RiwayatJabatan');
        $criteria2->together = true;
        if (!empty($this->riwayat_jabatan_id) && $this->riwayat_jabatan_id > 0)
            $criteria2->compare('riwayat_jabatan_id', $this->riwayat_jabatan_id);
        if (!empty($this->riwayat_pangkat_id) && $this->riwayat_pangkat_id > 0)
            $criteria2->compare('t.riwayat_pangkat_id', $this->riwayat_pangat_id);
        if (!empty($this->kedudukan_id) && $this->kedudukan_id > 0)
            $criteria2->compare('kedudukan_id', $this->kedudukan_id);
        if (!empty($this->tipe_jabatan))
            $criteria2->compare('tipe_jabatan', $this->tipe_jabatan);
        if (isset($_POST['jurusan']) and !empty($_POST['jurusan'])) {
            $criteria2->compare('RiwayatPendidikan.id_jurusan', $_POST['id_jurusan']);
        }
        $criteria2->addCondition('t.id = RiwayatPendidikan.pegawai_id');

        if (!empty($this->tmt_pns) && !empty($this->tmt_pensiun))
            $criteria2->addInCondition('tmt_pensiun between "' . $this->tmt_pns . '" and "' . $this->tmt_pensiun . '"');

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria2,
            'sort' => false,
        ));

        return $data;
    }

    //// untuk rekap jabatan fungsional
    public function searchJabFung() {
        $criteria = new CDbCriteria();
        $criteria->with = array('RiwayatJabatan', 'JabatanStruktural', 'JabatanFt');
//        $criteria->together = true;
        $criteria->addCondition('t.kedudukan_id=1');
        if (!empty($_POST['riwayat_jabatan_id'])) {
            $criteria->addCondition('JabatanStruktural.unit_kerja_id=' . $_POST['riwayat_jabatan_id']);
        }
        if (!empty($_POST['type'])) {
            if ($_POST['type'] == 'ft') {
                $criteria->addCondition('t.tipe_jabatan="fungsional_tertentu"');
            }
            if ($_POST['type'] == 'fu') {
                $criteria->addCondition('t.tipe_jabatan="fungsional_umum"');
            }
            if ($_POST['type'] == 'guru') {
                $criteria->addCondition('JabatanFt.type="guru"');
            }
            if ($_POST['type'] == 'keshatan') {
                $criteria->addCondition('JabatanFt.type="kesehatan"');
            }
        }
        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 't.nama ASC')
        ));

        return $data;
    }

    /// search untuk rekap eselon
    public function searchEselon() {
        $criteria = new CDbCriteria();
        $criteria->with = array('RiwayatJabatan', 'JabatanStruktural');
        $criteria->addCondition('kedudukan_id=1');
        if (!empty($_POST['riwayat_jabatan_id'])) {
            $criteria->addCondition('JabatanStruktural.unit_kerja_id=' . $_POST['riwayat_jabatan_id']);
        }
        if (!empty($_POST['eselon_id'])) {
            $criteria->addCondition('JabatanStruktural.eselon_id=' . $_POST['eselon_id']);
        }
        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => false,
        ));

        return $data;
    }

    /// search batas pensiun
    public function searchBup() {
        $criteria = new CDbCriteria();
        $criteria->with = array('JabatanStruktural');

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => false,
        ));

        return $data;
    }

    /// laporan pensiun pensiun
    public function searchPensiun() {
        $criteria = new CDbCriteria();
        $criteria->with = array('JabatanStruktural');
        if (!empty($_POST['tahun']) && !empty($_POST['bulan'])) {
            $criteria->addCondition('month(t.tmt_pensiun)=' . $_POST['bulan']);
            $criteria->addCondition('year(t.tmt_pensiun)=' . $_POST['tahun']);
            if (!empty($_POST['satuan_kerja_id'])) {
                $criteria->addCondition('JabatanStruktural.unit_kerja_id=' . $_POST['satuan_kerja_id']);
            }
            if (!empty($_POST['eselon_id'])) {
            $criteria->addCondition('JabatanStruktural.eselon_id=' . $_POST['eselon_id']);
        }
        }
        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => false,
        ));

        return $data;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Pegawai the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function listPegawai() {
//        if (!app()->session['listPegawai']) {
//            $result = array();
//            $users = $this->findAll(array('index' => 'id'));
//            app()->session['listPegawai'] = $users;
//        }
        $users = $this->findAll(array('index' => 'id'));
//        return app()->session['listPegawai'];
        return $users;
    }

    protected function beforeValidate() {
        if (empty($this->created_user_id)) {
            $this->created_user_id = Yii::app()->user->id;
            $this->modified = date("Y-m-d H:i:s");
            $this->modified_user_id = Yii::app()->user->id;
        }
        return parent::beforeValidate();
    }

    public function getBup() {
        $eselon = isset($this->RiwayatJabatan->JabatanStruktural->Eselon->nama) ? $this->RiwayatJabatan->JabatanStruktural->Eselon->nama : "-";
        $tingkatEselon = substr($eselon, 0, 2);
        $bup = '-';
        if (isset($this->RiwayatJabatan)) {
            if ($tingkatEselon == "II" and $this->RiwayatJabatan->tipe_jabatan == "struktural") {
                $bup = '60';
            } else if (($tingkatEselon == "III" or $tingkatEselon == "IV" or $tingkatEselon == "V") and $this->RiwayatJabatan->tipe_jabatan == "struktural") {
                $bup = '58';
            } else if ($this->RiwayatJabatan->tipe_jabatan == "fungsional_umum") {
                $bup = '60';
            } else if ($this->RiwayatJabatan->tipe_jabatan == "fungsional_tertentu") {
                $bup = '58';
            }
        }
        return $bup;
    }

    public function getGolongan() {
        return (!empty($this->Pangkat->Golongan->nama)) ? $this->Pangkat->Golongan->nama . ' - ' . $this->Pangkat->Golongan->keterangan : '-';
    }
   
    public function getTujuanMutasi() {
        return (!empty($this->PermohonanMutasi->UnitKerja->nama)) ? $this->PermohonanMutasi->UnitKerja->nama : '-';
    }
    public function getTmtTujuanMutasi() {
        return (!empty($this->PermohonanMutasi->tmt)) ? $this->PermohonanMutasi->tmt : '-';
    }

    public function getEselon() {
        return (!empty($this->JabatanStruktural->Eselon->nama)) ? $this->JabatanStruktural->Eselon->nama : '-';
    }

    public function getUnitKerjaJabatan() {
        return (!empty($this->RiwayatJabatan->JabatanStruktural->nama) ? $this->RiwayatJabatan->JabatanStruktural->nama : "-");
    }

    public function getRiwayatTipeJabatan() {
        return (!empty($this->RiwayatJabatan->tipe)) ? $this->RiwayatJabatan->tipe : '-';
    }

    public function getRiwayatNamaJabatan() {
        return (!empty($this->RiwayatJabatan->jabatanPegawai)) ? $this->RiwayatJabatan->jabatanPegawai : '-';
    }

    public function getRiwayatTmtJabatan() {
        return (!empty($this->RiwayatJabatan->tmt_mulai)) ? $this->RiwayatJabatan->tmt_mulai : '-';
    }

    public function getGajiPegawai() {
        return (!empty($this->Gaji->gaji)) ? landa()->rp($this->Gaji->gaji) : '-';
    }

    public function getTmtGaji() {
        return (!empty($this->Gaji->tmt_mulai)) ? $this->Gaji->tmt_mulai : '-';
    }

    public function getPangkat() {
        return (!empty($this->Pangkat->nama_golongan)) ? $this->Pangkat->nama_golongan : '-';
    }

    public function getTmtPangkat() {
        return (!empty($this->Pangkat->tmt_pangkat)) ? $this->Pangkat->tmt_pangkat : '-';
    }

    public function getPendidikanTerakhir() {
        return (!empty($this->Pendidikan->Jurusan->tingkat)) ? $this->Pendidikan->Jurusan->tingkat : '-';
    }

    public function getPendidikanTahun() {
        return (!empty($this->Pendidikan->tahun)) ? $this->Pendidikan->tahun : '-';
    }

    public function getPendidikanJurusan() {
        return (!empty($this->Pendidikan->jurusan)) ? $this->Pendidikan->jurusan : '-';
    }

    public function getLastEdit() {
        return (!empty($this->LastEdit->name)) ? date('d-M-Y, H:i', strtotime($this->modified)) . ' Oleh ' . $this->LastEdit->name : '-';
    }

    public function getNamaGolongan() {
        return (!empty($this->Golongan->nama)) ? $this->Golongan->nama : '-';
    }

    public function getNipNama() {
        return $this->nip . ' - ' . $this->nama;
    }

    public function getUnitKerja() {
        return (!empty($this->RiwayatJabatan->JabatanStruktural->UnitKerja->nama)) ? $this->RiwayatJabatan->JabatanStruktural->UnitKerja->nama : '-';
    }

    public function getKedudukan() {
        return (!empty($this->Kedudukan->nama)) ? $this->Kedudukan->nama : '-';
    }

    public function getTempatLahir() {
        return (!empty($this->tempat_lahir)) ? $this->tempat_lahir : '-';
    }

    public function getCity() {
        return (!empty($this->City->name)) ? $this->City->name : '-';
    }

    public function getTipe() {
        return ucwords(str_replace("_", " ", $this->tipe_jabatan));
    }

    public function getTipe_inisial() {
        if ($this->tipe_jabatan == "fungsional_umum")
            $result = "FU";
        elseif ($this->tipe_jabatan == "fungsional_tertentu")
            $result = "FT";
        else
            $result = "Eseleon";

        return $result;
    }

    public function getJabatanStruktural() {
        return (!empty($this->JabatanStruktural->nama)) ? $this->JabatanStruktural->nama : '-';
    }

    public function getJabatanFu() {
        return (!empty($this->JabatanFu->nama)) ? $this->JabatanFu->nama : '-';
    }

    public function getJabatanFt() {
        return (!empty($this->JabatanFt->nama)) ? $this->JabatanFt->nama : '-';
    }

    public function getJabatan() {
        if ($this->tipe_jabatan == "struktural") {
            return (!empty($this->JabatanStruktural->nama)) ? $this->JabatanStruktural->nama : '-';
        } elseif ($this->tipe_jabatan == "fungsional_umum") {
            return (!empty($this->JabatanFu->nama)) ? $this->JabatanFu->nama : '-';
        } elseif ($this->tipe_jabatan == "fungsional_tertentu") {
            return (!empty($this->JabatanFt->nama)) ? $this->JabatanFt->nama : '-';
        } else {
            return '-';
        }
    }

    public function getTmtJabatan() {
        return isset($this->RiwayatJabatan->tmt_mulai) ? $this->RiwayatJabatan->tmt_mulai : "-";
    }

    public function getImgUrl() {
        return landa()->urlImg('pegawai/', $this->foto, $this->id);
    }

    public function getSmallFoto() {
        return '<img style="width:40px;height:40px" src="' . $this->imgUrl['small'] . '" class="img-polaroid"/>';
    }

    public function getTinyFoto() {
        return '<img src="' . $this->imgUrl['small'] . '" style="width:70px" class="img-polaroid"/>';
    }

    public function getMediumFoto() {
        return '<img src="' . $this->imgUrl['medium'] . '" class="img-polaroid"/>';
    }
    

    public function getUsia() {
        return landa()->usia(date('d-m-Y', strtotime($this->tanggal_lahir)));
    }

    public function getMasaKerja() {
        if (empty($this->tmt_cpns)) {
            return '';
        }
        else
            return landa()->usia(date('d-m-Y', strtotime($this->tmt_cpns)));
    }

    public function getMasaKerjaTahun() {
        if (isset($this->perubahan_masa_kerja) and !empty($this->perubahan_masa_kerja)) {
            $perubahan = json_decode($this->perubahan_masa_kerja, false);
        }

        $perubahanTahun = isset($perubahan->tahun) ? $perubahan->tahun * -1 : 0;
        $perubahanBulan = isset($perubahan->bulan) ? $perubahan->bulan * -1 : 0;
        if ($this->tmt_cpns != NULL and $this->tmt_cpns != "0000-00-00") {
            $date = explode("-", $this->tmt_cpns);
            $tmt = mktime(0, 0, 0, $date[1] + $perubahanBulan, $date[2], $date[0] + $perubahanTahun);
            $tmt_cpns = date("Y-m-d", $tmt);
        } else {
            $tmt_cpns = date("Y-m-d");
        }

        if (empty($this->tmt_cpns)) {
            $tahun = '';
        }
        else
            $tahun = str_replace(" Tahun", "", landa()->usia(date('d-m-Y', strtotime($tmt_cpns)), true));

        return $tahun;
    }

    public function getMasaKerjaBulan() {
        if (isset($this->perubahan_masa_kerja) and !empty($this->perubahan_masa_kerja)) {
            $perubahan = json_decode($this->perubahan_masa_kerja, false);
        }
        $perubahanTahun = isset($perubahan->tahun) ? $perubahan->tahun * -1 : 0;
        $perubahanBulan = isset($perubahan->bulan) ? $perubahan->bulan * -1 : 0;

        if ($this->tmt_cpns != NULL and $this->tmt_cpns != "0000-00-00") {
            $date = explode("-", $this->tmt_cpns);
            $tmt = mktime(0, 0, 0, $date[1] + $perubahanBulan, $date[2], $date[0] + $perubahanTahun);
            $tmt_cpns = date("Y-m-d", $tmt);
        } else {
            $tmt_cpns = date("Y-m-d");
        }

        if (empty($this->tmt_cpns)) {
            $bulan = '';
        }
        else
            $bulan = str_replace(" Bulan", "", landa()->usia(date('d-m-Y', strtotime($tmt_cpns)), false, true));

        return $bulan;
    }

    public function getTtl() {
        return ucwords(strtolower($this->tempatLahir)) . ', ' . date('d M Y', strtotime($this->tanggal_lahir));
    }

    public function getNamaGelar() {
        $depan = (empty($this->gelar_depan) || $this->gelar_depan == "NULL" ) ? '' : $this->gelar_depan . '. ';
        $belakang = (empty($this->gelar_belakang) || $this->gelar_belakang == "NULL" ) ? '' : ', ' . $this->gelar_belakang . '. ';
//        $belakang = (empty($this->gelar_belakang)) ? ', ' . $this->gelar_belakang : '';
        return $depan . $this->nama . $belakang;
    }

    public function getStatus() {
        if ($this->tmt_pns == "0000-00-00" || $this->tmt_pns == "") {
            $status = 'CPNS';
        } else {
            $status = 'PNS';
        }
        return $status;
    }

    public function arrRekapitulasi() {
        $agama = array('jenis_kelamin' => '1 | Jenis Kelamin', 'agama' => '2 | Agama', 'tingkat_pendidikan' => '3 | Tingkat Pendidikan', 'golongan' => '4 | Golongan', 'jabatan' => '5 | Jabatan');
        return $agama;
    }

    public function arrRekapitulasiJabfung() {
        $agama = array('ft' => '1 | Fungsional tertentu', 'fu' => '2 | Fungsional Umum', 'guru' => '3 | Kelompok Guru', 'kesehatan' => '4 | Kelompok Kesehatan');
        return $agama;
    }

    public function arrAgama() {
        $agama = array('Islam' => 'Islam', 'Hindu' => 'Hindu', 'Budha' => 'Budha', 'Khatolik' => 'Khatolik', 'Protestan' => 'Protestan', 'Konghucu' => 'Konghucu', 'Lainnya' => 'Lainnya');
        return $agama;
    }

    public function arrJenisKelamin() {
        $agama = array('Laki - Laki' => 'Laki - Laki', 'Perempuan' => 'Perempuan');
        return $agama;
    }

    public function arrHubungan() {
        $agama = array('suami' => 'Suami', 'istri' => 'Istri', 'anak' => 'Anak');
        return $agama;
    }

    public function arrStatusHubungan() {
        $agama = array('aktif' => 'Aktif', 'cerai' => 'Cerai', 'meninggal' => 'Meninggal');
        return $agama;
    }

    public function arrStatusAnak() {
        $agama = array('kandung' => 'Kandung', 'tiri' => 'Tiri', 'angkat' => 'Angkat');
        return $agama;
    }

    public function arrGolonganDarah() {
        $agama = array('A' => 'A', 'B' => 'B', 'O' => 'O', 'AB' => 'AB');
        return $agama;
    }

    public function arrYesNo() {
        $yes = array('0' => 'Tidak', '1' => 'Ya');
        return $yes;
    }

    public function arrTipeJabatan() {
        $yes = array('struktural' => 'Eselon', 'fungsional_umum' => 'Fungsional Umum', 'fungsional_tertentu' => 'Fungsional Tertentu');
        return $yes;
    }

    public function arrJenjangPendidikan() {
        $data = array('SD' => 'SD', 'SLTP' => 'SLTP', 'SLTA/SMK' => 'SLTA/SMK', 'D-I' => 'D-I', 'D-II' => 'D-II', 'D-III' => 'D-III', 'D-IV' => 'D-IV', 'S-1' => 'S-1', 'S-2' => 'S-2', 'S-3' => 'S-3');
        return $data;
    }

    public function arrStatusPernikahan() {
        $data = array('Lajang' => 'Lajang', 'Menikah' => 'Menikah', 'Janda / Duda' => 'Janda / Duda');
        return $data;
    }

    public function getTagProfil() {
        $data = '<div  style="padding:15px">
                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>NIP</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span4" style="text-align:left;">
                        ' . $this->nip . '
                    </div>
                </div>        
                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Nama</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->namaGelar . '
                    </div>
                </div>  

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Pendidikan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . ucwords(strtolower($this->pendidikanTerakhir)) . ', Tahun : ' . $this->pendidikanTahun . '
                    </div>
                </div>  

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Jurusan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . ucwords(strtolower($this->pendidikanJurusan)) . '
                    </div>
                </div>  

               <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Jenis Kelamin</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->jenis_kelamin . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>TTL</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->ttl . '
                    </div>
                </div>  

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Alamat</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->alamat . ' ' . $this->city . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Kode Pos</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->kode_pos . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>HP</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . landa()->hp($this->hp) . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Agama</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->agama . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Golongan Darah</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->golongan_darah . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>Status Pernikahan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->status_pernikahan . '
                    </div>
                </div>
               
               <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>NPWP</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->npwp . '
                    </div>
                </div>
 <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>KPE</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->kpe . '
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span2" style="text-align:left">
                        <b>BPJS</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->bpjs . '
                    </div>
                </div>
</div>
                ';
        return $data;
    }

    public function getTagPangkatJabatan() {
        $data = '
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Kedudukan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->kedudukan . '
                    </div>
                </div>        
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Unit Kerja</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->unitKerja . '
                    </div>
                </div>  

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>TMT CPNS</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . date('d M Y', strtotime($this->tmt_cpns)) . '
                    </div>
                </div> 

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>TMT PNS</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . date('d M Y', strtotime($this->tmt_pns)) . '
                    </div>
                </div> 

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Pangkat / Golru</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->golongan . ' TMT : ' . date('d M Y', strtotime($this->tmt_golongan)) . '
                    </div>
                </div>   

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Tipe Jabatan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . ucwords(str_replace("_", " ", $this->tipe_jabatan)) . '
                    </div>
                </div>  

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Jabatan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->jabatan . ', TMT :  ' . $this->tmtJabatan . '
                    </div>
                </div> 

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Masa Kerja</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->masaKerja . '
                    </div>
                </div>   

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Gaji</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . landa()->rp($this->Gaji->gaji) . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>TMT Pensiun</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . date('d M Y', strtotime($this->tmt_pensiun)) . '
                    </div>
                </div>           
                ';
        return $data;
    }

    public function actionGetPensiun() {
        $tgl_lahir = $this->tanggal_lahir;
        $bup = 0;
//        if (!empty($this->tipe_jabatan)) {
//            if ($this->tipe_jabatan == "struktural") {
//                $eselon = isset($this->RiwayatJabatan->JabatanStruktural->Eselon->nama) ? $this->RiwayatJabatan->JabatanStruktural->Eselon->nama : "-";
//                $tingkatEselon = substr($eselon, 0, 2);
//                if ($tingkatEselon == "II") {
//                    $bup = 60;
//                } else if ($tingkatEselon == "III" or $tingkatEselon == "IV" or $tingkatEselon == "V") {
//                    $bup = 58;
//                }
//            } else if ($jabatan->tipe_jabatan == "fungsional_umum") {
//                $bup = 58;
//            } else if ($jabatan->tipe_jabatan == "fungsional_tertentu") {
//                $bup = 60;
//            }
//        } else {
//            $bup = 0;
//        }
        $date = explode("-", $tgl_lahir);
        $tmt_pensiun = mktime(0, 0, 0, $date[1], $date[2], $date[0] + $bup);
        return date("Y-m-d", $tmt_pensiun);
    }

}
