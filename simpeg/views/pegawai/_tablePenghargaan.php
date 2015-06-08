<div id="tablePenghargaan">
<?php
$action ='';
$th ='';
if(!empty($edit)){
    $pegawai_id = (!empty($pegawai_id))?$pegawai_id:'';
    $pegawai_id = (!empty($_GET['id']))?$_GET['id']:$pegawai_id;
   echo '<a class="btn blue addPenghargaan" pegawai="'.$pegawai_id.'" judulpenghargaan="Riwayat Penghargaan" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Penghargaan</a>';
   $th ='<th></th>';
}
?>
<table class="table table-bordered">
    <thead>
        <th>Penghargaan</th>
        <th>Nomor Register</th>
        <th>Tanggal Pemberian</th>
        <th>Pejabat</th>
        <th>Keterangan</th>   
        <?php echo $th;?>      
    </thead>
    <tbody>
        <?php
        
        foreach ($penghargaan as $value) {
           $action = $action = (!empty($edit))?
           '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editPenghargaan" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deletePenghargaan" title="Hapus" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-trash"></i></a>
                        </td>':'';   
            echo '
                <tr>
                <td>'.$value->penghargaan.'</td>
                <td>'.$value->nomor_register.'</td>
                <td>'.$value->tanggal_pemberian.'</td>
                <td>'.$value->pejabat.'</td>
                <td>'.$value->keterangan.'</td>      
                '.$action.'               
                </tr>
            ';
        }
        ?>
    </tbody>
</table>
</div>


<script>
$(".editPenghargaan,.addPenghargaan").click(function(){
    var judul = $(this).attr('judulpenghargaan');
            $.ajax({                  
                url:"<?php echo url('pegawai/getPenghargaan');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                
                     $(".modal-body").html(data);
                }
            });
            $("#modalForm").modal("show");
            $("#judul").html(judul);
        }); 
        $(".deletePenghargaan").click(function(){
            $.ajax({                                  
                url:"<?php echo url('pegawai/deletePenghargaan');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                             
                    $("#tablePenghargaan").replaceWith(data);
                }
            });            
        }); 
</script>