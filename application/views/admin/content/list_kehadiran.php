<div class="row">
	<div class="col-md">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Filter Data</h3>
			</div>
			<!-- form start -->
			<form role="form" id="form-filter">
				<div class="card-body">
					<div class="from-group row mb-2">
						<label class="col-md-2">Nama Pegawai</label>
						<div class="col-md">
							<select class="form-control" id="status1" required="">
								<option disabled="" selected=""> -- select an option -- </option>
								<?php
								foreach ($pegawai as $s) {
									?>
									<option value="<?= $s->nip?>"><?= $s->nama_pegawai?></option> 
									<?php
								}
								?>
							</select>
						</div>
					</div>
					<div class="from-group row">
						<label class="col-md-2">Bulan</label>
						<div class="col-md-5 mb-2">
							<select class="form-control" id="bulan1" required="">
								<option disabled="" selected=""> -- Bulan -- </option>
								<option value="01">Januari</option> 
								<option value="02">Februari</option> 
								<option value="03">Maret</option> 
								<option value="04">April</option> 
								<option value="05">Mei</option> 
								<option value="06">Juni</option> 
								<option value="07">Juli</option> 
								<option value="08">Juni</option> 
								<option value="09">Agustus</option> 
								<option value="10">September</option> 
								<option value="11">November</option> 
								<option value="12">Desember</option> 
							</select>
						</div>
						<div class="col-md-5">
							<select class="form-control" id="tahun1" required="">
								<?php
								for($i=date('Y'); $i>=date('Y')-15; $i-=1){
									echo '<option value='.$i.'> '.$i.' </option>';
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<!-- /.card-body -->

				<div class="card-footer">
					<button type="button" id="btn-filter" class="btn btn-primary mr-2">Filter</button>
					<button type="button" id="btn-reset" class="btn btn-default">Reset</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?= $title?></h3>
				<div class="card-tools">
					<a class="btn btn-warning" data-toggle="modal" data-target="#modal-default" id="expand" data-action="expand-all">
						<i class="fas fa-plus"></i> Add
					</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="kehadiran"  class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="20">No</th>
								<th>Nama Pegawai</th>
								<th>Tanggal</th>
								<th>Jam Masuk</th>
								<th>Jam Keluar</th>
								<th>Keterangan</th>
								<th width="200">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<!-- <?php
							$no = 1;
							foreach ($show as $i) {
								?>
								<tr>
									<td><?= $no;?></td>
									<td>
										<?php
										$where = array(
											'nip' => $i->nip, 
										);
										$nama_pegawai = $this->Admin_data->edit($where,'pegawai')->result();
										foreach ($nama_pegawai as $a) {
											echo $a->nama_pegawai;
										}		
										?>

									</td>
									<td><?= $i->tanggal_kehadiran?></td>
									<td><?= $i->status?></td>
									<td align="center">
										<a class="btn btn-info btn-sm m-1" href="<?= base_url('admin/edit_kehadiran/')?><?= $i->kode_kehadiran?>"> <i data-toggle="tooltip" title="Edit Pegawai" class="fas fa-edit"></i></a> 
										<a class="btn btn-danger btn-sm hapus m-1" id="<?= $i->nip?>"> <i data-toggle="tooltip" title="Hapus Kehadiran" class="fas fa-trash"></i></a>
									</td>
								</tr>
								<?php
								$no++;
							}
							?> -->
						</tbody>
						<tfoot>
							<tr>
								<th width="20">No</th>
								<th>Nama Pegawai</th>
								<th>Tanggal</th>
								<th>Jam Masuk</th>
								<th>Jam Keluar</th>
								<th>Keterangan</th>
								<th width="200">Aksi</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<!-- /.card-body -->
		</div>
	</div>
</div>

<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content ">
			<div class="modal-header bg-primary">
				<h4 class="modal-title">Input Kehadiran</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body ">
				<form id="formAtur" onSubmit="return validasi(this)" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" action="<?= base_url('admin/input_absen')?>">
					<div class="row justify-content-center">
						<div class="col-md">
							<div class="form-group row">
								<label  class="col-sm-6 control-label">Tanggal</label>
								<div class="col-sm-2">
									<input class="form-control" type="number" name="tanggal" value="<?= date('d')?>">
								</div>
								<div class="col-sm">
									<input class="form-control" type="text" name="bulan" value="<?php echo date("-m-Y")?>" readonly>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">Nama</th>
											<th scope="col" width="100px">Jam Masuk</th>
											<th scope="col" width="100px">Jam Keluar</th>
											<th scope="col">Keterangan</th>
										</tr>
									</thead>
									<tbody>
										<?php   
										$no =1;
										foreach ($pegawai as $w) {
											?>
											<tr>
												<input type="hidden" name="nip[]" value="<?= $w->nip?>">
												<th scope="row">
													<label  class="col-sm-6 control-label"><?= $no++ ?>. <?= $w->nama_pegawai?></label>
												</th>
												<td>
													<input class="form-control" type="time" value="08:00" name="jam_masuk[]">
												</td>
												<td>
													<input class="form-control" type="time" value="17:00" name="jam_keluar[]">
												</td>
												<td>
													<select class="form-control" name="keterangan[]" required="">
														<option value="Hadir">Hadir</option>
														<option value="Izin">Izin</option>
														<option value="Sakit">Sakit</option>
														<option value="Alpa">Alpa</option>
													</select>
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<div class="col-md">&nbsp</div>
							<button type="submit" class="btn btn-sm btn-primary col-md"><i class="glyphicon glyphicon-save"></i> Simpan</button>
						</div>  
					</div>  
				</form>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->

	<div class="modal fade" id="modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content ">
				<div class="modal-header bg-primary">
					<h4 class="modal-title">Edit Kehadiran</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body ">
					<form id="formAtur" onSubmit="return validasi(this)" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" action="<?= base_url('admin/aksi_update_kehadiran')?>">
						<div class="row justify-content-center">
							<div class="col-md">
								<div class="form-group row">
									<label  class="col-sm-2 control-label">Tanggal </label>
									<div class="col-sm">
										<label  class="col-sm-6 control-label" id="tanggal_kehadiran"></label>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th scope="col">Nama</th>
												<th scope="col" width="100px">Jam Masuk</th>
												<th scope="col" width="100px">Jam Keluar</th>
												<th scope="col">Keterangan</th>
											</tr>
										</thead>
										<tbody>

											<tr>
												<input type="hidden" id="kode_kehadiran" name="kode_kehadiran" value="">
												<th scope="row">
													<label  class="col-sm-6 control-label" id="nama_pegawai"></label>
												</th>
												<td>
													<input class="form-control" type="time" id="jam_masuk" value="08:00" name="jam_masuk">
												</td>
												<td>
													<input class="form-control" type="time" id="jam_keluar" value="17:00" name="jam_keluar">
												</td>
												<td>
													<select class="form-control" name="kehadiran" required="">
														<option id="keterangan" value="Hadir">Hadir</option>
														<option  id="keterangan" value="Izin">Izin</option>
														<option  id="keterangan" value="Sakit">Sakit</option>
														<option  id="keterangan" value="Alpa">Alpa</option>
													</select>
												</td>
											</tr>

										</tbody>
									</table>
								</div>
								<div class="col-md">&nbsp</div>
								<button type="submit" class="btn btn-sm btn-primary col-md"><i class="glyphicon glyphicon-save"></i> Simpan</button>
							</div>  
						</div>  
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<script type="text/javascript">
			$(document).on("click",".hapus",function() {

				var id = $(this).attr('id');

				Swal.fire({
					title: 'Apakah kamu Yakin?',
					text: "Menghapus user!!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							type: "POST",
							url: "<?= base_url('admin/hapus_gejala')?>",
							data: { id : id },
							cache : false,
							success: function(data){
								window.location.reload()

							} ,error: function(xhr, status, error) {
								alert(error);
							},
						});
					}
				})
				return false;
			});
		</script>

		<script type="text/javascript">
			var table;
			$(document).ready(function() {
      //datatables
      table = $('#kehadiran').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        // Load data for the table's content from an Ajax source
        "ajax": {
        	"url": "<?php echo site_url('admin/get_data_kehadiran')?>",
        	"type": "POST",
        	"data": function (data) {
        		data.nama_pegawai = $('#status1').val();
        		data.bulan = $('#bulan1').val();
        		data.tahun = $('#tahun1').val();
        	}
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        
        {
        	"targets": [ 6 ],
        	"data":"6",
        	"className" : "text-center",  
        	"render": function(data,type,full,meta,row)
        	{ return '<a id="btn-edit" data-id="'+data+'" class="btn btn-info btn-sm m-1" href="#"> <i data-toggle="tooltip" title="Edit Customer" class="fas fa-edit"></i></a> ';
        }

    },
    { 
            "targets": [ 5 ], //first column / numbering column
            "orderable": false, //set not orderable
            "data": "5",
            "render": function (data, type, full, meta,row) {
            	if (data == "Hadir"){
            		warna = "success";
            	}
            	if (data == "Izin"){
            		warna = "info";
            	}
            	if (data == "Sakit"){
            		warna = "warning";
            	}
            	if (data == "Alpa"){
            		warna = "danger";
            	}
            	return '<span class="badge badge-'+warna+'">'+data+'</span>';
            }
        }
        ],
    });

    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
    	$('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
    });
});
</script>


<script>
	$(document).on("click","#btn-edit",function() {
		$('#modal').appendTo("body").modal('show');

		id = $(this).data('id');

		$.ajax({
			url: '<?= base_url('admin/edit_kehadiran/')?>' + id,
			success: function (data) {
				$("#kode_kehadiran").val(data.kode_kehadiran);
				$("#nama_pegawai").html(data.nama_pegawai);
				$("#tanggal_kehadiran").html(data.tanggal_kehadiran);
				$("input[name='jam_masuk']").val(data.jam_masuk);
				$("input[name='jam_keluar']").val(data.jam_keluar);
				$("option[value="+data.keterangan+"]").prop('selected', true);
			}
		});
	});
</script>

