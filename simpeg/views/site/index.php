<?php
/* @var $this SiteController */
$this->pageTitle = 'Dashboard - Selamat Datang di Area Administrator';
$siteConfig = SiteConfig::model()->listSiteConfig();

$criteria = '';

$struktural = Pegawai::model()->with('JabatanStruktural.Eselon')->findAll(array('condition' => 'JabatanStruktural.eselon_id = Eselon.id and t.tipe_jabatan="struktural" and t.kedudukan_id=1 ', 'group' => 'Eselon.nama', 'select' => '*,count(t.id) as id'));
//$eselon = CHtml::listData(Eselon::model()->findAll(array('order' => 'id ASC')), 'nama', 'nama');
foreach ($struktural as $value) {
    if (isset($value->JabatanStruktural->Eselon->nama)) {
        $sEselon[$value->JabatanStruktural->Eselon->nama] = $value->id;
    }
}

foreach ($sEselon as $key => $value) {
    $grafik[$key] = intval($value);
}
//
$jbtTertentu = Pegawai::model()->with('JabatanFt')->findAll(array('condition' => 't.jabatan_ft_id = JabatanFt.id and t.tipe_jabatan="fungsional_tertentu" and t.kedudukan_id=1 ', 'group' => 'JabatanFt.type', 'select' => '*,count(t.id) as id'));
//$tertentu = array('guru' => 'Guru', 'kesehatan' => 'Kesehatan', 'umum' => 'Umum');
foreach ($jbtTertentu as $value) {
    if (isset($value->JabatanFt->type)) {
        $sgrafik[$value->JabatanFt->type] = $value->id;
    }
}

foreach ($sgrafik as $key => $value) {
    $grafik[$key] = intval($value);
}

$jbtUmum = Pegawai::model()->with('JabatanFu')->find(array('condition' => 't.tipe_jabatan="fungsional_umum" and t.kedudukan_id=1 ', 'group' => 'tipe_jabatan', 'select' => '*,count(t.id) as id'));
$grafik['fungsional umum'] = isset($jbtUmum->id) ? intval($jbtUmum->id) : 0;

$data = array();
foreach ($grafik as $key => $val) {
    $data[] = array($key, $val);
}
//print_r($data);
?>
<div class="row-fluid">
    <div class="span8">
        <div class="row-fluid">
            <div class="shortcuts">
                <ul>
                    <li><a style="width:100px" href="<?php echo url('pegawai/rekap') ?>" title="Rekap Data"><h6>Rekap Data</h6></a></li>
                    <li><a style="width:100px" href="<?php echo url('pegawai/rekapEselon') ?>" title="Rekap Eselon"><h6>Rekap Eselon</h6></a></li>
                    <li><a style="width:100px" href="<?php echo url('pegawai/rekapJabfung') ?>" title="Rekap Fungs"><h6>Rekap Fungs</h6></a></li>
                    <li><a style="width:100px" href="<?php echo url('report/urutKepangkatan') ?>" title="DUK"><h6>DUK</h6></a></li>
                    <li><a style="width:100px" href="<?php echo url('report/pensiun') ?>" title="Pensiun"><h6>Pensiun</h6></a></li>
                </ul>
            </div>
            <div class="box gradient">
                <div class="content" style="display: block;">
                    <?php
                    $this->Widget('common.extensions.highcharts.HighchartsWidget', array(
                        'options' => array(
                            'title' => array('text' => 'Grafik Rekap Jabatan'),
                            'series' => array(array(
                                    'type' => 'pie',
                                    'name'=>'Jumlah',
                                    'data' => $data,
                                )),
                            'credits' => array(
                                'enabled' => false
                            ),
                        )
                    ));
                    ?>
                </div>
            </div>

        </div>
    </div>
    <div class="span4">
        <div class="row-fluid">
            <div class="box">
                <div class="title">

                    <h4>
                        <span class="icon16 silk-icon-office"></span>
                        <span><?php echo Yii::app()->session['site']['client_name'] ?></span>
                    </h4>
                </div>
                <div class="content">
                    <?php
                    $img = Yii::app()->landa->urlImg('site/', $siteConfig->client_logo, param('id'));
                    echo '<img style="width:97%" src="' . $img['big'] . '" class="img-polaroid"/>';
                    ?>
                    <div class="clearfix"></div>
                    <dl>
                        <dt>Address</dt>
                        <dd><?php echo ucwords($siteConfig->fullAddress) ?></dd>
                        <dt>Telephone</dt>
                        <dd><?php echo $siteConfig->phone ?></dd>
                        <dt>Email</dt>
                        <dd><?php echo $siteConfig->email ?></dd>
                    </dl>
                </div>

            </div>

            <div class="box">
                <div class="title">
                    <h4>
                        <span class="icon16 icon-download-alt"></span>
                        <span>Manual Book</span>
                    </h4>
                </div>
                <div class="content">
                    <a href="simpeg-v1.pdf" target="_blank"><span class="icon32 icon-download-alt blue" style="float: left;padding: 5px 10px"></span></a>Buku panduan mengoperasikan Sistem Kepegawaian, web base version.
                </div>
            </div>
            <div class="todo">
                <h4>Latest Logged-in Users
                    <a href="#" class="icon tip" oldtitle="Configure" title=""><span class="icon16 iconic-icon-cog"></span></a>

                </h4>
                <ul>

                    <?php
                    $listUser = User::model()->listUser();
                    $oUserLogs = UserLog::model()->findAll(array('order' => 'created DESC', 'limit' => '5'));
                    foreach ($oUserLogs as $oUserLog) {
                        if (isset($oUserLog->User->Roles->name)) {
                            echo '<li class="clearfix">' .
                            $oUserLog->User->name . ' | ' . $oUserLog->User->Roles->name . '
                        <span class="label pull-right" style="margin-top: 6px;">' . landa()->ago($oUserLog->created) . '</span>
                        </li> ';
                        };
                    }
                    ?>

                </ul>
            </div>
        </div> 
    </div>
</div>
</div>
<style>
    .highcharts-container{
        width: 99% !important;
    }
</style>