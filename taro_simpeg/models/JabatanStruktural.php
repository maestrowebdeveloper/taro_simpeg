<?php

/**
 * This is the model class for table "{{jabatan_struktural}}".
 *
 * The followings are the available columns in table '{{jabatan_struktural}}':
 * @property integer $id
 * @property string $nama
 * @property string $keterangan
 * @property integer $unit_kerja_id
 * @property integer $eselon_id
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
class JabatanStruktural extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{jabatan_struktural}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('nama,  unit_kerja_id, eselon_id', 'required'),
            array('nama', 'required'),
            array('keterangan,   status, level, lft, rgt, root, parent_id, created, created_user_id', 'safe'),
            array('unit_kerja_id, eselon_id, status, level, lft, rgt, root, parent_id, created_user_id', 'numerical', 'integerOnly' => true),
            array('nama', 'length', 'max' => 150),
            array('modified', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nama, keterangan, unit_kerja_id, eselon_id, status, level, lft, rgt, root, parent_id, created, created_user_id, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'UnitKerja' => array(self::BELONGS_TO, 'UnitKerja', 'unit_kerja_id'),
            'Eselon' => array(self::BELONGS_TO, 'Eselon', 'eselon_id'),
            'Pegawai' => array(self::HAS_MANY, 'Pegawai', 'jabatan_struktural_id'),
            'Riwayatjabatan' => array(self::HAS_MANY, 'RiwayatJabatan', 'jabatan_struktural_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'nama' => 'Jabatan',
            'keterangan' => 'Keterangan',
            'unit_kerja_id' => 'Unit Kerja',
            'eselon_id' => 'Eselon',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('UnitKerja');

        $criteria->compare('id', $this->id);
        $criteria->compare('t.nama', $this->nama, true);
        $criteria->compare('keterangan', $this->keterangan, true);
        $criteria->compare('t.unit_kerja_id', $this->unit_kerja_id, true);
        $criteria->compare('eselon_id', $this->eselon_id,true);
        $criteria->compare('status', $this->status,true);
        $criteria->compare('level', $this->level, true);
        $criteria->compare('t.lft', $this->lft,true);
        $criteria->compare('t.rgt', $this->rgt,true);
        $criteria->compare('t.root', $this->root, true);
        $criteria->compare('parent_id', $this->parent_id, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_user_id', $this->created_user_id, true);
        $criteria->compare('modified', $this->modified, true);

        $data = new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 't.root,t.lft',),
        ));


        //app()->session['JabatanStruktural_records'] = $this->findAll($criteria); 

        return $data;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return JabatanStruktural the static model class
     */
    public static function model($className = __CLASS__) {
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

    function getPegawai() {
        $pegawai = Pegawai::model()->find(array('condition' => 'jabatan_struktural_id = ' . $this->id.' and tmt_pensiun > "'.date("Y-m-d").'"'));
        return (!empty($pegawai->nama) ? $pegawai->nama : '-');
    }

    function getStatus() {
        if ($this->pegawai_id == NULL or $this->pegawai_id == "0") {
            return "Kosong";
        } else {
            return "Diisi";
        }
    }

    function getUnitKerja() {
        return (!empty($this->UnitKerja->nama)) ? $this->UnitKerja->nama : '-';
    }

    function getEselon() {
        return (!empty($this->Eselon->nama)) ? $this->Eselon->nama : '-';
    }

}
