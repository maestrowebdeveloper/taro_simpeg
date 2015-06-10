<h2>LAPORAN DATA PEGAWAI NEGERI SIPIL (PNS) KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo landa()->date2Ind(date('d F Y')); ?></h4>
<?php if (!empty($model)): ?>
    <table border="1">
        <tr>		
            <th width="80px">NIP</th>
            <th width="80px">NIP LAMA</th> 	                
            <th width="80px">NAMA</th> 	
            <th width="80px">JENIS KELAMIN</th> 		
            <th width="80px">TTL</th> 		
            <th width="80px">AGAMA</th> 		 		 		 	
            <th width="80px">PENDIDIKAN</th> 		 		 		 	
            <th width="80px">JURUSAN</th> 		 		 		 	
            <th width="80px">TAHUN PENDIDIKAN</th>		 		 		 	
            <th width="80px">ALAMAT</th> 		 		 		 	
            <th width="80px">KOTA</th> 		 		 		 	
            <th width="80px">KODE POS</th> 		 		 		 	
            <th width="80px">HP</th> 		 		 		 	
            <th width="80px">GOLONGAN DARAH</th> 		 		 		 	
            <th width="80px">STATUS PERNIKAHAN</th> 		 		 		 	
            <th width="80px">ISSU</th> 		 		 		 	
            <th width="80px">NPWP</th> 		 		 		 	
            <th width="80px">BPJS / ASKES / KIS</th> 		 		 		 	
            <th width="80px">KARPEG</th> 		 		 		 	
            <th width="80px">KPE</th> 		 		 		 	
            <th width="80px">NO. TASPEN</th> 		 		 		 	
            <th width="80px">KEDUDUKAN</th> 		 		 		 	
            <th width="80px">KETERANGAN</th> 		 		 		 	
            <th width="80px">UNIT KERJA</th> 		 		 		 	
            <th width="80px">SATUAN KERJA</th> 		 		 		 	
            <th width="80px">TMT CPNS</th> 		 		 		 	
            <th width="80px">TMT PNS</th> 	 		 		 	
            <th width="80px">TMT PENSIUN</th> 	 		 		 	
            <th width="80px">BUP</th> 	 		 		 	
            <th width="80px">PANGKAT/GOLRU</th> 		 		 		 	
            <th width="80px">TMT PANGKAT/GOLRU</th> 		 		 		 	
            <th width="80px">TIPE JABATAN</th> 		 		 		 	
            <th width="80px">JABATAN</th> 		 		 		 	
            <th width="80px">TMT JABATAN</th> 		 		 		 	
            <th width="80px">GAJI</th>                         
            <th width="80px">MASA KERJA</th> 		 		 		 	
            <th width="80px">TMT PENSIUN</th> 		 		 		 	

        </tr>
        <?php foreach ($model as $row):
            ?>
            <tr>
                <td><?php echo  $row->nip."&nbsp;"; ?></td>
                <td><?php echo  $row->nip_lama."&nbsp;"; ?></td> 
                <td><?php echo $row->namaGelar; ?></td>
                <td><?php echo $row->jenis_kelamin; ?></td>
                <td><?php echo landa()->date2Ind($row->ttl); ?></td>
                <td><?php echo $row->agama; ?></td>
                <td><?php echo $row->pendidikanTerakhir; ?></td>
                <td><?php echo $row->pendidikanJurusan; ?></td>
                <td><?php echo $row->pendidikanTahun; ?></td>
                <td><?php echo $row->alamat; ?></td>
                <td><?php echo $row->city; ?></td>
                <td><?php echo $row->kode_pos; ?></td>
                <td><?php echo $row->hp; ?></td>
                <td><?php echo $row->golongan_darah; ?></td>
                <td><?php echo $row->status_pernikahan; ?></td>
                <td><?php // echo $namaIssu;  ?></td>
                <td><?php echo  $row->npwp."&nbsp;"; ?></td>
                <td><?php echo  $row->bpjs."&nbsp;"; ?></td>
                <td><?php echo  $row->karpeg."&nbsp;"; ?></td>
                <td><?php echo  $row->kpe."&nbsp;"; ?></td>
                <td><?php echo $row->no_taspen."&nbsp;"; ?></td>
                <td><?php echo $row->kedudukan; ?></td>
                <td><?php echo $row->keterangan; ?></td>
                <td><?php echo $row->UnitKerjaJabatan; ?></td>
                <td><?php echo $row->SatuanKerja; ?></td>
                <td><?php echo landa()->date2Ind($row->tmt_cpns); ?></td>
                <td><?php echo landa()->date2Ind($row->tmt_pns); ?></td>
                <td><?php echo landa()->date2Ind($row->tmt_pensiun); ?></td>
                <td><?php echo $row->bup; ?></td>
                <td><?php echo $row->golongan; ?></td>
                <td><?php echo landa()->date2Ind($row->tmtPangkat); ?></td>
                <td><?php echo $row->tipe; ?></td>
                <td><?php echo $row->jabatan; ?></td>
                <td><?php echo landa()->date2Ind($row->tmtJabatan); ?></td>
                <td><?php echo isset($row->Gaji->gaji) ? landa()->rp($row->Gaji->gaji) : "-"; ?></td>
                <td><?php echo $row->masaKerja; ?></td>               
                <td><?php echo landa()->date2Ind($row->tmt_pensiun); ?></td>       		
                      		
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
