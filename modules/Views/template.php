<!-- required na nandito sa views folder dahil sa CodeIgniter potek -->
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Faculty and Employees Association</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url();?>/dist/adminlte/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <?= $this->renderSection('styles');?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url('home');?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= base_url()?>/logout" class="nav-link">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url();?>" class="brand-link">
      <img src="<?= base_url();?>/dist/adminlte/img/adminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           >
      <!-- style="opacity: .8" -->
      <span class="brand-text font-weight-light">FEA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url();?>/uploads/profile_pic/<?= $logged_in['profile_pic']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url()?>/profile/<?= $logged_in['username'] ?>" class="d-block"><?= $logged_in['first_name'] ?> <?= $logged_in['last_name'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- profile -->
          <li class="nav-item">
            <a href="<?= base_url();?>/profile/<?= $logged_in['username'] ?>" class="nav-link
            <?php
              if ($active == 'profile') {
                echo ' active';
              }
             ?>">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
          <!-- announcements -->
          <?php if($logged_in['role'] == '1'): ?>
          <li class="nav-item">
            <a href="<?= base_url()?>/announcements" class="nav-link
            <?php
              if ($active == 'announcements') {
                echo ' active';
              }
             ?>">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcements
              </p>
            </a>
          </li>
          <?php endif; ?>
          <!-- users -->
          <li class="nav-item has-treeview <?php if($active == 'users'){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active == 'users'){echo 'active';}?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <!-- User List -->
              <li class="nav-item">
                <a href="<?= base_url('users');?>" class="nav-link <?php if(isset($userTab)){ if($userTab == 'list') {echo 'active';}}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
              <!-- User Roles -->
              <li class="nav-item">
                <a href="<?= base_url('roles');?>" class="nav-link <?php if(isset($userTab)){ if($userTab == 'roles') {echo 'active';}}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <!-- User Roles -->
              <li class="nav-item">
                <a href="<?= base_url('roles');?>" class="nav-link <?php if(isset($userTab)){ if($userTab == 'permissions') {echo 'active';}}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permissions</p>
                </a>
              </li>
            </ul>
          </li> <!-- users -->
          <!-- Files -->
          <li class="nav-item">
            <a href="<?= base_url()?>/files" class="nav-link
            <?php
              if ($active == 'files') {
                echo ' active';
              }
             ?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Files
              </p>
            </a>
          </li>
          <!-- sliders -->
          <li class="nav-item">
            <a href="<?= base_url()?>/sliders" class="nav-link
            <?php
              if ($active == 'sliders') {
                echo ' active';
              }
             ?>">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Sliders
              </p>
            </a>
          </li>
          <!-- Elections -->
          <li class="nav-item has-treeview <?php if($active == 'elections'){echo 'menu-open';}?>">
            <a href="#" class="nav-link <?php if($active == 'elections'){echo 'active';}?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Elections
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <!-- set elections -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('elections/main')?>" class="nav-link <?php if(isset($electionTab)){ if($electionTab == 'elections') {echo 'active';}}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Set Election</p>
                </a>
              </li>
            </ul>
            </a>
            <!-- positions -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('elections/positions')?>" class="nav-link <?php if(isset($electionTab)){ if($electionTab == 'positions') {echo 'active';}}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Positions</p>
                </a>
              </li>
            </ul>
            <!-- candidates -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('elections/candidates')?>" class="nav-link <?php if(isset($electionTab)){ if($electionTab == 'candidates') {echo 'active';}}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Candidates</p>
                </a>
              </li>
            </ul>
            <!-- voting -->
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('elections/voting')?>" class="nav-link <?php if(isset($electionTab)){ if($electionTab == 'voting') {echo 'active';}}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Voting</p>
                </a>
              </li>
            </ul>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <?= $this->renderSection('content_header');?>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?= $this->renderSection('content');?>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date("Y"); ?> Data Driven Squad.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url();?>/dist/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url();?>/dist/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url();?>/dist/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>/dist/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url();?>/dist/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url();?>/dist/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>/dist/adminlte/js/adminlte.min.js"></script>
<!-- SweetAlert JS -->
<script src="<?= base_url();?>/js/sweetalert.min.js"></script>
<script src="<?= base_url();?>/js/sweetalert2.all.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url();?>/dist/adminlte/plugins/moment/moment.min.js"></script>
<script src="<?= base_url();?>/dist/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url();?>/dist/adminlte/plugins/daterangepicker/daterangepicker.js"></script>


<?= $this->renderSection('scripts');?>
</body>
</html>
