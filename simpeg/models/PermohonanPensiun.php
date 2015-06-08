<?php

/**
 * This is the model class for table "{{permohonan_pensiun}}".
 *
 * The followings are the available columns in table '{{permohonan_pensiun}}':
 * @property integer $id
 * @property string $nomor_register
 * @property string $tanggal
 * @property integer $pegawai_id
 * @property integer $unit_kerja_id
 * @property string $tipe_jabatan
 * @property integer $jabatan_struktural_id
 * @property integer $jabatan_fu_id
 * @property integer $jabatan_ft_id
 * @property string $masa_kerja
 * @property string $tmt
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class PermohonanPensiun extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{permohonan_pensiun}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nomor_register, tanggal, pegawai_id,tmt', 'required'),
            array('unit_kerja_id, tipe_jabatan, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, masa_kerja, created, created_user_id, modified', 'safe'),
            array('pegawai_id, unit_kerja_id, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, created_user_id', 'numerical', 'integerOnly' => true),
            array('nomor_register', 'length', 'max' => 100),
            array('tipe_jabatan', 'length', 'max' => 19),
            array('masa_kerja', 'length', 'max' => 50),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nomor_register, status,tanggal, pegawai_id, unit_kerja_id, tipe_jabatan, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, masa_kerja, tmt, created, created_user_id, modified', 'safe', 'on' => 'search'),
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
            'UnitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja_id'),
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
            'nomor_register' => 'Nomor Register',
            'tanggal' => 'Tanggal',
            'pegawai_id' => 'Pegawai',
            'unit_kerja_id' => 'Unit Kerja',
            'tipe_jabatan' => 'Tipe Jabatan',
            'jabatan_struktural_id' => 'Jabatan',
            'jabatan_fu_id' => 'Jabatan Fu',
            'jabatan_ft_id' => 'Jabatan Ft',
            'masa_kerja' => 'Masa Kerja',
            'tmt' => 'Tmt',
            'status' => 'Status Pensiun',
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
         $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('nomor_register', $this->nomor_register, true);
        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('pegawai_id', $this->pegawai_id, true);
        $criteria->compare('unit_kerja_id', $this->unit_kerja_id);
        $criteria->compare('tipe_jabatan', $this->tipe_jabatan, true);
        $criteria->compare('jabatan_struktural_id', $this->jabatan_struktural_id);
        $criteria->compare('jabatan_fu_id', $this->jabatan_fu_id);
        $criteria->compare('jabatan_ft_id', $this->jabatan_ft_id);
        $criteria->compare('masa_kerja', $this->masa_kerja, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('tmt', $this->tmt, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);

        if (empty($export)) {
            $data = new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort' => array('defaultOrder' => 'id DESC')
            ));
        } else {
            $data = PermohonanPensiun::model()->findAll($criteria);
        }

        //app()->session['PermohonanMutasi_records'] = $this->findAll($criteria); 

        return $data;
    }

    public function search2() {
        $criteria2 = new CDbCriteria();
        if (!empty($this->tanggal) && !empty($this->created))
            $criteria2->condition = 'tanggal between "' . $this->tanggal . '" and "' . $this->created . '"';

        $isi = new CActiveDataProvider($this, array(
            'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));
        return $isi;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PermohonanPensiun the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getStatusPensiun() {
        if ($this->status == 'sudah') {
            $status = '<span class="label label-success">Sudah</span>';
        } else {
            $status = '<span class="label label-warning">Belum</span>';
        }
        return $status;
    }

    public function getPegawai() {
        return (!empty($this->Pegawai->nama)) ? $this->Pegawai->nama : '-';
    }

    public function getTglPensiun() {
        return (!empty($this->tanggal)) ? landa()->date2Ind($this->tanggal) : '-';
    }

    public function getTmtPensiun() {
        return (!empty($this->tmt)) ? landa()->date2Ind($this->tmt) : '-';
    }

    public function getUnitKerja() {
        return (!empty($this->UnitKerja->nama)) ? $this->UnitKerja->nama : '-';
    }

    public function getSatuanKerja() {
        return (!empty($this->JabatanStruktural->UnitKerja->nama)) ? $this->JabatanStruktural->UnitKerja->nama : '-';
    }

    public function getTipeJabatan() {
        return ucwords(str_replace("_", " ", $this->tipe_jabatan));
    }

    public function arrStatus() {
        $agama = array('sudah' => 'Sudah', 'belum' => 'Belum');
        return $agama;
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

}
