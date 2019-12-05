<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="<?= base_url('assets/')?>dist/img/favicon.ico" />
	<title>Hasil Cetak Pegawai</title>
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
					Tanggal : <?= date("d/m/Y")?>
				</span>
			</div>
			
			<table id="table">
				<thead >
					<tr bgcolor="#a09493" id="tr">
						<td align="center" id="td">No</td>
						<td width="300px" align="center" id="td">Nama</td>
						<td align="center" width="200px" id="td">NIP</td>
						<td align="center" width="200px" id="td">Devisi</td>
					</tr>
					
				</thead>
			</thead>
			<tbody>
				<?php

				$no = 1;
					foreach ($show as $i) {
					?>
					<tr id="tr">
						<td  align="center" id="td"><?= $no?></td>
						<td  id="td"><?= $i->nama_pegawai?></td>
						<td  align="center" id="td"><?= $i->nip?></td>
						<td  align="center" id="td"><?= $i->nama_devisi?></td>
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