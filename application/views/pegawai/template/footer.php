 <footer class="main-footer">
    <strong>Copyright &copy; 2019 <a href="<?= base_url('pegawai/index')?>">Absensi</a>.</strong>
    All rights reserved.
    <!-- <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-beta.1
    </div> -->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/')?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/')?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/')?>plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/')?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/')?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/')?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/')?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/')?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/')?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/')?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/')?>dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/')?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/')?>dist/js/demo.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/')?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url('assets/')?>plugins/toastr/toastr.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/')?>plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url('assets/')?>plugins/datatables/dataTables.bootstrap4.js"></script>

<script type="text/javascript">
  $('#Logout').click(function(){
    Swal.fire({
      title: 'Are you sure?',
      text: "Apakah anda ingin keluar",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya'
    }).then((result) => {
      if (result.value) {
        location.href = "<?= base_url('Login/logout_pegawai')?>";
      }
    })
    return false;
  })

  $(function () {
    $('#table').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
  
  var url = window.location;


  $('ul.nav-sidebar a').filter(function() {
    return this.href == url;
  }).addClass('active');

  $('ul.nav-treeview a').filter(function() {
    return this.href == url;
  }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open') .prev('a').addClass('active');
</script>

<?php
if ($this->session->flashdata('success')){
  ?>
  <script type="text/javascript">
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-right',
        showConfirmButton: false,
        timer: 3000
      });
      $(function() {
        toastr.success('<?= $this->session->flashdata('success') ?>')
      });
    });
  </script>  
  <?php
}if ($this->session->flashdata('warning')){
  ?>
  <script type="text/javascript">
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-right',
        showConfirmButton: false,
        timer: 3000
      });
      $(function() {
        toastr.warning('<?= $this->session->flashdata('warning') ?>')
      });
    });
  </script>  
  <?php
}
?>