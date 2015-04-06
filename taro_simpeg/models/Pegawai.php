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
            array('nip, nama, tanggal_lahir, jenis_kelamin,  kedudukan_id, unit_kerja_id', 'required'),
            array('gelar_depan, gelar_belakang, tempat_lahir,pendidikan_terakhir, tahun_pendidikan,agama, kedudukan_id, status_pernikahan, alamat, kota, kode_pos, hp, golongan_darah, bpjs, npwp, foto, tmt_cpns, tmt_pns, golongan_id, tmt_golongan, tipe_jabatan, jabatan_struktural_id, tmt_jabatan_struktural, jabatan_fu_id, tmt_jabatan_fu, jabatan_ft_id, tmt_jabatan_ft, gaji, tmt_pensiun, created, created_user_id, id', 'safe'),
            array('tempat_lahir, kedudukan_id, kota, unit_kerja_id, golongan_id, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, gaji, created_user_id, id', 'numerical', 'integerOnly' => true),
            array('nip, gelar_depan, gelar_belakang, bpjs, kpe, npwp', 'length', 'max' => 50),
            array('nama', 'length', 'max' => 100),
            array('jenis_kelamin', 'length', 'max' => 11),
            array('agama, pendidikan_terakhir', 'length', 'max' => 9),
            array('tahun_pendidikan, kode_pos', 'length', 'max' => 10),
            array('status_pernikahan', 'length', 'max' => 12),
            array('hp', 'length', 'max' => 25),
            array('golongan_darah', 'length', 'max' => 5),
            array('foto', 'length', 'max' => 225),
            array('tipe_jabatan', 'length', 'max' => 19),
            array('modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nip, nama, gelar_depan, gelar_belakang, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, pendidikan_terakhir, tahun_pendidikan, kedudukan_id, status_pernikahan, alamat, kota, kode_pos, hp, golongan_darah, bpjs, kpe, npwp, foto, unit_kerja_id, tmt_cpns, tmt_pns, golongan_id, tmt_golongan, tipe_jabatan, jabatan_struktural_id, tmt_jabatan_struktural, jabatan_fu_id, tmt_jabatan_fu, jabatan_ft_id, tmt_jabatan_ft, gaji, tmt_pensiun, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        return array(
            'UnitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja_id'),
            'Golongan' => array(self::BELONGS_TO, 'Golongan', 'golongan_id'),
            'TempatLahir' => array(self::BELONGS_TO, 'City', 'tempat_lahir'),
            'Kota' => array(self::BELONGS_TO, 'City', 'kota'),
            'Kedudukan' => array(self::BELONGS_TO, 'Kedudukan', 'kedudukan_id'),
            'JabatanStruktural' => array(self::BELONGS_TO, 'JabatanStruktural', 'jabatan_struktural_id'),
            'JabatanFu' => array(self::BELONGS_TO, 'JabatanFu', 'jabatan_fu_id'),
            'JabatanFt' => array(self::BELONGS_TO, 'JabatanFt', 'jabatan_ft_id'),
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
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama' => 'Agama',
            'pendidikan_terakhir' => 'Pendidikan Terakhir',
            'tahun_pendidikan' => 'Tahun Pendidikan',
            'kedudukan_id' => 'Kedudukan',
            'status_pernikahan' => 'Status Pernikahan',
            'alamat' => 'Alamat',
            'kota' => 'Kota',
            'kode_pos' => 'Kode Pos',
            'hp' => 'Hp',
            'golongan_darah' => 'Golongan Darah',
            'bpjs' => 'BPJS',
            'npwp' => 'No. NPWP',
            'kpe' => 'KPE',
            'no_taspen' => 'No. TASPEN',
            'foto' => 'Foto',
            'unit_kerja_id' => 'Unit Kerja',
            'tmt_cpns' => 'Tmt CPNS',
            'tmt_pns' => 'Tmt PNS',
            'golongan_id' => 'Pangkat/Golru',
            'tmt_golongan' => 'Tmt Golongan',
            'tipe_jabatan' => 'Tipe Jabatan',
            'jabatan_struktural_id' => 'Jabatan Struktural',
            'tmt_jabatan_struktural' => 'Tmt Jabatan Struktural',
            'jabatan_fu_id' => 'Jabatan Fu',
            'tmt_jabatan_fu' => 'Tmt Jabatan Fu',
            'jabatan_ft_id' => 'Jabatan Ft',
            'tmt_jabatan_ft' => 'Tmt Jabatan Ft',
            'gaji' => 'Gaji',
            'tmt_pensiun' => 'Tmt Pensiun',
            'created' => 'Created',
            'created_user_id' => 'Created User',
            'modified' => 'Upload File Excel',
        );
    }

    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

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

        if (isset($_GET['lahir']))
            $criteria->addCondition('tanggal_lahir = "0000-00-00"');
        if (isset($_GET['jk']))
            $criteria->addCondition('jenis_kelamin = ""');
        if (isset($_GET['agama']))
            $criteria->addCondition('agama = ""');
        if (isset($_GET['pangkat']))
            $criteria->addCondition('golongan_id = ""');
        if (isset($_GET['jabatan'])) {
            $criteria->addCondition('jabatan_struktural_id = ""');
            $criteria->addCondition('jabatan_fu_id = ""');
            $criteria->addCondition('jabatan_ft_id = ""');
        }
        if (isset($_GET['pendidikan']))
            $criteria->addCondition('pendidikan_terakhir = ""');

        $criteria->compare('id', $this->id);
        $criteria->compare('nip', $this->nip, true);
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('gelar_depan', $this->gelar_depan, true);
        $criteria->compare('gelar_belakang', $this->gelar_belakang, true);
        $criteria->compare('tempat_lahir', $this->tempat_lahir);
        $criteria->compare('tanggal_lahir', $this->tanggal_lahir, true);
        $criteria->compare('jenis_kelamin', $this->jenis_kelamin, true);
        $criteria->compare('agama', $this->agama, true);
        $criteria->compare('pendidikan_terakhir', $this->pendidikan_terakhir, true);
        $criteria->compare('tahun_pendidikan', $this->tahun_pendidikan, true);
        $criteria->compare('kedudukan_id', $this->kedudukan_id);
        $criteria->compare('status_pernikahan', $this->status_pernikahan, true);
        $criteria->compare('alamat', $this->alamat, true);
        $criteria->compare('kota', $this->kota);
        $criteria->compare('kode_pos', $this->kode_pos, true);
        $criteria->compare('hp', $this->hp, true);
        $criteria->compare('golongan_darah', $this->golongan_darah, true);
        $criteria->compare('bpjs', $this->bpjs, true);
        $criteria->compare('npwp', $this->npwp, true);
        $criteria->compare('kpe', $this->kpe, true);
        $criteria->compare('foto', $this->foto, true);
        $criteria->compare('unit_kerja_id', $this->unit_kerja_id);
        $criteria->compare('tmt_cpns', $this->tmt_cpns, true);
        $criteria->compare('tmt_pns', $this->tmt_pns, true);
        $criteria->compare('golongan_id', $this->golongan_id);
        $criteria->compare('tmt_golongan', $this->tmt_golongan, true);
        $criteria->compare('tipe_jabatan', $this->tipe_jabatan, true);
        $criteria->compare('jabatan_struktural_id', $this->jabatan_struktural_id);
        $criteria->compare('tmt_jabatan_struktural', $this->tmt_jabatan_struktural, true);
        $criteria->compare('jabatan_fu_id', $this->jabatan_fu_id);
        $criteria->compare('tmt_jabatan_fu', $this->tmt_jabatan_fu, true);
        $criteria->compare('jabatan_ft_id', $this->jabatan_ft_id);
        $criteria->compare('tmt_jabatan_ft', $this->tmt_jabatan_ft, true);
        $criteria->compare('gaji', $this->gaji);
        $criteria->compare('tmt_pensiun', $this->tmt_pensiun, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'nama')
        ));
        app()->session['Pegawai_records'] = $this->findAll($criteria);

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
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }

    public function getGolongan() {
        return (!empty($this->Golongan->nama)) ? $this->Golongan->nama . ' - ' . $this->Golongan->keterangan : '-';
    }

    public function getNamaGolongan() {
        return (!empty($this->Golongan->nama)) ? $this->Golongan->nama : '-';
    }

    public function getNipNama() {
        return $this->nip . ' - ' . $this->nama;
    }

    public function getUnitKerja() {
        return (!empty($this->UnitKerja->nama)) ? $this->UnitKerja->nama : '-';
    }

    public function getKedudukan() {
        return (!empty($this->Kedudukan->nama)) ? $this->Kedudukan->nama : '-';
    }

    public function getTempatLahir() {
        return (!empty($this->TempatLahir->name)) ? $this->TempatLahir->name : '-';
    }

    public function getKota() {
        return (!empty($this->Kota->name)) ? $this->Kota->name : '-';
    }

    public function getTipe() {
        return ucwords(str_replace("_", " ", $this->tipe_jabatan));
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
        if ($this->tipe_jabatan == "struktural") {
            return date('d M Y', strtotime($this->tmt_jabatan_struktural));
        } elseif ($this->tipe_jabatan == "fungsional_umum") {
            return date('d M Y', strtotime($this->tmt_jabatan_fu));
        } elseif ($this->tipe_jabatan == "fungsional_tertentu") {
            return date('d M Y', strtotime($this->tmt_jabatan_ft));
        } else {
            return '-';
        }
    }

    public function getImgUrl() {
        return landa()->urlImg('pegawai/', $this->foto, $this->id);
    }

    public function getSmallFoto() {
        return '<img style="width:98px;height:98px" src="' . $this->imgUrl['small'] . '" class="img-polaroid"/>';
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
        return landa()->usia(date('d-m-Y', strtotime($this->tmt_cpns)));
    }

    public function getTtl() {
        return ucwords(strtolower($this->tempatLahir)) . ', ' . date('d M Y', strtotime($this->tanggal_lahir));
    }

    public function getNamaGelar() {
        $depan = !empty($this->gelar_depan) ? $this->gelar_depan . '. ' : '';
        $belakang = !empty($this->gelar_belakang) ? ', ' . $this->gelar_belakang : '';
        return $depan . $this->nama . $belakang;
    }

    public function arrRekapitulasi() {
        $agama = array('jenis_kelamin' => '1 | Jenis Kelamin', 'agama' => '2 | Agama', 'tingkat_pendidikan' => '3 | Tingkat Pendidikan', 'golongan' => '4 | Golongan', 'jabatan' => '5 | Jabatan');
        return $agama;
    }

    public function arrAgama() {
        $agama = array('Islam' => 'Islam', 'Hindu' => 'Hindu', 'Budha' => 'Budha', 'Katolik' => 'Katolik', 'Protestan' => 'Protestan', 'Konghucu' => 'Konghucu', 'Lainnya' => 'Lainnya');
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
        $yes = array('struktural' => 'Struktural', 'fungsional_umum' => 'Fungsional Umum', 'fungsional_tertentu' => 'Fungsional Tertentu');
        return $yes;
    }

    public function arrJenjangPendidikan() {
        $data = array('SD' => 'SD', 'SMP' => 'SMP', 'SMA/SMK' => 'SMA/SMK', 'D-I' => 'D-I', 'D-II' => 'D-II', 'D-III' => 'D-III', 'D-IV' => 'D-IV', 'S-1' => 'S-1', 'S-2' => 'S-2', 'S-3' => 'S-3');
        return $data;
    }

    public function arrStatusPernikahan() {
        $data = array('Lajang' => 'Lajang', 'Menikah' => 'Menikah', 'Janda / Duda' => 'Janda / Duda');
        return $data;
    }

    public function getTagProfil() {
        $data = '
                <div class="row-fluid">
                    <div class="span3" style="text-align:left">
                        <b>NIP</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->nip . '
                    </div>
                </div>        
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
                        ' . ucwords(strtolower($this->pendidikan_terakhir)) . ', Tahun : ' . $this->tahun_pendidikan . '
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
                        ' . $this->alamat . ' ' . $this->kota . '
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
                        <b>KPE</b>
                    </div>
                    <div class="span1">:</div>
                    <div class="span8" style="text-align:left">
                        ' . $this->kpe . '
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
                        ' . landa()->rp($this->gaji) . '
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

}
