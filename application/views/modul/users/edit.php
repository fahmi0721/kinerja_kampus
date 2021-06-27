
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul Users
        <small>Ubah Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('jenis_surat/index/') ?>"><i class="fa fa-users"></i> Detail Data Users</a></li>
        <li class="active">Ubah Users</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Ubah Users</h3>

          <div class="box-tools pull-right">
            <div class='btn-group' id='BtnControl'>
                <a href="<?= base_url('users/index/'); ?>" class='btn btn-sm btn-danger' title='Kembali' data-toggle='tooltip'><i class='fa fa-mail-reply'></i> Kembali</a>
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
                                <div class='input-group'>
                                    <span class='input-group-addon'><i class='fa fa-users'></i></span>
                                    <input class='form-control FormInput' value="<?= $Item->Nama ?>" type='text' autocomplete='off' placeholder='Nama' name='Nama' id='Nama'>
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <label class="control-label">Username<span class='text-danger'>*</span></label>
                               <input class='form-control FormInput' value="<?= $Item->Username ?>" type='text' autocomplete='off' placeholder='Username' name='Username' id='Username'>
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
                                  <option value="0" <?php if($Item->Level == "0"){ echo "selected"; } ?>>Admin</option>
                                  <option value="1" <?php if($Item->Level == "1"){ echo "selected"; } ?>>Pemeriksa</option>
                                  <option value="2" <?php if($Item->Level == "2"){ echo "selected"; } ?>>Admin Fakultas</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='col-sm-6'>
                                <label class="control-label">Faklutas</label>
                                <select name="IdFakultas" id="IdFakultas" class='form-control FormInput'>
                                    <option value="0">Bukan Admin Fakultas</option>
                                    <?php if(count($fakultas) > 0){ ?>
                                    <?php foreach($fakultas as $key => $items){ 
                                      $sel = $items->Id === $Item->IdFakultas ? "selected" : "";
                                    ?>
                                        <option value="<?= $items->Id ?>" <?= $sel ?>><?= $items->Nama; ?></option>
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
  <?php $this->load->view('modul/users/edit_js'); ?>
