<?php

/**
 * This is the model class for table "{{jabatan_fungsional}}".
 *
 * The followings are the available columns in table '{{jabatan_fungsional}}':
 * @property integer $id
 * @property string $nama
 * @property string $keterangan
 * @property integer $golongan_id
 * @property integer $jabatan_ft_id
 * @property string $created
 * @property string $modified
 */
class JabatanFungsional extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{jabatan_fungsional}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('jabatan_ft_id, max_golongan_id, min_golongan_id', 'numerical', 'integerOnly' => true),
            array('nama', 'length', 'max' => 30),
            array('keterangan, created, modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nama, keterangan, jabatan_ft_id, max_golongan_id, min_golongan_id, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'DetailJf' => array(self::HAS_MANY, 'DetailJf', 'jabatan_fungsional_id'),
            'JabatanFt' => array(self::BELONGS_TO, 'JabatanFt', 'jabatan_ft_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
            'jabatan_ft_id' => 'Jabatan Ft',
            'created' => 'Created',
            'modified' => 'Modified',
            'min_golongan_id' => 'Golongan Terendah',
            'max_golongan_id' => 'Golongan Tertinggi'
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
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('keterangan', $this->keterangan, true);
        $criteria->compare('jabatan_ft_id', $this->jabatan_ft_id);
        $criteria->compare('created', $this->created, true);
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
     * @return JabatanFungsional the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    
    public function getJabFt(){
        return (isset($this->JabatanFt->nama)) ? $this->JabatanFt->nama : '-';
    }

}