<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('public/img/avatar.png') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('Nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php if($this->session->userdata('KodeLevel') == 0){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i> <span>Mater Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('ip/') ?>"><i class="fa fa-circle-o"></i> Indikator Penilaian</a></li>
            <li><a href="<?= base_url('fakultas/') ?>"><i class="fa fa-circle-o"></i> Fakultas</a></li>
          </ul>
        </li>
        <?php } ?>
        <?php $aktif = $this->uri->segment(1) == "k_fakultas" ? "class='active'" : ""; ?>
        <li <?= $aktif; ?>><a href="<?= base_url('k_fakultas/') ?>"><i class="fa fa-envelope"></i> <span>K - FAKULTAS</span></a></li>
      
        <?php if($this->session->userdata('KodeLevel') == 0){ ?>
          <li class="header">MAIN SETTING</li> 
          <?php $aktif = $this->uri->segment(1) == "users" ? "class='active'" : ""; ?>
          <li><a href="<?= base_url('users/') ?>"><i class="fa fa-users"></i> <span>Users</span></a></li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>