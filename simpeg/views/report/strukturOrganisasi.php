<?php
$this->setPageTitle('Daftar Struktur Organisasi');

$arrJabatanStruktural = JabatanStruktural::model()->findAll(array('order' => 'root,lft'));
?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Unit Kerja</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($arrJabatanStruktural as $arr) {
            ?>
            <tr>
                <td><?php echo $arr->nestedName ?></td>
                <td><?php echo $sPegNama ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
