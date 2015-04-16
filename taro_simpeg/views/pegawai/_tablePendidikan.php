<div id="tablePendidikan">
<?php
$action ='';
$th ='';
if(!empty($edit)){
    $pegawai_id = (!empty($pegawai_id))?$pegawai_id:'';
    $pegawai_id = (!empty($_GET['id']))?$_GET['id']:$pegawai_id;
   echo '<a class="btn blue addPendidikan" pegawai="'.$pegawai_id.'" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Pendidikan</a>';
   $th ='<th style="width:125px"></th>';
}
?>
<table class="table table-bordered">
    <thead>
        <th>Jenjang</th>        
        <th>Jurusan</th>
        <th>Nama Sekolah</th>
        <th>Alamat</th>
        <th>Tahun</th>        
        <?php echo $th;?>          
    </thead>
    <tbody>
        <?php
        
        foreach ($pendidikan as $value) {
          $action = $action = (!empty($edit))?'<td style="width: 85px;text-align:center">
                    <a class="btn btn-small update editPendidikan" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                    <a class="btn btn-small delete deletePendidikan" title="Hapus" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-trash"></i></a>
                    <a class="btn btn-small pilih selectPendidikan" title="Pilih" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-ok"></i></a>
                    </td>':'';  
            echo '
                <tr>
                <td>'.$value->jenjang_pendidikan.'</td>
                <td>'.$value->Jurusan->Name.'</td>
                <td>'.$value->Universitas->name.'</td>
                <td>'.$value->alamat_sekolah.'</td>
                <td>'.$value->tahun.'</td>                
                '.$action.'              
                </tr>
            ';
        }
        ?>
    </tbody>
</table>
</div>
<script>
$(".editPendidikan,.addPendidikan").click(function(){
            $.ajax({                  
                url:"<?php echo url('pegawai/getPendidikan');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                
                     $(".modal-body").html(data);
                }
            });
            $("#modalForm").modal("show");
        }); 
        $(".deletePendidikan").click(function(){
            $.ajax({                                  
                url:"<?php echo url('pegawai/deletePendidikan');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                             
                    /*$("#tablePendidikan").replaceWith(data);*/
                    $(".modal-body").html(data);
                    $("#modalForm").modal("show");
                }
            });            
        }); 
        $(".selectPendidikan").click(function(){
            $.ajax({                                  
                url:"<?php echo url('pegawai/selectPendidikan');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){         
                    obj = JSON.parse(data);                            
                    $("#Pegawai_pendidikan_id").val(obj.id);
                    $("#pendidikanTerakhir").val(obj.jenjang_pendidikan);
                    $("#pendidikanTahun").val(obj.tahun);
                    $("#pendidikanJurusan").val(obj.jurusan);
                    $("#modalForm").modal("hide");
                }
            });            
        }); 

</script>