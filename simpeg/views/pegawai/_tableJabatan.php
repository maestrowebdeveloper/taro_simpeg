<div id="tableJabatan">
    <?php
    $action = '';
    $th = '';
    if (!empty($edit)) {
        $pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : '';
        $pegawai_id = (!empty($_GET['id'])) ? $_GET['id'] : $pegawai_id;
        echo '<a class="btn blue addJabatan" pegawai="' . $pegawai_id . '" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Jabatan</a>';
        $th = '<th style="width:125px"></th>';
    }
    ?>
    <table class="table table-bordered" id="tableJabatan">
        <thead>
        <th>No. Register</th>
        <th>Unit Kerja</th>
        <th>Jabatan</th>
        
        <th>Tmt Jabatan</th>        
        <th>Eselon</th>     
        <th>Tmt Eselon</th>
        <?php echo $th; ?>
        </thead>
        <tbody>
            <?php
            foreach ($jabatan as $value) {
                $pegawai = Pegawai::model()->findByPk($value->pegawai_id);
                $display = ($pegawai->riwayat_jabatan_id == $value->id) ? 'none' : '';
                $pangkatGolongan = RiwayatPangkat::model()->findByAttributes(array('pegawai_id' => $value->pegawai_id));
                $jabatanFungsional = Golongan::model()->golJabatan($value->type,$pangkatGolongan->golongan_id);
                if (!empty($edit))
                    $action = '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editJabatan" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteJabatan" title="Hapus" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-trash"></i></a>
                        <a class="btn btn-small pilih selectJabatan" jabfungsional="'.$pegawai->JabatanFt->nama.' '.$jabatanFungsional.'" style="display:'.$display.'" title="Pilih" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-ok"></i></a>
                        </td>';

                $eselon = '-';
                $tmt_eselon = '-';

                if ($value->tipe_jabatan == "struktural") {
                    $tmt_jabatan = $value->tmt_mulai;
                    $eselon = (!empty($value->JabatanStruktural->Eselon->nama)) ? $value->JabatanStruktural->Eselon->nama : '-';
                    $tmt_eselon = $value->tmt_eselon;
                    $jabatan = (isset($value->JabatanStruktural->nama)) ? $value->JabatanStruktural->nama : '-';
                } else if ($value->tipe_jabatan == "fungsional_umum") {
                    $jabatan = (isset($value->JabatanFu->nama)) ? $value->JabatanFu->nama : '';
                    $tmt_jabatan = $value->tmt_mulai;
                } else if ($value->tipe_jabatan == "fungsional_tertentu") {
                    $jabatan = (isset($value->JabatanFt->nama)) ? $value->JabatanFt->nama : '';
                    $tmt_jabatan = $value->tmt_mulai;
                }

                echo '
                <tr>
                <td>' . $value->nomor_register . '</td>
                <td>' . (isset($value->JabatanStruktural->nama) ? $value->JabatanStruktural->nama : "-") . '</td>
                <td>' . $jabatan . '</td>
                
                <td>' . $tmt_jabatan . '</td>
                <td>' . $eselon . '</td>
                <td>' . $tmt_eselon . '</td>                            
                ' . $action . '
                </tr>
            ';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(".editJabatan,.addJabatan").click(function() {
        $.ajax({
            url: "<?php echo url('pegawai/getJabatan'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function(data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
    $(".deleteJabatan").click(function() {
        $.ajax({
            url: "<?php echo url('pegawai/deleteJabatan'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai") + "&riwayat_jabatan_pegawai=" + $("#Pegawai_riwayat_jabatan_id").val(),
            type: "post",
            success: function(data) {
                obj = JSON.parse(data);
                $(".modal-body").html(obj.body);
                if (obj.default == 1) {
                    $("#riwayatTipeJabatan").val("-");
                    $("#riwayatNamaJabatan").val("-");
                    $("#riwayatTmtJabatan").val("-");
                }
            }
        });
    });
    $(".selectJabatan").click(function() {
        var jabfung = $(this).attr("jabfungsional");
        $.ajax({
            url: "<?php echo url('pegawai/selectJabatan'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function(data) {
                obj = JSON.parse(data);
                if (obj.isi == 1) {
                    alert("Jabatan sudah di emban oleh "+obj.pegawai+" dengan NIP : "+obj.nip);
                } else {
                    $("#Pegawai_riwayat_jabatan_id").val(obj.id);
                    $("#riwayatTipeJabatan").val(obj.tipe);
                    $("#riwayatNamaJabatan").val(obj.jabatan);
                    $("#riwayatTmtJabatan").val(obj.tmt);
                    $("#riwayatBidangJabatan").val(obj.bidang);
                    $("#modalForm").modal("hide");
                    $("#jabatan-fungsional").val(jabfung);
                    pensiun($("#Pegawai_tanggal_lahir").val(), obj.id);
                }
            }
        });
    });
</script>
