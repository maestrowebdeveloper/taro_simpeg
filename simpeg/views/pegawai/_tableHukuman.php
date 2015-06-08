<div id="tableHukuman">
    <?php
    $action = '';
    $th = '';
    if (!empty($edit)) {
        $pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : '';
        $pegawai_id = (!empty($_GET['id'])) ? $_GET['id'] : $pegawai_id;
        echo '<a class="btn blue addHukuman" pegawai="' . $pegawai_id . '" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Hukuman</a>';
        $th = '<th></th>';
    }
    ?>
    <table class="table table-bordered">
        <thead>
        <th>Jenis Hukuman</th>
        <th>Tingkat Hukuman</th>
        <th>Nomor SK</th>
        <th>Tanggal SK</th>
        <th>Mulai SK</th>
        <th>Selesai SK</th>
        <th>Pejabat</th>
        <th>Alasan</th>        
        <?php echo $th; ?>         
        </thead>
        <tbody>
            <?php
            foreach ($hukuman as $value) {
                $action = $action = (!empty($edit)) ? '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editHukuman" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteHukuman" title="Hapus" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-trash"></i></a>
                        </td>' : '';
                echo '
                <tr>
                <td>' . $value->hukuman . '</td>
                <td>' . $value->tingkat_hukuman . '</td>
                <td>' . $value->nomor_register . '</td>
                <td>' . landa()->date2Ind($value->tanggal_pemberian) . '</td>
                <td>' . landa()->date2Ind($value->mulai_sk). '</td>
                <td>' . landa()->date2Ind($value->selesai_sk) . '</td>
                <td>' . $value->pejabat . '</td>
                <td>' . $value->alasan . '</td>                
                ' . $action . '                   
                </tr>
            ';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(".editHukuman,.addHukuman").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/getHukuman'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
    $(".deleteHukuman").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/deleteHukuman'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $("#tableHukuman").replaceWith(data);
            }
        });
    });
</script>