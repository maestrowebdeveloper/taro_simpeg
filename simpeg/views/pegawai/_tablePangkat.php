<div id="tablePangkat">
    <?php
    $action = '';
    $th = '';
    if (!empty($edit)) {
        $pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : '';
        $pegawai_id = (!empty($_GET['id'])) ? $_GET['id'] : $pegawai_id;
        echo '<a class="btn blue addPangkat" pegawai="' . $pegawai_id . '"  id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Pangkat</a>';
        $th = '<th style="width:125px"></th>';
    }
    ?>
    <table class="table table-bordered">
        <thead>
        <th>Pangkat / Golru</th>
        <th>No Register</th>
        <th>TMT</th>      
        <?php echo $th; ?>
        </thead>
        <tbody>
            <?php
            foreach ($pangkat as $value) {
                $displays = (!empty($edit) && ($value->id == $value->Pegawai->riwayat_pangkat_id)) ? 'style="display:none"' : 'style="display:"';
                if (!empty($edit))
                    $action = $action = (!empty($edit)) ? '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editPangkat" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deletePangkat" title="Hapus" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-trash"></i></a>
                        <a class="btn btn-small pilih selectPangkat" '.$displays.' title="Pilih" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-ok"></i></a>
                        </td>' : '';
                echo '
                <tr>
                <td>' . $value->golongan . '</td>
                <td>' . $value->nomor_register . '</td>
                <td>' . landa()->date2Ind($value->tmt_pangkat) . '</td>
                ' . $action . '           
                </tr>
            ';
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    $(".editPangkat,.addPangkat").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/getPangkat'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
    $(".deletePangkat").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/deletePangkat'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai") + "&riwayat_pangkat_pegawai=" + $("#Pegawai_riwayat_pangkat_id").val(),
            type: "post",
            success: function (data) {
                obj = JSON.parse(data);
                $(".modal-body").html(obj.body);
                if (obj.default == 1) {
                    $("#nama_pangkat").val("-");
                    $("#tmtPangkat").val("-");
                }
            }
        });
    });

    $(".selectPangkat").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/selectPangkat'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                obj = JSON.parse(data);
                $("#Pegawai_riwayat_pangkat_id").val(obj.id);
                $("#nama_pangkat").val(obj.nama_golongan);
                $("#tmtPangkat").val(obj.tmt_pangkat);
                $("#modalForm").modal("hide");
            }
        });
    });
</script>
