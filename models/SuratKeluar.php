<?php

/**
 * This is the model class for table "{{surat_keluar}}".
 *
 * The followings are the available columns in table '{{surat_keluar}}':
 * @property integer $id
 * @property string $pengirim
 * @property string $penerima
 * @property string $tanggal_kirim
 * @property string $tanggal_terima
 * @property string $sifat
 * @property string $nomor_surat
 * @property string $perihal
 * @property string $isi
 * @property string $file
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class SuratKeluar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{surat_keluar}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('penerima, tanggal_kirim, sifat, nomor_surat, perihal', 'required'),
			array('pengirim, tanggal_kirim, isi, file, created, created_user_id, modified', 'safe'),
			array('created_user_id', 'numerical', 'integerOnly'=>true),
			array('pengirim, penerima, nomor_surat, perihal, file', 'length', 'max'=>225),
			array('sifat', 'length', 'max'=>7),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, pengirim, penerima, tanggal_kirim, tanggal_terima, sifat, nomor_surat, perihal, isi, file, created, created_user_id, modified', 'safe', 'on'=>'search'),
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
			'pengirim' => 'Pengirim',
			'penerima' => 'Penerima',
			'tanggal_kirim' => 'Tanggal Kirim',
			'tanggal_terima' => 'Tanggal Terima',
			'sifat' => 'Sifat',
			'nomor_surat' => 'Nomor Surat',
			'perihal' => 'Perihal',
			'isi' => 'Isi',
			'file' => 'File',
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
		$criteria->compare('pengirim',$this->pengirim,true);
		$criteria->compare('penerima',$this->penerima,true);
		$criteria->compare('tanggal_kirim',$this->tanggal_kirim,true);
		$criteria->compare('tanggal_terima',$this->tanggal_terima,true);
		$criteria->compare('sifat',$this->sifat,true);
		$criteria->compare('nomor_surat',$this->nomor_surat,true);
		$criteria->compare('perihal',$this->perihal,true);
		$criteria->compare('isi',$this->isi,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_user_id',$this->created_user_id);
		$criteria->compare('modified',$this->modified,true);

		$data = new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder' => 'id DESC')
		));

		app()->session['SuratKeluar_records'] = $this->findAll($criteria); 

		return $data;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SuratKeluar the static model class
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
}
