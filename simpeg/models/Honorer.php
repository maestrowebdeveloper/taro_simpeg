<?php

class Honorer extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{honorer}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nomor_register, nama,tanggal_register, tanggal_lahir', 'required'),
            array('kode,gelar_depan,gelar_belakang,tempat_lahir,st_peg,pengesahan,status_sk, ket_agama, tanggal_lahir, jenis_kelamin, agama, id_jurusan, tahun_pendidikan, status_pernikahan, alamat, city_id, kode_pos, hp, golongan_darah, bpjs, npwp, foto,  tmt_kontrak, jabatan_struktural_id,jabatan_fu_id, tmt_jabatan, tmt_mulai_kontrak, tmt_akhir_kontrak, gaji, created, created_user_id', 'safe'),
            array(' unit_kerja_id, jabatan_struktural_id, gaji, created_user_id', 'numerical', 'integerOnly' => true),
            array('nomor_register, foto', 'length', 'max' => 225),
            array('nama', 'length', 'max' => 100),
            array('jenis_kelamin', 'length', 'max' => 11),
            array('agama', 'length', 'max' => 9),
            array('tahun_pendidikan, kode_pos', 'length', 'max' => 10),
            array('status_pernikahan', 'length', 'max' => 12),
            array('hp', 'length', 'max' => 25),
            array('golongan_darah', 'length', 'max' => 5),
            array('bpjs, npwp', 'length', 'max' => 50),
            array('modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id,kode,status_sk, st_peg,pengesahan, nomor_register, nama,gelar_depan,gelar_belakang, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, id_jurusan, tahun_pendidikan, status_pernikahan, alamat, city_id, kode_pos, hp, golongan_darah, bpjs, npwp, foto, unit_kerja_id, tmt_kontrak, jabatan_struktural_id,jabatan_fu_id, tmt_jabatan, tmt_mulai_kontrak, tmt_akhir_kontrak, gaji, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'SatuanKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja_id'),
            'Jurusan' => array(self::BELONGS_TO, 'Jurusan', 'id_jurusan'),
            'JabatanStruktural' => array(self::BELONGS_TO, 'JabatanStruktural', 'jabatan_struktural_id'),
            'JabatanFt' => array(self::BELONGS_TO, 'JabatanFt', 'jabatan_fu_id'),
//			'TempatLahir' => array(self::BELONGS_TO, 'City', 'tempat_lahir'),
            'City' => array(self::BELONGS_TO, 'City', 'city_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'kode' => 'Kode',
            'nomor_register' => 'No SK Pertama',
            'tanggal_register' => 'Tanggal SK Pertama',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'st_peg' => 'Status',
            'pengesahan' => 'Disahkan Oleh',
            'ket_agama' => 'Keterangan Agama',
            'id_jurusan' => 'Pendidikan Terakhir',
            'tahun_pendidikan' => 'Tahun Pendidikan',
            'status_pernikahan' => 'Status Pernikahan',
            'alamat' => 'Alamat',
            'city_id' => 'Kota',
            'kode_pos' => 'Kode Pos',
            'hp' => 'Hp',
            'golongan_darah' => 'Golongan Darah',
            'bpjs' => 'Bpjs / Askes / KIS',
            'npwp' => 'No. NPWP',
            'foto' => 'Foto',
//            'unit_kerja_id' => 'Unit Kerja',
            'tmt_kontrak' => 'Tmt Kontrak Pertama',
            'jabatan_struktural_id' => 'Unit Kerja',
            'jabatan_fu_id' => 'Jabatan',
            'tmt_jabatan' => 'Tmt Jabatan',
            'tmt_akhir_kontrak' => 'Tmt Akhir Kontrak',
            'tmt_mulai_kontrak' => 'Tmt Mulai Kontrak',
            'gaji' => 'Gaji',
            'created' => 'Created',
            'created_user_id' => 'Created User',
            'modified' => 'Modified',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search($export = null) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('Jurusan', 'JabatanStruktural', 'JabatanFt', 'City');
        $criteria->order = 't.nama ASC';

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
//        if (!empty($this->kode)){
//            $criteria->addCondition('kode IN (20,40)');
//        }

        $criteria->compare('id', $this->id);
//        $criteria->compare('kode', $this->kode);
        $criteria->compare('nomor_register', $this->nomor_register, true);
        if (!empty($this->kode))
            $criteria->compare('t.kode', $this->kode);
        if (!empty($this->jenis_kelamin))
            $criteria->compare('t.jenis_kelamin', $this->jenis_kelamin);
        if (!empty($this->nama))
            $criteria->compare('t.nama', $this->nama, true);
        if (!empty($this->agama))
            $criteria->compare('t.agama', $this->agama);
        if (!empty($this->id_jurusan))
            $criteria->compare('t.id_jurusan', $this->id_jurusan);
        if (!empty($this->tahun_pendidikan))
            $criteria->compare('t.tahun_pendidikan', $this->tahun_pendidikan, true);
        if (!empty($this->nomor_register))
            $criteria->compare('t.nomor_register', $this->nomor_register, true);
        if (!empty($this->jabatan_struktural_id))
            $criteria->compare('t.jabatan_struktural_id', $this->jabatan_struktural_id, true);
        if (!empty($this->jabatan_fu_id))
            $criteria->compare('t.jabatan_fu_id', $this->jabatan_fu_id, true);

        if (empty($export)) {
            $data = new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort' => array('defaultOrder' => 't.nama')
            ));
        } else {
            $data = Honorer::model()->findAll($criteria);
        }

        return $data;
    }

    public function search2() {
        $criteria2 = new CDbCriteria();
        if (!empty($this->jabatan_struktural_id))
            $criteria2->compare('jabatan_struktural_id', $this->jabatan_struktural_id);
        if (!empty($this->tmt_kontrak) && !empty($this->tmt_akhir_kontrak))
            $criteria2->condition = 'tmt_akhir_kontrak between "' . $this->tmt_kontrak . '" and "' . $this->tmt_akhir_kontrak . '"';

        $isi = new CActiveDataProvider($this, array(
            'criteria' => $criteria2,
        ));
        return $isi;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Honorer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }

    public function listHonorer() {
        /* if (!app()->session['listHonorer']) {
          $result = array(); */
        $users = $this->findAll(array('index' => 'id'));
        /* app()->session['listHonorer'] = $users;
          } */
        return $users; // app()->session['listHonorer'];
    }

    public function getMasaKerjaTahun() {
        $date1 = explode("-", $this->tmt_kontrak);
        $tmt1 = mktime(0, 0, 0, $date1[1], $date1[2], $date1[0]);

        $date2 = explode("-", $this->tmt_mulai_kontrak);
        $tmt2 = mktime(0, 0, 0, $date2[1], $date2[2], $date2[0]);

        $tmt_kontrak = date("d-m-Y", $tmt1);
        $tmt_mulai_kontrak = date("d-m-Y", $tmt2);

        if (isset($tmt_kontrak) or ! empty($tmt_kontrak)) {
            $tahun = str_replace(" Tahun", "", KenaikanGaji::model()->masaKerja($tmt_kontrak, $tmt_mulai_kontrak, true));
            return $tahun;
        }
    }

    public function getMasaKerjaBulan() {
        $date1 = explode("-", $this->tmt_kontrak);
        $tmt1 = mktime(0, 0, 0, $date1[1], $date1[2], $date1[0]);

        $date2 = explode("-", $this->tmt_mulai_kontrak);
        $tmt2 = mktime(0, 0, 0, $date2[1], $date2[2], $date2[0]);

        $tmt_kontrak = date("d-m-Y", $tmt1);
        $tmt_mulai_kontrak = date("d-m-Y", $tmt2);

        if (isset($tmt_kontrak) or ! empty($tmt_kontrak)) {
            $bulan = str_replace(" Bulan", "", KenaikanGaji::model()->masaKerja($tmt_kontrak, $tmt_mulai_kontrak, false, true));
            return $bulan;
        }
    }

    public function getTagProfil() {
        $data = '
                       
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Nama</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->namaGelar . '
                    </div>
                </div>  

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Pendidikan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . ucwords(strtolower($this->pendidikan)) . ', Tahun : ' . $this->tahun_pendidikan . '
                    </div>
                </div>  

               <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Jenis Kelamin</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->jenis_kelamin . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>TTL</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->ttl . '
                    </div>
                </div>  

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Alamat</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->alamat . ' ' . $this->namaCity . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Kode Pos</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->kode_pos . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>HP</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . landa()->hp($this->hp) . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Agama</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->agama . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Golongan Darah</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->golongan_darah . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Status Pernikahan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->status_pernikahan . '
                    </div>
                </div>
               
               <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>NPWP</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->npwp . '
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>BPJS</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->bpjs . '
                    </div>
                </div>

                ';
        return $data;
    }

    public function getTagPangkatJabatan() {
        $data = '
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Nomor Register</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->nomor_register . '
                    </div>
                </div>   
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Tanggal Register</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->tanggal_register . '
                    </div>
                </div>      
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Satuan Kerja</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->satuanKerja . '
                    </div>
                </div>  
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Jabatan</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->unitKerja . ', TMT :  ' . $this->tmtJabatan . '
                    </div>
                </div> 
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>Gaji</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . landa()->rp($this->gaji) . '
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
                        <b>TMT Kontrak</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . landa()->date2Ind($this->tmt_kontrak) . '
                    </div>
                </div>      
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>TMT Mulai Kontrak</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . landa()->date2Ind($this->tmt_mulai_kontrak) . '
                    </div>
                </div>      
                 <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>TMT Akhir Kontrak</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . landa()->date2Ind($this->tmt_akhir_kontrak) . '
                    </div>
                </div>        
                ';
        return $data;
    }

    public function arrStatus() {
        $agama = array('gtt' => 'Guru Tidak Tetap', 'ptt' => 'Pegawai Tidak Tetap', 'tkd' => 'Tenaga Kontrak Daerah');
        return $agama;
    }

    public function arrStatusSk() {
        $agama = array('40' => 'SK Bupati non Database', '20' => 'SK Bupati non Database Lulus', '21' => 'SK Bupati non Database Pensiun');
        return $agama;
    }

    public function getUnitKerja() {
        return (!empty($this->JabatanStruktural->nama)) ? $this->JabatanStruktural->nama : '-';
    }

    public function getSatuanKerja() {
        return (!empty($this->JabatanStruktural->UnitKerja->nama)) ? $this->JabatanStruktural->UnitKerja->nama : '-';
    }

    public function getTempatLahir() {
        return (!empty($this->TempatLahir->name)) ? $this->TempatLahir->name : '-';
    }

    public function getStatusSK() {
        if ($this->status_sk == '40') {
            $status = "SK Bupati non Database";
        } elseif ($this->status_sk == '20') {
            $status = "SK Bupati non Database Lulus";
        } elseif ($this->status_sk == '21') {
            $status = "SK Bupati non Database Pensiun";
        } else {
            $status = '-';
        }
        return $status;
    }

    public function getKota() {
        return (!empty($this->City->name)) ? $this->City->name : '-';
    }

    public function getNamaCity() {
        return (!empty($this->City->name)) ? $this->City->name : '-';
    }

    public function getJabatan() {
        return (!empty($this->JabatanFt->nama)) ? $this->JabatanFt->nama : '-';
    }

    public function getTmtJabatan() {
        return landa()->date2Ind($this->tmt_jabatan);
    }

    public function getTmtKontrak() {
        return landa()->date2Ind($this->tmt_kontrak);
    }

    public function getTmtMulaiKontrak() {
        return landa()->date2Ind($this->tmt_mulai_kontrak);
    }

    public function getTglLahir() {
        return landa()->date2Ind($this->tanggal_lahir);
    }

    public function getTmtAkhirKontrak() {
        return landa()->date2Ind($this->tmt_akhir_kontrak);
    }

    public function getImgUrl() {
//        return param('pathImg') . 'honorer/' . $this->foto;
        return(!empty($this->foto)) ? param('pathImg') . 'honorer/' . $this->foto : param('pathImg') . '350x350-noimage.jpg';
    }

    public function getSmallFoto() {
        return '<img style="width:40px;height:40px" src="' . $this->imgUrl . '" class="img-polaroid"/>';
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
        return landa()->usia(date('d-m-Y', strtotime($this->tmt_kontrak)));
    }

    public function getTtl() {
        return ucwords(strtolower($this->tempat_lahir)) . ', ' . landa()->date2Ind($this->tanggal_lahir);
    }

    public function getPendidikan() {
        '';
        return (!empty($this->Jurusan->Name)) ? $this->Jurusan->tingkat . ' - ' . $this->Jurusan->Name : '-';
    }

    public function getNamaGelar() {
        $depan = !empty($this->gelar_depan) ? $this->gelar_depan . '. ' : '';
        $belakang = !empty($this->gelar_belakang) ? ', ' . $this->gelar_belakang : '';
        return $depan . $this->nama . $belakang;
    }

}
