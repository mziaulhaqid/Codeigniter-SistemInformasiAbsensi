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
		table{
			border-collapse: collapse;
			padding-top: 10px;
		}
		table, th, td{
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
		}
		#kop{
			padding-top:-150px;
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
					Bulan : <?= $bulan?>
				</span>
			</div>
			
			<table id="table">
				<thead >
					<tr bgcolor="#a09493">
						<td rowspan="2" align="center">No</td>
						<td rowspan="2" width="180px" align="center">Nama</td>
						<td colspan="<?= $hari?>" align="center">Tanggal</td>

					</tr>
					
					<tr bgcolor="#a09493">
						<?php
						
						$no = 1;
						for ($i=0; $i < $hari ; $i++) { 
							?>
							<td width="30px" align="center"><?= $no++?></td>
							<?php
						}
						?>
					</tr>

				</thead>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach ($show as $i) {
					$nip = $i->nip;
					?>
					<tr>
						<td width="30px" align="center"><?= $no ++?></td>
						<td>
							<?php
							$where = array(
								'nip' => $nip, 
							);

							$e = $this->Admin_data->edit($where,'pegawai')->row();
							echo $e->nama_pegawai;
							?>
						</td>
						<?php
						$noo = 1;
						for ($i=0; $i < $hari ; $i++) { 
							$date = "".$noo."-".$bulan."";
							$where1 = array(
								'nip' => $nip, 
								'tanggal_kehadiran' => date("Y-m-d",strtotime($date)),
							);

							$x = $this->Admin_data->edit($where1,'kehadiran')->row();

							?>
							<td align="center" <?php if (empty($x)) { echo "bgcolor=\"red\"";}  ?> >
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
							<?php
							$noo++;
						}
						?>

					</tr>

					<?php
				}
				?>
			</tbody>

		</table>

	</div> 
</div> 
</body>
</html>