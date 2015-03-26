<?php

/**
 * This is the model class for table "{{riwayat_jabatan}}".
 *
 * The followings are the available columns in table '{{riwayat_jabatan}}':
 * @property integer $id
 * @property string $nomor_register
 * @property integer $pegawai_id
 * @property string $tipe_jabatan
 * @property integer $jabatan_struktural_id
 * @property integer $jabatan_fu_id
 * @property integer $jabatan_ft_id
 * @property string $nama_jabatan
 * @property string $tmt_mulai
 * @property string $tmt_selesai
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class RiwayatJabatan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{riwayat_jabatan}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pegawai_id, tipe_jabatan,  tmt_mulai', 'required'),
			array('nomor_register,jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id,tmt_selesai, nama_jabatan, created, created_user_id', 'safe'),
			array('pegawai_id, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, created_user_id', 'numerical', 'integerOnly'=>true),
			array('nomor_register, nama_jabatan', 'length', 'max'=>225),
			array('tipe_jabatan', 'length', 'max'=>19),
			array('modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nomor_register, pegawai_id, tipe_jabatan, jabatan_struktural_id, jabatan_fu_id, jabatan_ft_id, nama_jabatan, tmt_mulai, tmt_selesai, created, created_user_id, modified', 'safe', 'on'=>'search'),
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
			'JabatanStruktural' => array(self::BELONGS_TO, 'JabatanStruktural', 'jabatan_struktural_id'),
            'JabatanFu' => array(self::BELONGS_TO, 'JabatanFu', 'jabatan_fu_id'),
            'JabatanFt' => array(self::BELONGS_TO, 'JabatanFt', 'jabatan_ft_id'),
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
			'tipe_jabatan' => 'Tipe Jabatan',
			'jabatan_struktural_id' => 'Jabatan Struktural',
			'jabatan_fu_id' => 'Fungsional Umum',
			'jabatan_ft_id' => 'Fungsional Tertentu',
			'nama_jabatan' => 'Nama Jabatan',
			'tmt_mulai' => 'TMT',
			'tmt_selesai' => 'Tmt Selesai',
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
		$criteria->with = array('Pegawai','JabatanStruktural','JabatanFt','JabatanFu');
        $criteria->together = true;		

		
		$criteria->compare('Pegawai.nip',$this->id,true);
		$criteria->compare('nomor_register',$this->nomor_register,true);
		$criteria->compare('Pegawai.nama',$this->pegawai_id,true);
		$criteria->compare('t.tipe_jabatan',$this->tipe_jabatan,true);		
		$criteria->compare('JabatanStruktural.nama',$this->jabatan_struktural_id,true);
		$criteria->compare('JabatanFu.nama',$this->jabatan_fu_id,true);
		$criteria->compare('JabatanFt.nama',$this->jabatan_ft_id,true);		
		$criteria->compare('nama_jabatan',$this->nama_jabatan,true);
		$criteria->compare('tmt_mulai',$this->tmt_mulai,true);
		$criteria->compare('tmt_selesai',$this->tmt_selesai,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_user_id',$this->created_user_id);
		$criteria->compare('modified',$this->modified,true);

		$data = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder' => 'tmt_mulai DESC')
		));

		app()->session['RiwayatJabatan_records'] = $this->findAll($criteria); 

		return $data;
	}
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RiwayatJabatan the static model class
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

    public function getJabatan() {     
    	if($this->tipe_jabatan=="struktural"){
    		return (!empty($this->JabatanStruktural->nama))?$this->JabatanStruktural->nama:'-';
    	}elseif($this->tipe_jabatan=="fungsional_umum"){    
    		return (!empty($this->JabatanFu->nama))?$this->JabatanFu->nama:'-';       
    	}elseif($this->tipe_jabatan=="fungsional_tertentu"){ 
    		return (!empty($this->JabatanFt->nama))?$this->JabatanFt->nama:'-';          
    	}else{
    		return '-';
    	}    	
    }

    public function getJabatanStruktural() {     
    	if($this->tipe_jabatan=="struktural"){
    		return (!empty($this->JabatanStruktural->nama))?$this->JabatanStruktural->nama:'-';    	       
    	}else{
    		return '-';
    	}    	
    }

    public function getJabatanFu() {     
    	if($this->tipe_jabatan=="fungsional_umum"){    
    		return (!empty($this->JabatanFu->nama))?$this->JabatanFu->nama:'-';           	        
    	}else{
    		return '-';
    	}    	
    }

    public function getJabatanFt() {     
    	if($this->tipe_jabatan=="fungsional_tertentu"){ 
    		return (!empty($this->JabatanFt->nama))?$this->JabatanFt->nama:'-';          
    	}else{
    		return '-';
    	}    	
    }

    public function getTipe() {        
        return ucwords(str_replace("_", " ", $this->tipe_jabatan));
    }
}
