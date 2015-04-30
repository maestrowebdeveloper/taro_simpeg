<style>

    #login-form {
        margin-top: 2vh;

        padding: 20px;
        border: 1px solid #d4d4d4;
        width: 481px;
        background: #fff;
        border: 3px solid forestgreen;
        box-shadow: 1px 1px 1px 1px #ccc;
        border-radius: 2px;
        background: white;
        border-radius: 10px;
        height: 40px;
    }
    #login-form2 {
        width: 481px;
    }
    .center-bar {
        margin: 0 auto 30px;
        display: block;
    }

    .newLogin{
        left: 50%;
        top: 50%;
        width: 300px;
        height: auto;
        position: absolute;
        margin-top: -200px;
        margin-left: -150px;
        padding: 0px 20px;
        border: 3px solid forestgreen;
        box-shadow: 1px 1px 1px 1px #ccc;
        border-radius: 2px;
        background: white;
        border-radius: 20px;
    }

    .newLogin .form-actions {
        border-radius: 0 0 20px 20px;
    }

</style>
<?php
if (!isset($_POST['nip'])) {
    ?>
    <?php
//        $model = new User;
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'User-form',
//                                    'action' => url('bbiiMember/sendEmail'),
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'style' => 'margin-top: 25px;'
        )
    ));
    ?>
    <div class="container-fluid">
        <div class="newLogin">        
            <!--<form class="form-horizontal" action="dashboard.html" />-->
            <center>
                <img style="height: 75px;margin: 10px 5px 0 0px;" src="<?php echo bt() ?>/images/logo.png" />
                <h3 style="margin:5px 0 0 0">BADAN KEPEGAWAIAN DAERAH</h3>
                <span class="green" style="font-weight: bold;">Kabupaten Sampang, Madura</span>
            </center>
            <hr style="margin:10px 0px 20px 0px">

            <div class="form-row row-fluid">   
                <div class="span12"> 
                    <div class="form-row row-fluid">
                        <div class="span12">            
                            <input type="text" maxlength="18" placeholder="Masukan NIP" onKeyup="angka(this);" name="nip" required>
                        </div>
                    </div>
                    <br/>
                </div>
            </div>


            <div class="form-row row-fluid">                       
                <div class="span12">
                    <div class="row-fluid">
                        <div class="form-actions" style="margin:0px -20px">
                            <div class="span12 controls" style="padding:0px 20px">

          <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=""> <i class="icon-search"></i></a>-->
                                <a href="<?php echo url('site/logout') ?>" style="background:forestgreen" class="btn btn-info" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Login</a>
                                <button type="submit" style="background:forestgreen" class="btn btn-info right" id="loginBtn"><span class="icon16 icon-search white"></span> Search</button>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 

            <!--</form>-->
        </div>

    </div>
    <?php $this->endWidget(); ?>
    <?php
} else {
    echo'';
}
?>
<?php
if (isset($_POST['nip'])) {
    $model = Pegawai::model()->findByAttributes(array('nip' => $_POST['nip']));
    ?>
    <div id="login-form" class="center-bar clearfix">
        <?php
//        $model = new User;
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'User-form',
//                                    'action' => url('bbiiMember/sendEmail'),
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
//                'style' => 'margin-top: 25px;'
            )
        ));
        ?>
        <table width="100%">
            <tr>
                <td>
                    <div class="input-prepend" style="width: 90%;">
                        <span class="add-on"><i class="minia-icon-search"></i></span>
                        <input class="span12" maxlength="18" style="width:100%" placeholder="Masukan NIP" onKeyup="angka(this);" name="nip" id="nip" value="<?php echo (isset($_POST['nip'])) ? $_POST['nip'] : '' ?>" type="text" required>
                    </div>  
                </td>
                <td>
                    <button class="btn btn-primary btn-lg " name="commit" type="submit"><i class="icon-search"></i>&nbsp; Search</button>
                    <a href="<?php echo url('site/logout') ?>" class="btn btn-primary btn-lg " name="commit" ><i class="icon16 icomoon-icon-enter white"></i>&nbsp; Login</a>
                </td>
            </tr>
        </table>

        <?php $this->endWidget(); ?>
    </div>
    <?php
    if (empty($model)) {
        echo'<div id="login-form2" class="center-bar clearfix"><div class="alert fade in" span6>
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>Peringatan!</strong> Maaf NIP yang anda cari tidak terdaftar.
          </div></div>';
    } else {
        $pangkat = RiwayatPangkat::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tmt_pangkat DESC'));
        $jabatan = RiwayatJabatan::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tmt_mulai DESC'));
//                    $gaji = RiwayatGaji::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tmt_mulai DESC'));
        $keluarga = RiwayatKeluarga::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'hubungan DESC'));
        $pendidikan = RiwayatPendidikan::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tahun DESC'));
        $hukuman = RiwayatHukuman::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tanggal_pemberian DESC'));
        $cuti = RiwayatCuti::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tanggal_sk DESC'));
        $pelatihan = RiwayatPelatihan::model()->findAll(array('condition' => 'pegawai_id=' . $model->id, 'order' => 'tanggal DESC'));
        ?>

        <div class="row-fluid">
            <div class="span1">
                &nbsp;
            </div>
            <div class="span10">

                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#pegawai">Data Pegawai</a></li>
                    <li class=""><a href="#pangkat">Riwayat Pangkat</a></li>
                    <li class=""><a href="#jabatan">Riwayat Jabatan</a></li>
                    <li class=""><a href="#keluarga">Riwayat Keluarga</a></li>
                    <li class=""><a href="#pendidikan">Riwayat Pendidikan</a></li>
                    <li class=""><a href="#diklat">Riwayat Diklat</a></li>
                    <li class=""><a href="#cuti">Riwayat Cuti</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="pegawai">
                        <table class="table">
                            <tr>
                                <th style="background:beige;text-align:center !important" colspan="2">
                            <h3 style="margin:0px">PROFIL <?php echo strtoupper($model->nama); ?></h3>
                            </th>
                            </tr>
                            <tr>


                                <td style="line-height:10px;vertical-align:top;" class="span2">            
                                    <?php
                                    $img = Yii::app()->landa->urlImg('pegawai/', $model->foto, $_GET['id']);
                                    echo '<img style="max-width:250px;max-height:350px;" src="' . $img['medium'] . '" alt="" class="image img-polaroid" id="my_image"  /> ';
                                    ?>

                                </td>

                                <td>
                                    <div style="padding:8px">
                                        <table class="table2" width="100%" >

                                            <tr><td>NIP</td><td>:</td><td><?php echo $model->nip; ?></td></tr>
                                            <tr><td>Nama</td><td>:</td><td><?php echo $model->namaGelar; ?></td></tr>
                                            <tr><td>Pendidikan</td><td>:</td><td><?php echo ucwords(strtolower($model->pendidikanTerakhir)) . ', Tahun : ' . $model->pendidikanTahun; ?></td></tr>
                                            <tr><td>Jurusan</td><td>:</td><td><?php echo ucwords(strtolower($model->pendidikanJurusan)); ?></td></tr>
                                            <tr><td>Jenis Kelamin</td><td>:</td><td><?php echo $model->jenis_kelamin; ?></td></tr>
                                            <tr><td>TTL</td><td>:</td><td><?php echo $model->ttl; ?></td></tr>
                                            <tr><td>Kode Pos</td><td>:</td><td><?php echo $model->kode_pos; ?></td></tr>
                                            <tr><td>HP</td><td>:</td><td><?php echo landa()->hp($model->hp); ?></td></tr>
                                            <tr><td>Agama</td><td>:</td><td><?php echo $model->agama; ?></td></tr>
                                            <tr><td>Golongan Darah</td><td>:</td><td><?php echo $model->golongan_darah; ?></td></tr>
                                            <tr><td>Status Pernikahan</td><td>:</td><td><?php echo $model->status_pernikahan; ?></td></tr>
                                            <tr><td>NPWP</td><td>:</td><td><?php echo $model->npwp; ?></td></tr>
                                            <tr><td>Karpeg</td><td>:</td><td><?php echo $model->karpeg; ?></td></tr>
                                            <tr><td>KPE</td><td>:</td><td><?php echo $model->kpe; ?></td></tr>
                                            <tr><td>Taspen</td><td>:</td><td><?php echo $model->no_taspen; ?></td></tr>
                                            <tr><td>BPJS/ASKES/KIS</td><td>:</td><td><?php echo $model->bpjs; ?></td></tr>

                                        </table>
                                    </div>
                                </td>

                            </tr>
                        </table>
                    </div>
                    <div class="tab-pane" id="pangkat">
                        <table class="table table-bordered">
                            <thead>
                            <th>Pangkat / Golru</th>
                            <th>No Register</th>
                            <th>TMT</th>      
                            </thead>
                            <tbody>
                                <?php
                                foreach ($pangkat as $value) {
                                    if (!empty($edit))
                                        $action = $action = (!empty($edit)) ? '<td style="width: 85px;text-align:center">
                                                        <a class="btn btn-small update editPangkat" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                                                        <a class="btn btn-small delete deletePangkat" title="Hapus" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-trash"></i></a>
                                                        <a class="btn btn-small pilih selectPangkat" title="Pilih" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-ok"></i></a>
                                                        </td>' : '';
                                    echo '
                                                <tr>
                                                <td>' . $value->golongan . '</td>
                                                <td>' . $value->nomor_register . '</td>
                                                <td>' . $value->tmt_pangkat . '</td>
                                                </tr>
                                            ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="jabatan">
                        <table class="table table-bordered" id="tableJabatan">
                            <thead>
                            <th>No. Register</th>
                            <th>Jabatan</th>
                            <th>Bidang</th>
                            <th>Tmt Jabatan</th>        
                            <th>Eselon</th>     
                            <th>Tmt Eselon</th>

                            </thead>
                            <tbody>
                                <?php
                                foreach ($jabatan as $value) {


                                    $eselon = '-';
                                    $tmt_eselon = '-';
                                    if ($value->tipe_jabatan == "struktural") {
                                        $jabatan = $value->JabatanStruktural->nama;
                                        $tmt_jabatan = $value->tmt_mulai;
                                        $eselon = (!empty($value->JabatanStruktural->Eselon->nama)) ? $value->JabatanStruktural->Eselon->nama : '-';
                                        $tmt_eselon = $value->tmt_eselon;
                                    } else if ($value->tipe_jabatan == "fungsional_umum") {
                                        $jabatan = (isset($value->JabatanFu->nama)) ? $value->JabatanFu->nama : '';
                                        $tmt_jabatan = $value->tmt_mulai;
                                    } else if ($value->tipe_jabatan == "fungsional_tertentu") {
                                        $jabatan = (isset($value->JabatanFt->nama)) ? $value->JabatanFt->nama : '';
                                        $tmt_jabatan = $value->tmt_mulai;
                                    }
                                    $bidang = isset($value->Bidang->nama) ? $value->Bidang->nama : "-";
                                    echo '
                <tr>
                <td>' . $value->nomor_register . '</td>
                <td>' . ucwords($jabatan) . '</td>
                <td>' . $bidang . '</td>
                <td>' . $tmt_jabatan . '</td>
                <td>' . $eselon . '</td>
                <td>' . $tmt_eselon . '</td>                            
                
                </tr>
            ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="keluarga">
                        <table class="table table-bordered">
                            <thead>      
                            <th>Suami / Istri</th>
                            <th>TTL</th>
                            <th>Pendidikan</th>
                            <th>Pekerjaan</th>
                            <th>No Karsu</th>
                            <th>No Karsi</th>
                            <th>Tanggal Pernikahan</th>
                            <th>Status</th>

                            </thead>
                            <tbody>
                                <?php
                                foreach ($keluarga as $value) {
                                    if ($value->hubungan != 'anak') {

                                        $nama = ($value->keluarga_pegawai_id != 0) ? '<a href="' . url("pegawai/" . $value->keluarga_pegawai_id) . '">' . $value->nama . '</a>' : $value->nama;
                                        echo '
                <tr>                
                <td>' . $nama . '</td>
                <td>' . $value->ttl . '</td>
                <td>' . $value->pendidikan_terakhir . '</td>
                <td>' . $value->pekerjaan . '</td>
                <td>' . $value->nomor_karsu . '</td>
                <td>' . $value->nomor_karsi . '</td>
                <td>' . $value->tanggal_pernikahan . '</td>
                <td>' . $value->status . '</td>
                
                </tr>
            ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="pendidikan">
                        <table class="table table-bordered">
                            <thead>
                            <th>Jenjang</th>        
                            <th>Jurusan</th>
                            <th>Nama Sekolah</th>
                            <th>Alamat</th>
                            <th>Tahun</th>        

                            </thead>
                            <tbody>
                                <?php
                                foreach ($pendidikan as $value) {
                                    if (isset($value->Universitas->name))
                                        $sekolah = $value->Universitas->name;
                                    else
                                        $sekolah = $value->nama_sekolah;

                                    if (isset($value->Jurusan->Name))
                                        $jurusan = $value->Jurusan->Name;
                                    else
                                        $jurusan = $value->jurusan;

                                    echo '
                <tr>
                <td>' . $value->jenjang_pendidikan . '</td>
                <td>' . $jurusan . '</td>
                <td>' . $sekolah . '</td>
                <td>' . $value->alamat_sekolah . '</td>
                <td>' . $value->tahun . '</td>                
                             
                </tr>
            ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="diklat">
                        <table class="table table-bordered">
                            <thead>
                            <th>Pelatihan</th>
                            <th>Nomor Register</th>
                            <th>Nomor STTPL</th>
                            <th>Tanggal</th>
                            <th>Lokasi</th>
                            <th>Penyelenggara</th>    

                            </thead>
                            <tbody>
                                <?php
                                foreach ($pelatihan as $value) {
                                    $action = $action = (!empty($edit)) ? '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editPelatihan" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deletePelatihan" title="Hapus" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-trash"></i></a>
                        </td>' : '';
                                    echo '
                <tr>
                <td>' . $value->pelatihan . '</td>
                <td>' . $value->nomor_register . '</td>
                <td>' . $value->nomor_sttpl . '</td>
                <td>' . $value->tanggal . '</td>
                <td>' . $value->lokasi . '</td>
                <td>' . $value->penyelenggara . '</td>
                
                </tr>
            ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="cuti">
                        <table class="table table-bordered">
                            <thead>
                            <th>Jenis Cuti</th>
                            <th>Nomor SK</th>
                            <th>Tanggal Pemberian</th>
                            <th>Pejabat</th>        
                            <th>Lama Cuti</th>        
                            <?php echo $th; ?>         
                            </thead>
                            <tbody>
                                <?php
                                foreach ($cuti as $value) {
                                    echo '
                <tr>
                <td>' . $value->jenis_cuti . '</td>
                <td>' . $value->no_sk . '</td>
                <td>' . date('d-m-Y', strtotime($value->tanggal_sk)) . '</td>
                <td>' . $value->pejabat . '</td>                
                <td>' . date('d-m-Y', strtotime($value->mulai_cuti)) . ' - ' . date('d-m-Y', strtotime($value->selesai_cuti)) . '</td>                
                               
                </tr>
            ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="span1">
                &nbsp;
            </div>
        </div>
        <?php
    }
}
?>

<script>
    function angka(e) {
        if (!/^[0-9,+,-]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }
    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    })
</script>