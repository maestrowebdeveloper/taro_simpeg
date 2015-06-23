<h2>LAPORAN PERMOHONAN IJIN BELAJAR KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo landa()->date2Ind(date('d F Y')); ?></h4>
<?php if ($model !== null): ?>
    <table border="1">
        <tr>		
            <th width="80px">NOMOR REGISTER</th> 		
            <th width="80px">TANGGAL</th> 		 			 		 		 	 		
            <th width="80px">NAMA PEGAWAI HONORER</th>
            <th width="80px">JABATAN</th> 
            <th width="80px">UNIT KERJA</th> 
            <th width="80px">SATUAN KERJA</th> 
            <th width="80px">STATUS</th>		 			 		 		 	
            <th width="80px">BESAR HONOR</th> 		 			 		 		 	
            <th width="80px">TMT MULAI</th> 		 			 		 		 	
            <th width="80px">TMT SELESAI</th> 		 			 		 		 	 		
            <th width="80px">MASA KERJA THN</th> 		 			 		 		 	 		
            <th width="80px">MASA KERJA BLN</th> 		 			 		 		 	 		

        </tr>
        <?php foreach ($model as $row): ?>
           
            <tr>
                <td><?php echo $row->nomor_register . "&nbsp;"; ?></td>
                <td><?php echo $row->tgl; ?></td>        
                <td><?php echo $row->honorer; ?></td>      
                <td><?php echo $row->jabatan; ?></td>      
                <td><?php echo $row->unitKerja; ?></td>      
                <td><?php echo $row->satuanKerja; ?></td>      
                <td><?php echo $row->statusPerpanjangExcel; ?></td>      
                <td><?php echo landa()->rp($row->honor_saat_ini); ?></td>        
                <td><?php echo $row->tmtMulai; ?></td>        
                <td><?php echo $row->tmtSelesai; ?></td>        
                <td><?php echo $row->Honorer->masaKerjaTahun; ?></td>       
                <td><?php echo $row->Honorer->masaKerjaBulan; ?></td>       

            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>