
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul Jenis Surat
        <small>Ubah Jenis Surat</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('jenis_surat/index/') ?>"><i class="fa fa-users"></i> Detail Jenis Surat</a></li>
        <li class="active">Ubah Jenis Surat</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Ubah Jenis Surat</h3>

          <div class="box-tools pull-right">
            <div class='btn-group' id='BtnControl'>
                <a href="<?= base_url('jenis_surat/index/'); ?>" class='btn btn-sm btn-danger' title='Kembali' data-toggle='tooltip'><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
          </div>
        </div>
        <div class="box-body">
            <div class="col-sm-12"><div class="row"><div id="proses"></div></div></div>
            <form id="FormDataUpdate" class="form-horizontal" action="#">
                <input type='hidden' name='Id' value="<?= $data->Id ?>">
                <div class='row'>
                    <div class='col-sm-3 col-md-4'>
                        <small>Catatan:
                            <ul>
                                <li><span class='text-danger'>*)</span> Wajib diisi!</li>
                            </ul>
                        </small>
                    </div>
                    <div class='col-sm-9 col-md-8'>
                        <div class="form-group"><div class='col-sm-12'><span id='ProsesCrud'></span></div></div>
                        <div class="form-group">
                            <div class='col-sm-6'>
                                <label class="control-label">Kode<span class='text-danger'>*</span></label>
                                <div class='input-group'>
                                    <span class='input-group-addon'><i class='fa fa-key'></i></span>
                                    <input readonly class='form-control FormInput' value='<?= $data->Kode ?>' type='text' autocomplete='off' placeholder='Kode' name='Kode' id='Kode'>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <label class="control-label">Jenis Surat<span class='text-danger'>*</span></label>
                               <input class='form-control FormInput' type='text' value='<?= $data->Jenis ?>' autocomplete='off' placeholder='Jenis' name='Jenis' id='Jenis'>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='col-sm-12'>
                                <label class="control-label">Keterangan</label>
                                <textarea rows='5' type='text' autocomplete=off class='form-control FormInput' name='Keterangan' id='Keterangan' placeholder='Keterangan'><?= $data->Keterangan ?></textarea>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class='btn-group'>
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-check-square"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>
        </div>
      </div>
    </section>
  </div>
  <?php $this->load->view('modul/jenis_surat/js'); ?>
