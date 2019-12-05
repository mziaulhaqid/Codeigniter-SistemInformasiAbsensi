<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('pegawai/index')?>" class="brand-link">
    <img src="<?=  base_url('assets/')?>dist/img/pemkot.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">ABSENSI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php
        $where = array(
          'nip' => $this->session->userdata('nip'),
        );
        $profile = $this->Pegawai_data->edit($where,'pegawai')->result();

        foreach ($profile as $i) {
          ?>
          <img src="<?= base_url('assets/profile/')?><?= $i->profile?>" class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
          <a href="<?= base_url('pegawai/data_pribadi/')?><?= $this->session->userdata('nip') ?>" class="d-block"><?= $i->nama_pegawai?></a>
        </div>

        <?php
      }
      ?>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="<?= base_url('pegawai/index')?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">TOOL</li>
          <li class="nav-item">
            <a href="<?= base_url('pegawai/data_pribadi')?>" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Data Pribadi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('pegawai/list_kehadiran')?>" class="nav-link">
              <i class="nav-icon fas fa-hand-paper"></i>
              <p>Kehadiran</p>
            </a>
          </li>
          <li class="nav-header">SYSTEM</li>
          <li class="nav-item">
            <a href="#" class="nav-link"  id="Logout">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>