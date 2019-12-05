<div class="row">
	<div class="col-md">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?= $title?></h3>
				<div class="card-tools">
					<a class="btn btn-primary" href="<?= base_url('admin/tambah_devisi')?>" id="expand" data-action="expand-all">
						<i class="fas fa-plus"></i> Add
					</a>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="table" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="20">No</th>
								<th>Nama Devisi</th>
								<th width="200">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($show as $i) {
								?>
								<tr>
									<td><?= $no;?></td>
									<td><?= $i->nama_devisi?></td>
									<td align="center">
										<a class="btn btn-info btn-sm m-1" href="<?= base_url('admin/edit_devisi/')?><?= $i->kode_devisi?>"> <i data-toggle="tooltip" title="Edit Devisi" class="fas fa-edit"></i></a> 
										<a class="btn btn-danger btn-sm hapus m-1" id="<?= $i->kode_devisi?>"> <i data-toggle="tooltip" title="Hapus Devisi" class="fas fa-trash"></i></a>
									</td>
								</tr>
								<?php
								$no++;
							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<th width="20">No</th>
								<th>Nama Devisi</th>
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

<script type="text/javascript">
	$(document).on("click",".hapus",function() {

		var id = $(this).attr('id');

		Swal.fire({
			title: 'Apakah kamu Yakin?',
			text: "Menghapus Devisi Akan Menghapus Pegawai Sesuai Devisi Yang Di Jabat!!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "<?= base_url('admin/hapus_devisi')?>",
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
