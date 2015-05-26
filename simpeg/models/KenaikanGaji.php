<?php

/**
 * This is the model class for table "{{kenaikan_gaji}}".
 *
 * The followings are the available columns in table '{{kenaikan_gaji}}':
 * @property integer $id
 * @property integer $pegawai_id
 * @property string $nomor_register
 * @property string $sifat
 * @property string $perihal
 * @property integer $gaji_pokok_lama
 * @property integer $gaji_pokok_baru
 * @property string $pejabat
 * @property string $tanggal
 * @property string $tmt
 * @property string $created
 * @property integer $created_user_id
 */
class KenaikanGaji extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{kenaikan_gaji}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//			array('pegawai_id, nomor_register, sifat, perihal, gaji_pokok_lama, gaji_pokok_baru, pejabat, tanggal', 'required'),
            array('pegawai_id, gaji_pokok_lama, gaji_pokok_baru, created_user_id', 'numerical', 'integerOnly' => true),
            array('nomor_register, sifat, perihal', 'length', 'max' => 255),
            array('pejabat', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, pegawai_id, nomor_register, sifat, perihal, gaji_pokok_lama, gaji_pokok_baru, pejabat, tanggal, created, created_user_id', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'pegawai_id' => 'Pegawai',
            'nomor_register' => 'Nomor Register',
            'sifat' => 'Sifat',
            'perihal' => 'Perihal',
            'gaji_pokok_lama' => 'Gaji Pokok Lama',
            'gaji_pokok_baru' => 'Gaji Pokok Baru',
            'pejabat' => 'Pejabat',
            'tanggal' => 'Tanggal',
            'tmt' => 'Tmt',
            'created' => 'Created',
            'created_user_id' => 'Created User',
        );
    }

    public function masaKerja($dob, $today, $hanyaTahun = false, $hanyaBulan = false) {
        $dob_a = explode("-", $dob);
        $today_a = explode("-", $today);
        $dob_d = $dob_a[0];
        $dob_m = $dob_a[1];
        $dob_y = $dob_a[2];
        $today_d = $today_a[0];
        $today_m = $today_a[1];
        $today_y = $today_a[2];

        $startDate = gregoriantojd((int) $dob_m, (int) $dob_d, (int) $dob_y);
        $todayDate = gregoriantojd((int) $today_m, (int) $today_d, (int) $today_y);

        $lama = $todayDate - $startDate;

        $tahun = $lama / 365; //menghitung usia tahun

        $sisa = $lama % 365; //sisa pembagian dari tahun untuk menghitung bulan

        $bulan = $sisa / 30; //menghitung usia bulan

        $hari = $sisa % 30; //menghitung sisa hari

        if ($hanyaTahun == true) {
            return floor($tahun);
        } elseif ($hanyaBulan == true) {
            return floor($bulan);
        }
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
        $criteria->compare('nomor_register', $this->nomor_register, true);
        $criteria->compare('sifat', $this->sifat, true);
        $criteria->compare('perihal', $this->perihal, true);
        $criteria->compare('gaji_pokok_lama', $this->gaji_pokok_lama);
        $criteria->compare('gaji_pokok_baru', $this->gaji_pokok_baru);
        $criteria->compare('pejabat', $this->pejabat, true);
        $criteria->compare('tanggal', $this->tanggal, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'id DESC')
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return KenaikanGaji the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
