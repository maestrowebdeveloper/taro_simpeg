<?php

/**
 * This is the model class for table "{{auth}}".
 *
 * The followings are the available columns in table '{{auth}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $alias
 * @property string $module
 * @property string $crud
 */
class Auth extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{auth}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id, description', 'length', 'max' => 255),
            array('module, crud', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, description, crud', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'description' => 'Description',
//            'alias' => 'Alias',
//            'module' => 'Module',
            'crud' => 'Crud',
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

        $criteria->compare('id', $this->id);
//        $criteria->compare('name', $this->name, true);
        $criteria->compare('description', $this->description, true);
//        $criteria->compare('alias', $this->alias, true);
//        $criteria->compare('module', $this->module, true);
        $criteria->compare('crud', $this->crud, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return CDbConnection the database connection used for this class
     */
//    public function getDbConnection() {
//        return Yii::app()->db2;
//    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Auth the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function modules($arg = NULL) {
        if (empty($arg)) {
            $appName = app()->name;
        } else {
            $appName = $arg;
        }

        return array(
            array('label' => 'Dashboard', 'url' => array('/dashboard')),
            array('visible' => landa()->checkAccess('SiteConfig', 'r') || landa()->checkAccess('Roles', 'r') || landa()->checkAccess('User', 'r'), 'label' => 'Settings', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('SiteConfig', 'r'), 'auth_id' => 'SiteConfig', 'label' => 'Site config', 'url' => array('/siteConfig/update/1')),
                    array('visible' => landa()->checkAccess('groupUser', 'r'), 'auth_id' => 'groupUser', 'label' => 'Access', 'url' => array('/roles')),
                    array('visible' => landa()->checkAccess('user', 'r'), 'auth_id' => 'user', 'label' => 'User', 'url' => url('/user')),
                )),
            array('visible' => landa()->checkAccess('golongan', 'r'), 'label' => 'Data Master', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('unitKerja', 'r'), 'label' => 'Satuan Kerja', 'url' => url('/unitKerja'), 'auth_id' => 'unitKerja'),
                    array('visible' => landa()->checkAccess('jabatanStruktural', 'r'), 'label' => 'Unit Kerja', 'url' => url('/jabatanStruktural'), 'auth_id' => 'jabatanStruktural'),
                    array('visible' => landa()->checkAccess('jabatanFu', 'r'), 'label' => 'Jab. Fung. Umum', 'url' => url('/jabatanFu'), 'auth_id' => 'jabatanFu'),
                    array('visible' => landa()->checkAccess('jabatanFt', 'r'), 'label' => 'Jab. Fung. Tertentu', 'url' => url('/jabatanFt'), 'auth_id' => 'jabatanFt'),
                    array('visible' => landa()->checkAccess('jabatanFungsional', 'r'), 'label' => 'Jabatan Fungsional', 'url' => url('/jabatanFungsional'), 'auth_id' => 'jabatanFungsional'),
                    array('visible' => landa()->checkAccess('penghargaan', 'r'), 'label' => 'Penghargaan', 'url' => url('/penghargaan'), 'auth_id' => 'penghargaan'),
                    array('visible' => landa()->checkAccess('pelatihan', 'r'), 'label' => 'Pelatihan', 'url' => url('/pelatihan'), 'auth_id' => 'pelatihan'),
                    array('visible' => landa()->checkAccess('hukuman', 'r'), 'label' => 'Hukuman', 'url' => url('/hukuman'), 'auth_id' => 'hukuman'),
                    array('visible' => landa()->checkAccess('jurusan', 'r'), 'label' => 'Jurusan', 'url' => url('/jurusan'), 'auth_id' => 'jurusan'),
                    array('visible' => landa()->checkAccess('universitas', 'r'), 'label' => 'Kampus/Universitas', 'url' => url('/universitas'), 'auth_id' => 'universitas'),
                    array('visible' => landa()->checkAccess('Gaji', 'r'), 'label' => 'Gaji', 'url' => url('/gaji'), 'auth_id' => 'gaji'),
                )),
            array('visible' => landa()->checkAccess('pegawai', 'r'), 'label' => 'Data PNS', 'url' => url('/pegawai'), 'auth_id' => 'pegawai'),
            array('visible' => landa()->checkAccess('honorer', 'r'), 'label' => 'Data Honorer', 'url' => url('/honorer'), 'auth_id' => 'honorer'),
            array('visible' => landa()->checkAccess('suratMasuk', 'r'), 'label' => 'Arsip Surat', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('suratMasuk', 'r'), 'label' => 'Surat Masuk', 'url' => url('/suratMasuk'), 'auth_id' => 'suratMasuk'),
                    array('visible' => landa()->checkAccess('suratKeluar', 'r'), 'label' => 'Surat Keluar', 'url' => url('/suratKeluar'), 'auth_id' => 'suratKeluar')
                )),
            array('visible' => landa()->checkAccess('permohonanIjinBelajar', 'r'), 'label' => 'Permohonan', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('permohonanIjinBelajar', 'r'), 'label' => 'Ijin Belajar', 'url' => url('/permohonanIjinBelajar'), 'auth_id' => 'permohonanIjinBelajar'),
                    array('visible' => landa()->checkAccess('permohonanMutasi', 'r'), 'label' => 'Permohonan Mutasi', 'url' => url('/permohonanMutasi'), 'auth_id' => 'permohonanMutasi'),
                    array('visible' => landa()->checkAccess('permohonanPensiun', 'r'), 'label' => 'Permohonan Pensiun', 'url' => url('/permohonanPensiun'), 'auth_id' => 'permohonanPensiun'),
                    array('visible' => landa()->checkAccess('permohonanPerpanjanganHonorer', 'r'), 'label' => 'Perpanjang Honorer', 'url' => url('/permohonanPerpanjanganHonorer'), 'auth_id' => 'permohonanPerpanjanganHonorer'),
                )),
            array('visible' => landa()->checkAccess('kenaikanGaji', 'r'), 'label' => 'Kenaikan Gaji Berkala', 'url' => url('/kenaikanGaji'), 'auth_id' => 'kenaikanGaji'),
            array('visible' => landa()->checkAccess('transferCpns', 'r'), 'label' => 'Transfer CPNS', 'url' => url('/transferCpns'), 'auth_id' => 'transferCpns'),
            array('visible' => landa()->checkAccess('rekapPegawai', 'r'), 'label' => 'Rekapitulasi', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('rekapPegawai', 'r'), 'label' => 'Rekap Data', 'url' => url('/pegawai/rekap'), 'auth_id' => 'rekapPegawai'),
                    array('visible' => landa()->checkAccess('rekapEselon', 'r'), 'label' => 'Rekap Data Eselon', 'url' => url('/pegawai/rekapEselon'), 'auth_id' => 'rekapEselon'),
                    array('visible' => landa()->checkAccess('rekapJabfung', 'r'), 'label' => 'Rekap Data Jab. Fung.', 'url' => url('/pegawai/rekapJabfung'), 'auth_id' => 'rekapJabfung'),
                    array('visible' => landa()->checkAccess('rekapBatasPensiun', 'r'), 'label' => 'Rekap Batas Pensiun.', 'url' => url('/pegawai/rekapBatasPensiun'), 'auth_id' => 'rekapBatasPensiun'),
                )),
            array('visible' => landa()->checkAccess('laporanUrutanKepangkatan', 'r'), 'label' => 'Laporan Pegawai', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('laporanStrukturOrganisasi', 'r'), 'label' => 'Stuktur Organisasi', 'url' => url('/report/strukturOrganisasi'), 'auth_id' => 'laporanStrukturOrganisasi'),
                    array('visible' => landa()->checkAccess('laporanUrutanKepangkatan', 'r'), 'label' => 'Urutan Kepangkatan', 'url' => url('/report/urutKepangkatan/'), 'auth_id' => 'laporanUrutanKepangkatan'),
                    array('visible' => landa()->checkAccess('laporanMengikutiPelatihan', 'r'), 'label' => 'Mengikuti Pelatihan', 'url' => url('/report/mengikutiPelatihan/'), 'auth_id' => 'laporanMengikutiPelatihan'),
                    array('visible' => landa()->checkAccess('laporanPenghargaanPegawai', 'r'), 'label' => 'Penghargaan Pegawai', 'url' => url('/report/penerimaPenghargaan/'), 'auth_id' => 'laporanPenghargaanPegawai'),
                    array('visible' => landa()->checkAccess('laporanHukumanPegawai', 'r'), 'label' => 'Penerima Hukuman', 'url' => url('/report/penerimaHukuman'), 'auth_id' => 'laporanHukumanPegawai'),
                    array('visible' => landa()->checkAccess('laporanPensiun', 'r'), 'label' => 'Laporan Pensiun', 'url' => url('/report/pensiun'), 'auth_id' => 'laporanPensiun'),
                )),
            array('visible' => landa()->checkAccess('infoUlangTahun', 'r'), 'label' => 'Tools', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('infoUlangTahun', 'r'), 'label' => 'Info Ulang Tahun', 'url' => url('/pegawai/ulangTahun'), 'auth_id' => 'infoUlangTahun'),
                    array('visible' => landa()->checkAccess('checkError', 'r'), 'label' => 'Cek Kelengkapan Data', 'url' => url('/pegawai/checkError'), 'auth_id' => 'checkError'),
                    array('visible' => landa()->checkAccess('importData', 'r'), 'label' => 'Import Data Pegawai', 'url' => url('/pegawai/importData'), 'auth_id' => 'importData'),
                )),
            
        );
    }

}
