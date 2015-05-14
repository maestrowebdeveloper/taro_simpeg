<?php

/**
 * This is the model class for table "{{riwayat_pangkat}}".
 *
 * The followings are the available columns in table '{{riwayat_pangkat}}':
 * @property integer $id
 * @property string $nomor_register
 * @property integer $pegawai_id
 * @property integer $golongan_id
 * @property string $nama_golongan
 * @property string $tmt_pangkat
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class RiwayatPangkat extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{riwayat_pangkat}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nomor_register, pegawai_id, golongan_id,  tmt_pangkat', 'required'),
            array('', 'safe'),
            array('pegawai_id, golongan_id, created_user_id', 'numerical', 'integerOnly' => true),
            array('nomor_register', 'length', 'max' => 225),
            array('', 'length', 'max' => 25),
            array('modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nomor_register, pegawai_id, golongan_id, tmt_pangkat,no_sk,tgl_sk, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.am
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Pegawai' => array(self::BELONGS_TO, 'Pegawai', 'pegawai_id'),
            'Golongan' => array(self::BELONGS_TO, 'Golongan', 'golongan_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'NIP',
            'nomor_register' => 'Nomor CG',
            'pegawai_id' => 'Pegawai',
            'golongan_id' => 'Golongan',
//			'nama_golongan' => 'Nama Golongan',
            'tmt_pangkat' => 'Tmt Pangkat',
            'tgl_sk' => 'Tanggal SK',
            'tmt_pangkat' => 'Tanggal',
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
        $criteria->with = array('Pegawai', 'Golongan');
        $criteria->together = true;

        $criteria->compare('Pegawai.nip', $this->id, true);
        $criteria->compare('nomor_register', $this->nomor_register, true);
        $criteria->compare('Pegawai.nama', $this->pegawai_id, true);
        $criteria->compare('golongan_id', $this->golongan_id);
//		$criteria->compare('nama_golongan',$this->nama_golongan,true);
        $criteria->compare('tmt_pangkat', $this->tmt_pangkat, true);
        $criteria->compare('tgl_sk', $this->tgl_sk, true);
        $criteria->compare('no_sk', $this->no_sk, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'tmt_pangkat DESC')
        ));
        //app()->session['RiwayatPangkat_records'] = $this->findAll($criteria); 

        return $data;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RiwayatPangkat the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }

    public function getGolongan() {
        return (!empty($this->Golongan->nama)) ? $this->Golongan->nama . ' - ' . $this->Golongan->keterangan : '-';
    }

    public function getPegawai() {
        return (!empty($this->Pegawai->nama)) ? $this->Pegawai->nama : '-';
    }

}
