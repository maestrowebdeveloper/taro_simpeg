<?php

class PermohonanMutasi extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{permohonan_mutasi}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array(' created,pejabat,mutasi,status,tipe_jabatan_lama,unit_kerja_lama,jabatan_lama, created_user_id, modified,unit_kerja_id, tipe_jabatan, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id', 'safe'),
            array('nomor_register, tanggal, pegawai_id, new_tipe_jabatan, new_jabatan_struktural_id, new_jabatan_fu_id, new_jabatan_ft_id, tmt', 'required'),
            array('pegawai_id, unit_kerja_id, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, new_unit_kerja_id, new_jabatan_struktural_id, new_jabatan_fu_id, new_jabatan_ft_id, created_user_id', 'numerical', 'integerOnly' => true),
            array('nomor_register', 'length', 'max' => 100),
            array('tipe_jabatan, new_tipe_jabatan', 'length', 'max' => 19),
            // The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('id, nomor_register, pejabat,mutasi,status,tanggal, pegawai_id, unit_kerja_id, tipe_jabatan, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, new_unit_kerja_id, new_tipe_jabatan, new_jabatan_struktural_id, new_jabatan_fu_id, new_jabatan_ft_id, tmt, created, created_user_id, modified', 'safe', 'on' => 'search'),
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
            'UnitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'new_unit_kerja_id'),
            'JabatanStruktural' => array(self::BELONGS_TO, 'JabatanStruktural', 'new_jabatan_struktural_id'),
            'JabatanFu' => array(self::BELONGS_TO, 'JabatanFu', 'new_jabatan_fu_id'),
            'JabatanFt' => array(self::BELONGS_TO, 'JabatanFt', 'new_jabatan_ft_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nomor_register' => 'Nomor SK',
            'tanggal' => 'Tanggal',
            'pegawai_id' => 'Pegawai',
            'unit_kerja_id' => 'Unit Kerja Lama',
            'tipe_jabatan' => 'Tipe Jabatan Lama',
            'jabatan_struktural_id' => 'Unit Kerja',
            'jabatan_fu_id' => 'Jabatan Lama',
            'jabatan_ft_id' => 'Jabatan Lama',
            'new_unit_kerja_id' => 'Unit Kerja Baru',
            'new_tipe_jabatan' => 'Tipe Jabatan Baru',
            'new_jabatan_struktural_id' => 'Unit Kerja',
            'new_jabatan_fu_id' => 'Jabatan Baru',
            'new_jabatan_ft_id' => 'Jabatan Baru',
            'tmt' => 'Tmt',
            'pejabat' => 'Yang menconfirm',
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
    public function search() {
// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('nomor_register', $this->nomor_register, true);
        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('pegawai_id', $this->pegawai_id);
        $criteria->compare('unit_kerja_id', $this->unit_kerja_id);
        $criteria->compare('tipe_jabatan', $this->tipe_jabatan, true);
        $criteria->compare('jabatan_struktural_id', $this->jabatan_struktural_id);
        $criteria->compare('jabatan_fu_id', $this->jabatan_fu_id);
        $criteria->compare('jabatan_ft_id', $this->jabatan_ft_id);
        $criteria->compare('unit_kerja_lama', $this->jabatan_ft_id, true);
        $criteria->compare('tipe_jabatan_lama', $this->jabatan_ft_id, true);
        $criteria->compare('jabatan_lama', $this->jabatan_ft_id, true);
        $criteria->compare('new_unit_kerja_id', $this->new_unit_kerja_id);
        $criteria->compare('new_tipe_jabatan', $this->new_tipe_jabatan, true);
        $criteria->compare('new_jabatan_struktural_id', $this->new_jabatan_struktural_id);
        $criteria->compare('new_jabatan_fu_id', $this->new_jabatan_fu_id);
        $criteria->compare('new_jabatan_ft_id', $this->new_jabatan_ft_id);
        $criteria->compare('tmt', $this->tmt, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'id DESC')
        ));
//app()->session['PermohonanMutasi_records'] = $this->findAll($criteria);

        return $data;
    }

    public function search2() {
        $criteria2 = new CDbCriteria();
        if (!empty($this->tanggal) && !empty($this->created))
            $criteria2->condition = 'tanggal between "' . $this->tanggal . '" and "' . $this->created . '"';

        if (!empty($this->mutasi))
            $criteria2->compare('mutasi', $this->mutasi);

        if (!empty($this->status))
            $criteria2->compare('status', $this->status);

        $isi = new CActiveDataProvider($this, array(
            'criteria' => $criteria2,
        ));
        return $isi;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PermohonanMutasi the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getTglMutasi() {
        return date('d-m-Y', strtotime($this->tanggal)) ;
    }
    public function getTmtMutasi() {
        return date('d-m-Y', strtotime($this->tmt));
    }
    public function getPegawai() {
        return (!empty($this->Pegawai->nama)) ? $this->Pegawai->nama : '-';
    }

    public function getUnitKerja() {
        return (!empty($this->UnitKerja->nama)) ? $this->UnitKerja->nama : '-';
    }

    public function getTipeJabatan() {
        return ucwords(str_replace("_", " ", $this->new_tipe_jabatan));
    }

    public function getJabatan() {
        if ($this->new_tipe_jabatan == "struktural") {
            return (!empty($this->JabatanStruktural->nama)) ? $this->JabatanStruktural->nama : '-';
        } elseif ($this->tipe_jabatan == "fungsional_umum") {
            return (!empty($this->JabatanFu->nama)) ? $this->JabatanFu->nama : '-';
        } elseif ($this->tipe_jabatan == "fungsional_tertentu") {
            return (!empty($this->JabatanFt->nama)) ? $this->JabatanFt->nama : '-';
        } else {
            return '-';
        }
    }

    public function getStatusoto() {
        if ($this->status == 2) {
            $status = '<span class="label label-info">Sudah</span>';
        } else {
            $status = '<span class="label label-warning">Belum</span>';
        }
        return $status;
    }
    public function getStatuExel() {
        if ($this->status == 2) {
            $status = 'Sudah';
        } else {
            $status = 'Belum';
        }
        return $status;
    }
    
    public function getStatusTempat() {
        if ($this->mutasi == "luar_daerah") {
            $status = '<span class="label label-info">Luar Daerah</span>';
        } else {
            $status = '<span class="label label-warning">Dalam Daerah</span>';
        }
        return $status;
    }
    public function getStatusTempatExl() {
        if ($this->mutasi == "luar_daerah") {
            $status = 'Luar Daerah';
        } else {
            $status = 'Dalam Daerah';
        }
        return $status;
    }
    

    public function arrMutasi() {
        $agama = array('luar_daerah' => '1 | Luar Daerah', 'dalam_daerah' => '2 | Dalam Daerah');
        return $agama;
    }

}
