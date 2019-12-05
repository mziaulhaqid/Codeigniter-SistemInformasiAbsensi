<div class="row justify-content-center">
  <div class="col-md-10">
   <?php
   if (empty($show)) {
    ?>
    <div class="error-page">
      <h2 class="headline text-warning"> 404</h2>

      <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Data Tidak di Temukan.</h3>

        <p>
          Kami tidak menemukan data yang anda cari.
          <a href="<?= base_url('admin/index')?>">Kembali ke List</a>
        </p>
      </div>
      <!-- /.error-content -->
    </div>
    <?php
  }else{
    foreach ($show as $i) {
      ?>
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"><?= $title ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="<?= site_url('Admin/Aksi_Update_User')?>" enctype="multipart/form-data" method="post">
          <div class="card-body">
           <div class="row">
             <div class="col-md-6">
             <input type="hidden" name="kode_user" value="<?= $i->kode_user?>">
              <div class="form-group row">
                <label  class="col-sm-4 control-label">Nama</label>
                <div class="col-sm">
                  <input type="text" class="form-control" placeholder="Nama" name="nama" value="<?= $i->nama?>" required="">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-4 control-label">Username</label>
                <div class="col-sm">
                  <input type="text" class="form-control" placeholder="Username" value="<?= $i->username?>" name="username" required="">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-4 control-label">Password</label>
                <div class="col-sm">
                  <input type="password" class="form-control" placeholder="Password" name="password">
                </div>
              </div>
            </div>
            <div class="col-md-6">
             <div class="form-group row">
              <label  class="col-sm-3 control-label">Profil</label>
              <div class="col-sm-6">
                <div class="custom-file">
                  <input type="file" class="custom-file-input"  name="profile">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                </div>
              </div>
            </div>
            <input type="hidden" name="pro" value="<?= $i->profile?>">
            <img src="<?= base_url('assets/profile/')?><?= $i->profile?>" id="preview-image" width="200px" class="rounded mx-auto d-block avatar mb-3" alt="...">

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
}
?>
</div>
</div>
</div>
<script type="text/javascript">
  $('input[type=file]').change(function(e){
    $in=$(this);
    $in.next().html($in.val());
  });
</script>

<script type="text/javascript">
  function previewImage(input) {
    if (input.files && input.files[0]) {
      var fileReader = new FileReader();
      var imageFile = input.files[0];

      if(imageFile.type == "image/png" || imageFile.type == "image/jpeg") {
        fileReader.readAsDataURL(imageFile);

        fileReader.onload = function (e) {
          $('#preview-image').attr('src', e.target.result);
        }
      }
      else {
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          text: 'Format Gambar Tidak Sesuai.!',
        })
      }
    }
  }

  $("[name='profile']").change(function(){
    previewImage(this);
  });
</script>