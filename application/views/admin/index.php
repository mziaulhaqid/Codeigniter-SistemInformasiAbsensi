<!DOCTYPE html>
<html>
<?php $this->load->view('admin/template/header');?>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

   <?php $this->load->view('admin/template/navbar');?>

   <?php $this->load->view('admin/template/sidebar');?>


   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?= $title?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <?php $this->load->view("breadcrumb") ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php $this->load->view($content);?>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('admin/template/footer');?>
</body>
</html>
