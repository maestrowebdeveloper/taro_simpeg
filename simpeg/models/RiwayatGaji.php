<?php

/**
 * This is the model class for table "{{riwayat_gaji}}".
 *
 * The followings are the available columns in table '{{riwayat_gaji}}':
 * @property integer $id
 * @property string $nomor_register
 * @property integer $pegawai_id
 * @property integer $gaji
 * @property string $dasar_perubahan
 * @property string $tmt_mulai
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class RiwayatGaji extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{riwayat_gaji}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nomor_register, pegawai_id, gaji, dasar_perubahan', 'required'),
			array('created, created_user_id, modified,tmt_selesai', 'safe'),
			array('pegawai_id, gaji, created_user_id', 'numerical', 'integerOnly'=>true),
			array('nomor_register', 'length', 'max'=>225),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nomor_register, pegawai_id, gaji, dasar_perubahan, tmt_mulai, created, created_user_id, modified', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'NIP',
			'nomor_register' => 'Nomor Register',
			'pegawai_id' => 'Pegawai',
			'gaji' => 'Gaji',
			'dasar_perubahan' => 'Dasar Perubahan',
			'tmt_mulai' => 'Tmt Mulai',
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
		$criteria->with = array('Pegawai');
        $criteria->together = true;	

		$criteria->compare('Pegawai.nip',$this->id,true);
		$criteria->compare('nomor_register',$this->nomor_register,true);
		$criteria->compare('Pegawai.nama',$this->pegawai_id,true);
		$criteria->compare('t.gaji',$this->gaji);
		$criteria->compare('dasar_perubahan',$this->dasar_perubahan,true);
		$criteria->compare('tmt_mulai',$this->tmt_mulai,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_user_id',$this->created_user_id);
		$criteria->compare('modified',$this->modified,true);

		$data = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder' => 'tmt_mulai DESC')
		));

		//app()->session['RiwayatGaji_records'] = $this->findAll($criteria); 

		return $data;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RiwayatGaji the static model class
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
}
