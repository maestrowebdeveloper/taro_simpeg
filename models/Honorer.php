<?php

class Honorer extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{honorer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nomor_register, nama, unit_kerja_id,tanggal_register', 'required'),
			array('tempat_lahir, tanggal_lahir, jenis_kelamin, agama, pendidikan_terakhir, tahun_pendidikan, status_pernikahan, alamat, kota, kode_pos, hp, golongan_darah, bpjs, npwp, foto,  tmt_kontrak, jabatan_honorer_id, tmt_jabatan, tmt_akhir_kontrak, gaji, created, created_user_id', 'safe'),
			array('tempat_lahir, kota, unit_kerja_id, jabatan_honorer_id, gaji, created_user_id', 'numerical', 'integerOnly'=>true),
			array('nomor_register, foto', 'length', 'max'=>225),
			array('nama', 'length', 'max'=>100),
			array('jenis_kelamin', 'length', 'max'=>11),
			array('agama, pendidikan_terakhir', 'length', 'max'=>9),
			array('tahun_pendidikan, kode_pos', 'length', 'max'=>10),
			array('status_pernikahan', 'length', 'max'=>12),
			array('hp', 'length', 'max'=>25),
			array('golongan_darah', 'length', 'max'=>5),
			array('bpjs, npwp', 'length', 'max'=>50),
			array('modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nomor_register, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, pendidikan_terakhir, tahun_pendidikan, status_pernikahan, alamat, kota, kode_pos, hp, golongan_darah, bpjs, npwp, foto, unit_kerja_id, tmt_kontrak, jabatan_honorer_id, tmt_jabatan, tmt_akhir_kontrak, gaji, created, created_user_id, modified', 'safe', 'on'=>'search'),
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
			'UnitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja_id'),
			'JabatanHonorer' => array(self::BELONGS_TO, 'JabatanHonorer', 'jabatan_honorer_id'),
			'TempatLahir' => array(self::BELONGS_TO, 'City', 'tempat_lahir'),
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
			'nomor_register' => 'Nomor Register',
			'nama' => 'Nama',
			'tempat_lahir' => 'Tempat Lahir',
			'tanggal_lahir' => 'Tanggal Lahir',
			'jenis_kelamin' => 'Jenis Kelamin',
			'agama' => 'Agama',
			'pendidikan_terakhir' => 'Pendidikan Terakhir',
			'tahun_pendidikan' => 'Tahun Pendidikan',
			'status_pernikahan' => 'Status Pernikahan',
			'alamat' => 'Alamat',
			'kota' => 'Kota',
			'kode_pos' => 'Kode Pos',
			'hp' => 'Hp',
			'golongan_darah' => 'Golongan Darah',
			'bpjs' => 'Bpjs',
			'npwp' => 'Npwp',
			'foto' => 'Foto',
			'unit_kerja_id' => 'Unit Kerja',
			'tmt_kontrak' => 'Tmt Kontrak',
			'jabatan_honorer_id' => 'Jabatan',
			'tmt_jabatan' => 'Tmt Jabatan',
			'tmt_akhir_kontrak' => 'Tmt Akhir Kontrak',
			'gaji' => 'Gaji',
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

		if (isset($_GET['today'])){
            $today = date('m/d');
            $criteria->addCondition('date_format(tanggal_lahir,"%m/%d") = "'.$today.'"');
        }
        
        if (isset($_GET['week'])){
            $today = date('m/d');
            $week = date('m/d',strtotime("+7 day",strtotime($today)));
            $criteria->addCondition('date_format(tanggal_lahir,"%m/%d") between "'.$today.'" and "'.$week.'"');
        }

        if (isset($_GET['nextweek'])){
            $today = date('m/d');
            $week = date('m/d',strtotime("+7 day",strtotime($today)));
            $nextweek = date('m/d',strtotime("+7 day",strtotime($week)));
            $criteria->addCondition('date_format(tanggal_lahir,"%m/%d") between "'.$week.'" and "'.$nextweek.'"');
        }

        if (isset($_GET['month'])){
            $today = date('m');            
            $criteria->addCondition('date_format(tanggal_lahir,"%m") = "'.$today.'"');
        }

        if (isset($_GET['nextmonth'])){
            $today = date('Y-m-d');     
            $nextmonth = date('m',strtotime("+1 month",strtotime($today)));     
            $criteria->addCondition('date_format(tanggal_lahir,"%m") = "'.$nextmonth.'"');
        }

		$criteria->compare('id',$this->id);
		$criteria->compare('nomor_register',$this->nomor_register,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tempat_lahir',$this->tempat_lahir);
		$criteria->compare('tanggal_lahir',$this->tanggal_lahir,true);
		$criteria->compare('jenis_kelamin',$this->jenis_kelamin,true);
		$criteria->compare('agama',$this->agama,true);
		$criteria->compare('pendidikan_terakhir',$this->pendidikan_terakhir,true);
		$criteria->compare('tahun_pendidikan',$this->tahun_pendidikan,true);
		$criteria->compare('status_pernikahan',$this->status_pernikahan,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('kota',$this->kota);
		$criteria->compare('kode_pos',$this->kode_pos,true);
		$criteria->compare('hp',$this->hp,true);
		$criteria->compare('golongan_darah',$this->golongan_darah,true);
		$criteria->compare('bpjs',$this->bpjs,true);
		$criteria->compare('npwp',$this->npwp,true);
		$criteria->compare('foto',$this->foto,true);
		$criteria->compare('unit_kerja_id',$this->unit_kerja_id);
		$criteria->compare('tmt_kontrak',$this->tmt_kontrak,true);
		$criteria->compare('jabatan_honorer_id',$this->jabatan_honorer_id);
		$criteria->compare('tmt_jabatan',$this->tmt_jabatan,true);
		$criteria->compare('tmt_akhir_kontrak',$this->tmt_akhir_kontrak,true);
		$criteria->compare('gaji',$this->gaji);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_user_id',$this->created_user_id);
		$criteria->compare('modified',$this->modified,true);

		$data = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder' => 'nama')
		));

		app()->session['Honorer_records'] = $this->findAll($criteria); 

		return $data;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Honorer the static model class
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

    public function listHonorer() {
        if (!app()->session['listHonorer']) {
            $result = array();
            $users = $this->findAll(array('index' => 'id'));
            app()->session['listHonorer'] = $users;
        }
        return app()->session['listHonorer'];
    } 

    public function getUnitKerja() {        
        return (!empty($this->UnitKerja->nama))?$this->UnitKerja->nama:'-';
    }

    public function getTempatLahir() {        
        return (!empty($this->TempatLahir->name))?$this->TempatLahir->name:'-';
    }

    public function getKota() {        
        return (!empty($this->Kota->name))?$this->Kota->name:'-';
    }

    public function getJabatan() {        
        return (!empty($this->JabatanHonorer->nama))?$this->JabatanHonorer->nama:'-';
    }

    public function getTmtJabatan() {         	
    	return date('d M Y',strtotime($this->tmt_jabatan));    	
    }

    public function getImgUrl() {
        return landa()->urlImg('honorer/', $this->foto, $this->id);
    }


    public function getSmallFoto() {
        return '<img style="width:98px;height:98px" src="' . $this->imgUrl['small'] . '" class="img-polaroid"/>';
    }

    public function getTinyFoto() {
        return '<img src="' . $this->imgUrl['small'] . '" style="width:70px" class="img-polaroid"/>';
    }

    public function getMediumFoto() {
        return '<img src="' . $this->imgUrl['medium'] . '" class="img-polaroid"/>';
    }

    public function getUsia() {
        return landa()->usia(date('d-m-Y',strtotime($this->tanggal_lahir)));
    }

    public function getMasaKerja() {
        return landa()->usia(date('d-m-Y',strtotime($this->tmt_kontrak))) ;
    }

    public function getTtl() {
        return ucwords(strtolower($this->tempatLahir)).', '.date('d M Y',strtotime($this->tanggal_lahir));
    }
}
