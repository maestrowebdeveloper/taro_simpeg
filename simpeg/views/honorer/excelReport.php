<h2>LAPORAN PEGAWAI HONORER KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y'); ?></h4>
<?php if ($model !== null): ?>
    <table border="1">
        <tr>		 			
            <th width="80px">NAMA</th> 		
            <th width="80px">GELAR DEPAN</th> 		
            <th width="80px">GELAR BELAKANG</th> 		
            <th width="80px">JENIS KELAMIN</th> 		
            <th width="80px">TTL</th> 		
            <th width="80px">AGAMA</th> 		 		 		 	
            <th width="80px">No. NPWP</th> 		 		 		 	
            <th width="80px">Bpjs / Askes / KIS</th> 		 		 		 	
            <th width="80px">PENDIDIKAN</th> 		 		 		 	
            <th width="80px">TAHUN PENDIDIKAN</th> 		 		 		 	
            <th width="80px">ALAMAT</th> 		 		 		 	
            <th width="80px">KOTA</th> 		 		 		 	
            <th width="80px">KODE POS</th> 		 		 		 	
            <th width="80px">HP</th> 		 		 		 	
            <th width="80px">GOLONGAN DARAH</th> 		 		 		 	
            <th width="80px">STATUS PERNIKAHAN</th>
            <th width="80px">NO SK PERTAMA</th> 		 		 		 	
            <th width="80px">TANGGAL SK PERTAMA</th> 		 		 		 	
            <th width="80px">UNIT KERJA</th> 		 		 		 	
            <th width="80px">STATUS</th> 	 		 		 	
            <th width="80px">DI SAHKAN OLEH</th> 	 		 		 	
            <th width="80px">JABATAN</th> 	 		 		 	
            <th width="80px">TMT JABATAN</th> 		 		 	
            <th width="80px">GAJI</th> 		 		 		 	
            <th width="80px">TMT KONTRAK PERTAMA</th>		 		 		 	
            <th width="80px">TMT MULAI KONTRAK</th>                             
            <th width="80px">TMT AKHIR KONTRAK</th> 		 		 		 	
            <th width="80px">MASA KERJA</th> 		 		 		 	 		
        </tr>
        <?php foreach ($model as $row): ?>
            <tr>        
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->gelar_depan; ?></td>
                <td><?php echo $row->gelar_belakang; ?></td>
                <td><?php echo $row->jenis_kelamin; ?></td>
                <td><?php echo $row->ttl; ?></td>
                <td><?php echo $row->agama; ?></td>
                <td><?php echo $row->npwp."&nbsp;"; ?></td>
                <td><?php echo $row->bpjs."&nbsp;"; ?></td>
                <td><?php echo isset($row->pendidikan) ? $row->pendidikan : "-"; ?></td>
                <td><?php echo $row->tahun_pendidikan; ?></td>
                <td><?php echo $row->alamat; ?></td>
                <td><?php echo $row->kota; ?></td>
                <td><?php echo $row->kode_pos; ?></td>
                <td><?php echo $row->hp."&nbsp;"; ?></td>
                <td><?php echo $row->golongan_darah; ?></td>
                <td><?php echo $row->status_pernikahan; ?></td>
                <td><?php echo $row->nomor_register."&nbsp;"; ?></td>
                <td><?php echo landa()->date2Ind($row->tanggal_register); ?></td>
                <td><?php echo $row->unitKerja; ?></td>
                <td><?php echo $row->st_peg; ?></td>
                <td><?php echo $row->pengesahan; ?></td>
                <td><?php echo $row->jabatan; ?></td>
                <td><?php echo $row->tmtJabatan; ?></td>
                <td><?php echo $row->gaji; ?></td>
                <td><?php echo $row->tmtKontrak; ?></td>
                <td><?php echo $row->tmtMulaiKontrak; ?></td>
                <td><?php echo $row->tmtAkhirKontrak; ?></td>
                <td><?php echo $row->masaKerja; ?></td>        
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
