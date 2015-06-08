<div id="tableCuti">
<?php
$action ='';
$th ='';
if(!empty($edit)){
    $pegawai_id = (!empty($pegawai_id))?$pegawai_id:'';
    $pegawai_id = (!empty($_GET['id']))?$_GET['id']:$pegawai_id;
   echo '<a class="btn blue addCuti" pegawai="'.$pegawai_id.'" judulcuti="Riwayat Cuti" id=""><i class="minia-icon-file-add blue"></i>Tambah Riwayat Cuti</a>';
   $th ='<th></th>';
}
?>
<table class="table table-bordered">
    <thead>
        <th>Jenis Cuti</th>
        <th>Nomor SK</th>
        <th>Tanggal Pemberian</th>
        <th>Pejabat</th>        
        <th>Lama Cuti</th>        
        <?php echo $th;?>         
    </thead>
    <tbody>
        <?php               
        foreach ($cuti as $value) {
           $action = $action = (!empty($edit))?'<td style="width: 85px;text-align:center">
                        <a class="btn btn-small update editCuti" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" title="Edit" rel="tooltip" ><i class="icon-pencil"></i></a> 
                        <a class="btn btn-small delete deleteCuti" title="Hapus" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-trash"></i></a>
                        </td>':'';  
            echo '
                <tr>
                <td>'.$value->jenis_cuti.'</td>
                <td>'.$value->no_sk.'</td>
                <td>'.date('d-m-Y', strtotime($value->tanggal_sk)).'</td>
                <td>'.$value->pejabat.'</td>                
                <td>'.date('d-m-Y', strtotime($value->mulai_cuti)).' - '.date('d-m-Y', strtotime($value->selesai_cuti)).'</td>                
                '.$action.'                   
                </tr>
            ';
        }
        ?>
    </tbody>
</table>
</div>

<script>
$(".editCuti,.addCuti").click(function(){
    var judul = $(this).attr('judulcuti');
            $.ajax({                  
                url:"<?php echo url('pegawai/getCuti');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                
                     $(".modal-body").html(data);
                }
            });
            $("#modalForm").modal("show");
            $("#judul").html(judul);
        }); 
        $(".deleteCuti").click(function(){
            $.ajax({                                  
                url:"<?php echo url('pegawai/deleteCuti');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                             
                    $("#tableCuti").replaceWith(data);
                }
            });            
        }); 
</script>