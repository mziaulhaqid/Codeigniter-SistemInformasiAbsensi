<div class="row justify-content-center">
	<div class="col-md-5">
		<?php
		if (empty($show)) {
			?>
			<div class="error-page">
				<h2 class="headline text-warning"> 404</h2>

				<div class="error-content">
					<h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Data Tidak di Temukan.</h3>

					<p>
						Kami tidak menemukan data yang anda cari.
						<a href="<?= base_url('Admin/List_Kegiatan')?>">Kembali ke List</a>
					</p>
				</div>
				<!-- /.error-content -->
			</div>
			<?php
		}else{
			foreach ($show as $i) {
				?>
				<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="text-center mb-3">
							<img class="profile-user-img img-fluid img-circle" style=" width: 200px !important" src="<?= base_url('assets/profile/')?><?= $i->profile?>" alt="User profile picture">
						</div>
						<ul class="list-group list-group-unbordered mb-3">
							<li class="list-group-item">
								<b>Username</b> <a class="float-right"><?= $i->username?></a>
							</li>
							<li class="list-group-item">
								<b>Nama</b> <a class="float-right"><?= $i->nama?></a>
							</li>
						</ul>
						<a href="<?= base_url('Admin/Edit_User/')?><?= $i->kode_user?>" class="btn btn-primary btn-block"><b>Edit</b></a>
					</div>
					<!-- /.card-body -->
				</div>
				<?php
			}
		}
		?>
	</div>
</div>