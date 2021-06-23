
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul Users
        <small>Tambah Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('jenis_surat/index/') ?>"><i class="fa fa-users"></i> Detail Data Users</a></li>
        <li class="active">Tambah Users</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Users</h3>

          <div class="box-tools pull-right">
            <div class='btn-group' id='BtnControl'>
                <a href="<?= base_url('users/index/'); ?>" class='btn btn-sm btn-danger' title='Kembali' data-toggle='tooltip'><i class='fa fa-mail-reply'></i> Kembali</a>
            </div>
          </div>
        </div>
        <div class="box-body">
            <div class="col-sm-12"><div class="row"><div id="proses"></div></div></div>
            <form id="FormData" class="form-horizontal" action="#">
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
                                <div class='input-group'>
                                    <span class='input-group-addon'><i class='fa fa-users'></i></span>
                                    <input class='form-control FormInput' type='text' autocomplete='off' placeholder='Nama' name='Nama' id='Nama'>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <label class="control-label">Username<span class='text-danger'>*</span></label>
                               <input class='form-control FormInput' type='text' autocomplete='off' placeholder='Username' name='Username' id='Username'>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class='col-sm-6'>
                                <label class="control-label">Password<span class='text-danger'>*</span></label>
                                <div class='input-group'>
                                    <span class='input-group-addon'><i class='fa fa-key'></i></span>
                                    <input class='form-control FormInput' type='text' autocomplete='off' placeholder='Password' name='Password' id='Password'>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <label class="control-label">Level<span class='text-danger'>*</span></label>
                                <select name="Level" id="Level" class='form-control FormInput'>
                                  <option value="0">Admin</option>
                                  <option value="1">Pemeriksa</option>
                                  <option value="2">Admin Fakultas</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class='col-sm-6'>
                                <label class="control-label">Faklutas</label>
                                <select name="IdFaklutas" id="IdFakultas" class='form-control FormInput'>
                                    <option value="0">Bukan Admin Fakultas</option>
                                    <?php if(count($fakultas) > 0){ ?>
                                    <?php foreach($fakultas as $key => $items){ ?>
                                        <option value="<?= $items->Id ?>"><?= $items->Nama; ?></option>
                                    <?php } } ?>
                                </select>
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
  <?php $this->load->view('modul/users/tambah_js'); ?>
