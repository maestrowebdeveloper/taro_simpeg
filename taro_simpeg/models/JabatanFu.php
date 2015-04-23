<?php

/**
 * This is the model class for table "{{jabatan_fu}}".
 *
 * The followings are the available columns in table '{{jabatan_fu}}':
 * @property integer $id
 * @property string $nama
 * @property string $keterangan
 * @property integer $status
 * @property integer $level
 * @property integer $lft
 * @property integer $rgt
 * @property integer $root
 * @property integer $parent_id
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class JabatanFu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{jabatan_fu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama', 'required'),
			array('jabatan_struktural_id, keterangan, status, level, lft, rgt, root, parent_id, created, created_user_id', 'safe'),
			array('status, level, lft, rgt, root, parent_id, created_user_id', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>255),
			array('modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, keterangan, status, level, lft, rgt, root, parent_id, created, created_user_id, modified', 'safe', 'on'=>'search'),
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
                    'Bidang' => array(self::BELONGS_TO,'JabatanStruktural','jabatan_struktural_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Jabatan',
			'keterangan' => 'Keterangan',
			'status' => 'Status',
			'level' => 'Level',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'root' => 'Root',
			'parent_id' => 'Parent',
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
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('level',$this->level);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('root',$this->root);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_user_id',$this->created_user_id);
		$criteria->compare('modified',$this->modified,true);

		$data =  new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array ('defaultOrder' => 'root,lft',),
		));

		//app()->session['JabatanFu_records'] = $this->findAll($criteria); 

		return $data;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JabatanFu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function behaviors() {
        return array(
            'nestedSetBehavior' => array(
                'class' => 'common.extensions.NestedSetBehavior.NestedSetBehavior',
                'leftAttribute' => 'lft',
                'rightAttribute' => 'rgt',
                'levelAttribute' => 'level',
                'hasManyRoots' => true,
            ),
        );
    }
    
    
    public function getNestedName() {
        return ($this->level == 1) ? $this->nama : str_repeat("|— ", $this->level - 1) . $this->nama;
    }
    
    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }
}
