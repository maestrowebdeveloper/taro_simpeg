<div id="tableGajiPokok">
    <?php
    $action = '';
    $th = '';
    if (!empty($edit)) {
        $pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : '';
        $pegawai_id = (!empty($_GET['id'])) ? $_GET['id'] : $pegawai_id;
        echo '<a class="btn blue addGajiPokok" pegawai="' . $pegawai_id . '" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Gaji</a>';
        $th = '<th></th>';
    }
    ?>
    <table class="table table-bordered">
        <thead>        
        <th>Nomor Register</th>        
        <th>Dasar Perubahan</th>
        <th>Gaji</th>
        <th>TMT Mulai</th>        
        <th>TMT Selesai</th>        
        <?php echo $th; ?>            
        </thead>
        <tbody>
            <?php
            foreach ($gaji as $value) {
                if (!empty($edit))
                    $action = $action = (!empty($edit)) ? '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editGajiPokok" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteGajiPokok" title="Hapus" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-trash"></i></a>
                        <a class="btn btn-small pilih selectGaji" title="Pilih" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-ok"></i></a>
                        </td>' : '';
                echo '
                <tr>                
                <td>' . $value->nomor_register . '</td>                
                <td>' . $value->dasar_perubahan . '</td>
                <td>' . landa()->rp($value->gaji) . '</td>                
                <td>' . landa()->date2Ind($value->tmt_mulai) . '</td>
                <td>' . landa()->date2Ind($value->tmt_selesai) . '</td>
                ' . $action . '
                </tr>
            ';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(".editGajiPokok,.addGajiPokok").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/getGajiPokok'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
    $(".deleteGajiPokok").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/deleteGajiPokok'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai") + "&riwayat_gaji_pegawai=" + $("#Pegawai_riwayat_gaji_id").val(),
            type: "post",
            success: function (data) {
                obj = JSON.parse(data);
                $(".modal-body").html(obj.body);
                if (obj.default == 1) {
                    $("#riwayatGaji").val("-");
                    $("#tmtMulai").val("-");
                }
            }
        });
    });
    $(".selectGaji").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/selectGaji'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                obj = JSON.parse(data);
                $("#Pegawai_riwayat_gaji_id").val(obj.id);
                $("#riwayatGaji").val(obj.gaji);
                $("#tmtMulai").val(obj.tmt);
//                $("#riwayatTmtJabatan").val(obj.tmt);
//                $("#riwayatBidangJabatan").val(obj.bidang);
                $("#modalForm").modal("hide");
                pensiun($("#Pegawai_tanggal_lahir").val(), obj.id);
            }
        });
    });
</script>