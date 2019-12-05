<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <?php
      foreach ($show as $i) {
      ?>
      <form class="form-horizontal" action="<?= site_url('admin/aksi_update_devisi')?>" method="post">
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-4 control-label">Kode Devisi</label>
            <div class="col-sm">
              <input type="text" value="<?= $i->kode_devisi?>" class="form-control" name="kode_devisi" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label  class="col-sm-4 control-label">Nama Devisi</label>
            <div class="col-sm">
              <input type="text" class="form-control" value="<?= $i->nama_devisi?>" placeholder="Nama Devisi" name="nama_devisi" required="">
            </div>
          </div>
        </div>   
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <!-- /.card-footer -->
      </form>
      <?php
    }
      ?>
    </div>
  </div>
</div>