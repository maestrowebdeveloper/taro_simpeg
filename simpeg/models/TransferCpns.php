<?php

/**
 * This is the model class for table "{{transfer_cpns}}".
 *
 * The followings are the available columns in table '{{transfer_cpns}}':
 * @property integer $id
 * @property integer $pegawai_id
 * @property integer $nomor_kesehatan
 * @property string $tanggal_kesehatan
 * @property integer $pelatihan_id
 * @property integer $nomor_diklat
 * @property string $tanggal_diklat
 * @property integer $status
 */
class TransferCpns extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{transfer_cpns}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pegawai_id, nomor_kesehatan, pelatihan_id, nomor_diklat, status', 'numerical', 'integerOnly' => true),
            array('nomor,tmt,tanggal_kesehatan, tanggal_diklat', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, pegawai_id,nomor,tmt, nomor_kesehatan, tanggal_kesehatan, pelatihan_id, nomor_diklat, tanggal_diklat, status,created,created_user_id', 'safe', 'on' => 'search'),
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
            'Pelatihan' => array(self::BELONGS_TO, 'Pelatihan', 'pelatihan_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'pegawai_id' => 'Pegawai',
            'nomor' => 'Nomor',
            'tmt' => 'Tmt',
            'nomor_kesehatan' => 'Nomor Kesehatan',
            'tanggal_kesehatan' => 'Tanggal Kesehatan',
            'pelatihan_id' => 'Pelatihan',
            'nomor_diklat' => 'Nomor Diklat',
            'tanggal_diklat' => 'Tahun Diklat',
            'status' => 'Status',
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
        $criteria->compare('pegawai_id', $this->pegawai_id);
        $criteria->compare('nomor', $this->nomor);
        $criteria->compare('tmt', $this->tmt);
        $criteria->compare('nomor_kesehatan', $this->nomor_kesehatan);
        $criteria->compare('tanggal_kesehatan', $this->tanggal_kesehatan, true);
        $criteria->compare('pelatihan_id', $this->pelatihan_id);
        $criteria->compare('nomor_diklat', $this->nomor_diklat,true);
        $criteria->compare('tanggal_diklat', $this->tanggal_diklat, true);
        $criteria->compare('status', $this->status);
        if (empty($export)) {
            $date = new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort' => array('defaultOrder' => 'id DESC')
            ));
        } else {
            $date = TransferCpns::model()->findAll($criteria);
        }
        return $date;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return TransferCpns the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }

    public function getTgl() {
        return date('d-m-Y', strtotime($this->tanggal_kesehatan));
    }

    public function getStatusname() {
        $status = '';
        if ($this->status == 1) {
            $status = '<span class="label label-warning">Belum</span>';
        } else {
            $status = '<span class="label label-info">Sudah</span>';
        }
        return $status;
    }

    public function getCekStatus() {
        $status = '';
        if ($this->status == 1) {
            $status = false;
        } else {
            $status = true;
        }
        return $status;
    }

    public function getNamaPegawai() {
        $nama = '';
        if (isset($this->Pegawai->nama)) {
            return $this->Pegawai->nama;
        }
    }

}
