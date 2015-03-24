<div id="tableKeluarga">
<?php
$action ='';
$th ='';
if(!empty($edit)){
    $pegawai_id = (!empty($pegawai_id))?$pegawai_id:'';
    $pegawai_id = (!empty($_GET['id']))?$_GET['id']:$pegawai_id;
   echo '<a class="btn blue addKeluarga" pegawai="'.$pegawai_id.'" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Keluarga</a>';
   $th ='<th></th>';
}
?>
 <table class="table table-bordered">
    <thead>      
        <th>Suami / Istri</th>
        <th>TTL</th>
        <th>Pendidikan</th>
        <th>Pekerjaan</th>
        <th>No Karsu</th>
        <th>Tanggal Pernikahan</th>
        <th>Status</th>
        <?php echo $th;?>
    </thead>
    <tbody>
        <?php        
        foreach ($keluarga as $value) {
            if ($value->hubungan != 'anak'){
            $action = $action = (!empty($edit))?'<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editKeluarga" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteKeluarga" title="Hapus" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-trash"></i></a>
                        </td>':'';    
            echo '
                <tr>                
                <td>'.$value->nama.'</td>
                <td>'.$value->ttl.'</td>
                <td>'.$value->pendidikan_terakhir.'</td>
                <td>'.$value->pekerjaan.'</td>
                <td>'.$value->nomor_karsu.'</td>
                <td>'.$value->tanggal_pernikahan.'</td>
                <td>'.$value->status.'</td>
                '.$action.'
                </tr>
            ';
            }
        }
        ?>
    </tbody>
</table>
<hr>
<table class="table table-bordered">
    <thead>      
        <th>Anak</th>
        <th>TTL</th>
        <th>Jenis Kelamin</th>
        <th>Anak Ke</th>
        <th>Status</th>
        <th>Pendidikan</th>
        <th>Pekerjaan</th>     
        <?php echo $th;?>
    </thead>
    <tbody>
        <?php            
        foreach ($keluarga as $value) {
            if ($value->hubungan == 'anak'){ 
            $action = $action = (!empty($edit))?'<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editKeluarga" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteKeluarga" title="Hapus" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-trash"></i></a>
                        </td>':'';    
            echo '
                <tr>                
                <td>'.$value->nama.'</td>
                <td>'.$value->ttl.'</td>
                <td>'.$value->jenis_kelamin.'</td>
                <td>'.$value->anak_ke.'</td>
                <td>'.$value->status_anak.'</td>
                <td>'.$value->pendidikan_terakhir.'</td>
                <td>'.$value->pekerjaan.'</td>               
                '.$action.'
                </tr>
            ';
            }
        }
        ?>
    </tbody>
</table>
</div>

<script>
$(".editKeluarga,.addKeluarga").click(function(){
            $.ajax({                  
                url:"<?php echo url('pegawai/getKeluarga');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                
                     $(".modal-body").html(data);
                }
            });
            $("#modalForm").modal("show");
        }); 
        $(".deleteKeluarga").click(function(){
            $.ajax({                                  
                url:"<?php echo url('pegawai/deleteKeluarga');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                             
                    $("#tableKeluarga").replaceWith(data);
                }
            });            
        }); 
</script>