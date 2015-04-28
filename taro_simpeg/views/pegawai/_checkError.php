<?php
$get = "-";
if (isset($_GET['lahir'])) {
    $judul = 'TANGGAL LAHIR';
    $get = "lahir";
}

if (isset($_GET['jk'])) {
    $judul = 'JENIS KELAMIN';
    $get = 'jk';
}
if (isset($_GET['agama'])) {
    $judul = 'AGAMA';
    $get = "agama";
}
if (isset($_GET['pangkat'])) {
    $judul = 'PANGKAT / GOLONGAN';
    $get = "pangkat";
}

if (isset($_GET['jabatan'])) {
    $judul = 'JABATAN';
    $get = "jabatan";
}

if (isset($_GET['pendidikan'])) {
    $judul = 'PENDIDIKAN';
    $get = "pendidikan";
}


$judul = 'INFORMASI KESALAHAN DATA PEGAWAI PADA KOLOM ' . $judul;
?>
<a class="btn btn-info pull-right" href="checkErrorExcel.html?<?php echo $get; ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>

<h3 style="text-align:center"><?php echo $judul; ?></h3>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'pegawai-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{items}{pager}{summary}',
    'enableSorting' => false,
    'columns' => array(
        'nip',
        'nama',
        array(
            'name' => 'tanggal_lahir',
            'header' => 'Tempat / Tgl. Lahir',
            'type' => 'raw',
            'value' => '"$data->ttl"',
        ),
        'golongan',
        'jabatan',
        'unitKerja',
        'agama',
        array(
            'name' => 'pendidikan_terakhir',
            'type' => 'raw',
            'value' => 'isset($data->RiwayatPendidikan->jenjang_pendidikan) ? $data->RiwayatPendidikan->jenjang_pendidikan : ""',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Lihat',
                    'options' => array(
                        'class' => 'btn btn-small view'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
                    'options' => array(
                        'class' => 'btn btn-small update'
                    )
                ),
                'delete' => array(
                    'label' => 'Hapus',
                    'options' => array(
                        'class' => 'btn btn-small delete'
                    )
                )
            ),
            'htmlOptions' => array('style' => 'width: 20px;text-align:center'),
        )
    ),
));
?>
