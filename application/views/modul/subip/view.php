
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul Sub Indikator Kinerja
        <small>Data Sub Indikator Kinerja</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Sub Indikator Kinerja</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Data Sub Indikator Kinerja</h3>

          <div class="box-tools pull-right">
            <div class='btn-group' id='BtnControl'>
                <a href="<?= base_url('subip/tambah/'); ?>" class='btn btn-sm btn-primary' title='Tambah Data' data-toggle='tooltip'><i class='fa fa-plus'></i> Tambah</a>
                <button class='btn btn-sm btn-warning btn-flat' onclick="location.reload();" title='Reload' data-toggle='tooltip'><i class='fa fa-refresh'></i></button>
            </div>
          </div>
        </div>
        <div class="box-body">
            <div class="col-sm-12"><div class="row"><div id="proses"></div></div></div>
            </form>
            <div class='row'><div class='col-sm-12'>
            <div class='table-responsive'>
                <table id="tbl_users" class='table table-striped table-bordered'>
                    <thead>
                        <tr>
                            <th width='10px' class='text-center'>No</th>
                            <th>Nama</th>
                            <th>Indikator Kinerja</th>
                            <th>Key Data</th>
                            <th width='8%' class='text-center'>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id='ShowData'></tbody>
                </table> 
            </div>
            </div></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div id='Paging'></div>
        </div>
        <!-- /.box-footer-->
        <div class="overlay LoadingState" >
            <i class="fa fa-refresh fa-spin"></i>
        </div>

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class='modal fade in' id='modal' data-keyboard="false" data-backdrop="static" tabindex='0' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class="modal-header">
    <button type="button" class="close" id="close_modal" data-dismiss="modal">&times;</button>
    <h5 class="modal-title"></h5>
</div>
<div class='modal-body'>

    <div id="ModalDetail"></div>
    
    <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" onclick="SubmitDelete()"><i class="fa fa-check-square"></i> &nbsp;Hapus</button>
        <button type="button" class="btn btn-sm btn-danger" onclick="ClearModal()"><i class="fa fa-mail-reply"></i> &nbsp;Batal</button>
    </div>

</div>
</div>
</div>
</div>
<?php $this->load->view('modul/subip/view_js'); ?>