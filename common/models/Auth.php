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
            array('label' => '<span class="icon16 icomoon-icon-screen"></span>Dashboard', 'url' => array('/dashboard')),
            array('visible' => landa()->checkAccess('user', 'r'), 'label' => '<span class="icon16 eco-users"></span>User', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('groupUser', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Group User', 'url' => url('landa/roles/user'), 'auth_id' => 'groupUser'),
                    array('visible' => landa()->checkAccess('user', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>User', 'url' => url('/user'), 'auth_id' => 'user'),
                )),
            array('visible' => landa()->checkAccess('golongan', 'r'), 'label' => '<span class="icon16  eco-archive-2 "></span>Data Master', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('golongan', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Pangkat / Golru', 'url' => url('/golongan'), 'auth_id' => 'golongan'),
                    array('visible' => landa()->checkAccess('unitKerja', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Unit Kerja', 'url' => url('/unitKerja'), 'auth_id' => 'unitKerja'),
                    array('visible' => landa()->checkAccess('jabatanStruktural', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Jab. Struktural', 'url' => url('/jabatanStruktural'), 'auth_id' => 'jabatanStruktural'),
                    array('visible' => landa()->checkAccess('jabatanFu', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Jab. Fung. Umum', 'url' => url('/jabatanFu'), 'auth_id' => 'jabatanFu'),
                    array('visible' => landa()->checkAccess('jabatanFt', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Jab. Fung. Tertentu', 'url' => url('/jabatanFt'), 'auth_id' => 'jabatanFt'),
                    array('visible' => landa()->checkAccess('jabatanHonorer', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Jab. Pegawai Honorer', 'url' => url('/jabatanHonorer'), 'auth_id' => 'jabatanHonorer'),
                    array('visible' => landa()->checkAccess('jabatanFungsional', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Jabatan Fungsional', 'url' => url('/jabatanFungsional'), 'auth_id' => 'jabatanFungsional'),
                    array('visible' => landa()->checkAccess('penghargaan', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Penghargaan', 'url' => url('/penghargaan'), 'auth_id' => 'penghargaan'),
                    array('visible' => landa()->checkAccess('pelatihan', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Pelatihan', 'url' => url('/pelatihan'), 'auth_id' => 'pelatihan'),
                    array('visible' => landa()->checkAccess('hukuman', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Hukuman', 'url' => url('/hukuman'), 'auth_id' => 'hukuman'),
                    array('visible' => landa()->checkAccess('jurusan', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Jurusan', 'url' => url('/jurusan'), 'auth_id' => 'jurusan'),
                    array('visible' => landa()->checkAccess('universitas', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Kampus/Universitas', 'url' => url('/universitas'), 'auth_id' => 'universitas'),
                )),
            array('visible' => landa()->checkAccess('pegawai', 'r'), 'label' => '<span class="icon16  icomoon-icon-user-3 "></span>Data PNS', 'url' => url('/pegawai'), 'auth_id' => 'pegawai'),
            array('visible' => landa()->checkAccess('honorer', 'r'), 'label' => '<span class="icon16  wpzoom-user-2"></span>Data Honorer', 'url' => url('/honorer'), 'auth_id' => 'honorer'),
            array('visible' => landa()->checkAccess('suratMasuk', 'r'), 'label' => '<span class="icon16  eco-mail "></span>Arsip Surat', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('suratMasuk', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Surat Masuk', 'url' => url('/suratMasuk'), 'auth_id' => 'suratMasuk'),
                    array('visible' => landa()->checkAccess('suratKeluar', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Surat Keluar', 'url' => url('/suratKeluar'), 'auth_id' => 'suratKeluar')
                )),
            array('visible' => landa()->checkAccess('permohonanIjinBelajar', 'r'), 'label' => '<span class="icon16  eco-contract "></span>Permohonan', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('permohonanIjinBelajar', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Ijin Belajar', 'url' => url('/permohonanIjinBelajar'), 'auth_id' => 'permohonanIjinBelajar'),
                    array('visible' => landa()->checkAccess('permohonanMutasi', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Permohonan Mutasi', 'url' => url('/permohonanMutasi'), 'auth_id' => 'permohonanMutasi'),
                    array('visible' => landa()->checkAccess('permohonanPensiun', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Permohonan Pensiun', 'url' => url('/permohonanPensiun'), 'auth_id' => 'permohonanPensiun'),
                    array('visible' => landa()->checkAccess('permohonanPerpanjanganHonorer', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Perpanjang Honorer', 'url' => url('/permohonanPerpanjanganHonorer'), 'auth_id' => 'permohonanPerpanjanganHonorer'),
                )),
            array('visible' => landa()->checkAccess('rekapPegawai', 'r'), 'label' => '<span class="icon16  eco-article "></span>Rekap Data', 'url' => url('/pegawai/rekap'), 'auth_id' => 'rekapPegawai'),
            array('visible' => landa()->checkAccess('cariGolongan', 'r'), 'label' => '<span class="icon16  eco-search "></span>Cari Riwayat', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('cariGolongan', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Pangkat / Golru', 'url' => url('/pegawai/cariRiwayatPangkat'), 'auth_id' => 'cariGolongan'),
                    array('visible' => landa()->checkAccess('cariJabatan', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Jabatan', 'url' => url('/pegawai/cariRiwayatJabatan'), 'auth_id' => 'cariJabatan'),
                    array('visible' => landa()->checkAccess('cariGajiPokok', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Gaji', 'url' => url('/pegawai/cariRiwayatGaji'), 'auth_id' => 'cariGajiPokok'),
                    array('visible' => landa()->checkAccess('cariKeluarga', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Keluarga', 'url' => url('/pegawai/cariRiwayatKeluarga'), 'auth_id' => 'cariKeluarga'),
                    array('visible' => landa()->checkAccess('cariPendidikan', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Pendidikan', 'url' => url('/pegawai/cariRiwayatPendidikan'), 'auth_id' => 'cariPendidikan'),
                )),
            array('visible' => landa()->checkAccess('infoUlangTahun', 'r'), 'label' => '<span class="icon16  eco-cog "></span>Tools', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('infoUlangTahun', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Info Ulang Tahun', 'url' => url('/pegawai/ulangTahun'), 'auth_id' => 'infoUlangTahun'),
                    array('visible' => landa()->checkAccess('checkError', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Cek Kelengkapan Data', 'url' => url('/pegawai/checkError'), 'auth_id' => 'checkError'),
                    array('visible' => landa()->checkAccess('importData', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Import Data Pegawai', 'url' => url('/pegawai/importData'), 'auth_id' => 'importData'),
                )),
            array('visible' => landa()->checkAccess('laporanUrutanKepangkatan', 'r'), 'label' => '<span class="icon16  cut-icon-printer-2 "></span>Laporan Pegawai', 'url' => array('#'), 'submenuOptions' => array('class' => 'sub'), 'items' => array(
                    array('visible' => landa()->checkAccess('laporanUrutanKepangkatan', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Urutan Kepangkatan', 'url' => url('/report/urutKepangkatan/'), 'auth_id' => 'laporanUrutanKepangkatan'),
                    array('visible' => landa()->checkAccess('laporanPegawai', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Pegawai Negeri Sipil', 'url' => url('/report/pegawai/'), 'auth_id' => 'laporanPegawai'),
                    array('visible' => landa()->checkAccess('laporanHonorer', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Pegawai Honorer', 'url' => url('/report/honorer/'), 'auth_id' => 'laporanHonorer'),
                    array('visible' => landa()->checkAccess('laporanUnitPermohonanPensiun', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Permohonan Pensiun', 'url' => url('/report/permohonanPensiun/'), 'auth_id' => 'laporanUnitPermohonanPensiun'),
                    array('visible' => landa()->checkAccess('laporanPermohonanMutasi', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Permohonan Mutasi', 'url' => url('/report/permohonanMutasi/'), 'auth_id' => 'laporanPermohonanMutasi'),
                    array('visible' => landa()->checkAccess('laporanIjinBelajar', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Ijin Belajar', 'url' => url('/report/ijinBelajar/'), 'auth_id' => 'laporanIjinBelajar'),
                    array('visible' => landa()->checkAccess('laporanPerpanjanganHonorer', 'r'), 'label' => '<span class="icon16 icomoon-icon-arrow-right"></span>Perpanjangan Honorer', 'url' => url('/report/perpanjanganHonorer/'), 'auth_id' => 'laporanPerpanjanganHonorer'),
                    array('visible' => landa()->checkAccess('laporanMengikutiPelatihan', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Mengikuti Pelatihan', 'url' => url('/report/mengikutiPelatihan/'), 'auth_id' => 'laporanMengikutiPelatihan'),
                    array('visible' => landa()->checkAccess('laporanPenghargaanPegawai', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Penghargaan Pegawai', 'url' => url('/report/penerimaPenghargaan/'), 'auth_id' => 'laporanPenghargaanPegawai'),
                    array('visible' => landa()->checkAccess('laporanHukumanPegawai', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Penerima Hukuman', 'url' => url('/report/penerimaHukuman'), 'auth_id' => 'laporanHukumanPegawai'),
                    array('visible' => landa()->checkAccess('laporanSuratMasuk', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Surat Masuk', 'url' => url('/report/suratMasuk'), 'auth_id' => 'laporanSuratMasuk'),
                    array('visible' => landa()->checkAccess('laporanSuratKeluar', 'r'), 'label' => '<span class="icon16  icomoon-icon-arrow-right"></span>Surat Keluar', 'url' => url('/report/suratKeluar'), 'auth_id' => 'laporanSuratKeluar'),
                )),
        );
    }

}
