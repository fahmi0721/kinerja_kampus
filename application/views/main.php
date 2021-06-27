  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        DASHBORAD
        <small><?= $this->session->userdata('Nama') ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class='active'><i class="fa fa-clock-o"></i> <span id='Clock'><?= date("d F Y") ?></span></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
        <div class='row'>
            <div class='col-sm-12 col-md-12'>
                <div class="callout callout-success">
                    <h4><i class="icon fa fa-info"></i> SELAMAT DATANG!</h4>
                    <p>HAY <b><?= $this->session->userdata('Nama') ?></b></p>
                    <p>Apa kabarmu hari ini?, semangat bekerja ya hari ini. </p>
                </div>
            </div>
            
        </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
