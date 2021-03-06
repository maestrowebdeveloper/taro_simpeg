<?php

/**
 * This is the model class for table "{{permohonan_ijin_belajar}}".
 *
 * The followings are the available columns in table '{{permohonan_ijin_belajar}}':
 * @property integer $id
 * @property string $nomor_register
 * @property string $tanggal
 * @property integer $pegawai_id
 * @property string $nip
 * @property string $golongan
 * @property string $jabatan
 * @property string $unit_kerja
 * @property string $jenjang_pendidikan
 * @property string $jurusan
 * @property string $nama_sekolah
 * @property integer $kota
 * @property string $alamat
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class PermohonanIjinBelajar extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{permohonan_ijin_belajar}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('nomor_register, tanggal, pegawai_id, jenjang_pendidikan,id_jurusan,  tanggal_usul', 'required'),
            array('nip,status, golongan,tanggal, no_usul ,tanggal_usul, nama,jabatan, unit_kerja, id_jurusan, id_universitas, kota, alamat, nama_sekolah, created, created_user_id, modified', 'safe'),
            array('pegawai_id, kota, created_user_id', 'numerical', 'integerOnly' => true),
            array('nomor_register, nip, jabatan, unit_kerja, nama_sekolah', 'length', 'max' => 225),
            array('golongan', 'length', 'max' => 100),
            array('jenjang_pendidikan', 'length', 'max' => 9),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nomor_register, no_usul,nama, tanggal,tanggal_usul, pegawai_id, nip, golongan,status, jabatan, unit_kerja, jenjang_pendidikan, id_jurusan, nama_sekolah, kota, alamat, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Pegawai' => array(self::BELONGS_TO, 'Pegawai', 'pegawai_id'),
            'Jurusan' => array(self::BELONGS_TO, 'Jurusan', 'id_jurusan'),
//            'JurusanUniv' => array(self::BELONGS_TO, 'Jurusan', 'id_jurusan'),
            'Univ' => array(self::BELONGS_TO, 'Universitas', 'id_universitas'),
            'Kota' => array(self::BELONGS_TO, 'City', 'kota'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nomor_register' => 'Nomor Register',
            'no_usul' => 'Nomor Usul',
            'tanggal' => 'Tanggal Input',
            'pegawai_id' => 'Pegawai',
            'status' => 'Status',
            'nip' => 'Nip',
            'nama' => 'Nama Pegawai',
            'golongan' => 'Golongan',
            'jabatan' => 'Jabatan',
            'unit_kerja' => 'Unit Kerja',
            'jenjang_pendidikan' => 'Jenjang Pendidikan',
            'jenjang_pendidikan_asal' => 'Pendidikan Asal',
            'id_jurusan' => 'Jurusan',
            'nama_sekolah' => 'Nama Sekolah',
            'kota' => 'Kota',
            'alamat' => 'Alamat',
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

        if (!empty($_GET['PermohonanIjinBelajar']['tanggal_usul']) && !empty($_GET['PermohonanIjinBelajar']['created'])) {
            $awal = $_GET['PermohonanIjinBelajar']['tanggal_usul'];
            $akhir = $_GET['PermohonanIjinBelajar']['created'];
//            $criteria->addCondition = "tanggal  >= '$awal' and tanggal <= '$akhir'";
            $criteria->addCondition('tanggal between "' . $awal . '" and "' . $akhir . '"');
        }
        $criteria->order = 'tanggal DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('nomor_register', $this->nomor_register, true);
        $criteria->compare('no_usul', $this->no_usul, true);
        $criteria->compare('nama', $this->nomor_register, true);
//        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('pegawai_id', $this->pegawai_id);
        $criteria->compare('status', $this->status);
        $criteria->compare('nip', $this->nip, true);
        $criteria->compare('golongan', $this->golongan, true);
        $criteria->compare('jabatan', $this->jabatan, true);
        $criteria->compare('unit_kerja', $this->unit_kerja, true);
        $criteria->compare('jenjang_pendidikan', $this->jenjang_pendidikan, true);
        $criteria->compare('id_jurusan', $this->id_jurusan, true);
        $criteria->compare('nama_sekolah', $this->nama_sekolah, true);
        $criteria->compare('kota', $this->kota);
        $criteria->compare('alamat', $this->alamat, true);

        if (empty($export)) {
            $data = new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort' => array('defaultOrder' => 'tanggal DESC')
            ));
        } else {
            $data = PermohonanIjinBelajar::model()->findAll($criteria);
        }

        //app()->session['PermohonanIjinBelajar_records'] = $this->findAll($criteria);

        return $data;
    }

    public function search2() {
        $criteria2 = new CDbCriteria();
        if (!empty($this->tanggal) && !empty($this->created))
            $criteria->condition = 'tanggal between "' . $this->tanggal . '" and "' . $this->created . '"';
        $isi = new CActiveDataProvider($this, array(
            'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'id')
        ));
        return $isi;
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }

    public function getTglIjnBelajar() {
        return (empty($this->tanggal) || strtotime($this->tanggal) < 0) ? '-' : landa()->date2Ind($this->tanggal);
    }

    public function getTglUsul() {
        return (empty($this->tanggal_usul) || strtotime($this->tanggal_usul) < 0) ? '-' : landa()->date2Ind($this->tanggal_usul);
    }

    public function getPegawai() {
        if(!empty($this->Pegawai->nama)){
            $depan = (!empty($this->Pegawai->gelar_depan) || $this->Pegawai->gelar_depan == "NULL" || $this->Pegawai->gelar_depan == "0") ? '' : $this->Pegawai->gelar_depan . '. ';
        $belakang = (empty($this->Pegawai->gelar_belakang) || $this->Pegawai->gelar_belakang == "NULL" || $this->Pegawai->gelar_belakang == "0" ) ? '' : ', ' . $this->Pegawai->gelar_belakang . '. ';
        $nama = (!empty($this->Pegawai->nama)) ? $this->Pegawai->nama : '-';
       
        return $depan.strtoupper($nama).$belakang;
        }else{
            return $this->nama;
        }
        
    }

    public function getSatuanKerja() {
        return (!empty($this->Pegawai->JabatanStruktural->UnitKerja->nama)) ? $this->Pegawai->JabatanStruktural->UnitKerja->nama : '-';
    }

    public function getUnitKerja() {
        return (!empty($this->Pegawai->unitKerjaJabatan)) ? $this->Pegawai->unitKerjaJabatan : '-';
    }
    public function getGolru() {
        return (!empty($this->Pegawai->Pangkat->golongan)) ? $this->Pegawai->Pangkat->golongan : '-';
    }

    public function getJabatanPegawai() {
        return (!empty($this->Pegawai->jabatan)) ? $this->Pegawai->jabatan : '-';
    }

    public function getjurusanUniv() {
        return (!empty($this->Jurusan->Name)) ? $this->Jurusan->Name : '-';
    }

    public function getUniv() {
        return (!empty($this->Univ->name)) ? $this->Univ->name : '-';
    }

    public function getKotaSekolah() {
        return (!empty($this->Kota->name)) ? $this->Kota->name : '-';
    }

    public function arrStatuspros() {
        $agama = array('0' => 'Proses', '1' => 'Selesai');
        return $agama;
    }

    public function getStat() {
        $status = '';
        if ($this->status == 1) {
            $status = '<span class="label label-info">Sudah</span>';
        } else {
            $status = '<span class="label label-warning">Belum</span>';
        }
        return $status;
    }

}
