<?php

/**
 * This is the model class for table "{{riwayat_pendidikan}}".
 *
 * The followings are the available columns in table '{{riwayat_pendidikan}}':
 * @property integer $id
 * @property integer $pegawai_id
 * @property string $jenjang_pendidikan
 * @property string $tahun
 * @property string $jurusan
 * @property string $nama_sekolah
 * @property string $alamat_sekolah
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class RiwayatPendidikan extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{riwayat_pendidikan}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pegawai_id, jenjang_pendidikan, tahun', 'required'),
            array('alamat_sekolah, created, nama_sekolah, created_user_id, id_jurusan, id_universitas, modified, id, no_ijazah', 'safe'),
            array('pegawai_id, created_user_id', 'numerical', 'integerOnly' => true),
            array('jenjang_pendidikan', 'length', 'max' => 9),
            array('tahun', 'length', 'max' => 10),
            array('nama_sekolah', 'length', 'max' => 225),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, pegawai_id, id_jurusan,id_universitas,jenjang_pendidikan,no_ijazah, tahun, nama_sekolah, alamat_sekolah, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
      /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'Pegawai' => array(self::BELONGS_TO, 'Pegawai', 'pegawai_id'),
            'Jurusan' => array(self::BELONGS_TO, 'Jurusan', 'id_jurusan'),
            'Universitas' => array(self::BELONGS_TO, 'Universitas', 'id_universitas'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'NIP',
            'pegawai_id' => 'Pegawai',
            'jenjang_pendidikan' => 'Jenjang Pendidikan',
            'tahun' => 'Tahun',
            'id_universitas' => 'Universitas',
            'id_jurusan' => 'Jurusan',
            'nama_sekolah' => 'Nama Sekolah',
            'alamat_sekolah' => 'Alamat Sekolah',
            'created' => 'Created',
            'created_user_id' => 'Created User',
            'modified' => 'Modified',
            'no_ijazah'=>'No Ijazah'
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
        $criteria->with = array('Pegawai','Jurusan');
        $criteria->together = true;


        $criteria->compare('Pegawai.nip', $this->id, true);
        $criteria->compare('Pegawai.nama', $this->pegawai_id, true);
        $criteria->compare('jenjang_pendidikan', $this->jenjang_pendidikan, true);
        $criteria->compare('tahun', $this->tahun, true);
//        $criteria->compare('jurusan', $this->jurusan, true);
        $criteria->compare('universitas', $this->id_universitas, true);
        $criteria->compare('Jurusan.Name', $this->id_jurusan, true);
        $criteria->compare('nama_sekolah', $this->nama_sekolah, true);
        $criteria->compare('alamat_sekolah', $this->alamat_sekolah, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('no_ijazah', $this->no_ijazah, true);

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'tahun DESC')
        ));
        //app()->session['RiwayatPangkat_records'] = $this->findAll($criteria); 

        return $data;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RiwayatPendidikan the static model class
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
        return (!empty($this->Pegawai->nama)) ? $this->Pegawai->nama : '-';
    }
    
    public function getJurusanPegawai(){
        if(!empty($this->id_jurusan)){
            return $this->Jurusan->Name;
        }
    }

}
