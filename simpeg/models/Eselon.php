<?php

/**
 * This is the model class for table "{{eselon}}".
 *
 * The followings are the available columns in table '{{eselon}}':
 * @property integer $id
 * @property string $nama
 * @property string $keterangan
 * @property integer $level
 * @property integer $lft
 * @property integer $rgt
 * @property string $root
 * @property integer $parent_id
 * @property string $created
 * @property integer $created_user_id
 * @property string $modified
 */
class Eselon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{eselon}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama, keterangan, level, lft, rgt, root, parent_id, created, created_user_id', 'safe'),
			array('level, lft, rgt, parent_id, created_user_id', 'numerical', 'integerOnly'=>true),
			array('nama', 'length', 'max'=>150),
			array('root', 'length', 'max'=>50),
			array('modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, keterangan, level, lft, rgt, root, parent_id, created, created_user_id, modified', 'safe', 'on'=>'search'),
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
			'nama' => 'Eselon',
			'keterangan' => 'Keterangan',
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
//	public function search()
//	{
//		// @todo Please modify the following code to remove attributes that should not be searched.
//
//		$criteria=new CDbCriteria;
//
//		$criteria->compare('id',$this->id);
//		$criteria->compare('nama',$this->nama,true);
//		$criteria->compare('keterangan',$this->keterangan,true);
//		$criteria->compare('level',$this->level);
//		$criteria->compare('lft',$this->lft);
//		$criteria->compare('rgt',$this->rgt);
//		$criteria->compare('root',$this->root,true);
//		$criteria->compare('parent_id',$this->parent_id);
//		$criteria->compare('created',$this->created,true);
//		$criteria->compare('created_user_id',$this->created_user_id);
//		$criteria->compare('modified',$this->modified,true);
//
//		return new CActiveDataProvider($this, array(
//			'criteria'=>$criteria,
//                        'sort' => array ('defaultOrder' => 'root,lft',),
//		));
//	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Eselon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

//	 public function behaviors() {
//        return array(
//            'nestedSetBehavior' => array(
//                'class' => 'common.extensions.NestedSetBehavior.NestedSetBehavior',
//                'leftAttribute' => 'lft',
//                'rightAttribute' => 'rgt',
//                'levelAttribute' => 'level',
//                'hasManyRoots' => true,
//            ),
//        );
//    }
//    public function getNestedName() {
//        return ($this->level == 1) ? $this->nama : str_repeat("|— ", $this->level - 1) . $this->nama;
//    }
    
    protected function beforeValidate() {
        if (empty($this->created_user_id))
            $this->created_user_id = Yii::app()->user->id;
        return parent::beforeValidate();
    }
}
