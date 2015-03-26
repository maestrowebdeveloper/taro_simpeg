<?php

/**
 * This is the model class for table "{{nilai_honorer}}".
 *
 * The followings are the available columns in table '{{nilai_honorer}}':
 * @property integer $id
 * @property integer $pegawai_id
 * @property string $tanggal
 * @property integer $tahun
 * @property string $nilai_hasil_kerja
 * @property string $nilai_orientasi_pelayanan
 * @property string $nilai_integritas
 * @property string $nilai_disiplin
 * @property string $nilai_kerja_sama
 * @property string $nilai_kreativitas
 * @property string $created_user_id
 * @property string $created
 * @property string $modified
 * @property string $no_register
 */
class NilaiHonorer extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{nilai_honorer}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pegawai_id, tahun', 'numerical', 'integerOnly' => true),
            array('nilai_hasil_kerja, nilai_orientasi_pelayanan, nilai_integritas, nilai_disiplin, nilai_kerja_sama, nilai_kreativitas', 'length', 'max' => 5),
            array('no_register', 'length', 'max' => 30),
            array('tanggal, created_user_id, created, modified, id', 'safe'),
            array('tanggal, tahun, nilai_hasil_kerja, nilai_orientasi_pelayanan, nilai_integritas, nilai_disiplin, nilai_kerja_sama, nilai_kreativitas' => 'required'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, pegawai_id, tanggal, tahun, nilai_hasil_kerja, nilai_orientasi_pelayanan, nilai_integritas, nilai_disiplin, nilai_kerja_sama, nilai_kreativitas, created_user_id, created, modified, no_register', 'safe', 'on' => 'search'),
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
            'pegawai_id' => 'Pegawai',
            'tanggal' => 'Tanggal Input',
            'tahun' => 'Tahun',
            'nilai_hasil_kerja' => 'Nilai Hasil Kerja',
            'nilai_orientasi_pelayanan' => 'Nilai Orientasi Pelayanan',
            'nilai_integritas' => 'Nilai Integritas',
            'nilai_disiplin' => 'Nilai Disiplin',
            'nilai_kerja_sama' => 'Nilai Kerja Sama',
            'nilai_kreativitas' => 'Nilai Kreativitas',
            'created_user_id' => 'Created User',
            'created' => 'Created',
            'modified' => 'Modified',
            'no_register' => 'No Register',
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
        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('tahun', $this->tahun);
        $criteria->compare('nilai_hasil_kerja', $this->nilai_hasil_kerja, true);
        $criteria->compare('nilai_orientasi_pelayanan', $this->nilai_orientasi_pelayanan, true);
        $criteria->compare('nilai_integritas', $this->nilai_integritas, true);
        $criteria->compare('nilai_disiplin', $this->nilai_disiplin, true);
        $criteria->compare('nilai_kerja_sama', $this->nilai_kerja_sama, true);
        $criteria->compare('nilai_kreativitas', $this->nilai_kreativitas, true);
        $criteria->compare('created_user_id', $this->created_user_id, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('no_register', $this->no_register, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'id DESC')
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return NilaiHonorer the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
