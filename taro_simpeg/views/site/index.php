<?php
/* @var $this SiteController */
$this->pageTitle = 'Dashboard - Selamat Datang di Area Administrator';
$siteConfig = SiteConfig::model()->listSiteConfig();

if (empty(Yii::app()->session['pegawai'])) {
    $today = date('m/d');
    $week = date('m/d', strtotime("+7 day", strtotime($today)));
    $nextweek = date('m/d', strtotime("+7 day", strtotime($week)));
    $month = date('m');
    $nextmonth = date('m', strtotime("+1 month", strtotime($month)));


    $sql = Pegawai::model()->findBySql('SELECT COUNT(`id`) as total FROM `acca_pegawai` WHERE date_format(tanggal_lahir,"%m/%d") = "' . $today . '"');
    $pegawai['hariIni'] = (empty($sql->total)) ? 0 : intval($sql->total);

    $sql = Pegawai::model()->findBySql('SELECT COUNT(`id`) as total FROM `acca_pegawai` WHERE date_format(tanggal_lahir,"%m/%d") between "' . $today . '" and "' . $week . '"');
    $pegawai['mingguIni'] = (empty($sql->total)) ? 0 : intval($sql->total);

    $sql = Pegawai::model()->findBySql('SELECT COUNT(`id`) as total FROM `acca_pegawai` WHERE date_format(tanggal_lahir,"%m/%d") between "' . $week . '" and "' . $nextweek . '"');
    $pegawai['mingguDepan'] = (empty($sql->total)) ? 0 : intval($sql->total);

    $sql = Pegawai::model()->findBySql('SELECT COUNT(`id`) as total FROM `acca_pegawai` WHERE date_format(tanggal_lahir,"%m") = "' . $month . '"');
    $pegawai['bulanIni'] = (empty($sql->total)) ? 0 : intval($sql->total);

    $sql = Pegawai::model()->findBySql('SELECT COUNT(`id`) as total FROM `acca_pegawai` WHERE date_format(tanggal_lahir,"%m") = "' . $nextmonth . '"');
    $pegawai['bulanDepan'] = (empty($sql->total)) ? 0 : intval($sql->total);

    Yii::app()->session['pegawai'] = $pegawai;
}

$pegawai = Yii::app()->session['pegawai'];
?>
<div class="row-fluid">
    <div class="span8">
        <div class="row-fluid">
            <div class="shortcuts">
                <ul>
                    <li><a style="width:100px" href="<?php echo url('pegawai/rekap') ?>" title="Rekap Data"><span class="icon24 brocco-icon-calendar "></span><h6>Rekap Data</h6></a></li>
                    <li><a style="width:100px" href="<?php echo url('pegawai/rekapEselon') ?>" title="Rekap Eselon"><span class="icon24 icomoon-icon-calendar "></span><h6>Rekap Eselon</h6></a></li>
                    <li><a style="width:100px" href="<?php echo url('pegawai/rekapJabfung') ?>" title="Rekap Fungs"><span class="icon24 iconic-icon-calendar-alt-stroke"></span><h6>Rekap Fungs</h6></a></li>
                    <li><a style="width:100px" href="<?php echo url('report/urutKepangkatan') ?>" title="DUK"><span class="icon24 silk-icon-calendar "></span><h6>DUK</h6></a></li>
                    <li><a style="width:100px" href="<?php echo url('report/pensiun') ?>" title="Pensiun"><span class="icon24 minia-icon-calendar  "></span><h6>Pensiun</h6></a></li>
                </ul>
            </div>
            <div class="box gradient">
                <div class="content" style="display: block;">
                    <?php
                    $this->Widget('common.extensions.highcharts.HighchartsWidget', array(
                        'options' => array(
                            'title' => array('text' => 'Rekapitulasi berdasarkan Jabatan'),
                            'xAxis' => array(
                                'categories' => array('HARI INI', 'MINGGU INI', 'MINGGU DEPAN', 'BULAN INI', 'BULAN DEPAN')
                            ),
                            'yAxis' => array(
                                'title' => array('text' => 'Jumlah')
                            ),
                            'series' => array(
                                array('name' => 'Pegawai', 'data' => array($pegawai['hariIni'], $pegawai['mingguIni'], $pegawai['mingguDepan'], $pegawai['bulanIni'], $pegawai['bulanDepan'])),
                            ),
                            'legend' => array(
                                'enabled' => false
                            ),
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
<style>
    .highcharts-container{
        width: 99% !important;
    }
</style>