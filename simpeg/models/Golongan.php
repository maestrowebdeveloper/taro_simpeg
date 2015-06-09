<?php

/**
 * This is the model class for table "{{golongan}}".
 *
 * The followings are the available columns in table '{{golongan}}':
 * @property integer $id
 * @property string $nama
 * @property string $keterangan
 * @property integer $level
 * @property integer $lft
 * @property integer $rgt
 * @property integer $root
 * @property integer $parent_id
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class Golongan extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{golongan}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(' created, created_user_id,tingkat', 'safe'),
            array('nama, keterangan', 'required'),
            array('created_user_id', 'numerical', 'integerOnly' => true),
            array('nama', 'length', 'max' => 100),
            array('modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nama, keterangan,  created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nama' => 'Golru',
            'keterangan' => 'Pangkat',
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
        $criteria->compare('nama', $this->nama, true);
        $criteria->compare('keterangan', $this->keterangan, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'nama',),
        ));

        //app()->session['Golongan_records'] = $this->findAll($criteria); 

        return $data;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Golongan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getGolongan() {
        return $this->nama . ' - ' . $this->keterangan;
    }

    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }

    public function golJabatan($type, $id) {
        $golongan = array(
            'Terampil' => array(
                21 => 'Pelaksana Pemula',
                22 => 'Pelaksana',
                23 => 'Pelaksana',
                24 => 'Pelaksana',
                31 => 'Pelaksana Lanjutan',
                32 => 'Pelaksana Lanjutan',
                33 => 'Penyelia',
                34 => 'Penyelia',
            ),
            'Ahli' => array(
                31 => 'Ahli Pertama',
                32 => 'Ahli Pertama',
                33 => 'Ahli Muda',
                34 => 'Ahli Muda',
                41 => 'Ahli Madya',
                42 => 'Ahli Madya',
                43 => 'Ahli Madya',
                44 => 'Ahli Utama',
                45 => 'Ahli Utama',
            )
        );
        return (!empty($golongan[$type][$id])) ? $golongan[$type][$id] : '';
    }

}
