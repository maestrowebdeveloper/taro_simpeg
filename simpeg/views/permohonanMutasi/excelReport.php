<h2>LAPORAN PERMOHONAN IJIN MUTASI</h2>
<h4>Tanggal : <?php echo date('d F Y'); ?></h4>
<?php if ($model !== null): ?>
    <table border="1">
        <tr>	
            <th width="80px">NAMA PEGAWAI</th> 
            <th width="80px">NIP</th> 
            <th width="80px">OTORITAS</th> 		
            <th width="80px">MUTASI</th> 		
            <th width="80px">NOMOR SK</th> 		
            <th width="80px">PEMBERI IJIN</th> 		
            <th width="80px">TANGGAL</th>		 			 		 		 	
                                                 
            <th width="80px">UNIT KERJA LAMA</th>                                       
            <th width="80px">TIPE JABATAN LAMA</th>                                         
            <th width="80px">JABATAN LAMA</th>                                      
            <th width="80px">UNIT KERJA BARU</th>                                       
            <th width="80px">TIPE JABATAN BARU</th>                                         
            <th width="80px">JABATAN BARU</th> 		 			 		 		 	
            <th width="80px">ESELON</th> 		 			 		 		 	
            <th width="80px">TMT</th> 		 			 		 		 	 		
        </tr>
        <?php foreach ($model as $row): ?>
            <tr>
                <td><?php echo $row->pegawai; ?></td> 
                <td><?php echo $row->nipPegawai."&nbsp;"; ?></td> 
                <td><?php echo $row->statuExel; ?></td>
                <td><?php echo $row->statusTempatExl; ?></td>
                <td><?php echo $row->nomor_register; ?></td>
                <td><?php echo $row->ijinPejabat; ?></td>
                <td><?php echo $row->tglMutasi; ?></td>        
                       
        <!--        <td><?php // echo $row->Pegawai->namaGelar;  ?></td>        -->
                <td><?php echo $row->unit_kerja_lama; ?></td>        
                <td><?php echo $row->tipe_jabatan_lama; ?></td>        
                <td><?php echo $row->jabatan_lama; ?></td>        
                <td><?php echo $row->unitKerja; ?></td>        
                <td><?php echo $row->tipeJabatan; ?></td>        
                <td><?php echo $row->jabatan; ?></td>        
                <td><?php echo $row->jabatan; ?></td>        
                <td><?php echo $row->tmtMutasi; ?></td>        
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>