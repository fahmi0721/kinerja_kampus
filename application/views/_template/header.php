<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>K-FAKULTAS</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('public/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('public/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/css/datepicker3.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/css/AdminLTE.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/css/_all-skins.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/css/jquery-ui.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/js/select2-bootstrap/dist/select2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('public/js/select2-bootstrap/dist/select2-bootstrap.min.css') ?>">
  
 
  <script src="<?= base_url('public/js/jquery.min.js') ?>"></script>
  <script src="<?= base_url('public/js/jquery-ui.min.js') ?>"></script>
  <script src="<?= base_url('public/js/bootstrap.min.js') ?>"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>K-</b>FK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>K-</b>FAKULTAS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url('public/img/avatar.png') ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?= $this->session->userdata('Nama') ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url('public/img/avatar.png') ?>" class="img-circle" alt="User Image">

                <p>
                  <?= $this->session->userdata('Nama') ?>
                  <small><?= $this->session->userdata('Level') ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?= base_url('auth/logout') ?>" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    </header>