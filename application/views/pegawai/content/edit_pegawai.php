<div class="row justify-content-center">
  <div class="col-md-10">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <?php
      foreach ($show as $i) {
        ?>
        <form class="form-horizontal" action="<?= site_url('pegawai/aksi_update_pegawai')?>" enctype="multipart/form-data" method="post">
          <input type="hidden" name="profile" value="<?= $i->profile ?>">
          <div class="card-body">
           <div class="row">
             <div class="col-md-6">
              <div class="form-group row">
                <label  class="col-sm-4 control-label">NIP</label>
                <div class="col-sm">
                  <input type="text" class="form-control" placeholder="NIP" name="nip" value="<?= $i->nip?>" required="" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-4 control-label">Nama Pegawai</label>
                <div class="col-sm">
                  <input type="text" class="form-control" value="<?= $i->nama_pegawai?>" placeholder="Nama Pegawai" name="nama_pegawai" required="">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-4 control-label">Email</label>
                <div class="col-sm">
                  <input type="email" class="form-control" value="<?= $i->email?>" placeholder="Email" name="email" required="">
                </div>
              </div>
              <div class="form-group row">
                <label  class="col-sm-4 control-label">Password</label>
                <div class="col-sm">
                  <input type="password" class="form-control" placeholder="Password" name="password" >
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
            <?php
            if (!empty($i->profile)){
              $profile = 'assets/profile/'.$i->profile.'';
            }else{
              $profile = 'assets/dist/img/default-150x150.png';
            }
            ?>
            <img src="<?= base_url(''.$profile.'')?>" id="preview-image" width="200px" class="rounded mx-auto d-block avatar mb-3" alt="...">

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