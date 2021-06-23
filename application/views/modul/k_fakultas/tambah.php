<?php
$CI =& get_instance();
$CI->load->library('mylib');


?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Modul K-Fakultas
        <small>Tambah K-Fakultas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?= base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= base_url('k_fakultas/index/') ?>"><i class="fa fa-users"></i> Detail Data K-Fakultas</a></li>
        <li class="active">Tambah K-Fakultas</li>

      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah K-Fakultas</h3>

          <div class="box-tools pull-right">
            <div class='btn-group' id='BtnControl'>
                <a href="<?= base_url('k_fakultas/index/'); ?>" class='btn btn-sm btn-danger' title='Kembali' data-toggle='tooltip'><i class='fa fa-mail-reply'></i> Kembali</a>
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
                                <label class="control-label">Pilih Periode<span class='text-danger'>*</span></label>
                                <select name="Periode" id="Periode" class="form-control FormInput">
                                    <option value="">Pilih Periode</option>
                                    <?php 
                                        $now = date("Y-m");
                                        for($i = "2021-05"; $i <= $now; $i++){
                                        $pisah = explode("-",$i);
                                        $bulan = $pisah[1];
                                        $tahun = $pisah[0];
                                        $uraian = $CI->mylib->getBulan($bulan)." ".$tahun;
                                    ?>
                                    <option value="<?= $i ?>"><?= $uraian ?></option>
                                    <?php } ?>
                                </select>
                                
                            </div>
                            <div class='col-sm-6'>
                                <label class="control-label">Pilih Kompetensi<span class='text-danger'>*</span></label>
                                <select name="IdKompetensi" id="IdKompetensi" class="select-kompetensi form-control FormInput">
                                    <option value="">Pilih Kompetensi</option>
                                    <?php if(count($Ip) > 0){ ?>
                                    <?php foreach($Ip as $key => $item){ ?>
                                    <option value="<?= $item['Id'] ?>"><?= $item['Nama']." [".$item['Bobot']."]" ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class='btn-group'>
                                    <button type="button" class="btn btn-sm btn-primary" id="btnTambah"><i class="fa fa-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class='col-sm-12'>
                                <div class='table-responsive'>
                                    <table class='table table-bordered table-striped'>
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="8px">No</th>
                                                <th>Indikator Kompetensi</th>
                                                <th class="text-center" width="15%">Periode</th>
                                                <th class="text-center" width="10%">Bobot</th>
                                                <th class="text-center" width="8%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tData"></tbody>
                                    </table> 
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
  <?php $this->load->view('modul/k_fakultas/tambah_js'); ?>
