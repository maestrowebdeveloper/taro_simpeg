<?php

/**
 * This is the model class for table "{{riwayat_cuti}}".
 *
 * The followings are the available columns in table '{{riwayat_cuti}}':
 * @property integer $id
 * @property integer $pegawai_id
 * @property string $jenis_cuti
 * @property string $no_sk
 * @property string $tanggal_sk
 * @property string $mulai_cuti
 * @property string $selesai_cuti
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class RiwayatCuti extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{riwayat_cuti}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('jenis_cuti, pajabat', 'required'),
            array('pegawai_id, created_user_id', 'numerical', 'integerOnly' => true),
            array('jenis_cuti, no_sk', 'length', 'max' => 255),
            array('tanggal_sk, mulai_cuti, selesai_cuti, created', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, pegawai_id, pejabat, cuti_id, jenis_cuti, no_sk, tanggal_sk, mulai_cuti, selesai_cuti, created, created_user_id, modified', 'safe', 'on' => 'search'),
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
            'Cuti' => array(self::BELONGS_TO, 'Cuti', 'cuti_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'pegawai_id' => 'Pegawai',
            'jenis_cuti' => 'Jenis Cuti',
            'no_sk' => 'Nomor Sk',
            'tanggal_sk' => 'Tanggal',
            'mulai_cuti' => 'Mulai Cuti',
            'selesai_cuti' => 'Selesai Cuti',
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
        $criteria->compare('pegawai_id', $this->pegawai_id);
        $criteria->compare('jenis_cuti', $this->jenis_cuti, true);
        $criteria->compare('no_sk', $this->no_sk, true);
        $criteria->compare('tanggal_sk', $this->tanggal_sk, true);
        $criteria->compare('mulai_cuti', $this->mulai_cuti, true);
        $criteria->compare('selesai_cuti', $this->selesai_cuti, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'id DESC')
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RiwayatCuti the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }
     public function getPegawai() {        
        return (!empty($this->Pegawai->nama))?$this->Pegawai->nama:'-';
    }

    public function getHukuman() {        
        return (!empty($this->Cuti->nama))?$this->Cuti->nama:'-';
    }

}
