<div id="tableNilai">
    <?php
    $action = '';
    $th = '';
    if (!empty($edit)) {
        $pegawai_id = (!empty($pegawai_id)) ? $pegawai_id : '';
        $pegawai_id = (!empty($_GET['id'])) ? $_GET['id'] : $pegawai_id;
        echo '<a class="btn blue addNilai" pegawai="' . $pegawai_id . '" id=""><i class="minia-icon-file-add blue"></i>Tambah Nilai SKP</a>';
        $th = '<th rowspan="2"></th>';
    }
    ?>
    <table class="table table-bordered">
        <thead>   
            <tr>
                <th rowspan="2">Tahun</th>
                <th rowspan="2">Nomor Register</th>        
                <th colspan="6">Nilai</th>  
                <?php echo $th ?>
            </tr>         
            <tr>
                <th>Hasil Kerja</th>
                <th>Orientasi Pelayanan</th>
                <th>Integritas</th>
                <th>Disiplin</th>
                <th>Kerja Sama</th>
                <th>Kreativitas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($nilai as $val) {
                $action = (!empty($edit)) ? '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editNilai" pegawai="' . $val->pegawai_id . '" id="' . $val->id . '" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteNilai" title="Hapus" pegawai="' . $val->pegawai_id . '" id="' . $val->id . '" rel="tooltip" ><i class="icon-trash"></i></a>
                        </td>' : '';
                echo '<tr>';
                echo '<td>' . $val->tahun . '</td>';
                echo '<td>' . $val->no_register . '</td>';
                echo '<td>' . $val->nilai_hasil_kerja . '</td>';
                echo '<td>' . $val->nilai_orientasi_pelayanan . '</td>';
                echo '<td>' . $val->nilai_integritas . '</td>';
                echo '<td>' . $val->nilai_disiplin . '</td>';
                echo '<td>' . $val->nilai_kerja_sama . '</td>';
                echo '<td>' . $val->nilai_kreativitas . '</td>';
                echo $action;
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    $(".editNilai,.addNilai").click(function () {
        $.ajax({
            url: "<?php echo url('honorer/getNilaiSkp'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $(".modal-body").html(data);
                $("#modalForm").modal("show");
            }
        });
    });
    $(".deleteNilai").click(function () {
        $.ajax({
            url: "<?php echo url('honorer/deleteNilai'); ?>",
            data: "id=" + $(this).attr("id") + "&pegawai=" + $(this).attr("pegawai"),
            type: "post",
            success: function (data) {
                $("#tableNilai").replaceWith(data);
            }
        });
    });
</script>