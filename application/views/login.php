<?php

if(!empty($this->session->userdata('status'))){
  redirect(base_url("Admin"));
}if(!empty($this->session->userdata('status1'))){
  redirect(base_url("Pegawai"));
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | Absensi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Favicon -->
  <link href="<?= base_url('assets/dist/img/pemkot.png')?>" rel="icon" type="image/png">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/')?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page background_">
  <div class="login-box">

    <!-- /.login-logo -->
    <div class="card mt-5">
      <div class="card-body login-card-body">
       <div class="login-logo">
        <img class="img " style="width: 150px!important" src="<?= base_url('assets')?>/dist/img/pemkot.png" alt="User Avatar">
        <a href="#" class="ml-1 h4"><b>ABSENSI</b></a>
      </div>
      <?php 
      if ($this->session->flashdata('login'))
      { 
        ?>
        <div class="alert alert-danger" width="150px" >
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?= $this->session->flashdata('login');?>
        </div>
        <?php
      }
      if ($this->session->flashdata('berhasil')){
        ?>
        <div class="alert alert-success" width="150px" >
          <?= $this->session->flashdata('berhasil');?>
        </div>
        <?php
      }
      if ($this->session->flashdata('message'))
      { 
        ?>
        <div class="alert alert-dismissible alert-warning" width="150px" >
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?= $this->session->flashdata('message');?>
        </div>
        <?php
      }
      ?>
      <?php
      if ($this->input->get("info") == "admin"){
        $tab1 = "false";
        $tab2 = "true";
        $ta1 = "";
        $ta2 = "show";
        $t1 = "";
        $t2 = "active";
      }else{
        $tab1 = "true";
        $tab2 = "false";
        $ta1 = "show";
        $ta2 = "";
        $t1 = "active";
        $t2 = "";
      }
      ?>


      <nav>
        <div class="nav nav-tabs mb-2" id="nav-tab" role="tablist">
          <a class="nav-item nav-link <?= $t1?>" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="<?= $tab1 ?>">Pegawai</a>
          <a class="nav-item nav-link <?= $t2?>" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="<?= $tab2 ?>">Admin</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade <?=$t1?> <?=$ta1?> " id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <form action="<?= base_url('Login/login_pegawai')?>" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="NIP" name="nip" required>
              <div class="input-group-append input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" required>
              <div class="input-group-append input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <div class="tab-pane fade <?=$t2?> <?=$ta2?> " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <form action="<?= base_url('Login/login')?>" method="post">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Username" name="username" required>
              <div class="input-group-append input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="password" required>
              <div class="input-group-append input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <div class="row">
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
