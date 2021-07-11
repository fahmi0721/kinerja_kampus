
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul Sbb Indikator Kinerja
        <small>Tambah Sub Indikator Kinerja</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('subip/') ?>"><i class="fa fa-users"></i> Detail Data Sub Indikator Kinerja</a></li>
        <li class="active">Tambah Sub Indikator Kinerja</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Sub Indikator Kinerja</h3>

          <div class="box-tools pull-right">
            <div class='btn-group' id='BtnControl'>
                <a href="<?= base_url('subip/index/'); ?>" class='btn btn-sm btn-danger' title='Kembali' data-toggle='tooltip'><i class='fa fa-mail-reply'></i> Kembali</a>
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
                                <label class="control-label">Indikator Kinerja<span class='text-danger'>*</span></label>
                                <select name="IdIp" id="IdIp" class='form-control FormInput select-ip'>
                                    <option value="">..:: Pilih Indikator Kinerja ::.. </option>
                                    <?php 
                                        if(count($Ip) > 0){
                                            foreach($Ip as $key => $idataIp){
                                                echo "<option value='".$idataIp['Id']."'>".$idataIp['Nama']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class='col-sm-6'>
                                <label class="control-label">Nama Sub Indikator<span class='text-danger'>*</span></label>
                                <input class='form-control FormInput' type='text' autocomplete='off' placeholder='Nama' name='Nama' id='Nama' placeholder="Nama  Sub Indikator">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class='col-sm-6'>
                                <label class="control-label">Key Data<span class='text-danger'>*</span></label>
                                <div class="input-group">
                                    <span class='input-group-addon'><input type="radio" name='KeyData' id="KeyData0" value='0'></span>
                                    <input type="text" class='form-control' readonly value="Tidak">
                                    <span class='input-group-addon'><input type="radio" name='KeyData' id="KeyData1" value='1' checked></span>
                                    <input type="text" class='form-control' readonly value="Ya">
                                </div>
                            </div>
                            <div class='col-sm-6'>
                                <label class="control-label">Format<span class='text-danger'>*</span></label>
                                <div class="input-group">
                                    <input type="file" accept=".xls,.xlsx" class='form-control FormInput' name='format' id="format" value="Tidak">
                                    <span class='input-group-addon'><i class="fa fa-file"></i></span>
                                </div>
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
  <?php $this->load->view('modul/subip/tambah_js'); ?>
