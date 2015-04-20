<?php

/**
 * This is the model class for table "{{riwayat_penghargaan}}".
 *
 * The followings are the available columns in table '{{riwayat_penghargaan}}':
 * @property integer $id
 * @property integer $pegawai_id
 * @property integer $penghargaan_id
 * @property string $nomor_register
 * @property string $tanggal_pemberian
 * @property string $keterangan
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class RiwayatPenghargaan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{riwayat_penghargaan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pegawai_id, pejabat,penghargaan_id', 'required'),
			array('nomor_register, tanggal_pemberian, keterangan, created, created_user_id, modified', 'safe'),
			array('pegawai_id, penghargaan_id, created_user_id', 'numerical', 'integerOnly'=>true),
			array('nomor_register', 'length', 'max'=>225),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pegawai_id, penghargaan_id, nomor_register, tanggal_pemberian, keterangan, created, created_user_id, modified', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Pegawai' => array(self::BELONGS_TO, 'Pegawai', 'pegawai_id'),
			'Penghargaan' => array(self::BELONGS_TO, 'Penghargaan', 'penghargaan_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pegawai_id' => 'Pegawai',
			'penghargaan_id' => 'Penghargaan',
			'nomor_register' => 'Nomor Register',
			'pejabat' => 'Pejabat',
			'tanggal_pemberian' => 'Tanggal Pemberian',
			'keterangan' => 'Keterangan',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('pegawai_id',$this->pegawai_id);
		$criteria->compare('penghargaan_id',$this->penghargaan_id);
		$criteria->compare('nomor_register',$this->nomor_register,true);
		$criteria->compare('tanggal_pemberian',$this->tanggal_pemberian,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_user_id',$this->created_user_id);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder' => 'tanggal_pemberian DESC')
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RiwayatPenghargaan the static model class
	 */
	public static function model($className=__CLASS__)
	{
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

    public function getPenghargaan() {        
        return (!empty($this->Penghargaan->nama))?$this->Penghargaan->nama:'-';
    }
}
