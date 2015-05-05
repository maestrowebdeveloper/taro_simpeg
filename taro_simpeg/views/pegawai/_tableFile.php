<div id="tableFile">
<?php
$action ='';
$th ='<th></th>';
if(!empty($edit)){
    $pegawai_id = (!empty($pegawai_id))?$pegawai_id:'';
    $pegawai_id = (!empty($_GET['id']))?$_GET['id']:$pegawai_id;      
}
?>
 <table class="table table-bordered">
    <thead>
        <th>Nama File</th>         
        <?php echo $th;?>         
    </thead>
    <tbody>
        <?php               
        foreach ($file as $value) {
            $del = (!empty($edit))?'<a class="btn btn-small delete deleteFile" title="Hapus" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" rel="tooltip" ><i class="icon-trash"></i></a>':'';
            $action = '<td style="width: 85px;text-align:center">
                        <a class="btn btn-small view" target="_blank" href="'.param('urlImg').'/file/'.$value->pegawai_id."/".$value->nama.'" pegawai="'.$value->pegawai_id.'" id="'.$value->id.'" title="Download File" rel="tooltip" ><i class="icon-file"></i></a>                         
                        '.$del.'
                        </td>';
            echo '
                <tr>                
                <td>'.$value->nama.'</td>
                '.$action.'
                </tr>
            ';
        }
        ?>
    </tbody>
</table>

</div>
<script>
        $(".deleteFile").click(function(){
            $.ajax({                                  
                url:"<?php echo url('pegawai/deleteFile');?>",
                data:"id="+$(this).attr("id")+"&pegawai="+$(this).attr("pegawai"),
                type:"post",
                success:function(data){                             
                    $("#"+data).parent().parent().remove();                                     
                }
            });            
        }); 
</script>