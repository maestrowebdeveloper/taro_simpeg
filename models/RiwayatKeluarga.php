<?php

/**
 * This is the model class for table "{{riwayat_keluarga}}".
 *
 * The followings are the available columns in table '{{riwayat_keluarga}}':
 * @property integer $id
 * @property integer $pegawai_id
 * @property string $hubungan
 * @property string $nama
 * @property integer $tempat_lahir
 * @property string $tanggal_lahir
 * @property string $pendidikan_terakhir
 * @property string $pekerjaan
 * @property string $nomor_karsu
 * @property string $tanggal_pernikahan
 * @property string $status
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class RiwayatKeluarga extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{riwayat_keluarga}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pegawai_id, hubungan, nama', 'required'),
			array('jenis_kelamin,anak_ke,status_anak, tempat_lahir, tanggal_lahir, pendidikan_terakhir, pekerjaan, nomor_karsu, tanggal_pernikahan, status, created, created_user_id, modified', 'safe'),
			array('pegawai_id, tempat_lahir, created_user_id', 'numerical', 'integerOnly'=>true),
			array('hubungan', 'length', 'max'=>11),
			array('nama, pekerjaan, nomor_karsu', 'length', 'max'=>225),
			array('pendidikan_terakhir, status', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pegawai_id, hubungan, nama, tempat_lahir, tanggal_lahir, pendidikan_terakhir, pekerjaan, nomor_karsu, tanggal_pernikahan, status, created, created_user_id, modified', 'safe', 'on'=>'search'),
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
			'TempatLahir' => array(self::BELONGS_TO, 'City', 'tempat_lahir'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'NIP',
			'pegawai_id' => 'Pegawai',
			'hubungan' => 'Hubungan',
			'anak_ke' => 'Anak Ke',
			'status_anak' => 'Status',
			'jenis_kelamin' => 'JK',
			'nama' => 'Nama',
			'tempat_lahir' => 'Tempat Lahir',
			'tanggal_lahir' => 'Tanggal Lahir',
			'pendidikan_terakhir' => 'Pendidikan',
			'pekerjaan' => 'Pekerjaan',
			'nomor_karsu' => 'No. Karsu',
			'tanggal_pernikahan' => 'Tgl. Nikah',
			'status' => 'Status',
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
		$criteria->compare('Pegawai.nama',$this->pegawai_id,true);
		$criteria->compare('hubungan',$this->hubungan,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tempat_lahir',$this->tempat_lahir,true);
		$criteria->compare('tanggal_lahir',$this->tanggal_lahir,true);
		$criteria->compare('pendidikan_terakhir',$this->pendidikan_terakhir,true);
		$criteria->compare('pekerjaan',$this->pekerjaan,true);
		$criteria->compare('nomor_karsu',$this->nomor_karsu,true);
		$criteria->compare('tanggal_pernikahan',$this->tanggal_pernikahan,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('status_anak',$this->status_anak,true);
		$criteria->compare('jenis_kelamin',$this->jenis_kelamin,true);
		$criteria->compare('anak_ke',$this->anak_ke,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_user_id',$this->created_user_id);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder' => 'hubungan Desc')
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RiwayatKeluarga the static model class
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

    public function getTempatLahir() {        
        return (!empty($this->TempatLahir->name))?$this->TempatLahir->name:'-';
    }

    public function getTtl() {
        return $this->tempatLahir.' '.$this->tanggal_lahir;
    }

    public function getNomorKarsu() {
    	return ($this->hubungan=="anak")?"-":$this->nomor_karsu;    	
    }
    public function getTanggalPernikahan() {
    	return ($this->hubungan=="anak")?"-":$this->tanggal_pernikahan;    	
    }
    public function getStatusPernikahan() {
    	return ($this->hubungan=="anak")?"-":$this->status;    	
    }

    public function getJenisKelamin() {
    	return ($this->hubungan=="anak")?$this->jenis_kelamin:"-";    	
    }
    public function getAnakKe() {
    	return ($this->hubungan=="anak")?$this->anak_ke:"-";    	
    }
    public function getStatusAnak() {
    	return ($this->hubungan=="anak")?$this->status_anak:"-";    	
    }
}
