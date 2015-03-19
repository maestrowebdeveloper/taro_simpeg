<div id="tableJabatan">
<?php
$action ='';
$th ='';
if(!empty($edit)){
    $pegawai_id = (!empty($pegawai_id))?$pegawai_id:'';
    $pegawai_id = (!empty($_GET['id']))?$_GET['id']:$pegawai_id;
   echo '<a class="btn blue addJabatan" pegawai="'.$pegawai_id.'" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Jabatan</a>';
   $th ='<th></th>';
}
?>
<table class="table table-bordered">
    <thead>
        <th>Tipe Jabatan</th>
        <th>Jabatan</th>        
        <th>TMT</th>                
        <?php echo $th;?>
    </thead>
    <tbody>
        <?php
        
        foreach ($jabatan as $value) {
            if(!empty($edit))
               $action = '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editJabatan" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteJabatan" title="Hapus" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-trash"></i></a>
                        </td>';  
            echo '
                <tr>
                <td>'.ucwords(str_replace("_", " ", $value->tipe_jabatan)).'</td>
                <td>'.$value->jabatan.'</td>
                <td>'.$value->tmt_mulai.'</td>                            
                '.$action.'
                </tr>
            ';
        }
        ?>
    </tbody>
</table>
</div>

<script>
$(".editJabatan,.addJabatan").click(function(){
            $.ajax({                  
                url:"<?php echo url('pegawai/getJabatan');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                
                     $(".modal-body").html(data);
                }
            });
            $("#modalForm").modal("show");
        }); 
        $(".deleteJabatan").click(function(){
            $.ajax({                                  
                url:"<?php echo url('pegawai/deleteJabatan');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                             
                    $("#tableJabatan").replaceWith(data);
                }
            });            
        }); 
</script>