 <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $jumlah_pegawai?></h3>

            <p>Jumlah Pegawai</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <a href="<?= base_url('admin/list_pegawai')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-6 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $jumlah_devisi?></h3>

            <p>Jumlah Devisi</p>
          </div>
          <div class="icon">
            <i class="fas fa-project-diagram"></i>
          </div>
          <a href="<?= base_url('admin/list_devisi')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row mt-5 justify-content-center">
      <div class="col-md-3">
        <img class="rounded mx-auto d-block" style="width: 250px" src="<?= base_url('assets/dist/img/pemkot.png')?>" alt="User Avatar">
      </div>
      <div class="col-md mt-5 text-center">
       <h2>PEMERINTAH KABUPATEN ACEH TIMUR</h2><br>
       <h2>KECAMATAN JULOK</h2>
     </div>
   </div>
   <!-- /.row (main row) -->
 </div><!-- /.container-fluid -->
</section>
    <!-- /.content -->