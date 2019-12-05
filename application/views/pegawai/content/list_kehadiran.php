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
						<label class="col-md-2">Bulan</label>
						<div class="col-md-2">
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
						<div class="col-md-2">
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
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="kehadiran"  class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="20">No</th>
								<th>Tanggal</th>
								<th>Jam Masuk</th>
								<th>Jam Keluar</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<!-- <?php
							$no = 1;
							foreach ($show as $i) {
								?>
								<tr>
									<td><?= $no;?></td>
									<td><?= $i->tanggal_kehadiran?></td>
									<td><?= $i->jam_masuk?></td>
									<td><?= $i->jam_keluar?></td>									
									<td><?= $i->status?></td>
									<td align="center">
										<a class="btn btn-info btn-sm m-1" href="<?= base_url('admin/edit_kehadiran/')?><?= $i->kode_kehadiran?>"> <i data-toggle="tooltip" title="Edit Pegawai" class="fas fa-edit"></i></a> 
										<a class="btn btn-danger btn-sm hapus m-1" id="<?= $i->nip?>"> <i data-toggle="tooltip" title="Hapus Kehadiran" class="fas fa-trash"></i></a>
									</td>
								</tr>
								<?php
								$no++;
							}
							?>  -->
						</tbody>
						<tfoot>
							<tr>
								<th width="20">No</th>
								<th>Tanggal</th>
								<th>Jam Masuk</th>
								<th>Jam Keluar</th>
								<th>Keterangan</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
			<!-- /.card-body -->
		</div>
	</div>
</div>

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
        	"url": "<?php echo base_url('pegawai/get_data_kehadiran')?>",
        	"type": "POST",
        	"data": function (data) {
        		data.bulan = $('#bulan1').val();
        		data.tahun = $('#tahun1').val();

        	}
        },
        //Set column definition initialisation properties.
        "columnDefs": [
        
        
        { 
            "targets": [ 4 ], //first column / numbering column
            "orderable": false, //set not orderable
            "data": "4",
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


