
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul Indikator Penilaian
        <small>Ubah Indikator Penilaian</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('ip/') ?>"><i class="fa fa-users"></i> Detail Data Indikator Penilaian</a></li>
        <li class="active">Ubah Indikator Penilaian</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Ubah Indikator Penilaian</h3>

          <div class="box-tools pull-right">
            <div class='btn-group' id='BtnControl'>
                <a href="<?= base_url('ip/'); ?>" class='btn btn-sm btn-danger' title='Kembali' data-toggle='tooltip'><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
          </div>
        </div>
        <div class="box-body">
            <div class="col-sm-12"><div class="row"><div id="proses"></div></div></div>
            <form id="FormData" class="form-horizontal" action="#">
                <input type="hidden" name="Id" value="<?= $Item->Id; ?>">
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
                                <label class="control-label">Nama<span class='text-danger'>*</span></label>
                                <input class='form-control FormInput' value="<?= $Item->Nama; ?>" type='text' autocomplete='off' placeholder='Nama' name='Nama' id='Nama'>
                            </div>
                            <div class='col-sm-6'>
                                <label class="control-label">Bobot<span class='text-danger'>*</span></label>
                                <input class='form-control FormInput' value="<?= $Item->Bobot; ?>" type='text' autocomplete='off' placeholder='Bobot' name='Bobot' id='Bobot'>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class='col-sm-12'>
                                <label class="control-label">Keterangan</label>
                                <textarea class='form-control FormInput' rows="5" type='text' autocomplete='off' placeholder='Keterangan' name='Keterangan' id='Keterangan'><?= $Item->Keterangan; ?></textarea>
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
  <?php $this->load->view('modul/ip/edit_js'); ?>
