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
    <table class="table table-bordered">
        <thead>
        <th>No. Register</th>
        <th>Jabatan</th>
        <th>Tmt Jabatan</th>        
        <th>Eselon</th>     
        <th>Tmt Eselon</th>
        <?php echo $th; ?>
        </thead>
        <tbody>
            <?php
            foreach ($jabatan as $value) {
                if (!empty($edit))
                    $action = '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editJabatan" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteJabatan" title="Hapus" pegawai="' . $value->pegawai_id . '" id="' . $value->id . '" rel="tooltip" ><i class="icon-trash"></i></a>
                        <a class="btn btn-small pilih selectJabatan" title="Pilih" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-ok"></i></a>
                        </td>';

                $eselon = '-';
                $tmt_eselon = '-';
                if ($value->tipe_jabatan == "struktural") {
                    $jabatan = $value->JabatanStruktural->nama;
                    $tmt_jabatan = $value->tmt_mulai;
                    $eselon = (!empty($value->JabatanStruktural->Eselon->nama))?$value->JabatanStruktural->Eselon->nama:'-';
                    $tmt_eselon = $value->tmt_eselon;
                } else if ($value->tipe_jabatan == "fungsional_umum") {
                    $jabatan = $value->JabatanFu->nama;
                    $tmt_jabatan = $value->tmt_mulai;
                } else if ($value->tipe_jabatan == "fungsional_tertentu") {
                    $jabatan = $value->JabatanFt->nama;
                    $tmt_jabatan = $value->tmt_mulai;
                }
                echo '
                <tr>
                <td>' . $value->nomor_register . '</td>
                <td>' . ucwords($jabatan) . '</td>
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
    $(".editJabatan,.addJabatan").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/getJabatan'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
        $("#modalForm").modal("show");
    });
    $(".deleteJabatan").click(function () {
        $.ajax({
            url: "<?php echo url('pegawai/deleteJabatan'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                //$("#tableJabatan").replaceWith(data);
                $(".modal-body").html(data);
                    $("#modalForm").modal("show");
            }
        });
    });

    $(".selectJabatan").click(function(){
            $.ajax({                                  
                url:"<?php echo url('pegawai/selectJabatan');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){         
                    obj = JSON.parse(data);                            
                    $("#Pegawai_riwayat_jabatan_id").val(obj.id);
                    $("#riwayatTipeJabatan").val(obj.tipe);
                    $("#riwayatNamaJabatan").val(obj.jabatan);  
                    $("#riwayatTmtJabatan").val(obj.tmt);  
                    $("#modalForm").modal("hide");                  
                }
            });            
        }); 
</script>