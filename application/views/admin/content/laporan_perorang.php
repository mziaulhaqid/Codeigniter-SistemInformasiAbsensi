<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?= base_url('assets/')?>dist/img/favicon.ico" />
	<title>Hasil Cetak Kehadiran</title>
	<style type="text/css">
		@page {
			margin-top: 2cm;
			margin-bottom: 3cm;
			margin-left: 3cm;
			margin-right: 3cm;
			sheet-size: A4;
		}
		#body{
			padding-top: 10px;
			font-size: 16px;
		}
		#table{
			border-collapse: collapse;
			padding-top: 10px;
		}
		#table, #tr,#td{
			border: 1px solid black;
		}
		thead{
			background-color: #c3b4b4;
		}
		.bulan{
			padding-bottom: 10px;
		}
		#preview-image{
			position: absolute;
			z-index: -1;
			padding-top: -50px;
			padding-bottom: 10px;
			padding-left: -40px;
		}
		#kop{
			padding-top:-150px;
			padding-right: -60px
		}
		
	</style>
</head>
<body>
	<?php
	$m = date("m");
	$y = date("Y");
	$hari = cal_days_in_month(CAL_GREGORIAN, $m, $y);
	?>
	<div id="container">
		<img src="<?= base_url('assets/dist/img/pemkot.png')?>" id="preview-image" width="200px">
		<div id="kop">
			<h3 style="text-align: center;">KANTOR CAMAT JULOK ACEH TIMUR</h3> 
			<h5 style="text-align: center;">Jl. Medan - Banda Aceh, Km.245</h5> 
			<h5 style="text-align: center;">Telp. 0645-7003131</h5> 
		</div>
		<hr>
		<div id="body">
			<div class="bulan">
				<span>
					<table >
						<?php
						$where = array(
							'nip' => $nip, 
						);

						$e = $this->Admin_data->edit($where,'pegawai')->row();
						?>
						<tr>
							<td width="100px">Nama</td>
							<td>: <?= $e->nama_pegawai?></td>
						</tr>
						<tr>
							<td>NIP</td>
							<td>: <?= $nip?></td>
						</tr>
						<tr>
							<td>Bulan</td>
							<td>: <?= $bulan?></td>
						</tr>
					</table>
				</span>
			</div>
			
			<table id="table">
				<thead >
					<tr bgcolor="#a09493" id="tr">
						<td align="center" id="td">No</td>
						<td width="300px" align="center" id="td">Tanggal</td>
						<td width="150px" align="center" id="td">Jam Masuk</td>
						<td width="150px" align="center" id="td">Jam Keluar</td>
						<td align="center" width="200px" id="td">Keterangan</td>
					</tr>
					
				</thead>
			</thead>
			<tbody>
				<?php

				$no = 1;
				for ($i=0; $i < $hari ; $i++) { 
					$where1 = array(
						'nip' => $nip, 
						'tanggal_kehadiran' => date("Y-m-d",strtotime("".$no."-".$bulan."")),
					);

					$x = $this->Admin_data->edit($where1,'kehadiran')->row();
					?>
					<tr id="tr">
						<td  align="center" id="td"><?= $no?></td>
						<td  align="center" id="td"><?php echo date("d/m/Y",strtotime("".$no."-".$bulan.""))?></td>
						<td align="center" id="td" <?php if (empty($x)) { echo "bgcolor=\"red\"";}  ?>>
							<?php
							
							if(!empty($x)){
								echo $x->jam_masuk;
							}
							?> </td>
							<td align="center" id="td" <?php if (empty($x)) { echo "bgcolor=\"red\"";}  ?>> 
								<?php

								if(!empty($x)){
									echo $x->jam_keluar;
								}
								?> 
							</td>
							<td  align="center" id="td" <?php if (empty($x)) { echo "bgcolor=\"red\"";}  ?>>
								<?php

								if(!empty($x)){
									if ($x->status == "Hadir") {
										echo "√";
									}
									if ($x->status == "Izin") {
										echo "I";
									}
									if ($x->status == "Sakit") {
										echo "S";
									}
									if ($x->status == "Alpa") {
										echo "X";
									}
								}
								?>

							</td>
						</tr>
						<?php
						$no++;
					}
					?>
				</tbody>

			</table>

		</div> 
	</div> 
</body>
</html>