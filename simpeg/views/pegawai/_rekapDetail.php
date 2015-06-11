
	<div class="report" id="report" style="width: 100%; margin-top: 25px;">
	<h3 style="text-align:center">LAPORAN REKAPITULASI PEGAWAI BERDASARKAN <?php echo $header;?></h3><br>
	<h6  style="text-align:center">Tangga : <?php echo landa()->date2Ind(date('d F Y'));?></h6>
	<hr>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>UNIT KERJA</th>							
				<?php 
					foreach ($arr as $key=>$value) {
						echo '<th>'.strtoupper($value).'</th>';
					}
					echo '<th>JUMLAH</th>';
				?>
			</tr>
		</thead>
		<tbody>
		<?php 	
                if($berdasarkan == 'all'){
                     foreach($unitKerja as $unit => $aa){
                    	echo '<tr>';
                           
			echo '<td>'.$aa->nama.'</td>';	
                            
			$total = 0;
			foreach ($arr as $key => $value) {
				echo '<td>'.$data[$aa->id][$value].'</td>';	
				$total += $data[$aa->id][$value];
			}
			echo '<td>'.$total.'</td>';	
		echo '</tr>';
                     }
                }else{
		echo '<tr>';
			echo '<td>'.$unitKerja.'</td>';	
			$total = 0;
			foreach ($data as $key => $value) {
				echo '<td>'.$value.'</td>';	
				$total += $value;
			}
			echo '<td>'.$total.'</td>';	
		echo '</tr>';
                }
		?>
		</tbody>
	</table>
	</div>