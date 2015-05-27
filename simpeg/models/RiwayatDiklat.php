<?php

/**
 * This is the model class for table "riwayat_diklat".
 *
 * The followings are the available columns in table 'riwayat_diklat':
 * @property integer $id
 * @property integer $pegawai_id
 * @property string $nama
 * @property string $nama_pelatihan
 * @property string $penyelenggara
 * @property string $tahun
 */
class RiwayatDiklat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'riwayat_diklat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pegawai_id, nama, nama_pelatihan, penyelenggara, tahun', 'required'),
			array('pegawai_id', 'numerical', 'integerOnly'=>true),
			array('nama, nama_pelatihan, penyelenggara, tahun', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pegawai_id, nama, nama_pelatihan, penyelenggara, tahun', 'safe', 'on'=>'search'),
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
			'nama' => 'Nama',
			'nama_pelatihan' => 'Nama Pelatihan',
			'penyelenggara' => 'Penyelenggara',
			'tahun' => 'Tahun',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('nama_pelatihan',$this->nama_pelatihan,true);
		$criteria->compare('penyelenggara',$this->penyelenggara,true);
		$criteria->compare('tahun',$this->tahun,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder' => 'id DESC')
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RiwayatDiklat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
