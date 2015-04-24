<?php

/**
 * This is the model class for table "{{permohonan_perpanjangan_honorer}}".
 *
 * The followings are the available columns in table '{{permohonan_perpanjangan_honorer}}':
 * @property integer $id
 * @property string $nomor_register
 * @property string $tanggal
 * @property integer $honorer_id
 * @property integer $honor_saat_ini
 * @property string $masa_kerja
 * @property integer $unit_kerja_id
 * @property string $tmt_mulai
 * @property string $tmt_selesai
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class PermohonanPerpanjanganHonorer extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{permohonan_perpanjangan_honorer}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nomor_register, tanggal, honorer_id, tmt_mulai, tmt_selesai', 'required'),
            array('honor_saat_ini, masa_kerja, unit_kerja_id, created, created_user_id, modified', 'safe'),
            array('honorer_id, honor_saat_ini, unit_kerja_id, created_user_id', 'numerical', 'integerOnly' => true),
            array('nomor_register, masa_kerja', 'length', 'max' => 225),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nomor_register, tanggal, honorer_id, honor_saat_ini, masa_kerja, unit_kerja_id, tmt_mulai, tmt_selesai, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Honorer' => array(self::BELONGS_TO, 'Honorer', 'honorer_id'),
            'UnitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja_id'),
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
            'honorer_id' => 'Honorer',
            'honor_saat_ini' => 'Besar Honor',
            'masa_kerja' => 'Masa Kerja',
            'unit_kerja_id' => 'Unit Kerja',
            'tmt_mulai' => 'Tmt Mulai',
            'tmt_selesai' => 'Tmt Selesai',
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
        $criteria->compare('honorer_id', $this->honorer_id);
        $criteria->compare('honor_saat_ini', $this->honor_saat_ini);
        $criteria->compare('masa_kerja', $this->masa_kerja, true);
        $criteria->compare('unit_kerja_id', $this->unit_kerja_id);
        $criteria->compare('tmt_mulai', $this->tmt_mulai, true);
        $criteria->compare('tmt_selesai', $this->tmt_selesai, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'tanggal DESC')
        ));

        //app()->session['PermohonanPerpanjanganHonorer_records'] = $this->findAll($criteria); 

        return $data;
    }

    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
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

    public function getHonorer() {
        return (!empty($this->Honorer->nama)) ? $this->Honorer->nama : '-';
    }

    public function getUnitKerja() {
        return (!empty($this->UnitKerja->nama)) ? $this->UnitKerja->nama : '-';
    }

    public function getNomorPengangkatan() {
        return (!empty($this->Honorer->nomor_register)) ? $this->Honorer->nomor_register : '-';
    }

    public function getTanggalPengangkatan() {
        return (!empty($this->Honorer->tanggal_register)) ? $this->Honorer->tanggal_register : '-';
    }

    public function getTmtPengangkatan() {
        return (!empty($this->Honorer->tmt_kontrak)) ? $this->Honorer->tmt_kontrak : '-';
    }

    public function getTtl() {
        return (!empty($this->Honorer->ttl)) ? $this->Honorer->ttl : '-';
    }

    public function getJenisKelamin() {
        return (!empty($this->Honorer->jenis_kelamin)) ? $this->Honorer->jenis_kelamin : '-';
    }

    public function getPendidikan() {
        return (!empty($this->Honorer->pendidikan_terakhir)) ? $this->Honorer->pendidikan_terakhir : '-';
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PermohonanPerpanjanganHonorer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
