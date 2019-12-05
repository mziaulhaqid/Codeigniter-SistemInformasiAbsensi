  <div class="row justify-content-center">
   <!-- column -->
   <div class="col-md-9">
     <?php
     if (empty($show)) {
      ?>
      <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Data Tidak di Temukan.</h3>

          <p>
            Kami tidak menemukan data yang anda cari.
            <a href="<?= base_url('Admin/List_Pegawai')?>">Kembali ke List</a>
          </p>
        </div>
        <!-- /.error-content -->
      </div>
      <?php
    }else{
     foreach ($show as $i) {
      ?>
      <!-- Horizontal Form -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"><?= $title; ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="<?= base_url('Admin/Aksi_Update_Pegawai')?>" method="post">
          <div class="card-body">
            <?php
            if(!empty($i->profile)){
              $profile = base_url('assets/profile/'.$i->profile.'');
            }else{
              $profile = base_url('assets/dist/img/default-150x150.png');
            }
            ?>
            <div class="row">
             <img src="<?= $profile ?>" id="preview-image" width="200px" class="rounded mx-auto d-block avatar mb-3" alt="...">     
           </div>
           <div class="row">
            <div class="col-md">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td colspan="2"><h5><label>Biodata</label></h5></td>
                  </tr>
                  <tr>
                    <td width="40%">NIP</td>
                    <td><?= $i->nip?></td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td><?= $i->nama_pegawai?></td>
                  </tr>
                  <tr>
                    <td>Devisi</td>
                    <td><?= $i->nama_devisi?></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><?= $i->email?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>   
        <!-- /.card-body -->
        <div class="card-footer">
         <a href="<?= base_url('pegawai/edit_pegawai/'.$i->nip.'')?>" class="btn btn-primary">Edit</a>
          <!-- <a href="<?= base_url('admin/print_pegawai/'.$i->nip.'')?>" class="btn btn-warning"><i data-toggle="tooltip" title="Detail Produk" class="fas fa-print"></i> Print</a> -->
        </div>
        <!-- /.card-footer -->

      </form>
    </div>
    <?php
  }
}
?>
<!-- /.card -->
</div>
<!--/.column -->
</div>
<!-- /.row -->