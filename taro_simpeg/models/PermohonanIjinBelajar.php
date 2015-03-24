<?php

/**
 * This is the model class for table "{{permohonan_ijin_belajar}}".
 *
 * The followings are the available columns in table '{{permohonan_ijin_belajar}}':
 * @property integer $id
 * @property string $nomor_register
 * @property string $tanggal
 * @property integer $pegawai_id
 * @property string $nip
 * @property string $golongan
 * @property string $jabatan
 * @property string $unit_kerja
 * @property string $jenjang_pendidikan
 * @property string $jurusan
 * @property string $nama_sekolah
 * @property integer $kota
 * @property string $alamat
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class PermohonanIjinBelajar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{permohonan_ijin_belajar}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nomor_register, tanggal, pegawai_id,jurusan, jenjang_pendidikan,  nama_sekolah, tanggal_usul', 'required'),
			array('nip, golongan, nama,jabatan, unit_kerja,  kota, alamat, created, created_user_id, modified', 'safe'),
			array('pegawai_id, kota, created_user_id', 'numerical', 'integerOnly'=>true),
			array('nomor_register, nip, jabatan, unit_kerja, jurusan, nama_sekolah', 'length', 'max'=>225),
			array('golongan', 'length', 'max'=>100),
			array('jenjang_pendidikan', 'length', 'max'=>9),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nomor_register, tanggal, pegawai_id, nip, golongan, jabatan, unit_kerja, jenjang_pendidikan, jurusan, nama_sekolah, kota, alamat, created, created_user_id, modified', 'safe', 'on'=>'search'),
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
			'Kota' => array(self::BELONGS_TO, 'City', 'kota'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nomor_register' => 'Nomor Usul',
			'tanggal' => 'Tanggal Input',
			'pegawai_id' => 'Pegawai',
			'nip' => 'Nip',
			'nama' => 'Nama Pegawai',
			'golongan' => 'Golongan',
			'jabatan' => 'Jabatan',
			'unit_kerja' => 'Unit Kerja',
			'jenjang_pendidikan' => 'Jenjang Pendidikan',
			'jurusan' => 'Jurusan',
			'nama_sekolah' => 'Nama Sekolah',
			'kota' => 'Kota',
			'alamat' => 'Alamat',
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
		$criteria->compare('nomor_register',$this->nomor_register,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('pegawai_id',$this->pegawai_id);
		$criteria->compare('nip',$this->nip,true);
		$criteria->compare('golongan',$this->golongan,true);
		$criteria->compare('jabatan',$this->jabatan,true);
		$criteria->compare('unit_kerja',$this->unit_kerja,true);
		$criteria->compare('jenjang_pendidikan',$this->jenjang_pendidikan,true);
		$criteria->compare('jurusan',$this->jurusan,true);
		$criteria->compare('nama_sekolah',$this->nama_sekolah,true);
		$criteria->compare('kota',$this->kota);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_user_id',$this->created_user_id);
		$criteria->compare('modified',$this->modified,true);

		$data = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder' => 'tanggal DESC')
		));

		app()->session['PermohonanIjinBelajar_records'] = $this->findAll($criteria); 

		return $data;
	}

	
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

    public function getKotaSekolah() {        
        return (!empty($this->Kota->name))?$this->Kota->name:'-';
    }
}
