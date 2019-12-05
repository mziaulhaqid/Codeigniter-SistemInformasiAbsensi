<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= base_url('admin/index')?>" class="brand-link">
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
          'kode_user' => $this->session->userdata('kode_user'),
        );
        $profile = $this->Admin_data->edit($where,'user')->result();

        foreach ($profile as $i) {
          ?>
          <img src="<?= base_url('assets/profile/')?><?= $i->profile?>" class="img-circle elevation-2" alt="User Image">

        </div>
        <div class="info">
          <a href="<?= base_url('admin/view_user/')?><?= $this->session->userdata('kode_user') ?>" class="d-block"><?= $i->nama?></a>
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
            <a href="<?= base_url('admin/index')?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-header">TOOL</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pegawai
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/list_pegawai')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/tambah_pegawai')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Pegawai</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-project-diagram"></i>
              <p>
                Devisi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/list_devisi')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Devisi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/tambah_devisi')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Devisi</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-paper"></i>
              <p>
                Kehadiran
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('admin/list_kehadiran')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Kehadiran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('admin/tambah_kehadiran')?>" data-toggle="modal" data-target="#modal-default" id="expand" data-action="expand-all" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Kehadiran</p>
                </a>
              </li>
            </ul>
          </li>
               <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#"  data-toggle="modal" data-target="#modal-laporan" id="expand" data-action="expand-all"  class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Kehadiran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" data-toggle="modal" data-target="#modal-pegawai" id="expand" data-action="expand-all" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan Pegawai</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">SYSTEM</li>
          <li class="nav-item">
            <a href="#" class="nav-link" id="Logout">
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
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Input Kehadiran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
          <form id="formAtur" onSubmit="return validasi(this)" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" action="<?= base_url('admin/input_absen')?>">
            <div class="row justify-content-center">
              <div class="col-md">
                <div class="form-group row">
                  <label  class="col-sm-6 control-label">Tanggal</label>
                  <div class="col-sm-2">
                    <input class="form-control" type="number" name="tanggal" value="<?= date('d')?>">
                  </div>
                  <div class="col-sm">
                    <input class="form-control" type="text" name="bulan" value="<?php echo date("-m-Y")?>" readonly>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Nama</th>
                        <th scope="col" width="100px">Jam Masuk</th>
                        <th scope="col" width="100px">Jam Keluar</th>
                        <th scope="col">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php   
                      $no =1;
                      foreach ($pegawai as $w) {
                        ?>
                        <tr>
                          <input type="hidden" name="nip[]" value="<?= $w->nip?>">
                          <th scope="row">
                            <label  class="col-sm-6 control-label"><?= $no++ ?>. <?= $w->nama_pegawai?></label>
                          </th>
                          <td>
                            <input class="form-control" type="time" value="08:00" name="jam_masuk[]">
                          </td>
                          <td>
                            <input class="form-control" type="time" value="17:00" name="jam_keluar[]">
                          </td>
                          <td>
                            <select class="form-control" name="keterangan[]" required="">
                              <option value="Hadir">Hadir</option>
                              <option value="Izin">Izin</option>
                              <option value="Sakit">Sakit</option>
                              <option value="Alpa">Alpa</option>
                            </select>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md">&nbsp</div>
                <button type="submit" class="btn btn-sm btn-primary col-md"><i class="glyphicon glyphicon-save"></i> Simpan</button>
              </div>  
            </div>  
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="modal-laporan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Laporan Kehadiran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= site_url('admin/laporan_kehadiran')?>" method="post">
            <div class="from-group row mb-2">
              <label class="col-md-4">Nama Pegawai</label>
              <div class="col-md">
                <select class="form-control" name="nip" required="">
                  <option  selected="" disabled=""> -- Semua Pegawai -- </option>
                  <?php
                  foreach ($pegawai as $s) {
                    ?>
                    <option value="<?= $s->nip?>"><?= $s->nama_pegawai?></option> 
                    <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="from-group row">
              <label class="col-md-4">Bulan</label>
              <div class="col-md-4 mb-2">
                <select class="form-control" name="bulan" required>
                  <option value="01">Januari</option> 
                  <option value="02">Februari</option> 
                  <option value="03">Maret</option> 
                  <option value="04">April</option> 
                  <option value="05">Mei</option> 
                  <option value="06">Juni</option> 
                  <option value="07">Juli</option> 
                  <option value="08">Juni</option> 
                  <option value="09">Agustus</option> 
                  <option value="10">September</option> 
                  <option value="11">November</option> 
                  <option value="12">Desember</option> 
                </select>
              </div>
              <div class="col-md">
                <select class="form-control" name="tahun" required="">
                  <?php
                  for($i=date('Y'); $i>=date('Y')-15; $i-=1){
                    echo '<option value='.$i.'> '.$i.' </option>';
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Pilih</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

    <div class="modal fade" id="modal-pegawai">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Laporan Pegawai</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
            <div class="row justify-content-center">
              <div class="col-md">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Nama</th>
                        <th scope="col" width="100px">NIP</th>
                        <th scope="col" width="100px">Devisi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php   
                      $no =1;
                      $peg = $this->Admin_data->select('nama_pegawai','v_pegawai','ASC')->result();
                      foreach ($peg as $w) {
                        ?>
                        <tr>
                          <input type="hidden" name="nip[]" value="<?= $w->nip?>">
                          <td scope="row">
                            <label  class="col-sm-6 control-label"><?= $no++ ?>. <?= $w->nama_pegawai?></label>
                          </td>
                          <td>
                            <?= $w->nip?>
                          </td>
                            <td>
                            <?= $w->nama_devisi?>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md">&nbsp</div>
                
                <a  class="btn btn-sm btn-primary col-md" href="<?= base_url('admin/laporan_pegawai')?>"> Cetak</a>
              </div>  
            </div>  
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->



