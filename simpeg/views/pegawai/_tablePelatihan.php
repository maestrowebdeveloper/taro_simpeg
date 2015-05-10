<div id="tablePelatihan">
    <?php
    $action = '';
    $th = '';
    if (!empty($edit)) {
        $pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : '';
        $pegawai_id = (!empty($_GET['id'])) ? $_GET['id'] : $pegawai_id;
        echo '<a class="btn blue addPelatihan" pegawai="' . $pegawai_id . '" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Pelatihan</a>';
        $th = '<th></th>';
    }
    ?>
    <table class="table table-bordered">
        <thead>
        <th>Pelatihan</th>
        <th>Nomor Register</th>
        <th>Nomor STTPL</th>
        <th>Tanggal</th>
        <th>Lokasi</th>
        <th>Penyelenggara</th>    
        <?php echo $th; ?>         
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
                ' . $action . '
                </tr>
            ';
            }
            ?>
        </tbody>
    </table>

</div>
<script>
    $(".editPelatihan,.addPelatihan").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/getPelatihan'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
    $(".deletePelatihan").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/deletePelatihan'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $("#tablePelatihan").replaceWith(data);
            }
        });
    });
</script>